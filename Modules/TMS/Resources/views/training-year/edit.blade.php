@extends('tms::layouts.master')

@section('title', trans('tms::training_type.edit'))

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form"><i class="ft-user black"></i> @lang('tms::training_type.edit')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0 list-circle">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body preduce">
                        {!! Form::open(['route' =>  ['training-year.update',$trainingYear], 'class' => 'form wizard-circle training-type-form', 'novalidate', 'method' => 'post']) !!}
                        @method('put')
                        @include('tms::training-year.edit_form')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photo-upload.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/editors/tinymce/tinymce.min.css') }} "/>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>


    <script>
        $(document).ready(function () {
            validateForm('.training-year-form');

            const EndDateErrorMessage = `{!! trans('labels.end_date_greater_than_or_equal_start_date') !!}`;

            $('#start_date').pickadate({
                format: 'dd mmmm yyyy',
                container: "#start-date-container",
            });
            $('#end_date').pickadate({
                format: 'dd mmmm yyyy',
                container: "#end-date-container",

            });
            $('#registration_deadline').pickadate({
                format: 'dd mmmm yyyy',
                container: "#registration-deadline-container"
            });


            $('#start_date').change(function () {
                $('#end_date').pickadate('picker').set('min', new Date($(this).val()));
            });

            $('select').select2({
                placeholder: '{{ trans('labels.select') }}'
            });

            jQuery.validator.addMethod(
                "greaterThan",
                function (value, elements, params) {
                    let comparingDate = params === '#start_date' ? $(params).val() : params;
                    let diff = Date.parse(value) - Date.parse(comparingDate);
                    const oneMonth = 30000 * 24 * 60 * 60;
                    return diff > oneMonth
                },
                '{{ trans('labels.greaterThan', ['name' => trans('hrm::appraisal.start_date')]) }}'
            );

            //end date validation
            $('#end_date').rules('greaterThan', {
                    greaterThan: "#start_date",
                    messages: {
                        greaterThan: EndDateErrorMessage,
                    }
                }
            );

            $('#start-date').on('mousedown', function (event) {
                event.preventDefault();
            })


        });
    </script>
@endpush

