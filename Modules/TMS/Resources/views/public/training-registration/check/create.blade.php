@extends('layouts.public')

@section('title', trans('tms::training.training_registration'))
@push('page-css')
    <style>
        .success-p {
            color: black;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-12 my-auto align-self-center">
                <section id="validation">
                    <div class="row">
                        <div class="col-md-12 my-auto align-self-center">
                            <div class="card">
                                @if(is_null(optional($training)->registration_deadline))
                                    <div class="card-content">
                                        <div class="card-body text-center">
                                            <h1>@lang('tms::training.training_registration_not_started')</h1>
                                        </div>
                                    </div>
                                @elseif((\Carbon\Carbon::today() > \Carbon\Carbon::parse($training->registration_deadline)) || $training->trainee->count() >= $training->no_of_trainee)
                                    <div class="card-content">
                                        <div class="card-body text-center">
                                            <h1>@lang('tms::training.training_completed')</h1>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-header">
                                        <div class="card-title text-center"><h4><b>{{ $training->title }}</b></h4></div>
                                        <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            {{ Form::open(
                                                [
                                                    'route' => ['trainings.trainees.registrations.verify', $training],
                                                    'class' => 'wizard-circle training-registration-check'
                                                ]
                                            ) }}
                                            @include('tms::public.training-registration.check.partials.form')
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photo-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('theme/js/core/app.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/select/form-select2.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.training-registration-check').validate({
                ignore: 'input[type=hidden]', // ignore hidden fields
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'radio') {
                        error.insertAfter(element.parents().siblings('.radio-error'));
                    } else if (element[0].tagName === "SELECT") {
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {
                        error.insertAfter(element.parents('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {}
            });
        });

        jQuery.validator.addMethod(
            "regex-number",
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans('tms::trainee.errors.messages.regex.number') }}"
        );
    </script>
@endpush
