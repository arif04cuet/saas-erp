{{-- Session alert message Start --}}
{{-- redirect()->with() will work here too --}}
@if (session('warning'))
    <div class="alert bg-warning alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('warning') !!}
    </div>
@endif

@if (session('error'))
    <div class="alert bg-danger alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('error') !!}
    </div>
@endif

@if (session('success'))
    <div class="alert bg-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('success') !!}
    </div>
@endif

@if (session('message'))
    <div class="alert bg-info alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! session('message') !!}
    </div>
@endif

{{-- Session alert message End --}}

{{-- View with alert message start --}}

@if (!empty($warning))
    <div class="alert bg-warning alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $warning !!}
    </div>
@endif

@if(!empty($error))
    <div class="alert bg-danger alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $error !!}
    </div>
@endif

@if(!empty($success))
    <div class="alert bg-success alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $success !!}
    </div>
@endif

@if (!empty($message))
    <div class="alert bg-info alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {!! $message !!}
    </div>
@endif

{{-- View with alert message end --}}
