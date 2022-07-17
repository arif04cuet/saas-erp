@extends('hrm::layouts.master')
@section('title', trans('hrm::house-circular.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h4 class="card-title">
                            @lang('hrm::house-circular.title')
                           @if ($page == "create")
                                @lang('labels.create')
                           @else
                                @lang('labels.edit')
                           @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('hrm::house-circular.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-css')
    <!-- date-picker css -->
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
         $(document).ready(function () {
            validateForm('.house-circular-form');
            makeSelect2();
        });

        

        $('.house-repeater').repeater({
                show: function () {
                    $(this).slideDown();
                    makeSelect2();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                isFirstItemUndeletable: true
        });

        let placeholder = '{!!trans('labels.select')!!}';
        function makeSelect2() {
            $('.house-type, .house-details, .designation').select2({
                placeholder : placeholder
            });
        }
        
        $('.apply-to, .apply-from').pickadate({
            format : 'yyyy-mm-dd',
            drops: 'up',
        })
    </script>
@endpush