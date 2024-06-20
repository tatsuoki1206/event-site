<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_name',
        'num',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'tel',
        'email',
        'message',
    ];

    /**
     * メールアドレスと電話番号がマッチした予約データを返す
     * @param string $email
     * @return object
     */
    public function getUserByInput($tel, $email){
        return Reserve::where('email', '=', $email)
                    ->where('tel', '=', $tel)->first();
    }
}
