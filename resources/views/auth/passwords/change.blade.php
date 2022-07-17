@extends('layouts.app')
@section('title', trans('labels.change_password'))
@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{ trans('labels.password_change') }}</h4>
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
                            {!! Form::open(['url' =>  route('change.password'), 'class' => 'form']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> {{ trans('labels.change_password') }}</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current-password"
                                                   class="col-form-label required">{{ trans('labels.Current_Password') }}</label>
                                            <input id="current-password" type="password"
                                                   class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                                   name="current_password" required>

                                            @if ($errors->has('current_password'))
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $errors->first('current_password') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new-password"
                                                   class="col-form-label required">{{ trans('labels.New_Password') }}</label>
                                            <input id="new-password" type="password"
                                                   class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}"
                                                   name="new_password" required>

                                            @if ($errors->has('new_password'))
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $errors->first('new_password') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new-password-confirm"
                                                   class="col-form-label required">{{ trans('labels.confirm_new_password') }}</label>

                                            <input id="new-password-confirm" type="password" class="form-control"
                                                   name="new_password_confirmation" required>
                                            @if ($errors->has('new_password_confirmation'))
                                                <span class="invalid-feedback"
                                                      role="alert"><strong>{{ $errors->first('new_password_confirmation') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr/>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ trans('labels.save') }}
                                    </button>
                                    <a class="btn btn-warning mr-1" role="button" href="{{url()->previous()}}">
                                        <i class="ft-x"></i> {{ trans('labels.cancel') }}
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
