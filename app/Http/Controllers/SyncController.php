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
    public function index()
    {
        $channels = Channel::orderBy('created_at', 'asc')->get();
        $watches = Watch::orderBy('created_at', 'asc')->get();

        return view('index', ['channels' => $channels, 'watches' => $watches]);
    }

    //chat表示(chat.blade.php)
    public function chat($id)
    {
        return view('chat', ['id' => $id]);
    }

    //chatをDBに保存(chat.blade.php)
    public function store_chat(Request $request)
    {
        $user = Auth::user();
        $comment = $request->comment;
        $to_user_id = $request->to_user_id;

        Comment::create([
            'login_id' => $user->id,
            'name' => $user->name,
            'comment' => $comment,
            'ToUserId' => $to_user_id
        ]);
        return redirect('/chat/' . $to_user_id);
        // return response()->json();
    }

    //api通信
    public function getData(Request $request)
    {
        $comments = Comment::whereIn('login_id', [Auth::id(), $request->id])->whereIn('ToUserId', [Auth::id(), $request->id])->orderBy('created_at', 'desc')->get();
        // $comments = Comment::whereIn('login_id', [Auth::id(), $request->id])->orderBy('created_at', 'desc')->get();
        $json = ["comments" => $comments];
        return response()->json($json);
    }

    //watchをstore
    public function store_watch(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'watch_id' => 'required|min:11|max:11',
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
        $watches->user_id = Auth::id();
        $watches->save();
        return redirect('/');
    }

    //channelをstore
    public function store_channel(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'channel_id' => 'required|min:24|max:24|starts_with:UC',
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
        $channels->user_id = Auth::id();
        $channels->save();
        return redirect('/');
    }
}
