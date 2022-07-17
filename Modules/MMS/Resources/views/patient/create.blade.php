@extends('mms::layouts.master')
@section('title', trans('mms::patient.registration'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('mms::patient.registration')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('mms::patient.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
        $(document).ready(function () {
            InitAllDropDown();
            validateForm('.patient-form');
            @if($page == 'edit')
            if ($('input[name="type"]:checked').val() !== 'employee') {
                $('.txt-div').show();
                $('.dropdown-div').hide();
                $('.dropdown-name').removeClass('required');
            } else {
                $('.txt-div').hide();
                $('.dropdown-div').show();
                $('.dropdown-name').addClass('required');
            }
            @endif
        });

        function InitAllDropDown() {
            $('.select2-container').remove();
            $('.employee-select').select2({
                selectOnClose: true,
            });
        }
    </script>
@endpush
