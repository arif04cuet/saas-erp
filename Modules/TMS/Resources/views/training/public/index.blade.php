@extends('layouts.public')
@section('title', trans('tms::training.title'))

@section('content')
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
    <div class="col-12 d-flex align-items-center justify-content-center">
        {{ Form::open(['route' => 'trainings.public.show', 'method' => 'GET', 'class' => 'col-md-6']) }}
        <div class="form-group">
            <label for="mobile-no" class="required">@lang('labels.mobile')</label>
            {{ Form::text('mobile-no', null, [
                'class' => 'form-control' . ($errors->has('not_registered_trainee') ? ' is-invalid' : ''),
                'required'
            ]) }}


            @if($errors->has('not_registered_trainee'))
                <div class="help-block danger">{{ $errors->first('not_registered_trainee') }}</div>
            @endif
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-primary">@lang('labels.search')</button>
        </div>
        {{ Form::close() }}
    </div>
@endsection
