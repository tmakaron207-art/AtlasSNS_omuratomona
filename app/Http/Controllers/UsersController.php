<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
// 検索フォームのコントロール設定
    public function search(Request $request){
        $keyword=$request->keyword;
// ユーザー名限定で、あいまい検索の設定↓
        $users=User::WHERE('username','like','%'.$keyword.'%')
        ->get();
// 検索結果を検索画面に渡す↓
        return view('users.search',compact('users'));

        // return view('users.search');
    }



}
