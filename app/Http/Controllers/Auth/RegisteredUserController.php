<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //バリデーション
        $request->validate([
            'username' => 'required|string|min:2|max:12', // 必須、文字列、2〜12文字
            'email' => 'required|string|email|max:40|min:5|unique:users,email', // 必須、メール形式、一意
            'password' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20', // 必須、英数字のみ、8〜20文字
            'password_confirmation' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|same:password', // パスワード一致
        ]);


        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ユーザー名をセッションに保存
        session(['registered_username' => $user->username]);
        //登録完了ページにリダイレクト
        return redirect('added');
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
