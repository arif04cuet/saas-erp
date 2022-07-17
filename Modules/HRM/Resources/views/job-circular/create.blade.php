@extends('hrm::layouts.master')
@section('title', trans('labels.new') .' '. trans('hrm::circular.job_circular'))

@section("content")
    <section id="leave">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--<h4 class="card-title" id="repeat-form">@lang('hrm::leave.leave_application')</h4>--}}
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h3 class="form-section"><i
                                    class="ft-grid"></i> @lang('labels.new',[],'en') @lang('hrm::circular.job_circular',[],'en')
                            </h3>
                            @include('hrm::job-circular.form.form', ['page' => 'create'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('page-css')

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/editors/tinymce/tinymce.min.css') }} "/>
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>


    <script src="{{asset('theme/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            validateJobCircularForm('.job-circular-form');
            initAllRepeater('.job-circular-repeater');
            // datepicker
            $('#deadline_date').pickadate({
                min: new Date(),
                max: 365 * 17,
                default: new Date(),
            });
            $("select").select2();
            $(".job_nature").select2({
                tags: true
            })
            initTinyMce();
        });

        function initAllRepeater(className) {
            $(className).repeater({
                initEmpty: false,
                show: function () {
                    initTinyMce();
                    makeDropdownSelect2('.select2');
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                defaultValues: {},
                isFirstItemUndeletable: true,
            });
        }

        function initTinyMce() {
            tinymce.remove();
            tinymce.init({
                setup: function (editor) {
                    editor.on('init change', function () {
                        editor.save();
                    });
                },
                selector: 'textarea',
                menubar: false,
                height: 200,
                theme: 'modern',
                plugins: " advlist autolink lists link image charmap print preview textcolor anchor searchreplace visualblocks code fullscreen insertdatetime media table paste imagetools wordcount",
                toolbar: "textcolorinsertfile undo redo | fontselect fontsizeselect | styleselect| textcolor forecolor backcolor  | table  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link | image | ",
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '{{asset("theme/vendors/css/editors/tinymce/tinymce.min.css")}}'
                ]
            });
        }


        function makeDropdownSelect2(className) {
            $(className).next('.select2-container').remove();
            $(className).select2({
                selectOnClose: true,
            });
        }

        function validateJobCircularForm(classname) {
            removeBootstrapValidation();
            $(classname).validate({
                ignore: ':hidden:not(textarea)',
                errorClass: 'danger',
                successClass: 'success',
                errorElement: "span",
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                    $(element).parent('.form-group').addClass('error');
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                    $(element).parent('.form-group').removeClass('error');
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'radio') {
                        error.insertBefore(element.parents().siblings('.radio-error'));
                    } else if (element[0].tagName === "SELECT") {
                        //for normal dropdown
                        error.insertAfter(element);
                        //for select2 dropdown
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {
                        error.insertAfter(element);
                    } else if (element.attr('type') === 'file') {
                        error.insertAfter(element.parent().parent().find('.avatar-preview'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    // some common name and rules
                    name: {
                        maxlength: 50
                    },
                    mobile_number: {
                        minlength: 11,
                        maxlength: 11
                    },
                },
                submitHandler: function (form, event) {
                    if (confirm('Are you sure ?')) {
                        form.submit();
                    } else {
                        return false;
                    }
                }
            });
        }



    </script>
@endpush
