<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
    public function profile(){
        return view('profiles.profile');
    }

    //追記
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'required|string|min:8|confirmed',
            'bio' => 'nullable|string',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->bio = $request->input('bio');

        // アイコン画像の処理
        if ($request->hasFile('icon_image')) {
            $path = $request->file('icon_image')->store('public/icons');
            $user->icon_image = basename($path);
        }

        $user->save();

        return redirect('/top')->with('success', 'プロフィールが更新されました');
    }
    //追記
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
