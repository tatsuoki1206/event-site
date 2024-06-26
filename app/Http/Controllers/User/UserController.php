<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\SignupFormRequest;
use App\Http\Requests\EditUserFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserSignup;
use App\Mail\UserDelete;
Use Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * 新規登録画面を表示
     */ 
    public function showSignup() {
        return view( 'admin.signup.signup_form' );
    }

    /**
     * 新規登録確認画面に遷移、表示
     * @param App\Http\Requests\SignupFormRequest $request
     * @return \Illuminate\Http\Response
     */ 
    public function signupConfirm(SignupFormRequest $request) {
        
        // 入力値を取得
        $inputs = $request->all();
        // 入力したメールアドレスが既に存在をしているかをチェック
        $user = $this->user->getUserByEmail($inputs['email']);

        // 確認画面にパスワードを●で表示
        $inputs['str_password'] = $this->user->strPassword($inputs['password']);

        // メールアドレスが存在してない場合
        if (is_null($user)){
            // POSTされた値を取得し、確認画面を表示
            return view('admin.signup.signup_confirm', [
                'inputs' => $inputs,
            ]);
        }

        // メールアドレスが存在してる場合
        return back()->withErrors( [
            'danger' => '入力されたメールアドレスは既に登録済みです。',
        ] )->withInput($inputs);
    }

    /**
     * ユーザーを新規登録処理をする
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function signup(Request $request){

        // 入力内容を取得
        $inputs = $request->all();
        
        // ボタン分岐
        if(!empty($inputs['back'])){
            return redirect()->route('signup.show')->withInput($inputs);
        }
        
        // DBに登録
        $return = $this->user->signupUser($inputs);
        
        // 登録完了メールを送信
        $to = [
            ['email' => $inputs['email'], ]
        ];

        Mail::to($to)->send(new UserSignup($inputs['name']));
        
        // 登録完了
        return redirect()->route('signup_complete.show')->with( 'success', 'ユーザーの登録が完了しました！' );
    }

    /**
     * 編集フォーム画面を表示
     */
    public function showEdit($id) {
        
        // ユーザー情報を取得
        $inputs = $this->user->getUserById($id);
        
        return view( 'admin.edit.edit_form', ['inputs' => $inputs] );
    }

    /**
     * 編集確認画面に遷移、表示
     * @param App\Http\Requests\EditUserFormRequest $request
     * @return \Illuminate\Http\Response
     */ 
    public function editConfirm(EditUserFormRequest $request) {

        // 入力したメールアドレスが既に存在をしているかをチェック
        $inputs = $request->all();

        $user = $this->user->getUserByEmail($inputs['email']);

        // 確認画面にパスワードを●で表示
        $inputs['str_password'] = $this->user->strPassword($inputs['password']);

        // 入力したメールアドレスが現在のメールアドレスと同じ時も、確認画面へ遷移
        $my_user = User::find($inputs['id']);
        
        if (is_null($user) || $inputs['email'] === $my_user['email']){
            // POSTされた値を取得し、確認画面を表示
            return view('admin.edit.edit_confirm', [
                'inputs' => $inputs,
            ]);
        }

        return back()->withErrors( [
            'danger' => '入力されたメールアドレスは既に登録済みです。',
        ] )->withInput($inputs);
    }

    /**
     * ユーザ情報を編集する
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function edit(Request $request){

        $inputs = $request->all();
        
        // ボタン分岐
        if(!empty($inputs['back'])){
            return redirect()->route('edit.show', ['id' => $inputs['id']])->withInput($inputs);
        }
        
        // DBを更新
        $return = $this->user->editUser($inputs);
                
        // 更新完了
        return redirect()->route( 'home' )->with( 'success', 'ユーザー情報を更新しました！' );
    }

    /**
     * 退会確認画面を表示
     */
    public function showDeleteConfirm() {
        return view( 'admin.delete.delete_confirm' );
    }

    /**
     * ユーザを退会する
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){

        $data= $request->all();

        // DBから削除
        $return = $this->user->deleteUser($data['id']);

        // 退会完了メールを送信
        $to = [
            ['email' => $data['email'], ]
        ];
    
        Mail::to($to)->send(new UserDelete($data['name']));
        
        return redirect()->route( 'delete_complete.show' )->with( 'success', '退会完了しました。' );
        
    }

}
