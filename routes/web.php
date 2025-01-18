<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// トップページ
Route::get('/top', [PostsController::class, 'index'])->name('top');

// プロフィール関連
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// 認証関連
require __DIR__ . '/auth.php';

//フォローリストページルーティング
Route::get('/follows', [FollowsController::class, 'followList'])->name('follows.list');
//フォロワーリストページルーティング
Route::get('/followers', [FollowsController::class, 'followerList'])->name('followers.list');
//ユーザー検索ページルーティング
Route::get('/search', [UsersController::class, 'search'])->name('search');


// フォロー関連
Route::post('/users/{user}/follow', [FollowsController::class, 'follow'])->name('users.follow');
Route::post('/users/{user}/unfollow', [FollowsController::class, 'unfollow'])->name('users.unfollow');
// Route::get('/follows', [FollowsController::class, 'list'])->name('follows.list');
// Route::get('/followers', [FollowsController::class, 'listFollowers'])->name('followers.list');

// 検索関連
// Route::get('/search/users', [UsersController::class, 'index'])->name('search.users');

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 投稿
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
