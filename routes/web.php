<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

// ☆ログアウトのための宣言↓
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// フォロー用の宣言
use App\Http\Controllers\FollowsController;

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


    // ☆ログイン後のアクセス制限のルーティング処理↓
    Route::middleware('auth')->group(function(){
        Route::get('/top',function(){
            return view('posts.index');
        })->name('top');

        Route::get('/profile',function(){
            return view('profiles.profile');
        })->name('profile');

        Route::get('/search',function(){
            return view('users.search');
        })->name('search');

        Route::get('/follow-list',function(){
            return view('follows.followList');
        })->name('follow-list');

        Route::get('/follower-list',function(){
            return view('follows.followerList');
        })->name('follower-list');

        Route::get('/user/{id}',function(){
            return view('user_profile');
        });
    });

    // ☆ログインしてない人はログインページへ自動的にいくルート設定↓
    Route::get('/login',function(){
        return view('auth.login');
    })->name('login');


    // ☆投稿フォームのルート設定↓
    Route::post('top', [PostsController::class, 'store']);

    // ☆投稿内容を表示させるためのルート設定↓
    Route::get('top', [PostsController::class, 'index'])
    ->name('top');

    // ☆投稿削除用のルート↓
    Route::delete('/post/{id}', [PostsController::class, 'destroy'])
    ->name('post.destroy');

    // 編集更新処理用のルート↓
    Route::post('/post/update',[PostsController::class,'update'])
    ->name('post.update');

    // 検索用のルート
    Route::get('/search',[UsersController::class,'search'])
    ->name('users.search');

    // 検索ページのフォローする用のルート
    Route::post('/follow/{id}', [FollowsController::class, 'follow'])
    ->name('user.follows');

    // 検索ページのフォロー削除用のルート
      Route::delete('/unfollow/{id}', [FollowsController::class, 'unfollow'])
    ->name('user.unfollows');

    // フォローユーザーのアイコンを表示させるルート
    Route::get('/follow-list',[FollowsController::class,'followList']);

    // フォローユーザーの投稿を表示させるルート
    Route::get('/follow-list', [FollowsController::class, 'index']);

    // フォロワーユーザーのアイコンを表示させるルート
    Route::get('/follower-list',[FollowsController::class,'followerList']);

     // フォロワーユーザーの投稿を表示させるルート
    Route::get('/follower-list', [FollowsController::class, 'followerindex']);
