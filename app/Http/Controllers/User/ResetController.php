<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ResetMailRequest;
use App\Http\Requests\ResetPassRequest;
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
     * パスワードリセットメールの送信を要求
     */ 
    public function resetMail(ResetMailRequest $request) {

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
        }
    }

    /**
     * パスワード再設定画面を表示
     */ 
    public function showResetPasswordForm($token, $email) {
        
        return view('reset_password/reset_password_form', ['token' => $token, 'email' => $email]);
    }

    /**
     * パスワード再設定
     */ 
    public function resetPassword(ResetPassRequest $request) {
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route(('login'))->with('message.success', 'パスワードを再設定しました。新しいパスワードでログインしてください。');
        } else {
            return back()->with('message.error', __($status));
        }

    }
}
