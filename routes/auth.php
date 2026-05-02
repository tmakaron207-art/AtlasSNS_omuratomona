<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create']);
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create']);
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('added', [RegisteredUserController::class, 'added']);
    Route::post('added', [RegisteredUserController::class, 'added']);

    // ☆ユーザー名を登録した後に表示させるルーティング処理↓
    Route::get('/added', function () {
    return view('auth.added');
});

// ☆ログイン後のアクセス制限のルーティング処理↓
    Route::middleware('auth')->group(function(){
        Route::get('/top',function(){
            return view('top');
        });

        Route::get('/profile',function(){
            return view('profile');
        });

        Route::get('/search',function(){
            return view('search');
        });

        Route::get('/follow-list',function(){
            return view('follow-list');
        });

        Route::get('/follower-list',function(){
            return view('follower-list');
        });

        Route::get('/user/{id}',function(){
            return view('user_profile');
        });
    });

    // ☆ログインした人はログインページいかないルート設定↓
    // Route::get('/login',function(){
    //     return view('login');
    // })->middleware('guest');







});
