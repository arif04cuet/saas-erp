@extends('tms::layouts.master')
@section('title', trans('tms::trainee.add_trainee'))
@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photo-upload.css') }}">
@endpush

@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('tms::training.add_trainee')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                            @include('tms::trainee.partials.forms.personal_info')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-css')
    <style type="text/css">
        #imageValidationMassage > label {
            font-size: 16px;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
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

    <script type="text/javascript">
        $(document).ready(function () {
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");
            $('.select').select2();

            // datepicker
            $('#dateOfBirth').daterangepicker({
                startDate: moment().subtract('18', 'years'),
                maxDate: moment().subtract('18', 'years'),
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            let validator = $('.trainee-create-form').validate({
                ignore: [],
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') == 'radio') {
                        error.insertBefore(element.parents().siblings('.radio-error'));
                    } else if (element[0].tagName == "SELECT") {
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') == 'ckeditor') {
                        error.insertAfter(element.siblings('#cke_ckeditor'));
                    } else if(element.attr("type") === "file") {
                        $('#imageValidationMassage').html(error);
                    }else {
                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    form.submit();
                }
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

        jQuery.validator.addMethod(
            "regex-bn",
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans('tms::trainee.errors.messages.regex.bn') }}"
        );

        jQuery.validator.addMethod(
            "regex-en",
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans('tms::trainee.errors.messages.regex.en') }}"
        );

        jQuery.validator.addMethod(
            'unique-mobile',
            function (value, element, params) {
                let success = true;
                $.ajax({
                    url: "{{ route('trainings.trainees.registrations.unique', ['training' => $training]) }}",
                    type: 'post',
                    async: false,
                    dataType: 'json',
                    data: {
                        'mobile': $('input[name=mobile]').val(),
                        'training_id': "{{ $training->id }}",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        success = response.status === true;
                    }
                });

                return success;
            },
            "{{ trans('tms::trainee.registration.mobile.unique') }}"
        );

        jQuery.validator.addMethod(
            'no-white-space',
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans("labels.This field is required") }}"
        );

        jQuery.validator.addMethod(
            'image-size',
            function (value, element, params) {
                if($(params)[0].files.length > 0) {
                    let imageSize = ($(params)[0].files.item(0).size)/1028;
                    return (imageSize <= 3000.00);
                }

                return true;
            },
            "{{ trans('tms::trainee.errors.messages.image_size') }}"
        );

        jQuery.validator.addMethod(
            'regex-fax',
            function (value, element, params) {

                if(value === "") {
                    return true;
                }

                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans('tms::trainee.errors.messages.regex.number') }}"
        );

    </script>
@endpush
