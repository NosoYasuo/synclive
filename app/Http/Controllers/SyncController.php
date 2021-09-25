<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Channel;
use App\Watch;
use App\Comment;
use Validator;

class SyncController extends Controller
{
    // ダッシュボード表示(index.blade.php)
    public function index(){
        $channels = Channel::orderBy('created_at', 'asc')->get();
        $watches = Watch::orderBy('created_at', 'asc')->get();

        return view('index', ['channels' => $channels, 'watches' => $watches]);
    }

    //chat表示(chat.blade.php)
    public function chat(){
        $comments = Comment::get();
        return view('chat', ['comments' => $comments]);

    }

    //chatをDBに保存(chat.blade.php)
    public function store_chat(Request $request){
        $user = Auth::user();
        $comment = $request->input('comment');
        Comment::create([
            'login_id' => $user->id,
            'name' => $user->name,
            'comment' => $comment
        ]);
        return redirect('chat');
    }

    //api通信
    public function getData()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $json = ["comments" => $comments];
        return response()->json($json);
    }

    //watchをstore
    public function store_watch(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'watch_id' => 'required|max:255',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // Eloquentモデル
        $watches = new Watch;
        $watches->watch = $request->watch_id;
        $watches->users_id = "1";
        $watches->save();
        return redirect('/');
    }

    //channelをstore
    public function store_channel(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'channel_id' => 'required|max:255',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // Eloquentモデル
        $channels = new Channel;
        $channels->channel = $request->channel_id;
        $channels->users_id = "1";
        $channels->save();
        return redirect('/');
    }




}
