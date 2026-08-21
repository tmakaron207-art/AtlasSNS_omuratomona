<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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


    // ログインユーザーのプロフィール画面編集用設定
    public function edit(){
        $user=Auth::user();
        return view ('profiles.profile',compact('user'));
    }


    // ログインユーザーのプロフィール画面更新用設定
    public function update(Request $request){
        $user = Auth::user();

        $request -> validate([
            'username' => 'required|string|min:2|max:12',
            'email' => 'required|email|min:5|max:40|unique:users,email,' . $user->id,
            'password' => 'required|alpha_num|min:8|max:20|confirmed',
        ],[
            'username.required' => '名前は必須です',
            'username.min' => 'ユーザー名は2文字以上で入力してください','username.max' => 'ユーザー名は12文字以内で入力してください',

            'email.required' => 'メールアドレスは必須です',
            'email.email' => '正しいメールアドレスを入力してください','email.unique' => 'このメールアドレスはすでに使われています',

            'password.required' => 'パスワードは必須です',
            'password.alpha_num' => 'パスワードは半角英数字で入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください','password.max' => 'パスワードは20文字以内で入力してください',
            'password.confirmed' => 'パスワードが一致していません',

        ]);

// username・emailを$userに保存する
        $user->username = $request->username;
        $user->email = $request->email;
        $user->bio = $request->bio;

// パスワードが入力された場合だけ変更
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

// アイコン画像が選択された場合
    if ($request->hasFile('images')) {

        $image = $request->file('images');

        $filename = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('images'), $filename);

        $user->icon_image = $filename;
    }

    $user->save();

    return redirect()->route('profile');


    }


}
