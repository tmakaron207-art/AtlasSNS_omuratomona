<x-login-layout>


<p>トップ画面</p>

<!-- ☆バリデーションエラーメッセージ -->
@if ($errors -> any())
<ul class="error-messege">
    @foreach ($errors -> all() as $error)
    <li>{{$error}}</li>
    @endforeach
</ul>
@endif


<!-- ☆☆投稿フォーム -->
 <form action="/top" method="post" class="postform">



    @csrf
    <!-- ☆☆ユーザーアイコン -->
     @if(Auth::user()->images)
     <img src="{{ asset('images/' . Auth::user()->images) }}" alt="ユーザーアイコン" class="user-icon">
     @else
      <img src="{{ asset('images/icon1.png') }}" class="user-icon">
     @endif

     <!-- ☆☆投稿入力箱 -->
      <textarea name="post" class="postbox" placeholder="投稿内容を入力してください"></textarea>

      <!-- ☆☆投稿ボタン -->
       <button class="formbtn" type="submit">
        <img src="{{ asset('images/post.png') }}" alt="投稿ボタン" >
       </button>

 </form>



    <!-- ☆☆投稿内容表示↓ -->
@foreach($posts as $post)
    <div class="post-list">

    @if($post->user && $post->user->images)
        <img src="{{ asset('images/' . $post->user->images) }}" class="user-icon">
    @else
        <img src="{{ asset('images/icon1.png') }}" class="user-icon">
    @endif

    <div class="post-info">
        <!-- ユーザー名 -->
        <div class="username">
            <p>{{$post->user->username}}</p>
        </div>

        <!-- 投稿内容 -->
        <div class="post-content">
            <br><p>{{ $post->post }}</p>
        </div>

        <!-- 投稿日時 -->
        <div class="post-date">
            <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
        </div>

    </div>


    <!-- ☆☆投稿フォーム編集ボタン -->
@if($post->user_id == Auth::id())

<div class="edit-form">
    <button type="button" class="edit-btn">
        <img src="{{ asset('images/edit.png') }}" alt="編集" class="edit-icon">
    </button>
</div>

<div class="edit-modal" style="display: none;">

    <form action="{{ route('post.update') }}" method="POST">
    @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <textarea name="post">{{ $post->post }}</textarea>
        <button type="submit" class="edit-btn">
        <img src="{{ asset('images/edit.png') }}" alt="編集" class="edit-icon">
    </button>

    </form>
</div>

@endif






    <!-- ☆☆投稿フォーム削除ボタン -->
        @if($post->user_id == Auth::id())

        <!-- 削除時のモーダルボタン -->
        <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="delete-form" onsubmit="return confirm('この投稿を削除をします。よろしいでしょうか？')">
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-btn" >
                <img src="{{ asset('images/trash.png') }}" alt="削除" class="delete-icon">
            </button>
        </form>
    </div>

@endif


@endforeach


  <h2>機能を実装していきましょう。</h2>

</x-login-layout>
