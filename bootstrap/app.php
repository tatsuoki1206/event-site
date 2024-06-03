<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Laravel11 非認証ユーザーはログイン画面へリダイレクト
        $middleware->redirectGuestsTo('/');
        //$middleware->redirectGuestsTo(fn (Request $request) => route('login.show'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
