<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FollowController;
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

// フォロー関連
Route::get('/follows', [FollowController::class, 'list'])->name('follows.list');
Route::get('/followers', [FollowController::class, 'listFollowers'])->name('followers.list');

// 検索関連
Route::get('/search/users', [UsersController::class, 'index'])->name('search.users');
Route::get('/search/posts', [SearchController::class, 'index'])->name('search.posts');

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 投稿
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
