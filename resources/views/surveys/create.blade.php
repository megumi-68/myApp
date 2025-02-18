@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg mt-10">
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="text-3xl font-semibold text-center text-gray-800 dark:text-gray-200 mb-6">ダラダラ案を投稿する😪</h1>
    <form action="{{ route('surveys.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="title" class="block text-lg font-medium text-gray-700 dark:text-gray-300">タイトル:</label>
            <input type="text" name="title" id="title"
                class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white">
        </div>
        <div>
            <label for="description" class="block text-lg font-medium text-gray-700 dark:text-gray-300">説明:</label>
            <textarea name="description" id="description" rows="4"
                class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white"></textarea>
        </div>
        <button type="submit"
            class="w-full py-3 text-white bg-green-400 hover:bg-blue-600 rounded-lg font-semibold transition ease-in-out duration-300">
            投稿
        </button>
    </form>
</div>
@endsection
