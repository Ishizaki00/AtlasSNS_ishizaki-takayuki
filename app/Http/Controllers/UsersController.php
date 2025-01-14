<?php

namespace App\Http\Controllers;

use App\Models\User; // Userモデルをインポート
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; // Authファサードをuse

class UsersController extends Controller
{
    public function search()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // 自分以外のユーザーを取得

        // dd($users);デバックuser情報が送られているか確認


        return view('users.search', compact('users')); // ビューにデータを渡す。ビュー名を修正
    }
}
