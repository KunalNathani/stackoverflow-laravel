@extends('frontend_layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Notifications</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.markAllNotificationAsRead') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-primary mb-3" type="submit">Mark All As Read</button>
                        </form>
                        <ul class="list-group">
                            @foreach($notifications as $notification)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @if($notification->type === \App\Notifications\NewReplyAdded::class)
                                        <p>
                                            A new Answer was added to your question! "<strong>{{ $notification->data['question']['title'] }}"</strong>
                                        </p>
                                    @elseif($notification->type === \App\Notifications\NewVoteReceived::class)
                                        <p>A new vote was added to your question by: <strong>{{ $notification->data['user']['name'] }}</strong></p>
                                    @endif
                                    @if($notification->read_at === null)
                                        <form action="{{ route('users.markNotificationAsRead', $notification) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-primary" type="submit">Mark As Read</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
