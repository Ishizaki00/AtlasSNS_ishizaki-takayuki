<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){
        // ログインユーザーがフォローしているユーザーを取得
        // $follows = Auth::user()->follows()->get();

        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
}
