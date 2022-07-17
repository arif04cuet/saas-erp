@extends('vms::layouts.master')
@section('title', trans('vms::trip.title'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('labels.create') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        {!! Form::open(['route' =>  'vms.monthly-bill.store', 'class' => 'form vms-monthly-bill-form']) !!}
                        @include('vms::bill-sector.submission.form.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($method == 'POST')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' => 'vms.monthly-bill.submit', 'class' => 'form vms-monthly-bill-submit-form']) !!}
                            @include('vms::bill-sector.submission.form.submission-form')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')

    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- daterange picker -->
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <!-- custom -->
    <script>
        let genericErrorMessage = '<?php echo trans('labels.generic_error_message'); ?>';
        $(document).ready(function () {
            validateForm('.driver-form');

            $('.date').pickadate({
                // min: new Date(year, month, 2),
                format: 'mmmm,yyyy',
                formatSubmit: 'yyyy-mm-dd',
                selectYears: true,
                selectMonths: true
            });

            $('.vms-monthly-bill-submit-form').submit(function (eventObj) {
                    if (confirm("Are you sure ?")) {
                        let table = $('#bill-submission-table').dataTable();
                        table.api().rows().nodes().page.len(-1).draw(false);
                        return true;
                    } else {
                        return false;
                    }
                }
            );

        })
    </script>
@endpush
