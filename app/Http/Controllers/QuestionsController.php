<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('owner')->latest('created_at')->paginate('5');
        return view('questions.index', compact(['questions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        auth()->user()->questions()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        session()->flash('status', 'success');
        session()->flash('message', 'Question has been reported to all our expert users!');
        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views_count');
        return view('questions.show', compact(['question']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if($this->authorize('update', $question)) {
            return view('questions.edit', compact(['question']));
        }
        return abort(403, 'Access Denied!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        if($this->authorize('update', $question)) {
            $question->update([
                'title' => $request->title,
                'body' => $request->body
            ]);
            session()->flash('status', 'success');
            session()->flash('message', 'Question has been updated and will be answered accordingly soon!');
            return redirect(route('questions.index'));
        }
        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if($this->authorize('delete', $question)) {
            $question->delete();
            session()->flash('status', 'success');
            session()->flash('message', 'Question deleted!');
            return redirect(route('questions.index'));
        }
        return abort(403);
    }

}
