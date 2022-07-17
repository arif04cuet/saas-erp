@extends('layouts.front-app')
@section('title', trans('tms::training.title'))
@push('page-css')
    <style>
        @media screen and (max-width: 1200px) {
            .header-navbar .navbar-container ul.nav li > a.nav-link {
                font-size: 14px;
                padding: 1.9rem 0.6rem;
            }
        }

        .mt-27vh {
            margin-top: 27vh;
        }
        .header-navbar {
            box-shadow: 0 2px 15px 0px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush()

@section('content')
    <div class="col-12 d-flex align-items-center justify-content-center mt-27vh pl-0 pr-0 ">
        {{ Form::open(['route' => 'courses.public.show', 'method' => 'GET', 'class' => 'col-sm-11 col-md-9 col-lg-7 col-xl-6 pl-0 pr-0']) }}
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
