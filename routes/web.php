<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// ログインフォームの表示
Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
// ログイン処理
Route::post('login', [AuthController::class, 'login'])->name('login');

// ホーム画面
Route::get('home', function() {
    return view('home');
})->name('home');
