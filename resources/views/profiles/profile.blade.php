<x-login-layout>


<div class="profile-edit">

<!-- ☆バリデーションエラーメッセージ -->
@if ($errors -> any())
<ul class="error-messege">
    @foreach ($errors -> all() as $error)
    <li>{{$error}}</li>
    @endforeach
</ul>
@endif


<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-icon">
@if(Auth::user()->icon_image)
    <img src="{{ asset('images/' . Auth::user()->icon_image) }}" alt="ユーザーアイコン" class="user-icon">
    @else
    <img src="{{ asset('images/icon1.png') }}" class="user-icon">
    @endif



    <div class="form-info">
    <!-- ユーザー名 -->
        <div class="form-item">
            <label>ユーザー名</label>

            <input type="text" name="username" value="{{ $user->username }}">
        </div>

<!-- メールアドレス -->
        <div class="form-item">
            <label>メールアドレス</label>

            <input type="email" name="email" value="{{ $user->email }}">
        </div>

<!-- パスワード -->
        <div class="form-item">
            <label>パスワード</label>

            <input type="password" name="password">
        </div>

<!-- パスワード確認 -->
        <div class="form-item">
            <label>パスワード確認</label>

            <input type="password" name="password_confirmation">
        </div>

<!-- 自己紹介 -->
        <div class="form-item">
            <label>自己紹介</label>

            <textarea name="bio">{{ $user->bio }}</textarea>
        </div>

<!-- アイコン画像 -->
        <div class="form-item">
            <label>アイコン画像</label>

            <input type="file" name="images">
        </div>

    </div>
</div>

<!-- 更新ボタン -->
        <button type="submit">
            更新
        </button>

</form>


</div>




</x-login-layout>
