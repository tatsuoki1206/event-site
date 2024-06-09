<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ResetFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ResetController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * パスワードリセット画面を表示
     */ 
    public function showPasswordReset() {
        return view( 'reset.reset_form' );
    }

    /**
     * パスワードリセット処理
     */ 
    public function passwordReset(ResetFormRequest $request) {

        // 入力したメールアドレスが既に存在をしているかをチェック
        $inputs = $request->all();

        $user = $this->user->getUserByEmail($inputs['email']);
        
        if(!is_null($user)){

            $status = Password::sendResetLink(
                $request->only('email')
            );
            
            // リクエストメールを送信する
            if($status === Password::RESET_LINK_SENT){
                back()->with(['status' => __($status)]);
                return redirect()->route('reset_complete.show');
                
            } else {
                return back()->withErrors(['email' => __($status)]);
                
            }
            
            /*
            return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
            */
        }
    }
}
