@extends('accounts::layouts.master')
@section('title', trans('accounts::customer.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">\
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::customer.create')</h4>
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

                            {!! Form::open(['route' =>  'journal.store', 'class' => 'form', 'novalidate']) !!}
                            <h4 class="form-section"><i
                                    class="la la-tag"></i>@lang('accounts::customer.general_information')</h4>

                            <!-- Name and phone -->
                            <div class="row">
                                <!-- Name -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('name', trans('labels.name'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('name', null,
                                        ['class' => "form-control", "required ", "placeholder" => __('labels.name'),
                                        'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <!-- address -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('address', trans('labels.address'), ['class' => 'form-label required']) !!}
                                        {!! Form::text('address', null,
                                        ['class' => "form-control", "required ", "placeholder" => trans('labels.name'),
                                        'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>

                            <!-- Email & Mobile Address -->
                            <div class="row">

                                <!-- Email Address -->
                                <div class="col-6">
                                    <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
                                        {{ Form::label('email', trans('labels.email_address'), ['class' => 'required']) }}
                                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'info@example.com', 'required' => 'required', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
                                        <div class="help-block"></div>
                                        @foreach ($errors->get('email') as $message)
                                            <div class="help-block">  {{ $message }}</div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Mobile Number -->
                                <div class="col-6">
                                    <div class="form-group {{ $errors->has('mobile_one') ? ' error' : '' }}">
                                        {{ Form::label('mobile_one', trans('labels.mobile') , ['class' => 'required']) }}
                                        {{ Form::number('mobile_one', null, ['class' => 'form-control','placeholder' => '017XXXXXXXX','required' => 'required',
                                        'data-validation-required-message'=> trans('labels.This field is required'),  'minlength' =>'11',
                                        'data-validation-minlength-message'=>trans('validation.minlength', ['attribute'=> __('labels.mobile'), 'min'=>11]), 'maxlength' =>'11',
                                        'data-validation-maxlength-message'=> trans('validation.maxlength', ['attribute'=> __('labels.mobile'), 'max'=>11])]) }}
                                        <div class="help-block"></div>
                                        @foreach ($errors->get('mobile_one') as $message)
                                            <div class="help-block">  {{ $message }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Validation Date  & Types -->
                            <div class="row">

                                <!--Validation Date  -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('validation_date', 'Validation Date', ['class' => 'form-label required']) !!}
                                        {{ Form::text('validation_date', date('d/m/Y'), ['class' => 'form-control']) }}
                                    </div>

                                </div>


                                <!-- Types -->
                                <div class="col-6">

                                {!! Form::label('type', trans('ims::location.type'), ['class' => 'form-label required']) !!}
                                <!-- individual -->
                                    <div class="form-check-inline">
                                        {!! Form::radio('type', 'individual',
                                        ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                        <label>Individual</label>
                                    </div>
                                    <!-- company -->
                                    <div class="form-check-inline">
                                        {!! Form::radio('type', 'company',
                                        ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                        <label>Company</label>
                                    </div>
                                </div>
                            </div>

                            <h4 class="form-section"><i
                                    class="la la-tag"></i>@lang('accounts::accounts.information')</h4>

                            <!-- Address and Email -->


                            <!-- todo:: Fetch Economic Codes and set here -->
                            <!-- Debit/Credit Account -->
                            <div class="row">

                                <!-- Credit Account -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('account_receivable_id', 'Account Receivable', ['class' => 'form-label required']) !!}
                                        {!! Form::select('account_receivable_id', $economicCodes, null,
                                        ['class' => "form-control", "required ", "placeholder" => 'Select a receivable account',
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <!--  Debit Account  -->
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::label('account_payable_id', 'Account Payable', ['class' => 'form-label required']) !!}
                                        {!! Form::select('account_payable_id', $economicCodes, null,
                                        ['class' => "form-control", "required ", "placeholder" => 'Select a payable account',
                                        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                            </div>


                            <!-- Save / Cancel Button -->
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i>{{ trans('labels.save') }}
                                </button>
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{url(route('journal.index'))}}">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </a>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">

@endpush

@push('page-js')
    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    <script>
        $('input[name=validation_date]').pickadate({
            max: new Date('12/09/2023'),
            format: 'dd/mm/yyyy',
            drops: 'up',
        });
    </script>
@endpush
