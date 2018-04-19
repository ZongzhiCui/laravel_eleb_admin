@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <div class="flash-message container alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif
@endforeach


