@extends('layouts.front-app')
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
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert bg-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="success-p">@lang('labels.dear') {{ Session::get('trainee') }},</p>
                        <p class="success-p">@lang('labels.training_registration_thank_you_message', ['attribute' => $training->title])</p>
                        <p class="success-p">@lang('labels.rdcd_authority_will_contact')</p>
                        <a href="{{ route('training-registration.index') }}" class="btn btn-amber btn-accent-4"
                            style="color: white"><b>@lang('tms::training.registration_for_training')</b></a>
                    </div>
                    <div class="text-center">
                        <h4>{{ trans('tms::trainee.help_number') }}</h4>
                    </div>
                @else
                    <!-- Form wizard with number tabs section start -->
                    <section id="validation">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    @if ($currentDate > $deadline || $registeredTraineeNo >= $training->no_of_trainee)
                                        <div class="card-content">
                                            <div class="card-body text-center">
                                                <h1>@lang('tms::training.training_completed')</h1>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-header">
                                            <h4 class="card-title">@lang('tms::training.training_registration_form')</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-h font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body">
                                                {!! Form::open(['route' => ['training-registration.store', $training->id], 'class' => 'wizard-circle training-steps', 'novalidate', 'enctype' => 'multipart/form-data']) !!}

                                                {!! Form::hidden('lang_preference', $langPreference) !!}
                                                <!-- Step 1 -->
                                                <!-- todo:: filter with localization -->
                                                @include(
                                                    'tms::public.training-registration.partials.form.step-1'
                                                )
                                                <!-- Step 2 -->
                                                <!-- todo:: filter with localization -->
                                                @include(
                                                    'tms::public.training-registration.partials.form.step-2'
                                                )
                                                <!-- Step 3 -->
                                                @include(
                                                    'tms::public.training-registration.partials.form.step-3'
                                                )
                                                <!-- Step 4 -->
                                                <!-- todo:: filter with localization -->
                                                @include(
                                                    'tms::public.training-registration.partials.form.step-4'
                                                )
                                                <!-- Step 5 -->
                                                @include(
                                                    'tms::public.training-registration.partials.form.step-5'
                                                )
                                                {{ Form::close() }}
                                            </div>
                                            <div class="text-center">
                                                <h4>{{ trans('tms::trainee.help_number') }}</h4>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Form wizard with number tabs section end -->
                @endif
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
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


    <script>
        let trainingForm = '.training-steps';
        var form = $(trainingForm).show();
        var imageSize;
        var image_require_massage = "{{ trans('tms::training.image_required_validation') }}"

        $(trainingForm).validate({
            ignore: 'input[type=hidden],[readonly=readonly]', // ignore hidden fields
            errorClass: 'danger',
            successClass: 'success',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio') {
                    error.insertAfter(element.parents().siblings('.radio-error'));
                } else if (element[0].tagName === "SELECT") {
                    error.insertAfter(element.siblings('.select2-container'));
                } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {
                    error.insertAfter(element.parents('.input-group'));
                } else if (element.attr("type") === "file") {
                    $('#imageValidationMassage').html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                end_date: {
                    greaterThanOrEqual: '#start_date'
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
                passing_year: {
                    minlength: 4,
                    required: true,
                    // number_custom: true [ As per BARD urgest requirement]
                }

            },
            messages: {
                passing_year: {
                    minlength: '{!! Lang::get('labels.At least 4 characters') !!}',
                    required: '{!! Lang::get('labels.This field is required') !!}',
                }
            }
        });
        $(trainingForm).steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: '{!! trans('labels.submit') !!}',
                next: '{!! trans('labels.next') !!}',
                previous: '{!! trans('labels.previous') !!}',
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                // if(currentIndex === 0){
                //     if( $("#imageUpload")[0].files.length > 0 ){
                //         if( ($("#imageUpload")[0].files.item(0).size/1028) > 3000 ){
                //             window.scrollTo(0, 0);
                //             return false;
                //         }
                //     }else{
                //         $('#imageValidationMassage').html(image_require_massage);
                //
                //         window.scrollTo(0, 0);
                //         return false
                //     }
                // }

                // show the language preference options only in the first step
                if (currentIndex < 0 || newIndex == 0) {
                    $('.heading-elements').show();
                } else {
                    $('.heading-elements').hide();
                }

                // Always allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                // Forbid next action on "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age-2").val()) < 18) {
                    return false;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden,[readonly=readonly]";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled,:hidden,[readonly=readonly]";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled,:hidden,[readonly=readonly]";
                if (form.valid()) {
                    form.find('div.actions').find('a[href="#finish"]').attr('disabled', true).off('click');
                    $('.training-steps').submit();
                } else {
                    alert('Fill all the required fields');
                }
            }
        });
    </script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script>
        $(document).ready(function() {

            toggleLanguageFields();

            $('#dateOfBirth').daterangepicker({
                startDate: moment().subtract('18', 'years'),
                maxDate: moment().subtract('18', 'years'),
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $('#dateOfJoining').daterangepicker({
                startDate: moment().subtract('18', 'years'),
                maxDate: moment(),
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });


            function toggleLanguageFields() {
                let languagePreference = @json($langPreference);
                let langOptions = @json($langOptions);
                let languageEnFields = ['input[name=badge_name]', 'input[name=english_name]',
                    'input[name=fathers_name]', 'input[name=mothers_name]', 'textarea[name=present_address]',
                    'input[name=designation]'
                ];
                let languageBnFields = ['input[name=badge_name_bn]', 'input[name=bangla_name]',
                    'input[name=fathers_name_bn]', 'input[name=mothers_name_bn]',
                    'textarea[name=present_address_bn]', 'input[name=designation_bn]'
                ];
                if (languagePreference == langOptions['only_english']) {
                    modifyLanguageElements(languageBnFields, true);
                    modifyLanguageElements(languageEnFields, false);
                } else if (languagePreference == langOptions['only_bangla']) {
                    modifyLanguageElements(languageEnFields, true);
                    modifyLanguageElements(languageBnFields, false);
                } else {
                    modifyLanguageElements(languageBnFields, false);
                    modifyLanguageElements(languageEnFields, false);
                }
            }

            function modifyLanguageElements(elementArray, makeReadonly) {

                $.each(elementArray, function(key, value) {
                    if (makeReadonly) {
                        $(value).val('');
                        $(value).attr('readonly', 'readonly');
                    } else {
                        $(value).removeAttr('readonly');
                    }
                });
            }


            jQuery.validator.addMethod(
                'unique-mobile',
                function(value, element, params) {
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
                        success: function(response) {
                            success = response.status === true;
                        }
                    });

                    return success;
                },
                "{{ trans('tms::trainee.registration.mobile.unique') }}"
            );

            jQuery.validator.addMethod(
                "regex-bn",
                function(value, element, params) {
                    let regex = new RegExp(params);
                    return value.match(params);
                },
                "{{ trans('tms::trainee.errors.messages.regex.bn') }}"
            );

            jQuery.validator.addMethod(
                "regex-en",
                function(value, element, params) {
                    let regex = new RegExp(params);
                    return value.match(params);
                },
                "{{ trans('tms::trainee.errors.messages.regex.en') }}"
            );

            jQuery.validator.addMethod(
                'max-experience',
                function(value, element, params) {
                    let numbers = {
                        '0': 0,
                        '1': 1,
                        '2': 2,
                        '3': 3,
                        '4': 4,
                        '5': 5,
                        '6': 6,
                        '7': 7,
                        '8': 8,
                        '9': 9,
                        '\u09E6': 0,
                        '\u09E7': 1,
                        '\u09E8': 2,
                        '\u09E9': 3,
                        '\u09EA': 4,
                        '\u09EB': 5,
                        '\u09EC': 6,
                        '\u09ED': 7,
                        '\u09EE': 8,
                        '\u09EF': 9,
                    };

                    let experience = '';
                    if (value.length > 0) {
                        for (var i = 0; i < value.length; i++) {
                            if (value[i] !== '.') {
                                experience += numbers[value[i]];
                            } else {
                                experience += value[i];
                            }
                        }

                        if (isNaN(Number(experience))) {
                            return false;
                        }
                        if (experience[experience.length - 1] === '.') {
                            return false;
                        }

                        experience = parseFloat(experience);

                        return (experience <= 50.00);
                    }

                    return true;
                },
                "{{ trans('tms::trainee.errors.messages.experience') }}"
            );

            jQuery.validator.addMethod(
                'no-white-space',
                function(value, element, params) {
                    let regex = new RegExp(params);
                    return value.match(params);
                },
                "{{ trans('labels.This field is required') }}"
            );

            jQuery.validator.addMethod(
                'regex-fax',
                function(value, element, params) {

                    if (value === "") {
                        return true;
                    }

                    let regex = new RegExp(params);
                    return value.match(params);
                },
                "{{ trans('tms::trainee.errors.messages.regex.number') }}"
            );

            jQuery.validator.addMethod(
                'image-size',
                function(value, element, params) {
                    if ($(params)[0].files.length > 0) {
                        let imageSize = ($(params)[0].files.item(0).size) / 1028;
                        return (imageSize <= 3000.00);
                    }

                    return true;
                },
                "{{ trans('tms::trainee.errors.messages.image_size') }}"
            );

            jQuery.validator.addMethod("number_custom", function(value, element) {

                if (document.getElementById('localisation').value == 'bn') {
                    return this.optional(element) || /^[০-৯]+()$/.test(value);
                } else {
                    return this.optional(element) || /^[0-9]+()$/.test(value);
                }

            }, '{!! Lang::get('labels.Please enter a valid number') !!}');
        });
    </script>

    <script src="{{ asset('theme/js/scripts/forms/select/form-select2.js') }}"></script>
@endpush
