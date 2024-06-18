<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetMailRequest;
use App\Http\Requests\ResetPassRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Password_reset_token;

class ResetController extends Controller
{
    public function __construct(User $user, Password_reset_token $reset_user){
        $this->user = $user;
        $this->password_reset_token = $reset_user;
    }

    /**
     * パスワードリセット画面を表示
     */ 
    public function showPasswordReset() {
        return view( 'admin.reset.reset_form' );
    }

    /**
     * パスワードリセットメールの送信を要求
     * @param ResetMailRequest $request
     * @return \Illuminate\Http\Response
     */ 
    public function resetMail(ResetMailRequest $request) {

        // 入力したメールアドレスが既に存在をしているかをチェック
        $inputs = $request->all();

        $user = $this->user->getUserByEmail($inputs['email']);
        
        if(!is_null($user)){

            $status = Password::sendResetLink(
                $request->only('email')
            );
            
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
     * @param string $token, $email
     * @return \Illuminate\Http\Response
     */ 
    public function showResetPasswordForm($token, $email) {
        
        // emailからパスワードリセット情報があるか（まだ1度も再設定してないか）
        $reset_user = $this->password_reset_token->getResetUserByEmail($email);
        // 現在の時間を取得し、有効期限が過ぎてないか
        $now = Carbon::now();

        if(!is_null($reset_user) && $now <= $reset_user['expire_at']){
                // 条件を満たしていればパスワード再設定画面を表示
                return view('admin.reset_password.reset_password_form', ['token' => $token, 'email' => $email]);
        }
        
        // それ以外の場合は別の画面にリダイレクト
        return redirect()->route(('login.show'))->with('danger', '既にパスワード再設定済み、またはURLが有効期限切れです。再度パスワード再設定が必要な場合は、パスワードリセットをご依頼ください。');
    }

    /**
     * パスワード再設定を実施
     * @param ResetPassRequest $request
     * @return \Illuminate\Http\Response
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
            return redirect()->route(('reset_password_complete.show'))->with('success', 'パスワードを再設定しました。新しいパスワードでログインしてください。');
        } else {
            $status = "本ページのURL発行から60分経過した為、パスワードを設定できません。再度パスワード再設定が必要な場合は、パスワードリセットをご依頼ください。";
            return back()->with('danger', __($status));
        }

    }
}
