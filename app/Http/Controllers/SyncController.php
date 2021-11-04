<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Channel;
use App\Watch;
use App\Room;
use App\Comment;
use Validator;
use App\Tag;

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


            // // preg_match_allを使用して#タグのついた文字列を取得している
            // preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);

            // $tags = [];
            // // $matchの中でも#が付いていない方を使用する(配列番号で言うと1)
            // foreach($match[1] as $tag) {
            //     // firstOrCreateで重複を防ぎながらタグを作成している。
            //     $record = Tag::firstOrCreate(['name' => $tag]);
            //     array_push($tags, $record);
            // }

    //     $tags_id = [];
    //    foreach($tags as $tag) {
    //        array_push($tags_id, $tag->id);
    //    }
    $watches = new Watch;

    $watches->insert(['auther' => 'author{{$watch->id}}', 'title' => 'title{{$watch->id}}',
    'user_name' =>'user_name:{{$watch->user->name}}']);

        $watches->watch = $request->watch;
        $watches->user_id = Auth::id();
        $watches->save();
        // タグはpostがsaveされた後にattachするように。//
    //    $watches->tags()->attach($tags_id);

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
