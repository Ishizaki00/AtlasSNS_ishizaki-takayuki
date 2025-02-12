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
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'bio' => 'nullable|string',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        return redirect()->route('profile')->with('success', 'プロフィールを更新しました。');
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
