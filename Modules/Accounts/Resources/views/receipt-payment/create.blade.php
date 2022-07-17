@extends('accounts::layouts.master')
@section('title', trans('accounts::receipt-payment.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::receipt-payment.create') @lang('accounts::receipt-payment.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">

                            {!! Form::open(['class' => 'form', 'novalidate']) !!}
                            <h4 class="form-section"><i
                                    class="la la-tag"></i>@lang('accounts::vendor.general_information')</h4>

                            <!-- Journal and Transaction To  -->
                            <div class="row">

                                <!-- Journal Dropdown -->
                                <div class="col-md-6 form-group">

                                    {!! Form::label('category_id', 'Journal', ['class' => 'form-label required']) !!}
                                    {!! Form::select('category_id', ['HM: Sale Journal','HM: Purchase Journal'], null, [
                                                                     'class' => 'form-control category-type-select required',
                                                                     'data-msg-required' => Lang::get('labels.This field is required'),
                                                                     ]) !!}
                                </div>

                            {{--                                <!-- Transaction To -->--}}
                            {{--                                <div class="col-md-6 form-group">--}}

                            {{--                                    {!! Form::label('category_id', 'Transaction To', ['class' => 'form-label required']) !!}--}}
                            {{--                                    {!! Form::select('category_id', ['Vendor','Customer','Sector','Temporary Sector'], null, [--}}
                            {{--                                                                     'class' => 'form-control category-type-select required',--}}
                            {{--                                                                     'data-msg-required' => Lang::get('labels.This field is required'),--}}
                            {{--                                                                     ]) !!}--}}
                            {{--                                </div>--}}

                            <!-- Date -->
                                <div class="col-md-6 form-group">
                                    {!! Form::label('date', 'Date', ['class' => 'form-label required']) !!}
                                    {{ Form::text('date', date('d/m/Y'), ['class' => 'form-control']) }}
                                </div>

                            </div>

                            <!-- Vendor Dropdown & Sector Dropdown -->
                            <div class="row">

                                <!-- Accounts Dropdown -->
                                <div class="col-md-6 form-group">
                                    {!! Form::label('account_receivable_id', 'Category', ['class' => 'form-label required']) !!}
                                    {!! Form::select('account_receivable_id', $economicCodes, null,
                                    ['class' => "form-control", "required ", "placeholder" => 'Select a receivable account',
                                    'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <div class="help-block"></div>
                                </div>

                                <!-- Accounts Dropdown -->
                                <div class="col-md-6 form-group">
                                    {!! Form::label('account_receivable_id', 'Payment Account', ['class' => 'form-label required']) !!}
                                    {!! Form::select('account_receivable_id', $economicCodes, null,
                                    ['class' => "form-control", "required ", "placeholder" => 'Select a receivable account',
                                    'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <div class="help-block"></div>
                                </div>

                            </div>

{{--                            <!-- Vendor Dropdown & Sector Dropdown -->--}}
{{--                            <div class="row">--}}

{{--                                <!-- Date -->--}}
{{--                                <div class="col-md-6 form-group">--}}
{{--                                    {!! Form::label('date', 'Date', ['class' => 'form-label required']) !!}--}}
{{--                                    {{ Form::text('date', date('d/m/Y'), ['class' => 'form-control']) }}--}}
{{--                                </div>--}}

{{--                                <!-- Amount -->--}}
{{--                                <div class="col-md-6 form-group">--}}
{{--                                    {!! Form::label('amount', 'Amount', ['class' => 'form-label required']) !!}--}}
{{--                                    {!! Form::number('amount',null,['class' => 'form-control']) !!}--}}
{{--                                </div>--}}

{{--                            </div>--}}


                            <!-- Attachments and Types -->
                            <div class="row">

                                <!-- Attachments -->
                                <div class="col-md-6">
                                    <label class="required">{{trans('rms::research_proposal.attachment')}}</label>
                                    {!! Form::file('attachment[]', ['class' => 'form-control required' . ($errors->has('attachment') ? ' is-invalid' : ''), 'data-msg-required' => trans('labels.This field is required'), 'accept' => '.doc, .docx, .xlx, .xlsx, .csv, .pdf', 'multiple' => 'multiple']) !!}

                                    @if ($errors->has('attachment.*'))
                                        @foreach(range(0, count($errors->get('attachment.*')) - 1) as $index)
                                            <strong
                                                style="color: red">{{ $errors->first('attachment.' . $index) }}</strong>
                                            <br>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Amount -->
                                <div class="col-md-6 form-group">
                                    {!! Form::label('amount', 'Amount', ['class' => 'form-label required']) !!}
                                    {!! Form::number('amount',null,['class' => 'form-control']) !!}
                                </div>

                                <!-- Types -->
                                {{--                                <div class="col-md-6">--}}

                                {{--                                {!! Form::label('type', trans('ims::location.type'), ['class' => 'required']) !!}--}}

                                {{--                                <!-- Payment -->--}}
                                {{--                                    <div class="form-check-inline">--}}
                                {{--                                        {!! Form::radio('type', 'payment',--}}
                                {{--                                        ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}--}}
                                {{--                                        <label>Payment</label>--}}
                                {{--                                    </div>--}}

                                {{--                                    <!-- Receipt -->--}}
                                {{--                                    <div class="form-check-inline">--}}
                                {{--                                        {!! Form::radio('type', 'receipt',--}}
                                {{--                                        ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}--}}
                                {{--                                        <label>Receipt</label>--}}
                                {{--                                    </div>--}}

                                {{--                                    <!-- Transfer -->--}}
                                {{--                                    <div class="form-check-inline">--}}
                                {{--                                        {!! Form::radio('type', 'transfer',--}}
                                {{--                                        ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}--}}
                                {{--                                        <label>Transfer</label>--}}
                                {{--                                    </div>--}}

                                {{--                                </div>--}}

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

    <script type="text/javascript">
        $('input[name=date]').pickadate({
            max: new Date('12/09/2024'),
            format: 'dd/mm/yyyy',
        });
    </script>

@endpush
