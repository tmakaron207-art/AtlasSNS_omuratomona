<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// 追加
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
// 検索フォームのコントロール設定
    public function search(Request $request){
        $keyword=$request->keyword;
// ユーザー名限定で、あいまい検索の設定↓
        $users=User::WHERE('username','like','%'.$keyword.'%')
        ->where('id', '!=', Auth::id())
        ->get();
// 検索結果を検索画面に渡す↓
        return view('users.search',compact('users','keyword'));

        // return view('users.search');
    }


    // 相手のユーザープロフィールページ
    public function profile($id){
        $user=User::findOrFail($id);

        // 投稿を取得する処理
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        return view ('users.userprofile',compact('user','posts'));
    }



}
