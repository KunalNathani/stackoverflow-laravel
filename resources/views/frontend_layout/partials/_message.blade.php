@if(session('status'))
    <div class="alert alert-dismissible alert-{{ session()->get('status') }}" role="alert">
        <span>{{ session()->get('message') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
