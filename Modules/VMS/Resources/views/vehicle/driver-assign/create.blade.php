@extends('vms::layouts.master')
@section('title', trans('vms::driver-assign.title'))
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
                        {!! Form::open(['route' =>  'vms.vehicles.driver-assign.store','class' => 'form vehicle-driver-assign-form']) !!}
                        @include('vms::vehicle.driver-assign.form')
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
    <!-- custom -->
    <script>
        let vehicle = @json($vehicle);
        $(document).ready(function () {
            validateForm('.vehicle-driver-assign-form');
            if (!vehicle) $('.dynamic-content').hide();
            $('select[name=vehicle_id]').change(function () {
                let selectedId = $(this).val();
                url = '{{route('vms.vehicles.driver-assign.vehicle-information',":id")}}';
                url = url.replace(":id", selectedId);
                $.get(url, function (data) {
                    $('.dynamic-content').html(data).show();
                });
            });
        })
    </script>
@endpush
