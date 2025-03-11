@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg flex flex-col md:flex-row gap-6">
    <div class="w-full md:w-2/3">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">今日はどんなダラダラ気分？</h1>

        {{-- 検索 --}}
        <form method="GET" action="{{ route('surveys.index') }}" class="flex items-center space-x-2 mb-8">
            <input
                type="text"
                name="keyword"
                value="{{ $keyword }}"
                placeholder="キーワードを入力"
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button type="submit" class="px-4 py-2 bg-green-400 text-white rounded-lg hover:bg-yellow-600 transition">
                検索
            </button>
        </form>
        <form action="{{ route('surveys.index') }}" method="GET">
            <select name="category" class="border border-gray-300 rounded">
                <option value="">全てのカテゴリー</option>
                <option value="アウトドア気分">アウトドア気分</option>
                <option value="インドア気分">インドア気分</option>
                <option value="グルメな気分">グルメな気分</option>
                <option value="癒されたい気分">癒されたい気分</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-green-400 text-white rounded-lg hover:bg-yellow-600 transition">検索</button>
        </form>

        <h1 class="text-xl font-semibold text-gray-700 mb-4">みんなの過ごし方</h1>

        <div class="space-y-6">
            @foreach ($surveys as $survey)
                <div class="p-4 border border-gray-300 rounded-lg shadow-sm bg-yellow-50 hover:bg-gray-200 transition">
                    <h2 class="text-lg font-semibold text-yellow-900">
                        <a href="{{ route('surveys.show', $survey) }}" class="hover:underline">
                            {{ $survey->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 mt-1">カテゴリー: {{ $survey->category }}</p>
                    <p class="text-gray-600 mt-1">{{ $survey->description }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        わたしもそうする！: <span class="font-bold text-blue-500">{{ $survey->votes->count() }}</span>
                        | 👤 投稿者: <span class="font-bold">{{ $survey->user->name }}</span>
                        | 🕐 投稿時間: <span class="font-bold">{{ $survey->created_at->format('Y-m-d H:i') }}</span></p>
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="w-full md:w-1/3 bg-gray-50 p-4 border border-gray-300 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold text-black-500 mb-3">本日の最強ダラリスト👑</h2>
        @if ($topSurvey && $topSurvey->votes->count()>0)
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-yellow-900">
                    <span class="font-bold">{{ $topSurvey->user->name }}さん！</span>
                </h3>
                <p class="text-gray-700 mt-2">
                    タイトル：<a href="{{ route('surveys.show', $topSurvey) }}" class="hover:underline">{{ $topSurvey->title }}</a>
                </p>
                <p class="text-gray-700 mt-2">{{ $topSurvey->description }}</p>
                <p class="text-sm text-gray-500 mt-2">
                    同じように過ごしている人: <span class="font-bold text-blue-500">{{ $topSurvey->votes->count() }}人</span>
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
