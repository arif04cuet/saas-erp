@extends('hm::layouts.master')
@section('title', __('hm::checkin.search_approved_booking'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">
                            @lang('hm::checkin.training.form')
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('hm::check-in.physical-facility.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/check-in/checkin.js') }}"></script>
    <script src="{{ asset('js/check-in/approved-training.js') }}"></script>
    <script>
        let roomTypes = @json($roomTypes,JSON_UNESCAPED_UNICODE);
        let placeholder = '{!! trans('labels.select') !!}';
        $(document).ready(function () {
            initAllRepeater();
            validateForm('.organization-hostel-checkin-form');
        });

        function initAllRepeater() {
            $('.room-assign-repeater').repeater({
                initEmpty: false,
                isFirstItemUndeletable: true,
                show: function () {
                    resetValidation(getFormElement());
                    deleteDuplicateFromRepeater(
                        '.room-type-select',
                        roomTypes,
                        false,
                        true,
                        placeholder
                    );
                    if (!isSelectOptionsEmpty('.room-type-select')) {
                        return;
                    }
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    resetValidation(getFormElement());
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                defaultValues: {},
                repeaters: [{
                    initEmpty: false,
                    isFirstItemUndeletable: true,
                    // (Required)
                    selector: '.inner-repeater',
                    show: function () {
                        resetValidation(getFormElement());
                        $(this).slideDown();
                    },
                    defaultValues: {},
                }]
            });
        }

    </script>

@endpush
