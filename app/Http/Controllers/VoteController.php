<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(Request $request, Survey $survey)
    {
        $request->validate([
            'comment' => 'nullable|string|max:255',
        ]);

        if (!Vote::where('user_id', Auth::id())->where('survey_id', $survey->id)->exists()) {
            Vote::create([
                'user_id' => Auth::id(),
                'survey_id' => $survey->id,
                'comment' => $request->comment,
            ]);
        } elseif (Vote::where('user_id', Auth::id())){
            return back()->with('flash_message', '⚠️自分の投稿には賛成できません');
        }

        return back();
    }
}
