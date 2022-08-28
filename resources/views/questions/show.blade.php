@extends('frontend_layout.app')

@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ $question->title }}</h1>
                    </div>
                    <div class="card-body">
                        {!! $question->body !!}
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between mr-3">
                            <div></div>
                            <div class="d-flex flex-column">
                                <div class="text-end">
                                    Asked {{ $question->created_date }}
                                </div>
                                <div class="d-flex mt-2">
                                    <div>
                                        <img src="{{ $question->avatar }}">
                                    </div>
                                    <div class="mt-3 ms-2">
                                        {{ $question->owner->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-0">{{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}</h3>
                    </div>
                    <div class="card-body">
                        @foreach($question->answers as $answer)
                            {!! $answer->body !!}
                            <div class="d-flex justify-content-between mr-3 mb-3">
                                <div class="d-flex">
                                    <div>
                                        <a href="" title="Vote Up" class="vote-up d-block text-center text-dark">
                                            <i class="fa fa-caret-up fa-3x"></i>
                                        </a>
                                        <h4 class="m-0 text-muted">45</h4>
                                        <a href="" title="Vote Down" class="vote-down d-block text-center text-dark">
                                            <i class="fa fa-caret-down fa-3x"></i>
                                        </a>
                                    </div>
                                    <div class="mt-3 ms-3">
                                        <a href="" title="Mark as Fav" class="favorite d-block text-center mb-2">
                                            <i class="fa fa-star fa-2x text-dark"></i>
                                        </a>
                                        <h4 class="text-muted">123</h4>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="text-end">
                                        Answered {{ $answer->created_date }}
                                    </div>
                                    <div class="d-flex mt-2">
                                        <div>
                                            <img src="{{ $answer->author->avatar }}">
                                        </div>
                                        <div class="mt-2 ms-2">
                                            {{ $answer->author->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
