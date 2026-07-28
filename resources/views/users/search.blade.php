<x-login-layout>

<p>検索画面</p>

<!-- 検索フォーム入力欄 -->
<form action="{{ route('users.search') }}" method="GET" class="search-form">
	<input type="text" placeholder="ユーザー名" name="keyword">


    <!-- 検索ボタン -->
<button type="submit" class="search-btn">
	<img src="{{ asset('images/search.png') }}" alt="検索">
</button>

</form>


<!-- コントロールで設定した検索結果を表示↓ -->
@if(isset($users))
    @foreach($users as $user)

    <div class="user-list">

        <div class="user-info">
            <!-- ユーザーアイコン -->
            @if($user->images)
                <img src="{{ asset('images/' .  $user->user->images) }}" class="user-icon">
            @else
            <img src="{{ asset('images/icon1.png') }}"  class="user-icon">
            @endif

            <!-- ユーザー名 -->
            <p>{{ $user->username }}</p>
        </div>

<!-- フォローしてるか判定設定↓ -->
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

    @endforeach
@endif




</x-login-layout>
