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
        'tel1',
        'tel2',
        'tel3',
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
     * @param object $inputs
     * @param bool
     */
    public function ticketReserve($inputs){
        
        \DB::beginTransaction();
        try {
            // 予約情報を登録、予約変更・取消URL用のidを取得
            $reserve = Reserve::create($inputs);
            $id = $reserve->id;

            \DB::commit();
            return $id;
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
            return false;
        }
        
    }

    /**
     * 既存の予約データを取得
     * @param object $id
     * @param $inputs
     */
    public function getReserveById($id){
        return Reserve::find($id);
    }

    /**
     * 予約情報の変更を反映する
     * @param object $inputs
     * @param bool
     */
    public function editTicketReserve($inputs){
        

        \DB::beginTransaction();
        try {
            // 予約情報を更新
            $reserve = Reserve::find($inputs['id']);
            $reserve->update($inputs);

            \DB::commit();
            return true;
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
            return false;
        }
        
    }

    /**
     * 予約情報を削除する
     * @param object $user
     * @param bool
     */
    public function dbDeleteReserve($id){
        
        if(empty($id)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('login'));
        }

        try{
            // 予約情報を削除する
            Reserve::destroy($id);
        } catch(\Throwable $e){
            // エラーで500ページに遷移
            abort(500);
        }
    }
}
