<nav class="bg-yellow-50 text-white p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('surveys.index') }}" class="-m-1.5 p-1.5 text-green-600 font-bold">
            {{-- <img src="{{ asset('images/top.png') }}" class="h-12 w-auto" alt="トップ画像"> --}}
            みんなでダラダラ
        </a>

        {{-- メニュー --}}
        <ul class="flex space-x-4">
            @guest
                <li>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 rounded hover:bg-green-600 transition">新規登録</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-500 rounded hover:bg-gray-600 transition">ログイン</a>
                </li>
            @else
                <li>
                    <a href="{{ route('surveys.create') }}" class="px-4 py-2 bg-yellow-700 rounded hover:bg-yellow-600 transition">投稿する</a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-green-700 rounded hover:bg-yellow-600 transition">プロフィール編集</a>
                </li>
                <li>
                    <a href="{{ route('surveys.my') }}" class="px-4 py-2 bg-yellow-700 rounded hover:bg-yellow-600 transition">自分の投稿一覧</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-700 rounded hover:bg-yellow-600 transition">ログアウト</button>
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>
