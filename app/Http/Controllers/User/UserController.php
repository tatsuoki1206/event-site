<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\SignupFormRequest;
use App\Http\Requests\EditUserFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        return view( 'signup.signup_form' );
    }

    /**
     * 新規登録確認画面に遷移、表示
     * @param App\Http\Requests\SignupFormRequest $request
     * @return \Illuminate\Http\Response
     */ 
    public function signupConfirm(SignupFormRequest $request) {
        // 入力したメールアドレスが既に存在をしているかをチェック
        $inputs = $request->all();

        $user = $this->user->getUserByEmail($inputs['email']);

        // 確認画面にパスワードを●で表示
        $inputs['str_password'] = $this->user->strPassword($inputs['password']);

        if (is_null($user)){
            // POSTされた値を取得し、確認画面を表示
            return view('signup.signup_confirm', [
                'inputs' => $inputs,
            ]);
        }

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

        $inputs = $request->all();
        
        // ボタン分岐
        if(!empty($inputs['back'])){
            return redirect()->route('signup.show')->withInput($inputs);
        }
        
        // 入力内容を取得
        $inputs = $request->all();
        
        // DBに登録
        $return = $this->user->signupUser($inputs);
        
        // 登録完了
        return redirect()->route('signup_complete.show')->with( 'success', 'ユーザーの登録が完了しました！' );
    }

    /**
     * 編集フォーム画面を表示
     */
    public function showEdit($id) {
        
        $inputs = User::find($id);
        
        return view( 'edit.edit_form', ['inputs' => $inputs] );
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
            return view('edit.edit_confirm', [
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
        return view( 'delete.delete_confirm' );
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
        
        Session::flash('success','退会完了しました。');
        return redirect()->route( 'delete_complete.show' )->with( 'success', '退会完了しました。' );
        
    }

}
