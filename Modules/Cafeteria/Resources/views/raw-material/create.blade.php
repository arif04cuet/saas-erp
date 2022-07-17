@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::raw-material.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('cafeteria::raw-material.title')
                           @if ($page == "create")
                                @lang('labels.create')
                           @else
                                @lang('labels.edit')
                           @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('cafeteria::raw-material.form')
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
                if($('input[name=type]:checked').val() == "finish-food") {
                    changeUnitPriceCategoryVisibility(true);
                } else {
                    changeUnitPriceCategoryVisibility(false);
                }
                validateForm('.raw-material-form');
            });

            $('input[name=type]').on('ifClicked', function () {
                if ($(this).val() == "finish-food") {
                    changeUnitPriceCategoryVisibility(true)
                } else {
                    changeUnitPriceCategoryVisibility(false);
                }
            });

            function changeUnitPriceCategoryVisibility(flag) {
                var element = $('.unit-price-category');
                if (flag) {
                    element.show();
                    $('.price').addClass('required');
                } else {
                    element.hide();
                    $('.price').removeClass('required');
                }
            }
        </script>
@endpush