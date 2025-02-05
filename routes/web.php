<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Route;

// 認証が必要なルート（ログインしていないと移動できないないページ）
Route::middleware('auth')->group(function () {
    // トップページ
    Route::get('/top', [PostsController::class, 'index'])->name('top');

    // プロフィール関連
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // プロフィールの表示（プロフィール編集画面）
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    // プロフィール編集画面
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // プロフィール更新
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // 検索ページ
    Route::get('/search', [UsersController::class, 'search'])->name('search');

    // フォロー関連
    Route::get('/follows', [FollowsController::class, 'followList'])->name('follows.list');
    Route::get('/followers', [FollowsController::class, 'followerList'])->name('followers.list');
    Route::post('/users/{user}/follow', [FollowsController::class, 'follow'])->name('users.follow');
    Route::post('/users/{user}/unfollow', [FollowsController::class, 'unfollow'])->name('users.unfollow');

    // 投稿関連
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::resource('posts', PostsController::class);
    //投稿編集
    Route::put('/posts/update/{id}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/update/{id}', [PostsController::class, 'delete'])->name('posts.delete');
});


// 認証関連
require __DIR__ . '/auth.php';

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
