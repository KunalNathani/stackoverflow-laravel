<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Notifications\NewVoteReceived;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function canUpdateQuestionVote(Question $question, int $vote)
    {
        return (
            ($vote !== 1 && $question->hasMarkedUpVote(auth()->user()))
                                ||
            ($vote !== -1 && $question->hasMarkedDownVote(auth()->user()))
        );
    }
    public function canUpdateAnswerVote(Answer $answer, int $vote)
    {
        return (
            ($vote !== 1 && $answer->hasMarkedUpVote(auth()->user()))
            ||
            ($vote !== -1 && $answer->hasMarkedDownVote(auth()->user()))
        );
    }
    public function voteQuestion(Question $question, int $vote)
    {
        if($question->hasVoted(auth()->user()))
        {
            if($this->canUpdateQuestionVote($question, $vote))
            {
                $question->updateVote($vote);
            }
        }
        else
        {
            $question->vote($vote);
            $question->owner->notify(new NewVoteReceived(auth()->user(), $question));
        }
        return redirect()->back();
    }

    public function voteAnswer(Answer $answer, int $vote)
    {
        if($answer->hasVoted(auth()->user()))
        {
            if($this->canUpdateAnswerVote($answer, $vote))
            {
                $answer->updateVote($vote);
            }

        }
        else
        {
            $answer->vote($vote);
            $answer->author->notify(new NewVoteReceived(auth()->user(), $answer));
        }
        return redirect()->back();
    }
}
