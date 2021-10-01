<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Channel;
use App\Watch;
use App\Comment;
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // ダッシュボード表示
    public function userpage($id)
    {
        $user = User::find($id);
        return view('userpage', ['user' => $user]);
    }


    // ダッシュボード表示
    public function mypage()
    {
        $watches = Watch::where ('user_id',Auth::id())->get();
        $channels = Channel::where('user_id', Auth::id())->get();
        // $comments = Comment::whereIn('id', function ($query) {
        //     $query->select(DB::raw('MAX(id) As id'))->from('comments')->groupBy('ToUserId');
        //     })->get();
        // $comments = Comment::where('ToUserId', Auth::id())->groupBy('login_id')->first();
        // $aa = Comment::where(['login_id', 'ToUserId'], Auth::id())->get();
        // $aa = Comment::whereRaw('`login_id` = ? OR ToUserId = ?', [Auth::id(), Auth::id()])->get();
        // dd($comments);
        // where('login_id', '!=', Auth::id())
        // $aa = Comment::select(DB::raw('MAX(id) As id'))->from('comments')->groupBy('login_id');
        // $aa = Comment::whereIn('id', function ($query) {
        //     $query->select(DB::raw('MAX(id) As id'))->from('comments')->groupBy('ToUserId');
        // })->where('login_id', '!=', Auth::id())->get();
        // dd($aa);

        $comment = Comment::where('recipient_id', Auth::id())->orderBy('id', 'desc')->first();
        // dd($comment);
        return view('mypage', ['watches' => $watches, 'comment' =>$comment, 'channels' => $channels]);
    }


}
