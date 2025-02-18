<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>みんなでダラダラ</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="flex items-center justify-center min-h-screen bg-cover bg-center bg-gray-100 dark:bg-black" style="background-image: url('/images/background.jpg');">
        <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <img src="{{ asset('images/top.png') }}" alt="トップ画像">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">ログイン</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 transition">新規登録</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
