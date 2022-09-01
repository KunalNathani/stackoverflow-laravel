<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    public function markAsBest(Question $question, Answer $answer)
    {
        $question->markAsBest($answer);
        return redirect()->back();
    }

    public function edit(Question $question, Answer $answer)
    {
        if($this->authorize('update', $answer)) {
            return view('answers.edit', compact(['answer', 'question']));
        }
    }
}
