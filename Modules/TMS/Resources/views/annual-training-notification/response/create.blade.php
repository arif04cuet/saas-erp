@extends('tms::layouts.master')
@section('title', trans('tms::annual_training.response.title'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if($type == $responseTypes[0])
                        @if($isOrganizationNotificationExpired && !Auth::check())
                            <div class="alert alert-danger" role="alert">
                                {{trans('tms::annual_training.response.expired_message')}}
                            </div>
                        @else
                            <h4 class="card-title">{{ trans('labels.create') }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        @endif
                    @else
                        <h4 class="card-title">{{ trans('labels.create') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    @endif

                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                    @if($type == $responseTypes[0])
                        @if(!$isOrganizationNotificationExpired || Auth::check())
                            <!-- organization form -->
                            @include('tms::annual-training-notification.response.form.organization-form')
                        @endif
                    @else
                           <!-- response by user -->
                            @include('tms::annual-training-notification.response.form.user-form')
                        @endif
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
    <script>
        const placeHolder = `{!! trans('labels.select') !!}`;

        function initDatePickers() {
            const startDate = $('.start-date').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date()
            })
                .on('change', function () {
                    $(this).valid();
                });
            const endDate = $('.end-date').pickadate({
                format: 'yyyy-mm-dd',
            })
                .on('change', function () {
                    $(this).valid();
                });
        }

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

            $('.start-date').each(function () {
                let element = $(this).attr('name');
                let index = getNumberFromString(element);
                let endDateElement = `input[name="response[${index}][end_date]"]`
                $(this).rules('add', {
                        smallerThan: endDateElement,
                        messages: {
                            smallerThan: StartDateErrorMessage,
                        }
                    }
                );
            });
            $('.end-date').each(function () {
                let element = $(this).attr('name');
                let index = getNumberFromString(element);
                let startDateElement = `input[name="response[${index}][start_date]"]`
                $(this).rules('add', {
                        greaterThan: startDateElement,
                        messages: {
                            greaterThan: EndDateErrorMessage,
                        }
                    }
                );
            });
        }

        function resetDatePickers() {
            $(this).find('.start-date').removeClass('picker__input').removeAttr('aria-owns').removeAttr('id').attr('readOnly', false);
            $(this).find('.end-date').removeClass('picker__input').removeAttr('aria-owns').removeAttr('id').attr('readOnly', false);
            $(this).find('.picker').remove();
            $(this).find('.picker__input').remove();
            initDatePickers();
            addCustomValidation();
        }

        $(document).ready(function () {
            initDatePickers();
            let repeater = $('.annual-training-notification-response-repeater').repeater({
                show: function () {
                    resetDatePickers();
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                defaultValues: {
                    no_of_trainee: 1,
                    start_date: formatDate(new Date()),
                    end_date: formatDate(new Date()),
                },
                isFirstItemUndeletable: true,
            })
            validateForm('.tms-annual-training-notification-response-form');
            addCustomValidation();
        });

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }
    </script>
@endpush
