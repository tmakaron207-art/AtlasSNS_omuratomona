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
        @if($user->user && $user->user->images)
            <img src="{{ asset('images/' . $user->user->images) }}" class="user-icon">
        @else
            <img src="{{ asset('images/icon1.png') }}" class="user-icon">
        @endif

        <p>{{ $user->username }}</p>
    </div>

    @endforeach
@endif




</x-login-layout>
