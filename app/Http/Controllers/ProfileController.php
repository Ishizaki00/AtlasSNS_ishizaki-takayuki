<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profiles.profile');
    }

    // 追記
    public function update(Request $request)
    {
        $request->validate([
    // UserName: 入力必須、2文字以上、12文字以内
    'username' => 'required|string|min:2|max:12',

    // MailAddress: 入力必須、5文字以上、40文字以内、登録済みメールアドレス使用不可（自分のメールアドレスは除く）、メールアドレスの形式
    'email' => 'required|string|email|min:5|max:40|unique:users,email,' . Auth::id(),

    // NewPassword: 入力必須、英数字のみ、8文字以上、20文字以内
    'password' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',

    // NewPasswordConfirmation: 入力必須、英数字のみ、8文字以上、20文字以内、Passwordと一致
    'password_confirmation' => 'required|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|same:password',

    // Bio: 150文字以内
    'bio' => 'nullable|string|max:150',

    // IconImage: 画像（jpg、png、bmp、gif、svg）のみ
    'icon_image' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
], [
    'username.required' => 'ユーザー名は必須です。',
    'username.string' => 'ユーザー名は文字列で入力してください。',
    'username.min' => 'ユーザー名は2文字以上で入力してください。',
    'username.max' => 'ユーザー名は12文字以内で入力してください。',

    'email.required' => 'メールアドレスは必須です。',
    'email.string' => 'メールアドレスは文字列で入力してください。',
    'email.email' => '有効なメールアドレスを入力してください。',
    'email.min' => 'メールアドレスは5文字以上で入力してください。',
    'email.max' => 'メールアドレスは40文字以内で入力してください。',
    'email.unique' => 'このメールアドレスはすでに登録されています。',

    'password.required' => 'パスワードは必須です。',
    'password.string' => 'パスワードは文字列で入力してください。',
    'password.regex' => 'パスワードは英数字のみ使用できます。',
    'password.min' => 'パスワードは8文字以上で入力してください。',
    'password.max' => 'パスワードは20文字以内で入力してください。',

    'password_confirmation.required' => '確認用パスワードは必須です。',
    'password_confirmation.string' => '確認用パスワードは文字列で入力してください。',
    'password_confirmation.regex' => '確認用パスワードは英数字のみ使用できます。',
    'password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
    'password_confirmation.max' => '確認用パスワードは20文字以内で入力してください。',
    'password_confirmation.same' => '確認用パスワードが一致しません。',

    'bio.max' => '自己紹介は150文字以内で入力してください。',
    'icon_image.image' => 'アイコン画像は画像ファイルでなければなりません。',
    'icon_image.mimes' => 'アイコン画像はjpg, png, bmp, gif, svg形式の画像ファイルでなければなりません。',
]);


        $user = Auth::user();

        // ユーザー情報の更新
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // アイコン画像のアップロード処理
        if ($request->hasFile('icon_image')) {

            // 新しいアイコンを保存
            $file = $request->file('icon_image');
            $filename = 'icon_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/icons', $filename);

            // ユーザーモデルにファイル名を保存
            $user->icon_image = $filename;
        }

        $user->save();

        return redirect()->route('top')->with('success', 'プロフィールを更新しました。');
    }

    // 追記
    public function edit()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // 'profile' ビューに 'user' データを渡して表示
        return view('profiles.profile', compact('user'));
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_user_id', 'user_id');
    }
}
