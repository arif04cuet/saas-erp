@extends('mms::layouts.master')
@section('title', trans('mms::company.registration'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('mms::company.registration')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('mms::company.form')
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

    </script>
@endpush
