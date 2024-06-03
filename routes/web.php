<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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