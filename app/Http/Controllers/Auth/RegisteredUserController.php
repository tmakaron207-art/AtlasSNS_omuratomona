<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ☆バリデーション
        $request -> validate([
            'username' => 'required|string|min:2|max:12',
            'email' => 'required|email|min:5|max:40|unique:users,email',
            'password' => 'required|alpha_num|min:8|max:20|confirmed',
        ],[
            'username.required' => '名前は必須です','username.min' => 'ユーザー名は2文字以上で入力してください','username.max' => 'ユーザー名は12文字以内で入力してください',
            'email.required' => 'メールアドレスは必須です','email.email' => '正しいメールアドレスを入力してください','email.unique' => 'このメールアドレスはすでに使われています',
            'password.required' => 'パスワードは必須です','password.alpha_num' => 'パスワードは半角英数字で入力してください','password.min' => 'パスワードは8文字以上で入力してください','password.max' => 'パスワードは20文字以内で入力してください','password.confirmed' => 'パスワードが一致していません',

        ]);


        // ☆登録処理
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // return redirect('added');

        // ☆完了後のユーザー名表示
        return redirect('/added')->with('username', $user->username);

    }

    public function added(): View
    {
        return view('auth.added');
    }
}
