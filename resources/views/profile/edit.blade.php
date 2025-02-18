@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg dark:bg-gray-800">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">プロフィール編集</h1>

    @if(session('success'))
        <p class="text-green-600 dark:text-green-400 mb-4">{{ session('success') }}</p>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium">名前:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                   class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label for="profile_image" class="block text-gray-700 dark:text-gray-300 font-medium">プロフィール画像:</label>
            <input type="file" name="avatar" id="avatar"
                   class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white">
        </div>

        <div class="flex items-center space-x-4">
            <label class="text-gray-700 dark:text-gray-300 font-medium">現在のプロフィール画像:</label>
            <img src="{{ $user->avatar ? asset($user->avatar) : asset('images/default_profile.png') }}"
                 alt="プロフィール画像" class="w-16 h-16 rounded-full shadow-md">
        </div>

        <button type="submit" class="w-full bg-green-400 text-white py-2 px-4 rounded-lg hover:bg-blue-600">更新</button>
    </form>

    <div class="mt-6">
        <a href="{{ route('surveys.index') }}" class="text-blue-500 hover:underline">戻る</a>
    </div>
</div>
@endsection
