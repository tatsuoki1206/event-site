<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * create()メソッドで保存するカラムを指定
     * @var array<int, string>
     */
    protected $fillable = [
        'file_name',
        'file_path',
        'description',
    ];

    /**
     * 画像イメージを登録する
     * @param object $user
     * @param bool
     */
    public function dbPostImage($file_name, $save_path, $description){
        
        \DB::beginTransaction();
        try {
            // 画像を登録
            Image::create([
                'file_name' => $file_name,
                'file_path' => $save_path,
                'description' => $description,
            ]);
            \DB::commit();
            return true;
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
            return false;
        }
    }

    /**
     * 画像データを削除する
     * @param object $user
     * @param bool
     */
    public function dbDeleteImage($id){
        
        if(empty($id)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('login'));
        }

        try{
            // 画像データを削除
            Image::destroy($id);
        } catch(\Throwable $e){
            // エラーで500ページに遷移
            abort(500);
        }
    }
}
