<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Channel;
use App\Watch;
use App\Room;
use App\Comment;
use Validator;

class SyncController extends Controller
{
    // ダッシュボード表示(index.blade.php)
    public function index()
    {
        $x = date("Y-m-d H:i:s",strtotime("-4 week"));
        $channels = Channel::orderBy('created_at', 'asc')->get();
        $watches = Watch::where('created_at', '>=', $x)->orderBy('created_at', 'asc')->get();
        return view('index', ['channels' => $channels, 'watches' => $watches]);
    }
    public function confirm()
    {

        return view('confirm');
    }

    //chat表示(chat.blade.php)
    public function room($id)
    {
        $user1 = Auth::id();
        $user2 = $id;
        if ($user1 <= $user2) {
            $room = Room::firstOrCreate(['user1' => $user1, 'user2' => $user2]);
        }else{
            $room = Room::firstOrCreate(['user1' => $user2, 'user2' => $user1]);
        }

        return view('chat', ['room' => $room]);
    }

    //watchをstore
    public function store_watch(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'watch' => 'required|string|min:11|max:11|unique:watches',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        /// 取得するYoutube動画ＩＤ
$video_id = $request->watch;
/// Youtube動画のURL
$video_url = 'https://www.youtube.com/watch?v='.$video_id;

/// oEmebdからメタ情報取得して表示
$oembed_url = "https://www.youtube.com/oembed?url={$video_url}&format=json";
$ch = curl_init( $oembed_url );
curl_setopt_array( $ch, [
  CURLOPT_RETURNTRANSFER => 1
] );
$resp = curl_exec( $ch );

$metas = json_decode( $resp, true );

// echo 'タイトル : '.$metas['title'].'<br>';
// echo 'サムネURL : '.$metas['thumbnail_url'].'<br>';
// echo '作者名 : '.$metas['author_name'].'<br>';
// echo 'チャンネルURL : '.$metas['author_url'].'<br>';
// echo '幅 : '.$metas['width'].'ピクセル, ';
// echo '高さ : '.$metas['height'].'ピクセル';
        // Eloquentモデル
        $watches = new Watch;
        $watches->watch = $request->watch;
        $watches->author= $metas['author_name'];
        $watches->title= $metas['title'];
        $watches->user_id = Auth::id();
        $watches->user_name=Auth::user()['name'];
        $watches->save();
        return redirect('/');
    }


    //channelをstore
    public function store_channel(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'channel' => 'required|string|min:24|max:24|starts_with:UC|unique:channels',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // Eloquentモデル
        $channels = new Channel;
        $channels->channel = $request->channel;
        $channels->user_id = Auth::id();
        $channels->save();
        return redirect('/');
    }
}
