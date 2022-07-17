@extends('vms::layouts.master')
@section('title', trans('vms::requisition.items.create'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('vms::requisition.items.create')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('vms::requisition.create.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('page-js')
    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <script>
        $(`.repeater-medicine`).repeater({
            initEmpty: false,
            show: function () {
                $(this).find('.select2-container').remove();
                $(this).find('select').select2({
                    placeholder: 'Select a Option'
                });

                $(this).slideDown();
            },

        });

        $(document).ready(function () {
            validateForm('.maintenanceIteForm');

        });

        $('.select2').select2({
            allowClear: true
        });
        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: true,
            format: 'mmm yyyy'
        });
    </script>
@endpush
