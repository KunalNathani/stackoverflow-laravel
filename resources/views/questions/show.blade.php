@extends('frontend_layout.app')

@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" />
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
                                    @can('markAsFavorite', $question)
                                        @if($question->is_favorite)
                                            <form action="{{ route('questions.unfavorite', $question) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Mark as Fav" class="favorite d-block text-center mb-2 border-0">
                                                    <i class="fa fa-star fa-2x text-warning"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('questions.favorite', $question) }}" method="POST">
                                                @csrf
                                                <button type="submit" title="Mark as Fav" class="favorite d-block text-center mb-2 border-0">
                                                    <i class="fa fa-star fa-2x text-dark"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <h4 class="text-muted text-center">{{ $question->favorites_count }}</h4>
                                    @endcan
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="text-end">
                                    Asked {{ $question->created_date }}
                                </div>
                                <div class="d-flex mt-2">
                                    <div>
                                        <img src="{{ $question->owner->avatar }}">
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
        @include('answers._index')
    </div>
@endsection

@section('page-level-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
