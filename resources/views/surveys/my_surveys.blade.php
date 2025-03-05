@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg dark:bg-gray-800">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">過去の思いつき💭</h1>

    @if ($surveys->isEmpty())
        <p class="text-gray-700 dark:text-gray-300">まだ案を投稿していません。</p>
    @else
        <ul class="space-y-4">
            @foreach ($surveys as $survey)
                <li class="p-4 border border-gray-300 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700">
                    <a href="{{ route('surveys.edit', $survey->id) }}" class="text-lg font-semibold text-blue-500 hover:underline">{{ $survey->title }}</a>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $survey->description }}</p>
                    <small class="text-gray-500 dark:text-gray-400">投稿日時: {{ $survey->created_at->format('Y-m-d H:i') }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
