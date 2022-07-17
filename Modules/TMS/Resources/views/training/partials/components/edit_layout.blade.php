@extends('tms::layouts.master')
@section('title', trans('tms::training.edit_training'))
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
@endpush
@section('content')
    <body onload="">
    <section id="user-form-layouts">
        <div class="container">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card training-process-tab">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form"><i class="ft-tag"></i> {{trans('tms::training.edit_training')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @include('tms::training.partials.edit_nab_tabs')
                                <div class="tab-content px-1 pt-1">
                                    <div role="tabpanel"
                                         class="tab-pane active">
                                        <!-- views are injected in slot -->
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

            if($('#training_start_date').length > 0) {
                $('#training_start_date, #training_end_date, #registration_deadline').pickadate({
                    format: 'dd mmmm yyyy',
                });

                $('#training_end_date').pickadate('picker').set('min', new Date($('#training_start_date').val()));

                $('#training_start_date').change(function () {
                    $('#training_end_date').pickadate('picker').set('min', new Date($(this).val()));
                });

                dateDifference();
            }

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
            $('select').select2({
                placeholder: '{{ trans('labels.select') }}'
            });

            jQuery.validator.addMethod(
                "greaterThanOrEqual",
                function (value, element, params) {
                    let comparingDate = params == '#training_start_date' ? $(params).val() : params;
                    return Date.parse(value) >= Date.parse(comparingDate);
                },
                "{{ trans('labels.greaterThanOrEqual', ['name' => trans('tms::training.start_date')]) }}"
            );

            $('.training-form').validate({
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
                        if ((element.hasClass('training_level'))) {
                            error.insertAfter(element.parents().siblings('.radio-error'));
                        } else {
                            error.insertBefore($('div').find("[data-radio-field-name='" + element.attr('name') + "']"));
                        }

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));

                    } else {

                        error.insertAfter(element);
                    }
                },
                rules: {
                    end_date: {
                        greaterThanOrEqual: '#training_start_date'
                    },
                    first_name: {
                        maxlength: 50
                    },
                    // 'room-show': {
                    //     CheckRoomValidation: 0
                    // },
                    contact: {
                        minlength: 11,
                        maxlength: 11
                    },
                    address: {
                        maxlength: 300
                    },
                    nid: {
                        minlength: 10,
                        maxlength: 10
                    },
                },
            });

        });
    </script>

    <script>
        function dateDifference() {
            var val1 = document.getElementById('training_start_date').value;
            var val2 = document.getElementById('training_end_date').value;
            var date1 = new Date(val1);
            var date2 = new Date(val2);

            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = (Math.ceil(timeDiff / (1000 * 3600 * 24))) + 1;
            if (diffDays > 0)
                document.getElementById('training_len').value = diffDays + " days";
            else
                document.getElementById('training_len').value = "...";
        }
    </script>

@endpush
