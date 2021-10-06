<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Channel;
use App\Watch;
use App\Comment;
use App\Room;
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // userpageダッシュボード表示
    public function userpage($id)
    {
        $user = User::find($id);

        $watches = Watch::where('user_id', $id)->get();
        $channels = Channel::where('user_id', $id)->get();

        return view('userpage', ['user' => $user, 'watches' => $watches, 'channels' => $channels]);
    }


    // ダッシュボード表示
    public function mypage()
    {
        $watches = Watch::where ('user_id',Auth::id())->get();
        $channels = Channel::where('user_id', Auth::id())->get();

        $rooms =  Room::where('user2', Auth::id())->orwhere('user1', Auth::id())->orderBy('id', 'desc')->get();
        $room = Room::find(5);
        return view('mypage', ['watches' => $watches, 'rooms' => $rooms, 'channels' => $channels]);
    }

    //chatをDBに保存(chat.blade.php)
    public function store_chat(Request $request)
    {
        $user = Auth::user();
        $comment = $request->comment;
        $recipient_id = $request->recipient_id;
        $room_id = $request->room_id;

        // Eloquentモデル
        $comments = new Comment;
        $comments->sender_id = $user->id;
        $comments->sender_name = $user->name;
        $comments->comment = $comment;
        $comments->recipient_id = $recipient_id;
        $comments->room_id = $room_id;
        $comments->save();
        return redirect('/room/' . $recipient_id);
        // return response()->json();
    }

    //api通信
    public function getData(Request $request)
    {
        $comments = Comment::whereIn('sender_id', [$request->id1, $request->id2])->whereIn('recipient_id', [$request->id1, $request->id2])->orderBy('created_at', 'desc')->get();
        // $comments = Comment::whereIn('login_id', [Auth::id(), $request->id])->orderBy('created_at', 'desc')->get();
        $json = ["comments" => $comments];
        return response()->json($json);
    }

    //プロフィール更新
    public function edit_prof(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'profile' => 'max:191',
            'avail_time' => 'max:191',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $users = User::find(Auth::id());
        $users->profile = $request->profile;
        $users->avail_time = $request->avail_time;
        $users->price = $request->price;
        $users->save();

        return redirect('mypage');
    }


}
