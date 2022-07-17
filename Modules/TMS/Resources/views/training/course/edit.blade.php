@component('tms::training.course.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'edit',
])
    <div class="col-md-12">
        {{ Form::open(['route' => ['trainings.courses.update', $training->id, $course->id], 'method' => 'PUT', 'class' => 'training-course-edit-form course-custom-textarea', 'id' => 'training-course-edit-form','enctype' => 'multipart/form-data']) }}
        @if($through_training == 'online' && isset($through_training))
            @include('tms::training.course.partial.online_edit_form')
        @else
            @include('tms::training.course.partial.edit_form')
        @endif
        <div class="form-actions">
            <button type="submit" class="master btn btn-primary">
                <i class="ft-check-square"></i> {{ trans('labels.save') }}
            </button>
            <a href="{{ route('trainings.courses.show', [$training->id, $course->id]) }}" class="master btn btn-warning">
                <i class="ft-x"></i> {{ trans('labels.cancel') }}
            </a>
        </div>
        {{ Form::close() }}
    </div>

    {{-- <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script> --}}
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
            $(window).ready(function () {
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

        <script type="text/javascript">
            $(window).ready(function () {

                jQuery.validator.addMethod(
                    'no-white-space',
                    function (value, element, params) {
                        let regex = new RegExp(params);
                        return value.match(params);
                    },
                    "{{ trans("labels.This field is required") }}"
                );

                $('.training-course-edit-form').validate({
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
                    rules: {},
                });
            });
        </script>
    @endpush
@endcomponent
