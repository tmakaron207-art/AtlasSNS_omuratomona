<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }



    // ☆☆投稿フォーム用コントローラ設定↓
    public function store (Request $request)
    {$request->validate([
    'post' => 'required|min:1|max:150',
    ],
    ['post.required' => '投稿内容を入力してください',
    'post.min' => '1文字以上で入力してください',
    'post.max' => '150文字以内で入力してください',]);

    // ☆☆投稿保存用
    Post::create(['user_id' => Auth::id(),
    'post' => $request->post,
    ]);

    // return redirect('/top');
    }
}
