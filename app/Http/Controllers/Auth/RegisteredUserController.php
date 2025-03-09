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
        ], [
    'username.required' => 'ユーザー名は必須です。',
        'username.string' => 'ユーザー名は文字列で入力してください。',
        'username.min' => 'ユーザー名は2文字以上で入力してください。',
        'username.max' => 'ユーザー名は12文字以内で入力してください。',

        'email.required' => 'メールアドレスは必須です。',
        'email.string' => 'メールアドレスは文字列で入力してください。',
        'email.email' => '有効なメールアドレスを入力してください。',
        'email.max' => 'メールアドレスは40文字以内で入力してください。',
        'email.min' => 'メールアドレスは5文字以上で入力してください。',
        'email.unique' => 'このメールアドレスはすでに登録されています。',

        'password.required' => 'パスワードは必須です。',
        'password.string' => 'パスワードは文字列で入力してください。',
        'password.regex' => 'パスワードは英数字のみ使用できます。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは20文字以内で入力してください。',
        'password.confirmed' => 'パスワードが確認用と一致しません。',

        'password_confirmation.required' => '確認用パスワードは必須です。',
        'password_confirmation.string' => '確認用パスワードは文字列で入力してください。',
        'password_confirmation.regex' => '確認用パスワードは英数字のみ使用できます。',
        'password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
        'password_confirmation.max' => '確認用パスワードは20文字以内で入力してください。',
        'password_confirmation.same' => '確認用パスワードが一致しません。',
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
