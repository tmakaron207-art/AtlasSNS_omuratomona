        <div id="head">
            <h1><a><img src="images/atlas.png"></a></h1>
            <div id="">
                <div id="">
                    <p>{{Auth::user()->username}}さん</p>
                </div>
                <ul>
                    <li><a href="{{route('top')}}">ホーム</a></li>
                    <li><a href="{{route('profile')}}">プロフィール</a></li>
                    <li><form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit">ログアウト</button></form></li>
                </ul>
            </div>
        </div>
