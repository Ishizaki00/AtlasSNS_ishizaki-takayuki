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
        // UserName: 入力必須, 2〜12文字
        'username' => 'required|string|min:2|max:12',

        // MailAddress: 入力必須, 5〜40文字, メール形式, 自分以外の重複不可
        'email' => 'required|string|email|min:5|max:40|unique:users,email,' . Auth::id(),

        // NewPassword: 入力必須, 8〜20文字, 英数字のみ
        'password' => [
            'required',
            'string',
            'min:8',
            'max:20',
            'regex:/^[a-zA-Z0-9]+$/', // 半角英数字のみ
            'confirmed', // password_confirmation と一致するかチェック
        ],

        // NewPasswordConfirmation: 入力必須, 8〜20文字, 英数字のみ, Password と一致
        'password_confirmation' => [
            'required',
            'string',
            'min:8',
            'max:20',
            'regex:/^[a-zA-Z0-9]+$/', // 半角英数字のみ
        ],

        // Bio: 150文字以内
        'bio' => 'nullable|string|max:150',

        // IconImage: 画像のみ (jpg, png, bmp, gif, svg)
        'icon_image' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',

        // 更新ボタンを押したらtopページに移動
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
