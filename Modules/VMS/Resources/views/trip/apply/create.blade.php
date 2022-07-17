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
                        {!! Form::open(['route' =>  'vms.trip.show-available-vehicle','class' => 'form driver-form']) !!}
                        @include('vms::trip.apply.form')
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
                            {!! Form::open(['route' =>  'vms.trip.create', 'method'=>'get', 'class' => 'form vms-trip-apply-form']) !!}
                            @include('vms::trip.apply.vehicle-form')
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

            $('.start-date-time').pickadate({
                // min: new Date(year, month, 2),
                format: "yyyy-mm-dd",
            });

            $(".vms-trip-apply-form").submit(function (e) {
                e.preventDefault();
                let passed = setSession();
                if (passed) {
                    $(this).unbind('submit').submit();
                } else {
                    alert(genericErrorMessage);
                    return;
                }
            });

            function setSession() {
                const form = $('.vms-trip-apply-form').serializeArray();
                const data = getSelectedVehicles(form);
                let url = '{{route('vms.trip.apply.set-vehicle-session')}}';
                return $.ajax({
                    url: url,
                    data: {'vehicles': data, '_token': "{{ csrf_token() }}"},
                    type: "post",
                    async: false,
                    success: function (data) {
                        if (!data) {
                            return false;
                        }
                        return true;
                    },
                    error: function (request, status, error) {
                        return false;
                    }
                }).responseText;
            }

            function getSelectedVehicles(formInputs) {
                let selectedVehicles = [];
                const data = [...formInputs].reduce(function (r, e) {
                    const [i, prop] = e.name.split(/\[(.*?)\]/g).slice(1).filter(Boolean)
                    if (!r[i]) r[i] = {}
                    r[i][prop] = e.value
                    return r;
                }, [])
                for (i = 0; i < data.length; i++) {
                    if (data[i]) {
                        if (data[i].hasOwnProperty('selected')) {
                            selectedVehicles.push(data[i].vehicle_id);
                        }
                    }
                }
                return selectedVehicles;
            }
        })
    </script>
@endpush
