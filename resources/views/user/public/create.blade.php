@extends('layouts.master')
@section('title', trans('labels.User create'))
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/custom.css') }}">
@endpush
@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('user-management.create_user_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['url' =>  route('users.store'), 'class' => 'form', 'novalidate']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> {{trans('user-management.user_form_title')}}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label required">{{trans('labels.name')}}</label>
                                            <input id="name" type="text"
                                                   class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" value="{{ old('name') }}" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.name')])}}" autofocus>
                                            <div class="help-block"></div>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"
                                                   class="form-label">{{trans('labels.email_address')}}</label>
                                            <input id="email" type="email"
                                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile"
                                                   class="form-label required">{{trans('labels.mobile')}}</label>
                                            <input id="mobile" type="text"
                                                   class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                                   name="mobile" value="{{ old('mobile') }}" placeholder="01xxxxxxxxx" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.mobile')])}}">
                                            <div class="help-block"></div>
                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username"
                                                   class="form-label required">{{trans('labels.username')}}</label>
                                            <input id="username" type="text"
                                                   class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                   name="username" value="{{ old('username') }}" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.username')])}}">
                                            <div class="help-block"></div>
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password"
                                                   class="form-label required">{{trans('labels.password')}}</label>
                                            <input id="password" type="password"
                                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.password')])}}">
                                            <div class="help-block"></div>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password-confirm"
                                                   class="form-label required">{{trans('labels.confirm_password')}}</label>

                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.confirm_password')])}}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- <div class="form-group">
                                            <label for="doptors" class="form-label required">{{trans('user-management.select_doptor')}}</label>
                                            {{ Form::select("doptors", $doptors, null,
                                               ["class"=>"form-control select2", "id"=>"doptor_id",
                                                'name'=>'doptor_id','placeholder' => trans('labels.select')
                                                ]) 
                                            }}

                                            @if ($errors->has('doptor_id'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('doptor_id') }}</strong></span>
                                            @endif
                                        </div> --}}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="roles" class="form-label">{{trans('user-management.select_user_roles')}}</label>
                                            {{ Form::select("roles", $roles, null, ["class"=>"form-control select2", "id"=>"roles",
                                             'multiple' => 'multiple', 'name'=>'roles[]']) }}

                                            @if ($errors->has('roles'))
                                                <span class="invalid-feedback"><strong>{{ $errors->first('roles') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row icheck_minimal skin.skin-square">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_type"
                                                   class="form-label required">{{trans('user-management.user_type')}}</label>
                                            @foreach($userTypes as $key => $value)
                                                <fieldset class="radio">
                                                    <input type="radio"
                                                           name="user_type" value="{{$key}}" {{$key == 'GUEST' ? 'checked' : ''}} required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('user-management.user_type')])}}">
                                                    <label for="user_type">
                                                        {{$value}}
                                                    </label>
                                                </fieldset>
                                            @endforeach
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status"
                                                   class="form-label required">{{trans('labels.status')}}</label>
                                            @foreach($status as $key => $value)
                                                <fieldset class="radio">
                                                    <label for="status">
                                                        <input type="radio"
                                                               name="status" value="{{$key}}" {{$key == 'ACTIVE' ? 'checked' : ''}} required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.status')])}}">
                                                        {{$value}}
                                                    </label>
                                                </fieldset>
                                            @endforeach
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                    </button>
                                    <a class="btn btn-warning mr-1" role="button" href="{{route('users.index')}}">
                                        <i class="ft-x"></i> {{trans('labels.cancel')}}
                                    </a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
<script type="text/javascript" src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('theme/js/scripts/forms/checkbox-radio.min.js') }}"></script>
@endpush
