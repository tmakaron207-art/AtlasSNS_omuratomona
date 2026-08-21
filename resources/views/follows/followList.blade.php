<x-login-layout>

<!-- フォローリストのアイコンのみ部分全体 -->
<div class="followicon-content">

<!-- フォローリストのタイトル文字 -->
    <div class="followlist-title">
        <p>フォローリスト</p>
    </div>

    <!-- フォローリストのアイコン全体 -->
    <div class="follow-user">
    @foreach($followUsers as $user)


    <!-- アイコン画像 -->
        <div class="follow-icon">
            <a href="/user/{{ $user->id }}">
                @if($user->icon_image)
                <img src="{{ asset('images/' . $user->icon_image) }}" alt="アイコン">
                @else
                <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
                @endif
            </a>
        </div>

    @endforeach
    </div>
</div>


<!-- フォローリストの投稿内容全体 -->
@foreach($posts as $post)

<div class="post-list">

    <!-- ユーザーアイコン -->
    <a href="/user/{{ $user->id }}">
        @if($post->user->icon_image)
            <img src="{{ asset('images/' . $post->user->icon_image) }}" class="user-icon">
        @else
            <img src="{{ asset('images/icon1.png') }}" class="user-icon">
        @endif
    </a>


    <!-- ユーザー名 -->
<div class="post-info">
    <div class="username">
        <p>
            {{ $post->user->username }}
        </p>
    </div>

    <!-- 投稿内容 -->
    <div class="post-content">
        <p>
            {{ $post->post }}
        </p>
    </div>


    <!-- 投稿日時 -->
    <div class="post-date">
        <p>
            {{ $post->created_at->format('Y-m-d H:i') }}
        </p>
    </div>
</div>


</div>

@endforeach


</x-login-layout>
