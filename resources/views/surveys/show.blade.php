@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg dark:bg-gray-800">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ $survey->title }}</h1>
    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $survey->description }}</p>
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">投稿者: {{ $survey->user->name }}</p>
    @if (session('flash_message'))
            <div class="flash_message bg-success text-center py-3 my-0">
                {{ session('flash_message') }}
            </div>
    @endif
    <form method="POST" action="{{ route('votes.store', $survey) }}" class="mb-6">
        @csrf
        <textarea name="comment" placeholder="コメントを入力（任意）" class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white"></textarea>
        <button type="submit" class="mt-2 bg-green-400 text-white py-2 px-4 rounded-lg hover:bg-blue-600">賛成!</button>
    </form>

    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">わたしもそうしよ💭</h2>
    @foreach ($survey->votes as $vote)
        <div class="p-4 border border-gray-300 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700 flex items-start space-x-4 mb-4">
            <img src="{{ $vote->user->avatar ? asset($vote->user->avatar) : asset('images/default_profile.png') }}" alt="プロフィール画像" class="w-12 h-12 rounded-full">
            <div>
                <p class="font-semibold text-gray-900 dark:text-white">{{ $vote->user->name }}</p>
                <p class="text-gray-700 dark:text-gray-300">{{ $vote->comment }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
