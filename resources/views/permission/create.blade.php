@extends('layouts.master')
@section('content')
    <section id="permission-form-layouts">
        <div class="row match-height">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('user-management.permission_create_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['url' =>  '/user/permission', 'class' => 'form', 'novalidate']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> {{trans('user-management.permission_create_form_title')}}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="model_name" class="form-label required">{{trans('user-management.permission_create_model_name')}}</label>
                                            <input name="model_name" type="text" id="model_name" value="{{ old('model_name') }}"
                                                   class="form-control {{ $errors->has('model_name') ? 'is-invalid' : '' }}"
                                                   placeholder="eg. User" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('user-management.permission_create_model_name')])}}">
                                            <div class="help-block"></div>
                                            @if ($errors->has('model_name'))
                                                <span class="invalid-feedback">
                                            <strong>{{ $errors->first('model_name') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                    </button>
                                    <a class="btn btn-warning mr-1" role="button" href="{{url('/user/permission')}}">
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
