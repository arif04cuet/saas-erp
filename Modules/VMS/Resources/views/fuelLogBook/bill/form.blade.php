@extends('vms::layouts.master')
@section('title', trans('vms::fuelBillSubmit.registration'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('vms::fuelBillSubmit.registration')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
<div class="card-body">

        {!! Form::open(['route' => 'vms.fuel.bill.store', 'class' => 'form company-form','enctype'=>'multipart/form-data']) !!}

    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('vms::fuelBillSubmit.title') @lang('labels.form')</h4>
        <!-- Vehicle Type -->
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('date_label', trans('labels.date'),
                     ['class' => 'form-label required']) !!}
                    {!! Form::text('date', $page == "edit"
                                ? null
                                : date('M Y'), ['class' =>'form-control required datepicker','data-validation-required-message'=> __('labels.This field is required')])!!}
                    @if ($errors->has('date'))
                        <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-6">
            {!! Form::label('filling_station_label', trans('vms::fuelBillSubmit.form_elements.filling_station'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('filling_station_id', $fillingStation, $page == "edit" ? $fillingStation ? $fuelLog->filling_station_id : null : null, [
                        'class' => 'form-control required select2',
                        'placeholder' => trans('labels.select') ,
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('filling_station_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('filling_station_id') }}
                    </div>
                @endif
            </div>

        </div>



        <div class="row mt-1">
            <div class="col-6">
            {!! Form::label('amount_label', trans('vms::fuelBillSubmit.form_elements.amount'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('amount', $page == "edit" ? $fuelLog->amount : null, ['class' =>
            'form-control required',
            'placeholder' => trans('vms::fuelLogBook.form_elements.amount'),
            'data-msg-required'=> __('labels.This field is required'),
            'data-rule-maxlength' => 8,
            'data-msg-maxlength'=> trans('labels.At most 8 characters') ])!!}
            <!-- error message -->
                @if ($errors->has('amount'))
                    <div class="help-block text-danger">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
            </div>
            <div class="col-6">
            {!! Form::label('voucher_number', trans('vms::fuelBillSubmit.form_elements.voucher_number'), ['class' => 'form-label']) !!}
            {!! Form::text('voucher_number', $page == "edit" ? $fuelLog->voucher_number : null, ['class' =>
            'form-control',
            'placeholder' => trans('vms::fuelLogBook.form_elements.voucher_number'),
             'data-msg-required'=> __('labels.This field is required'),
            'data-rule-maxlength' => 60,
            'data-msg-maxlength'=> trans('labels.At most 60 characters') ])!!}
            <!-- error message -->
                @if ($errors->has('voucher_number'))
                    <div class="help-block text-danger">
                        {{ $errors->first('voucher_number') }}
                    </div>
                @endif
            </div>

        </div>

        <div class="row mt-1">
            <div class="col-6">
                {!! Form::label('voucher_number', trans('vms::fuelBillSubmit.form_elements.attachment'), ['class' => 'form-label required']) !!}
                <input class="form-control required" accept=".png, .jpg, .jpeg" name="acknowledgement_one" type="file" data-msg-required="{{__('labels.This field is required')}}">
{{--                {!! Form::File('acknowledgement_one', null, ['class' =>--}}
{{--                            'form-control required',--}}
{{--                             'data-msg-required'=> __('labels.This field is required')--}}
{{--                            ])!!}--}}
                <label>@lang('vms::fuelLogBook.image_size')</label>
                <!-- error message -->
                @if ($errors->has('acknowledgement_one'))
                    <div class="help-block text-danger">
                        {{ $errors->first('acknowledgement_one') }}
                    </div>
                @endif
            </div>
            <div class="col-6">
            {!! Form::label('voucher_number', trans('vms::fuelBillSubmit.form_elements.attachment'), ['class' => 'form-label']) !!}
                    <input class="form-control " accept=".png, .jpg, .jpeg" name="acknowledgement_two" type="file">

                <label>@lang('vms::fuelLogBook.image_size')</label>
            <!-- error message -->
                @if ($errors->has('acknowledgement_two'))
                    <div class="help-block text-danger">
                        {{ $errors->first('acknowledgement_two') }}
                    </div>
                @endif
            </div>

        </div>
        <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('labels.save')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{ route('vms.fuel.log.index') }}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('page-css')
        <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    @endpush


@push('page-js')


    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script>
        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: true,
            format: 'mmm yyyy'
        });

        $(document).ready(function () {
            validateForm('.company-form');

        });
        $('.select2').select2({
            allowClear: true
        });
    </script>
@endpush

@endsection
