@extends('vms::layouts.master')
@section('title', trans('vms::fuelLogBook.registration'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('vms::fuelLogBook.registration')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('vms::fuelLogBook.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('page-js')


    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
        $(document).ready(function () {
            validateForm('.company-form');

        });
        $('.select2').select2({
            allowClear: true
        });
    </script>
@endpush
