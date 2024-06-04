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
     * 会員登録画面を表示
     */ 
    public function showSignup() {
        return view( 'signup.signup_form' );
    }

    /**
     * 編集画面を表示
     */
    public function showEdit() {
        return view( 'edit.edit_form' );
    }

    /**
     * 退会確認画面を表示
     */
    public function showDeleteConfirm() {
        return view( 'delete.delete_confirm' );
    }


    /**
     * ユーザーを新規登録する
     * @param App\Http\Requests\SignupFormRequest $request
     * @return \Illuminate\Http\Response
    */
    public function signup(SignupFormRequest $request){

        // 入力内容を取得
        $inputs = $request->all();
        
        // DBに登録
        $return = $this->user->signupUser($inputs);
        
        // 登録完了
        return redirect()->route('signup_complete.show')->with( 'success', 'ユーザーの登録が完了しました！' );
    }

    /**
     * ユーザ情報を編集する
     * @param App\Http\Requests\EditUserFormRequest $request
     * @return \Illuminate\Http\Response
     */

     public function edit(EditUserFormRequest $request){

        // 入力内容を取得
        $inputs = $request->all();
        
        // DBを更新
        $return = $this->user->editUser($inputs);
                
        // 更新完了
        return redirect()->route( 'home' )->with( 'success', 'ユーザー情報を更新しました！' );
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

        \Session::flash('err_msg','退会完了しました。');
        return redirect(route('delete_complete.show'));
    }

}
