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
// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // Authファサードをuse
// use App\Models\Post;

// class FollowsController extends Controller
// {
//     public function followList()
//     {
//         // ログインユーザーがフォローしているユーザーを取得
//         $followings = Auth::user()->followings;

//         // フォローしているユーザーの投稿をすべて取得
//         return view('follows.followList', compact('posts'));
//     }

//     public function followerList()
//     {
//         return view('follows.followerList');
//     }
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    public function followList()
    {
        $user = Auth::user();
        $followings = $user->followings;
        $posts = collect(); // 空のコレクションで初期化

        foreach ($followings as $following) {
            $posts = $posts->merge($following->posts);
        }

        $posts = $posts->sortByDesc('created_at');

        return view('follows.followList', compact('posts', 'followings'));
    }

    public function followerList()
    {
        $user = Auth::user();
        $followers = $user->followers;

        return view('follows.followerList', compact('followers'));

    }

    public function follow(User $user)
    {
        Auth::user()->followings()->attach($user->id);
        return back(); // またはリダイレクト先を指定
    }

    public function unfollow(User $user)
    {
        Auth::user()->followings()->detach($user->id);
        return back(); // またはリダイレクト先を指定
    }
}
