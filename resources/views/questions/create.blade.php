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
                        <h3>Ask a Question</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Question Title" name="title" id="title" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="body">Question</label>
                                <input type="hidden" class="form-control"  name="body" id="body" />
                                <trix-editor input="body" placeholder="Ask your question" class="form-control"></trix-editor>
                            </div>

                            <div class="form-group mb-3">
                                <input type="submit" value="Ask Experts" class="btn btn-outline-success">
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
