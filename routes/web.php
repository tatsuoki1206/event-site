<?php

use Illuminate\Support\Facades\Route;
// 管理サイト
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\Image\ImageController;
// ユーザーサイト
use App\Http\Controllers\Ticket\ReserveController;

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
      return view('admin.home');
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
      return view('admin.signup.signup_complete');
  })->name('signup_complete.show');
  
});

/**
 * パスワードリセット処理を行う
 */
Route::group(['middleware' => ['guest']], function () {
  
  // リセット画面を表示
  Route::get('reset', [ResetController::class, 'showPasswordReset'])->name('reset.show');
  
  // リセットメール送信
  Route::post('reset', [ResetController::class, 'resetMail'])->name('resetMail');

  // リセットメール送信完了画面表示
  Route::get('reset/complete', function() {
    return view('admin.reset.reset_complete');
  })->name('reset_complete.show');

  // パスワード再設定画面を表示
  Route::get('reset_password/{token}/{email}', [ResetController::class, 'showResetPasswordForm'])->name('reset_password.show');

  // パスワード再設定を実施
  Route::post('reset_password', [ResetController::class, 'resetPassword'])->name('resetPassword');

  // パスワード再設定完了画面表示
  Route::get('reset_password/complete', function() {
    return view('admin.reset_password.reset_password_complete');
  })->name('reset_password_complete.show');

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
  Route::post('delete/complete', [UserController::class, 'delete'])->name('deleteComplete');

});

Route::group(['middleware' => ['guest']], function () {
  // 退会完了画面
  Route::get('delete/delete_complete', function() {
    return view('admin.delete.delete_complete');
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

/**
 * 予約管理画面
 */
Route::group(['middleware' => ['auth']], function () {
    Route::get('reserveList', [ReserveController::class, 'showReserveList'])->name('reserve_list.show');
    // 予約情報編集

    // 予約情報
    Route::post('reserveList/delete', [ReserveController::class, 'deleteReserve'])->name('deleteReserve');
});

/**
 * チケット予約
 */
// 予約画面に遷移
Route::get('reserve', [ReserveController::class, 'showReserveForm'])->name('reserve_form.show');

// 予約確認画面に遷移
Route::post('reserve/confirm', [ReserveController::class, 'reserveConfirm'])->name('reserveConfirm');

// 予約登録処理、完了画面または入力画面へ遷移
Route::post('reserve/complete', [ReserveController::class, 'reserveRegister'])->name('reserveRegister');

// 予約完了画面を表示
Route::get('reserve/complete', function() {
      return view('users.reserve.reserve_complete');
})->name('reserve_complete.show');

/**
 * チケット予約内容編集
 */
// 予約編集画面に遷移
Route::get('reserve/edit/{id}', [ReserveController::class, 'showEditReserveForm'])->name('editReserve_form.show');

// 予約編集確認画面に遷移
Route::post('reserve/edit/confirm', [ReserveController::class, 'editReserveConfirm'])->name('editReserveConfirm');

// 予約編集登録処理、完了画面または入力画面へ遷移
Route::post('reserve/edit/complete', [ReserveController::class, 'editReserveRegister'])->name('editReserveRegister');

// 予約編集完了画面を表示
Route::get('reserve/edit/complete', function() {
      return view('users.reserve.edit.editReserve_complete');
})->name('editReserve_complete.show');