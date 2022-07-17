@extends('tms::layouts.master')

@section('title', trans('labels.new') .' '. trans('tms::training.create_card_title'))

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card training-process-tab">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form"><i class="ft-tag"></i> @lang('tms::training.edit_training')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('tms::training.partials.form.general_info_edit')
                        </div>
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
    <!-- custom -->
    <style>
        .picker__holder {
            bottom: 100px;
        }
    </style>
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
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                readURL(this);
            });
        })
    </script>

    <script>
        $(document).ready(function () {
            validateForm('.training-form');

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