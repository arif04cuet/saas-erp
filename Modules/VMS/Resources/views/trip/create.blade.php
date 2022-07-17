@extends('vms::layouts.master')
@section('title', trans('vms::trip.create'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('vms::trip.create') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        {!! Form::open(['route' =>  'vms.trip.store','class' => 'form vms-trip-form']) !!}
                        @include('vms::trip.form.form')
                        {!! Form::close() !!}
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
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')
    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- bootstrap date time picker -->
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script>
        $(document).ready(function () {
            changeElement('billed_to');
            changeElement('training_id');
            changeElement('project_id');

            validateForm('.vms-trip-form');
            // $('.trip_date_time').datetimepicker();
            let reasons = @json($reasons);
            $('.start-date-time').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                startDate: moment().startOf('hour'),
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss'
                }
            });
            $('.end-date-time').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                startDate: moment().startOf('hour'),
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss'
                }
            });

            $('.trip-type').on('ifChecked', function () {
                let val = $(this).val();
                changeDropdown(val);
            });

            function changeDropdown(name) {
                if (name == reasons[1]) {
                    // personal
                    changeElement('billed_to', true);
                    changeElement('training_id', false);
                    changeElement('project_id', false);
                } else if (name == reasons[2]) {
                    // training
                    changeElement('billed_to', false);
                    changeElement('training_id', true);
                    changeElement('project_id', false);
                } else if (name == reasons[3]) {
                    // project
                    changeElement('billed_to', false);
                    changeElement('training_id', false);
                    changeElement('project_id', true);
                } else {
                    changeElement('billed_to', false);
                    changeElement('training_id', false);
                    changeElement('project_id', false);
                }
            }

            function changeElement(name, shouldShow = false) {
                if (shouldShow) {
                    $('.' + name).show();
                } else {
                    $('.' + name).hide();
                }
            }
        })
    </script>
@endpush
