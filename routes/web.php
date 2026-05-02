<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

// ☆ログアウトのための宣言↓
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

Route::get('top', [PostsController::class, 'index']);

Route::get('profile', [ProfileController::class, 'profile']);

Route::get('search', [UsersController::class, 'index']);

Route::get('follow-list', [PostsController::class, 'index']);
Route::get('follower-list', [PostsController::class, 'index']);


// ☆ホーム、プロフィール画面へ飛ぶルーティング設定↓
    Route::get('/top',function(){
        return view('posts.index');
    })->name('top');
    Route::get('/profile',function(){
        return view('profiles.profile');
    })->name('profile');

    // ☆ログアウトのルーティング設定↓
    Route::post('/logout',[AuthenticatedSessionController::class,'destroy'])->name('logout');
