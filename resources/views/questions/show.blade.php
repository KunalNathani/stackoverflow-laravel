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
        @include('answers._index')
    </div>
@endsection
