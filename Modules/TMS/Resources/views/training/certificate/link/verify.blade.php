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
            <label for="unique_code" class="required">@lang('tms::certificate.link.unique_code')</label>
            {{ Form::text('unique_code', null, [
                'class' => 'form-control' . ($errors->has('unique_code') ? ' is-invalid' : ''),
                'required'
            ]) }}


            @if($errors->has('unique_code'))
                <div class="help-block danger">{{ $errors->first('unique_code') }}</div>
            @endif
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-primary">@lang('labels.search')</button>
        </div>
        {{ Form::close() }}
    </div>
@endsection
