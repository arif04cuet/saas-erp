@extends('tms::layouts.master')
@section('title', trans('tms::hostel_booking_request.title'))
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
                        @include('tms::hostel-booking-request.form.form')
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
    <script src="{{ asset('js/tms-accounts/journal-entry.js') }}"></script>
    <script>
        const trainingInformations = {!! $trainingInformations !!};
        const placeHolder = `{!! trans('labels.select') !!}`;
        const roomTypes = @json($roomTypes,JSON_UNESCAPED_UNICODE);
        const startDate = $('input[name="start_date"]').pickadate({
            format: 'yyyy-mm-dd',
            min: new Date()
        }).on('change', function () {
            $('input[name="end_date"]').valid();
        });
        const endDate = $('input[name="end_date"]').pickadate({
            format: 'yyyy-mm-dd',
        }).on('change', function () {
            $(this).valid();
        });
        function addCustomValidation() {
            const StartDateErrorMessage = `{!! trans('labels.start_date_greater_than_or_equal_end_date') !!}`;
            const EndDateErrorMessage = `{!! trans('labels.end_date_greater_than_or_equal_start_date') !!}`;

            // greater than
            jQuery.validator.addMethod("greaterThan",
                function (value, element, params) {
                    let endDate = new Date(value);
                    let startDate = new Date($(params).val());
                    if (!/Invalid|NaN/.test(endDate)) {
                        return endDate >= startDate;
                    }
                    return false;
                });
            // smaller than
            jQuery.validator.addMethod("smallerThan",
                function (value, element, params) {
                    let startDate = new Date(value);
                    let endDate = new Date($(params).val());
                    if (!/Invalid|NaN/.test(startDate)) {
                        return startDate <= endDate;
                    }
                    return false;
                });
            //end date validation
            $('.end-date').rules('add', {
                    greaterThan: ".start-date",
                    messages: {
                        greaterThan: EndDateErrorMessage,
                    }
                }
            );
        }

        $(document).ready(function () {
            let repeater = $('.tms-hostel-booking-request-repeater').repeater({
                show: function () {
                    deleteDuplicateFromRepeater('.select-room-type', roomTypes, false, true, placeHolder);
                    if (!isSelectOptionsEmpty('.select-room-type')) {
                        return;
                    }
                    makeDropdownSelect2('.select-room-type', placeHolder);
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                defaultValues: {
                    quantity: 1,
                },
                isFirstItemUndeletable: true,
            })
            validateForm('.tms-hostel-booking-request-form');
            addCustomValidation();
        });

        function changeInformation(element) {
            let trainingId = $(element).val();
            let values = trainingInformations[trainingId];
            $('input[name=no_of_trainee]').val(values.total_registered_trainees);
            startDate.pickadate('picker').set('select', values.start_date, {format: 'yyyy-mm-dd'});
            endDate.pickadate('picker').set('select', values.end_date, {format: 'yyyy-mm-dd'});
            removeBootstrapValidation();
        }


    </script>
@endpush
