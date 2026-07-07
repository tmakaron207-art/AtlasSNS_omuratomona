<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{
    //
    public function index(){


    // ☆☆投稿内容を取得↓
    // $posts = Post::all();



    // フォロー中ユーザーのIDを取得
    $followingIds = Auth::user()
        ->follows()
        ->pluck('users.id');

    // 自分のIDを追加
    $followingIds->push(Auth::id());

    // 自分とフォロー中ユーザーの投稿を取得
    $posts = Post::whereIn('user_id', $followingIds)
        ->orderBy('created_at', 'desc')
        ->get();



    return view('posts.index',compact('posts'));
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

    return redirect('/top');
    }



    // ☆☆投稿削除用コントローラ↓
    public function destroy($id)
    {
    $post = Post::find($id);

    if ($post->user_id == Auth::id()) {
        $post->delete();
    }

    return redirect('/top');
    }

// ☆☆投稿編集用コントローラ↓
    public function update(Request $request){
    $request -> validate(['post'=>'required|min:1|max:150',],
    ['post.required' => '編集内容を入力してください',
    'post.min' => '1文字以上で入力してください',
    'post.max' => '150文字以内で入力してください',]);

    $post=Post::find($request->id);

    if ($post->user_id!=Auth::id())
        {return redirect ('/top');}
    $post->post=$request->post;
    $post->save();

    return redirect ('/top');
}

}
