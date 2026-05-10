

<link rel="stylesheet" href="{{ asset('css/style.css') }}">





       <div id="head">
            <h1><a href="/top"><img src="images/atlas.png"></a></h1>
            <div id="">
                <div id="">
                    <!-- ☆ログインできてたら1、×なら空と表示される設定↓ -->
                    <!-- <p>{{Auth::check()}}</p> -->
                    <p>{{Auth::user()->username}}さん</p>
                </div>

                <!-- アコーディオンメニュー -->
        <div class="accordion">
            <div class="accordion-btn">
                <span class="arrow">
                    ▼
                </span>
            </div>
                <ul class="accordion-list">
                    <li class="list-item"><a href="{{route('top')}}" class="list-link">HOME</a></li>

                    <li class="list-item"><a href="{{route('profile')}}" class="list-link">プロフィール編集</a></li>

                    <li class="list-item"><form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="logout-btn">ログアウト</button></form></li>
                </ul>
        </div>
        <script src="{{ asset('js/style.js') }}"></script>
            </div>
        </div>
