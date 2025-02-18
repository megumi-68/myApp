@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg dark:bg-gray-800">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">案を編集する</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('surveys.update', $survey->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-gray-700 dark:text-gray-300">タイトル:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $survey->title) }}"
                   class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label for="description" class="block text-gray-700 dark:text-gray-300">説明:</label>
            <textarea name="description" id="description" rows="4" required
                      class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white">{{ old('description', $survey->description) }}</textarea>
        </div>

        <button type="submit" class="w-full bg-green-400 text-white py-2 rounded-md hover:bg-blue-600">更新</button>
    </form>

    <!-- 削除ボタン -->
    <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-md hover:bg-red-600">削除</button>
    </form>

    <a href="{{ route('surveys.my') }}" class="block text-center text-blue-500 mt-4 hover:underline">戻る</a>
</div>
@endsection
