<?php
//User.php（Userモデル）は他のモデルとのリレーションを定義する。
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // フォロウ機能
    //フォローを行った人のリレーション
    Public function followings()
    {
        return $this->belongsToMany(
            User::class, // ① User モデルの場所
            'follows',         // ② 中間テーブル名（小文字にするのが一般的）
            'following_id',         // ③ 中間テーブルの自分の ID が入るカラム
            'followed_id' // ④ 中間テーブルの相手モデルに関係しているカラム
        );
    }

    //フォローをされた人用のリレーション
    Public function followers()
    {
        return $this->belongsToMany(
            User::class, // ① User モデルの場所
            'follows',         // ② 中間テーブル名（小文字にするのが一般的）
            'followed_id',         // ③ 中間テーブルの自分の ID が入るカラム
            'following_id' // ④ 中間テーブルの相手モデルに関係しているカラム
        );
    }

    public function isFollowing(User $user)
    {
        return $this->followings()->where('followed_id', $user->id)->exists();
    }
}
