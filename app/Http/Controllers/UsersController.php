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
        $user = User::with(['posts' => function ($query) {
        $query->orderBy('created_at', 'desc'); // 投稿を新しい順に並べる
        }])->findOrFail($id);

        return view('profiles.user-profile', compact('user'));
    }

public function update(Request $request)
{
    // バリデーション
    $request->validate([
        'username' => 'required|string|min:2|max:12', // 必須、文字列、2〜12文字
        'email' => 'required|string|email|max:40|min:5|unique:users,email,' . Auth::id(), // 必須、メール形式、一意
        'password' => 'nullable|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20', // 任意、英数字のみ、8〜20文字
        'password_confirmation' => 'nullable|string|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|same:password', // パスワード一致
        'bio' => 'nullable|string|max:150', // 自己紹介、最大150文字
        'icon_image' => 'nullable|image|mimes:jpg,png,bmp,gif,svg', // 画像ファイル形式
    ], [
        // ユーザー名エラーメッセージ
        'username.required' => 'ユーザー名は必須です。',
        'username.string' => 'ユーザー名は文字列で入力してください。',
        'username.min' => 'ユーザー名は2文字以上で入力してください。',
        'username.max' => 'ユーザー名は12文字以内で入力してください。',

        // メールアドレスエラーメッセージ
        'email.required' => 'メールアドレスは必須です。',
        'email.string' => 'メールアドレスは文字列で入力してください。',
        'email.email' => '有効なメールアドレスを入力してください。',
        'email.max' => 'メールアドレスは40文字以内で入力してください。',
        'email.min' => 'メールアドレスは5文字以上で入力してください。',
        'email.unique' => 'このメールアドレスはすでに登録されています。',

        // パスワードエラーメッセージ
        'password.string' => 'パスワードは文字列で入力してください。',
        'password.regex' => 'パスワードは英数字のみ使用できます。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは20文字以内で入力してください。',
        'password.confirmed' => 'パスワードが確認用と一致しません。',

        // 確認用パスワードエラーメッセージ
        'password_confirmation.required' => '確認用パスワードは必須です。',
        'password_confirmation.string' => '確認用パスワードは文字列で入力してください。',
        'password_confirmation.regex' => '確認用パスワードは英数字のみ使用できます。',
        'password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
        'password_confirmation.max' => '確認用パスワードは20文字以内で入力してください。',
        'password_confirmation.same' => '確認用パスワードが一致しません。',

        // 自己紹介エラーメッセージ
        'bio.max' => '自己紹介は150文字以内で入力してください。',

        // アイコン画像エラーメッセージ
        'icon_image.image' => 'アイコン画像は画像形式である必要があります。',
        'icon_image.mimes' => 'アイコン画像はjpg、png、bmp、gif、またはsvg形式である必要があります。',
    ]);

    // バリデーションが成功したら、ユーザーの更新処理を行う
    $user = Auth::user();
    $user->update([
        'username' => $request->username,
        'email' => $request->email,
        'bio' => $request->bio,
    ]);

    // パスワード更新がある場合、処理を行う
    if ($request->password) {
        $user->update([
            'password' => bcrypt($request->password),
        ]);
    }

    // アイコン画像の更新
    if ($request->hasFile('icon_image')) {
        $path = $request->file('icon_image')->storeAs('public/icons', $user->id . '.' . $request->file('icon_image')->getClientOriginalExtension());
        $user->update([
            'icon_image' => basename($path),
        ]);
    }

    // 更新後にトップページへリダイレクト
    return redirect()->route('profile.show', $user->id)->with('success', 'プロフィールが更新されました！');
}


}
