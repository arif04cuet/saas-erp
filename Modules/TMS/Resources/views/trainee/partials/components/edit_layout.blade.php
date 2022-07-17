@extends('tms::layouts.master')
@section('title', trans('tms::trainee.edit_trainee'))
@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/photo-upload.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@section('content')
    <section id="user-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card trainee-create-process-tab">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{
                             Auth::user()->can('tms-access-medical') ? trans('tms::training.health_examination_report_edit') : trans('tms::training.edit_trainee')
                        }}</h4>

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
                            @include('tms::trainee.partials.nab-tabs.edit')
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
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
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
                maxDate: moment().subtract('18', 'years'),
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            let validator = $('.trainee-edit-form').validate({
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
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {

                    pulse:{
                        required:true,
                        number:true,
                        min:1
                    },
                    temperature: {
                        required:true,
                        number:true,
                        max:108,
                        min:1
                    },
                    respiration:{
                        required:true,
                        number:true,
                        min:1
                    },
                    conjunctiva: {
                        required:true,
                    },
                    oral_cavity: {
                        required:true,
                    },
                    denture:{
                        required:true,
                    },
                    blood_pressure:{
                        required:true,
                    },
                    anaemia:{
                        required:true,
                    },
                    oedema:{
                        required:true,
                    },
                    heart:{
                        required:true,
                    },
                    lung:{
                        required:true,
                    },
                    abdomen:{
                        required:true,
                    },
                    eye_sight:{
                        required:true,
                    },
                    left_eye:{
                        required:true,
                    },
                    right_eye:{
                        required:true,
                    }

                },
                messages:{
                    pulse:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                        number:"{!!Lang::get('labels.number')!!}",
                        min:"{!!Lang::get('labels.number_min')!!}"
                    },
                    temperature: {
                        required:"{!!Lang::get('labels.This field is required')!!}",
                        number:"{!!Lang::get('labels.number')!!}",
                        max:"{!!Lang::get('labels.temp_max')!!}",
                        min:"{!!Lang::get('labels.number_min')!!}"
                    },
                    respiration:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                        number:"{!!Lang::get('labels.number')!!}",
                        min:"{!!Lang::get('labels.number_min')!!}"
                    },
                    conjunctiva: {
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    oral_cavity: {
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    denture:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    blood_pressure:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    anaemia:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    oedema:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    heart:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    lung:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    abdomen:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    eye_sight:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    left_eye:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    },
                    right_eye:{
                        required:"{!!Lang::get('labels.This field is required')!!}",
                    } 
                },
                submitHandler: function (form, event) {
                    form.submit();
                }
            });
        });

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
            "regex-number",
            function (value, element, params) {
                let regex = new RegExp(params);
                return value.match(params);
            },
            "{{ trans('tms::trainee.errors.messages.regex.number') }}"
        );

        jQuery.validator.addMethod(
            'unique-mobile',
            function (value, element, params) {
                let success = true;
                $.ajax({
                    url: "{{ route('trainings.trainees.registrations.unique', ['training' => $trainee->training, 'trainee' => $trainee]) }}",
                    type: 'post',
                    async: false,
                    dataType: 'json',
                    data: {
                        'mobile': $('input[name=mobile]').val(),
                        'training_id': "{{ $trainee->training->id }}",
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

        $('#dateOfJoining').daterangepicker({
            startDate: moment().subtract('18', 'years'),
            maxDate: moment().subtract('18', 'years'),
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });

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

        jQuery.validator.addMethod(
            'max-experience',
            function (value, element, params) {
                let numbers = {
                    '0' : 0,
                    '1' : 1,
                    '2' : 2,
                    '3' : 3,
                    '4' : 4,
                    '5' : 5,
                    '6' : 6,
                    '7' : 7,
                    '8' : 8,
                    '9' : 9,
                    '\u09E6' : 0,
                    '\u09E7' : 1,
                    '\u09E8' : 2,
                    '\u09E9' : 3,
                    '\u09EA' : 4,
                    '\u09EB' : 5,
                    '\u09EC' : 6,
                    '\u09ED' : 7,
                    '\u09EE' : 8,
                    '\u09EF' : 9,
                };

                let experience = '';
                if(value.length > 0) {
                    for(var i=0; i< value.length; i++) {
                        if(value[i] !== '.') {
                            experience += numbers[value[i]];
                        }else {
                            experience += value[i];
                        }
                    }

                    if(isNaN(Number(experience))) {
                        return false;
                    }
                    if(experience[experience.length-1] === '.') {
                        return false;
                    }

                    experience = parseFloat(experience);

                    console.log(experience);
                    return (experience <= 50.00);
                }

                return true;
            },
            "{{ trans('tms::trainee.errors.messages.experience') }}"
        );

        function setRadio(obj) 
        {
            if(document.getElementById('org_trainee_type').checked == true) {
                $('.kormokarta-form').css('display', 'none');
                $('.association-member').css('display', 'block');
                $('input:text[name="org_name"]').prop('disabled',false);
                $('input:text[name="org_id"]').prop('disabled',false);
                $('input:text[name="org_member_name"]').prop('disabled',false);
                $('input:text[name="org_member_join_date"]').prop('disabled',false);
            }else if(document.getElementById('doptor_trainee_type').checked == true){
                $('.association-member').css('display', 'none');
                $('.kormokarta-form').css('display', 'block');

                $('input:text[name="doptor_name"]').prop('disabled',false);
                $('input:text[name="doptor_service_id"]').prop('disabled',false);
                $('select[name="doptor_present_designation"]').prop('disabled',false);
                $('input:text[name="doptor_join_date"]').prop('disabled',false);
                $('input:text[name="doptor_present_designation_join_date"]').prop('disabled',false);

                $('input:text[name="org_name"]').prop('disabled',true);
                $('input:text[name="org_id"]').prop('disabled',true);
                $('input:text[name="org_member_name"]').prop('disabled',true);
                $('input:text[name="org_member_join_date"]').prop('disabled',true);

            }
        }

        $('#org_member_join_date').pickadate({
                singleDatePicker: true,
                showDropdowns: true,
                autoclose:true,
                todayHighlight: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
            $('#doptor_join_date').pickadate({
                singleDatePicker: true,
                showDropdowns: true,
                autoclose:true,
                todayHighlight: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
            $('#doptor_present_designation_join_date').pickadate({
                singleDatePicker: true,
                showDropdowns: true,
                autoclose:true,
                todayHighlight: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

    </script>
@endpush
