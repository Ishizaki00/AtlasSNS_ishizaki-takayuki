<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // 投稿一覧表示
    public function index()
    {
        // 「desc」は降順に並べる、「asc」 だと昇順
        // ログインユーザーのIDを取得
    $userId = Auth::id();

    // ログインユーザーがフォローしているユーザーのIDを取得
    $followingIds = Auth::user()->followings()->pluck('users.id');

    // フォローしているユーザー + 自分の投稿を取得
    $posts = Post::whereIn('user_id', $followingIds) // フォローしているユーザーの投稿
                 ->orWhere('user_id', $userId) // 自分の投稿
                 ->orderBy('created_at', 'desc') // 作成日時の降順に並べる
                 ->get();

    return view('posts.index', compact('posts'));
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    // フォローリスト
    public function followList()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('follows.followList', compact('posts'));
    }

    // 投稿保存処理
    public function store(Request $request)
{
    // バリデーション
    $request->validate([
        'post' => 'required|string|max:150', // ✅ 'post' に統一
    ], [
        'post.required' => '投稿内容を入力してください。',
        'post.string' => '投稿内容は文字列で入力してください。',
        'post.max' => '投稿内容は150文字以内で入力してください。',
    ]);

    $id = Auth::id(); // ログインユーザーIDを取得

    // 投稿データをデータベースに保存
    Post::create([
        'post' => $request->input('post'), // ✅ 'post' に保存
        'user_id' => $id,
    ]);

    return redirect()->route('posts.index');
}


    // 投稿の編集
public function update(Request $request, $post)
{
    $request->validate([
        'post' => 'required|string|max:150', // ✅ 'post' に統一
    ], [
        'post.required' => '投稿内容を入力してください。',
        'post.string' => '投稿内容は文字列で入力してください。',
        'post.max' => '投稿内容は150文字以内で入力してください。',
    ]);

    $post = Post::findOrFail($post);
    $post->update(['post' => $request->post]); // ✅ 'post' を更新

    return redirect()->route('posts.index')->with('success', '投稿を更新しました！');
}


    // 投稿の削除
public function destroy($id)
{
    $post = Post::findOrFail($id);

    // 投稿がログインユーザーのものであれば削除
    if (Auth::id() === $post->user_id) {
        $post->delete();
    }

    return back()->with('success', '投稿を削除しました。');
}
    // ↑idはデータベースのカラム名、$id は、メソッドの引数として渡される値です。この値は、ルートパラメータ（{id}）から受け取った、削除したい投稿のIDを表す
}
