<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locked_flg',
        'error_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            //'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Emailがマッチしたユーザを返す
     * @param string $email
     * @return object
     */
    public function getUserByEmail($email){
        return User::where('email', '=', $email)->first();
    }

    /**
     * アカウントがロックされているか？
     * @param object $user
     * @return bool
     */
    public function isAccountLocked($user){
        if($user->locked_flg === 1){
            return true;
        }

        return false;
    }

    /**
     * エラーカウントをリセットする
     * @param object $user
     */
    public function resetErrorCount($user){
        // 2.成功した場合エラーカウントを0にする
        if($user->error_count > 0){
            $user->error_count = 0;
            $user->save();
        }

    }

    /**
     * エラーカウントを1増やす
     * @param int $error_count
     * @return int 
     */
    public function addErrorCount($error_count){
        return $error_count+1;
    }

    /**
     * アカウントをロックする
     * @param object $user
     * @param bool
     */
    public function lockAccount($user){
        
        if($user->error_count  > 5){
            // エラーカウント6回でロックフラグを立てる
            $user->locked_flg = 1;
            return $user->save();
        }
        return false;
    }
}
