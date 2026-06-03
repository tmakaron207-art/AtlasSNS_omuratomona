<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }


    // ☆☆投稿フォーム用コントローラ設定↓
    $request->validate([
    'post' => 'required|min:1|max:150',
    ],
    ['post.required' => '投稿内容を入力してください',
    'post.min' => '1文字以上で入力してください',
    'post.max' => '150文字以内で入力してください',]);

    // ☆☆投稿保存用
    post::create(['user_id' => Auth::id(),
    'post' => $request->post,
    ]);
}
