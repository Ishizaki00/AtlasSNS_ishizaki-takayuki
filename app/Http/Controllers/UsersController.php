<?php

namespace App\Http\Controllers;

use App\Models\User; // Userモデルをインポート
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; // Authファサードをuse

class UsersController extends Controller
{
    // public function search()
    // {
    //     // $users = User::where('id', '!=', Auth::id())->get(); // 自分以外のユーザーを取得

    //     // // dd($users);デバックuser情報が送られているか確認


    //     // return view('users.search', compact('users')); // ビューにデータを渡す。ビュー名を修正
    // }
    public function search(Request $request) // ← 🔹 Request を引数に追加
    {
        // 🔹 検索ワードを取得
        $query = $request->input('query'); // ← ここで $request を使えるようになる

        // 🔹 検索ワードがある場合、該当するユーザーを検索
        if ($query) {
            $users = User::where('username', 'LIKE', "%{$query}%")->get();
        } else {
            // 🔹 検索ワードがない場合、全ユーザーを取得
            $users = User::all();
        }

        return view('users.search', compact('users', 'query')); // ← 🔹 検索ワードもビューに渡す
    }

    public function show($id)
    {
        $user = User::with('posts')->findOrFail($id); // ユーザー情報と投稿を取得
        return view('profiles.user-profile', compact('user'));  //表示ページprofiles>user-profile.bladeを表示
    }

}
