<x-login-layout>




<div class="profile">
    <!-- プロフィールアイコン -->
@if($user->images)
    <img src="{{ asset('images/' . $user->images) }}" alt="アイコン" class="user-icon">
@else
    <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン" class="user-icon">
@endif

<div class="profile-info">

    <!-- ユーザー名 -->
    <div class="profile-row">
        <p class="profile-label">ユーザー名</p>
        <h2 class="profile-value">{{$user->username}}</h2>
    </div>


    <!-- 自己紹介文 -->
    <div class="profile-row">
        <p class="profile-label">自己紹介</p>
        <p class="profile-value">{{$user->bio}}</p>
    </div>
</div>


<!-- フォローしてるか判定設定↓ -->
<div class="profile-follow">
    @if(Auth::user()
            ->follows()
            ->where ('followed_id',$user->id)
            ->exists())

            <!-- フォロー削除ボタン -->
            <form action="{{ route('user.unfollows', $user->id) }}" method="POST">
            @csrf
            @method('delete')

                <button type="submit" class="unfollows-btn">
                    フォロー解除
                </button>
            </form>

    @else

            <!-- フォローするボタン -->
            <form action="{{ route('user.follows', $user->id) }}" method="POST">
            @csrf

                <button type="submit" class="follows-btn">
                    フォローする
                </button>
            </form>
    @endif
</div>
</div>


<!-- フォロワーリストの投稿表示全体 -->
<div class="follower-user">
    @foreach($posts as $post)

    <div class="post-list">

        <!-- ユーザーアイコン -->
        <a href="/user/{{ $user->id }}">
            @if($post->user->images)
                <img src="{{ asset('images/' . $post->user->images) }}" class="user-icon">
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
</div>



</x-login-layout>
