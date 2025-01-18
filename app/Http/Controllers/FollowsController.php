<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class FollowsController extends Controller
// {
//     //
//     public function followList(){
//         // ログインユーザーがフォローしているユーザーを取得
//         // $follows = Auth::user()->follows()->get();

//         return view('follows.followList');
//     }
//     public function followerList(){
//         return view('follows.followerList');
//     }
// }
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Authファサードをuse
use App\Models\Post;

class FollowsController extends Controller
{
    public function followList()
    {
        // ログインユーザーがフォローしているユーザーを取得
        $followings = Auth::user()->followings;

        // フォローしているユーザーの投稿をすべて取得
        $posts = Post::whereIn('user_id', $followings->pluck('id'))->orderBy('created_at', 'desc')->get();

        return view('follows.followList', compact('posts'));
    }

    public function followerList()
    {
        return view('follows.followerList');
    }
}
