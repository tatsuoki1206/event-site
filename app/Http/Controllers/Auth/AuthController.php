<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\LoginFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * @return View
     * ログイン画面を表示
     */
    public function showLogin() {
        return view( 'login.login_form' );
    }

    /**
    * @param App\Http\Requests\LoginFormRequest $request
    */

    public function login( LoginFormRequest $request ) {
        $credentials = $request->only('id', 'email', 'password');

        // 1.emailが存在するかを確認
        $user = $this->user->getUserByEmail($credentials['email']);

        if (!is_null($user)){
            // アカウントロックされているかを確認
            if($this->user->isAccountLocked($user)){
                return back()->withErrors( [
                    'danger' => 'アカウントがロックされています',
                ] );
            }

            if ( Auth::attempt( $credentials ) ) {
                $request->session()->regenerate();

                // 2.成功した場合エラーカウントを0に戻す
                $this->user->resetErrorCount($user);

                return redirect()->route( 'home' )->with( 'success', 'ログイン成功しました！' );
            }
            // 3.ログイン失敗したらエラーカウントを1増やす
            $user->error_count = $this->user->addErrorCount($user->error_count);

            // 4.エラーカウントが6でアカウントをロックする
            if($this->user->lockAccount($user)){
                return back()->withErrors( [
                    'danger' => 'アカウントがロックされました。解除したい場合は運営者に連絡してください。',
                ] );
            }
            $user->save();
        }

        return back()->withErrors( [
            'danger' => 'メールアドレスかパスワードが間違っています。',
        ] );
    }

    /**
    * ユーザーをアプリケーションからログアウトさせる
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function logout( Request $request ) {
        Auth::logout();

        $request->session()->invalidate();
        // ボタン連打による2重送信を防ぐ
        $request->session()->regenerateToken();
        // 名前付きルートのURLを生成
        return redirect()->route('login.show')->with( 'danger', 'ログアウトしました！' );
    }
}
