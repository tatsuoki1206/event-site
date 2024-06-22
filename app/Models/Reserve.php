<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

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
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'event_name',
        'num',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'tel',
        'tel1',
        'tel2',
        'tel3',
        'email',
        'message',
    ];

    /**
     * メールアドレスと電話番号がマッチした予約データを返す
     * @param string $email
     * @return object
     */
    public function getUserByInput($event_name, $tel, $email){
        return Reserve::where('email', '=', $event_name)
                    ->where('email', '=', $email)
                    ->where('tel', '=', $tel)->first();
    }

    /**
     * 予約情報を登録する
     * @param object $user
     * @param bool
     */
    public function ticketReserve($inputs){
        
        \DB::beginTransaction();
        try {
           
            // 予約情報を登録
            Reserve::create($inputs);
            
            \DB::commit();
            return true;
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
            return false;
        }
    }
}
