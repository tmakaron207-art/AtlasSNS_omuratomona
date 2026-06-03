<x-login-layout>

<p>トップ画面</p>


<!-- ☆☆投稿フォーム -->
 <form action="" methood="post" class="postform">
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


  <h2>機能を実装していきましょう。</h2>

</x-login-layout>
