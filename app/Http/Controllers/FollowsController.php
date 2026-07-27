<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    // ☆画面に表示をさせる設定↓
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
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
}
