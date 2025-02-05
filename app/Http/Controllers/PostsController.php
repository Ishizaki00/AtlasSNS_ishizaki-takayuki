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
        $posts = Post::orderBy('created_at', 'desc')->get();
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
            'content' => 'required|max:150',
        ]);

        $id = Auth::id(); //ログインユーザーIDを取得

        // 投稿データをデータベースに保存
        Post::create([
            'post' => $request->input('content'), // 投稿内容
            'user_id' => $id, //27行目$idを持ってくる
        ]);

        // 投稿一覧ページへリダイレクト
        return redirect()->route('posts.index');
    }

    // 投稿の編集
    public function update(Request $request, $id)
    {
        // 投稿を取得(findOrFail($id) は 指定した ID の投稿を取得)
        $post = Post::findOrFail($id);
     // dd($post);

        // 投稿内容の更新
        $post->update(['post' => $request->content]);
        return redirect('/top')->with('success', '投稿を更新しました！');
    }
    // 投稿の削除
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }
    // ↑idはデータベースのカラム名、$id は、メソッドの引数として渡される値です。この値は、ルートパラメータ（{id}）から受け取った、削除したい投稿のIDを表す
}
