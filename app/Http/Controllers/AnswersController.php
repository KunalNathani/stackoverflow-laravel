<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnswerRequest $request)
    {
        auth()->user()->answers()->create(
            [
                'question_id' => $request->q_id,
                'body' => $request->body,
            ]);
        session()->flash('status', 'success');
        session()->flash('message', 'Answer submitted successfully!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        if ($request->hasAny(['body'])) {
            $answer->update([
                'body' => $request->body
            ]);
            session()->flash('status', 'success');
            session()->flash('message', 'Answer updated!');
            return redirect(route('single-question', $answer->question->slug));
        }
        return abort(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        session()->flash('status', 'success');
        session()->flash('message', 'Answer deleted!');
        return redirect()->back();
    }
}
