<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Survey::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%");
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $surveys = $query->get();

        $topSurvey = Survey::with(['user', 'votes'])
        ->whereDate('created_at', today()) // 今日の投稿
        ->withCount('votes') // 賛成数カウント
        ->orderByDesc('votes_count') // 賛成数が多い順
        ->first();
        return view('surveys.index', compact('surveys', 'keyword', 'topSurvey'));
    }

    public function mySurveys()
    {
        // 自分の投稿一覧
        $surveys = Auth::user()->surveys()->latest()->get();
        return view('surveys.my_surveys', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'required|string',
        ],
        [
            'title.required' => 'タイトルは必須です。',
            'description.required' => '説明は必須です。'
        ]);

        Survey::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('surveys.index');
    }

    public function show(Survey $survey)
    {
        return view('surveys.show', compact('survey'));
    }

    // 編集
    public function edit(Survey $survey)
    {
        return view('surveys.edit', compact('survey'));
    }

    // 更新
    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'required|string',
        ],
        [
            'title.required' => 'タイトルは必須です。',
            'description.required' => '説明は必須です。'
        ]);

        $survey->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('surveys.my')->with('success', '更新しました');
    }

    public function destroy(Survey $survey)
   {
        $survey->delete();

        return redirect()->route('surveys.my')->with('success', '削除しました');
    }
}
