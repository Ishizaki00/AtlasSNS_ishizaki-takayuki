<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // マスアサインメントを許可するカラムを定義
    protected $fillable = ['user_id','post'];

    // 投稿に紐付いたユーザー情報を取得するリレーション
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
