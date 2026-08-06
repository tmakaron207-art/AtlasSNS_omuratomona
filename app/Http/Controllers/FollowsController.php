<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class FollowsController extends Controller
{
    // ☆画面に表示をさせる設定↓
    //
    // フォロー
    public function followList(){

    $followUsers = Auth::user()->follows;

        return view('follows.followList',compact('followUsers'));
    }

    // フォロワー
    public function followerList(){

    $followers=Auth::user()->followers;

        return view('follows.followerList',compact('followers'));
    }

// フォロー登録の設定
    public function follow($id)
    {
    Follow::create([
        'following_id' => Auth::id(),
        'followed_id' => $id,
    ]);

        return redirect()->back();
    }

    // フォロー削除の設定
    public function unfollow($id)
    {
        Follow::where('following_id',Auth::id())
        ->where('followed_id',$id)
        ->delete();

        return redirect()->back();
    }


    // フォローしているユーザーのみ投稿見れる設定
    public function index(){

    // フォロー中ユーザーのIDを取得
    $followingIds = Auth::user()
        ->follows()
        ->pluck('users.id');

    // 自分とフォロー中ユーザーの投稿を取得
    $posts = Post::whereIn('user_id', $followingIds)
        ->orderBy('created_at', 'desc')
        ->get();

        // フォロー中ユーザーのアイコン表示用
    $followUsers = Auth::user()->follows;


    return view('follows.followList',compact('posts','followUsers'));
    }



    // フォロワーリストのユーザー投稿のみ見れる設定
    public function followerindex(){
        // 自分がフォローされているユーザー取得
        $followerIds=Auth::user()->followers()->pluck('users.id');

        // 自分とフォロー中ユーザーの投稿を取得
    $posts = Post::whereIn('user_id', $followerIds)
        ->orderBy('created_at', 'desc')
        ->get();

         // フォロー中ユーザーのアイコン表示用
    $followerUsers = Auth::user()->followers;

    return view('follows.followerList',compact('posts','followerUsers'));

    }
}
