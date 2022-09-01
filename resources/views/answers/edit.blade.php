@extends('frontend_layout.app')

@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" />
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Answer</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('answers.update', $answer) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" placeholder="Enter Question Title" name="title" id="title"
                                        class="form-control"
                                        value="{{ $question->title }}" readonly/>
                            </div>
                            <div class="form-group mb-3">
                                <label for="body">Answer</label>
                                <input type="hidden" name="body" id="body"
                                        value="{{ old('answer', $answer->body) }}"/>
                                <trix-editor input="body" placeholder="Ask your question"
                                             class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></trix-editor>
                                @error('body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="submit" value="Update" class="btn btn-outline-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-level-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection