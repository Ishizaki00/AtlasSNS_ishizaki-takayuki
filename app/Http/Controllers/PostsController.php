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
        'content' => 'required|string|max:150',
    ], [
        'content.required' => '投稿内容を入力してください。',
        'content.string' => '投稿内容は文字列で入力してください。',
        'content.max' => '投稿内容は150文字以内で入力してください。',
    ]);

        $id = Auth::id(); //ログインユーザーIDを取得

        // 投稿データをデータベースに保存
        Post::create([
            'content' => $request->input('content'), // 修正１投稿内容
            'user_id' => $id, //27行目$idを持ってくる
        ]);

        // 投稿一覧ページへリダイレクト
        return redirect()->route('posts.index');
    }

    // 投稿の編集
    public function update(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string|max:150',
    ], [
        'content.required' => '投稿内容を入力してください。',
        'content.string' => '投稿内容は文字列で入力してください。',
        'content.max' => '投稿内容は150文字以内で入力してください。',
    ]);

    $post = Post::findOrFail($id); // IDに該当する投稿を取得

    // 投稿内容を更新
    $post->update(['post' => $request->content]);

    return redirect()->route('posts.index')->with('success', '投稿を更新しました！');
}

    // 投稿の削除
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('top');
    }
    // ↑idはデータベースのカラム名、$id は、メソッドの引数として渡される値です。この値は、ルートパラメータ（{id}）から受け取った、削除したい投稿のIDを表す
}
