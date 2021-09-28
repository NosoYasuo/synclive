<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Channel;
use App\Watch;
use App\Comment;
use Validator;

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
        return view('mypage');
    }
}
