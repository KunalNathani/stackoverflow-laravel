<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-0">Contribute a Answer!</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('answers.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="body">Answer</label>
                        <input type="hidden" value="{{ $question->id }}" name="q_id"/>
                        <input type="hidden" name="body" id="body"
                                value="{{ old('body') }}"/>
                        <trix-editor input="body" placeholder="Ask your question"
                                     class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></trix-editor>
                        @error('body')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" value="Post Answer" class="btn btn-outline-success">
                    </div>
            </div>

            </form>
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
                                <form action="{{ route('markAsBest', ['question' => $question, 'answer'=>$answer]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button title="Mark as Fav" class="favorite d-block text-center mb-2 text-dark border-0 btn"
                                            type="submit">
                                        <i class="fa fa-check fa-2x"></i>
                                    </button>
                                </form>
                                <a href="{{ route('edit-question', ['question' => $question, 'answer'=>$answer]) }}">
                                    <i class="fa fa-pencil text-dark fa-2x"></i>
                                </a>
                            </div>
                            <div class="m-3">
                                <form action="{{ route('answers.destroy', $answer) }}"
                                                        class="d-inline"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn"><i class="fa fa-trash fa-2x"></i></button>
                            </form>
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
