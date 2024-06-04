<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;

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
// 新規登録フォームの表示
Route::get('signup', [UserController::class, 'showSignup'])->name('signup.show');
    
// 新規登録処理
Route::post('signup', [UserController::class, 'signup'])->name('signup');
    
// 登録完了画面
Route::get('signup/signup_complete', function() {
    return view('signup/signup_complete');
})->name('signup_complete.show');


/**
 *  ユーザ情報を編集 
 * */   
// 編集フォームの表示
Route::get('edit', [UserController::class, 'showEdit'])->name('edit.show');
    
// 編集処理
Route::post('edit', [UserController::class, 'edit'])->name('edit');


/**
 *  ユーザを退会
 */
// 退会確認画面の表示
Route::get('delete', [UserController::class, 'showDeleteConfirm'])->name('delete_confirm.show');
    
// 退会処理
Route::post('delete', [UserController::class, 'delete'])->name('delete');

// 退会完了画面
Route::get('delete/delete_complete', function() {
    return view('delete/delete_complete');
})->name('delete_complete.show');