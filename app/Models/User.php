<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        'name',
        'email',
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

    /**
     * ユーザー情報を登録する
     * @param object $user
     * @param bool
     */
    public function signupUser($inputs){
        
        // パスワードのハッシュ化
        $inputs['password'] = Hash::make($inputs['password']);
        
        \DB::beginTransaction();
        try {
            // ユーザを登録
            User::create($inputs);
            \DB::commit();
            return true;
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
            return false;
        }
    }

    /**
     * ユーザー情報を更新する
     * @param object $user
     * @param bool
     */
    public function editUser($inputs){
        
        \DB::beginTransaction();
        try {
            // ユーザ情報を更新
            $user = User::find($inputs['id']);

            $user->fill([
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'password' => Hash::make($inputs['password']),
            ]);
            $user->save();
            \DB::commit();
            return true;

        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
            return false;
        }

    }

    /**
     * ユーザー情報を削除する
     * @param object $user
     * @param bool
     */
    public function deleteUser($id){
        
        if(empty($id)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('login'));
        }

        try{
            // ユーザーを退会
            User::destroy($id);
        } catch(\Throwable $e){
            // エラーで500ページに遷移
            abort(500);
        }
    }

    /**
     * パスワードを●に変換して確認画面に表示する
     * @param object $password 
     */
    public function strPassword($password){

        $str_password = "";
        $count_password = strlen($password);

        for($i = 0 ; $i < $count_password; $i++){
            $str_password = "●".$str_password;
        }
        
        return $str_password;
    }
}
