<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\Image\ImageController;

/**
 * ログイン処理を行う
 */
//ログイン前
Route::group(['middleware' => ['guest']], function () {
    // ログインフォーム表示
    Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
    // ログイン処理
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

//ログイン後
Route::group(['middleware' => ['auth']], function () {
    // ホーム画面
    Route::get('home', function() {
      return view('home');
    })->name('home');
    // ログアウト
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


/**
 *  ユーザ情報を新規登録  
 * */

 Route::group(['middleware' => ['guest']], function () {
  // 新規登録フォームの表示
  Route::get('signup', [UserController::class, 'showSignup'])->name('signup.show');
  
  // 確認画面に遷移
  Route::post('signup/confirm', [UserController::class, 'signupConfirm'])->name('signupConfirm');

  // 新規登録処理、完了画面または入力画面へ遷移
  Route::post('signup/complete', [UserController::class, 'signup'])->name('signupRegister');

  // 登録完了画面を表示
  Route::get('signup/complete', function() {
      return view('signup/signup_complete');
  })->name('signup_complete.show');
  
});

/**
 * パスワードリセット処理を行う
 */
Route::group(['middleware' => ['guest']], function () {
  
  // リセット画面を表示
  Route::get('reset', [ResetController::class, 'showPasswordReset'])->name('reset.show');
  
  // リセットメール送信
  Route::post('reset', [ResetController::class, 'passwordReset'])->name('reset');

  // リセットメール送信完了画面表示
  Route::get('reset/complete', function() {
    return view('reset/reset_complete');
  })->name('reset_complete.show');

  // パスワード再設定画面

  // パスワード再設定完了
});

/**
 *  ユーザ情報を編集 
 * */

Route::group(['middleware' => ['auth']], function () {
  // 編集フォームの表示
  Route::get('edit/{id}', [UserController::class, 'showEdit'])->name('edit.show');

  // 編集確認画面に遷移
  Route::post('edit/confirm', [UserController::class, 'editConfirm'])->name('editConfirm');

  // 編集処理
  Route::post('edit/complete', [UserController::class, 'edit'])->name('editRegister');
});

/**
 *  ユーザを退会
 */

Route::group(['middleware' => ['auth']], function () {
  // 退会確認画面の表示
  Route::get('delete', [UserController::class, 'showDeleteConfirm'])->name('delete_confirm.show');
    
  // 退会処理
  Route::post('delete', [UserController::class, 'delete'])->name('delete');

  // 退会完了画面
  Route::get('delete/delete_complete', function() {
    return view('delete/delete_complete');
  })->name('delete_complete.show');
});

/**
 *  画像の投稿・削除・編集
 */
// 画像一覧画面の表示
Route::group(['middleware' => ['auth']], function () {
  Route::get('image', [ImageController::class, 'showImageList'])->name('image_list.show');

  // 画像アップロード画面の表示
  Route::get('image/upload', [ImageController::class, 'showImageForm'])->name('image_form.show');

  // 画像アップロード処理
  Route::post('image', [ImageController::class, 'imagePost'])->name('image');

  // 画像削除処理
  Route::post('image/delete', [ImageController::class, 'deleteImage'])->name('deleteImage');
});