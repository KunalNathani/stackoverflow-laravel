@extends('frontend_layout.app')

@section('page-level-styles')
    <style>
        .statistics strong {
            font-size: 1.2rem;
        }

        .statistics .answers {
            padding: 10px;
            border-radius: 5px;
        }

        .statistics .answers.answered {
            border: solid 1px green;
            color: green;
        }

        .statistics .answers.has-best-answer {
            border: solid 1px green;
            background: green;
            color: white;
        }

        .statistics .answers.unanswered {
            border: solid 1px darkred;
            color: darkred;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-end">
                <a href="{{ route('questions.create') }}" class="btn btn-outline-primary mb-3">Ask a Question!</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Questions</div>
                    @foreach($questions as $question)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="d-flex flex-column statistics">
                                        <div class="votes text-center mb-3">
                                            <strong class="d-block">{{ $question->votes_count }}</strong>
                                            Votes
                                        </div>
                                        <div class="answers text-center mb-3 {{ $question->styles_for_answer }}">
                                            <strong class="d-block">
                                                {{ $question->answers_count }}
                                            </strong>
                                            Answers
                                        </div>
                                        <div class="views text-center mb-3">
                                            <strong class="d-block">
                                                {{ $question->views_count }}
                                            </strong>
                                            Views
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <h2 class="card-title">
                                        <a href="{{ $question->url }}">{{ $question->title }}</a>
                                    </h2>
                                    <p>
                                        <small>Asked By: <a href="#">{{ $question->owner->name }}</a></small>
                                        <span class="text-muted">{{ $question->created_date }}</span>
                                    </p>
                                    <p class="card-body">
                                        {{ \Illuminate\Support\Str::limit($question->body, 250) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                    <div class="card-footer">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
