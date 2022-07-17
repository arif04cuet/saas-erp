@extends('layouts.public')
@section('title', trans('job-application.job_application'))
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/panel.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">

    <style>
        legend.scheduler-border {
            width: inherit;
            /* Or auto */
            padding: 0 10px;
            /* To give a bit of padding on the left and right */
            border-bottom: none;
        }

        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0 0 0 0 #000;
            box-shadow: 0 0 0 0 #000;
        }

    </style>
@endpush
@section('content')
    <section id="loan">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title" id="repeat-form" style="font-size: 20px;"><b>Job Application</b></h2>
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
                            <!-- Job Circular Details -->
                            <div class="text-center" id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                <div class="card collapse-icon panel mb-0 box-shadow-0 border-0">
                                    <div id="heading-1" role="tab"
                                        class="card-header border-bottom-blue-grey border-bottom-lighten-4">
                                        <a data-toggle="collapse" data-parent="#accordionWrap1" href="#accordion-1"
                                            aria-expanded="false" aria-controls="accordion-1" class="btn btn-info">
                                            <i class="ft ft-arrow-down"></i>
                                            @lang('hrm::job-circular.title')
                                        </a>
                                    </div>
                                    <div id="accordion-1" role="tabpanel" aria-labelledby="heading-1" class="collapse"
                                        aria-expanded="false">
                                        <div class="card-body">
                                            @include('hrm::job-circular.partial.common-view')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['url' => route('job-applications.public.store', $jobCircular->id), 'id' => 'job-application', 'class' => 'form job-application-tab-steps wizard-circle', 'novalidate', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                                {!! Form::token() !!}

                                @include('job-application.form.step-1')
                                @include('job-application.form.step-2')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-js')
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    @include('job-application.javascript')
    <script src="{{ asset('js/job-application/step.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/moment/moment-precise-range.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script>
        function getDataByLevel(name) {
            $index = name.match(/\d+/).toString();
            $level = $("select[name='education_information[" + $index + "][level]']").val();
            $exams = $("select[name='education_information[" + $index + "][exam_name]']");
            $board = $("select[name='education_information[" + $index + "][board_or_university]']");

            let url = "{{ url('get-data-by-level') }}";
            $.get(url + '/' + $level, function(data) {
                $($exams).find('option').remove();
                $($board).find('option').remove();

                let options = ``;
                for (let i = 0; data.exams.length > i; i++) {
                    options += `<option value="${data.exams[i]}">${data.exams[i]}</option>`;
                }

                $($exams).append(options);

                if ($level == 'secondary' || $level == 'intermediate') {
                    let options = ``;
                    for (let obj in data.boards) {
                        options += `<option value="${data.boards[obj].name}">${data.boards[obj].name}</option>`;
                    }
                    $($board).append(options);
                }

                if ($level == 'undergraduate' || $level == 'postgraduate') {
                    let options = ``;
                    for (let obj in data.institutes) {
                        options +=
                            `<option value="${data.institutes[obj].name}">${data.institutes[obj].name}</option>`;
                    }
                    $($board).append(options);
                }
            });
        }
    </script>

    <script>
        let maxAgeLimits = @json($maxAgeLimit);

        /** Experience JS */
        $('#experienceInfo').on('click', '.currently-working', function() {
            let name = $(this).attr('name');
            $index = name.match(/\d+/).toString();

            $toDate = $("input[name='experience_information[" + $index + "][to]']");

            if ($(this).prop('checked') === true) {
                $toDate.removeAttr('placeholder')
                    .removeClass('required')
                    .attr('disabled', true)
                    .val('');
            } else {
                let toPlaceHolder = @json(__('job-application.to'));
                $toDate.attr('placeholder', toPlaceHolder)
                    .addClass('required')
                    .attr('disabled', false);
            }
        })

        $('#add-experience').on('ifClicked', function() {
            let allClass = `.organaization, .designation, .length, .form-date, .to-date, .responsibility`;

            if ($(this).prop('checked') == false) {
                $('.experience-field').show();
                $(allClass).addClass('required');
            } else {
                $('.experience-field').hide();
                $(allClass).removeClass('required');
            }
        });

        $('.repeater-experience-info').repeater({
            show: function() {
                $(this).slideDown();
                dateInitialization();
            },

            hide: function(deleteElement) {
                if (confirm('{{ __('labels.confirm_delete') }}')) {
                    $(this).slideUp(deleteElement);
                }
            },

            // making the first item not deletable
            isFirstItemUndeletable: true
        })

        /** Research JS */
        $('#add_research').on('ifClicked', function() {
            let allClass = `.title, .duration, .form, .to, .supervisor, .reserarch-organaization`;

            if ($(this).prop('checked') == false) {
                $('.research-field').show();
                $(allClass).addClass('required');
            } else {
                $('.research-field').hide();
                $(allClass).removeClass('required');
            }
        });

        $('.repeater-research-info').repeater({
            show: function() {
                $(this).slideDown();
                dateInitialization();
            },

            hide: function(deleteElement) {
                if (confirm('{{ __('labels.confirm_delete') }}')) {
                    $(this).slideUp(deleteElement);
                }
            },

            // making the first item not deletable
            isFirstItemUndeletable: true
        })

        /** Education JS */
        let educationInfoRepeater = $(`.repeater-education-info`).repeater({
            initEmpty: true,

            defaultValues: {
                'level': 'postgraduate'
            },

            show: function() {
                if ($(this).index() < 10) {
                    $(this).find('.select2').next('.select2-container').remove();
                    $(this).find('.select2').select2({
                        placeholder: "{{ __('labels.select', [], 'en') }}",
                    });

                    $(this).slideDown();
                } else {
                    $(this).remove();
                    alert('{{ __('job-application.maximum_education_field') }}');
                }
            },
            hide: function(deleteElement) {
                if (confirm('{{ __('labels.confirm_delete') }}')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // making the first item not deletable
            isFirstItemUndeletable: false

        });

        $("#birth_date").change(function() {
            var date2 = new Date($("#circular_date").val());
            var date1 = new Date($("#birth_date").val());
            var starts = moment($("#birth_date").val());
            var ends = moment($("#circular_date").val());
            if (date2 > date1) {
                var duration = moment.duration(starts.diff(ends));
                var diff = moment.preciseDiff(starts, ends, true);
                if (duration) {
                    $("#age").html(diff.years + " Years " + diff.months + " Months " + diff.days + " Days");
                } else
                    $("#age").html("...");
            } else {
                $("#age").html("...");
            }
        });

        $("#present_district").change(function() {
            $.get("{{ url('thanas/') }}/" + $(this).val(), function(data) {
                $("#present_sub_district").html("");
                data.forEach(function(item) {
                    $("#present_sub_district").append(new Option(item['name'], item['name']));
                })
            });
        });

        $("#permanent_district").change(function() {
            $.get("{{ url('thanas/') }}/" + $(this).val(), function(data) {
                $("#permanent_sub_district").html("");
                data.forEach(function(item) {
                    $("#permanent_sub_district").append(new Option(item['name'], item['name']));
                })
            });
        });

        $("#same_as_present").change(function() {
            if ($(this).prop('checked')) {
                $("#permanent_address :input").removeAttr('required');
                $("#permanent_address :input").removeAttr('data-msg-required');
                $("#permanent_address :input").val('');
                $("#permanent_address :input").val('');
                $("#permanent_address :selected").val('');
                $("#permanent_sub_district").empty();
                $("#permanent_address :selected").trigger('change');
            } else {
                $("#permanent_address :input").attr('required', 'required');
                $("#permanent_address :input").attr('data-msg-required',
                    "{{ __('labels.This field is required') }}");
            }

            $("#permanent_address :input").attr('disabled', $(this).prop('checked'));
        });

        $("#is_postgraduate").change(function() {
            if ($(this).prop('checked')) {
                $("#postgraduate :input").removeAttr('required');
                $("#postgraduate :input").removeAttr('data-msg-required');
            } else {
                $("#postgraduate :input").attr('required', 'required');
                $("#postgraduate :input").attr('data-msg-required', "{{ __('labels.This field is required') }}");
            }

            $("#postgraduate :input").attr('disabled', $(this).prop('checked'));
        });

        function changeBirthDateValidation() {
            // if changed, first check if divisiona or quota selected
            // then get the max age
            // set the limits to the date field
            let isDivisionalEmployee = checkIfAnyRadioButtonSelected('is_divisional_applicant');
            let isQuotaEmployee = checkIfAnyRadioButtonSelected('quota');
            let birthDateElement = $('#birth_date');
            let value = $('#job_circular_detail_id').val();
            let divisonalVal = $("input:radio[name='is_divisional_applicant']:checked").val();
            let maxAge = 100;
            if (isDivisionalEmployee && isQuotaEmployee && divisonalVal == 1) {
                // let maxAge = maxAgeLimits[value]['max_age_divisional_employee'] > maxAgeLimits[value]['max_age_quota_employee'] 
                //             ? maxAgeLimits[value]['max_age_divisional_employee'] : maxAgeLimits[value]['max_age_quota_employee'];
                setValidationToDateField(birthDateElement, maxAge);
            } else if (isDivisionalEmployee && divisonalVal == 1) {
                // let maxAge = maxAgeLimits[value]['max_age_divisional_employee'];
                setValidationToDateField(birthDateElement, maxAge);
            } else if (isQuotaEmployee) {
                maxAge = maxAgeLimits[value]['max_age_quota_employee'];
                setValidationToDateField(birthDateElement, maxAge);
            } else {
                maxAge = maxAgeLimits[value]['max_age'];
                setValidationToDateField(birthDateElement, maxAge);
            }
        }

        $("input:radio[name='is_divisional_applicant']").on('ifChanged', function(e) {
            changeBirthDateValidation();
        });

        $("input:radio[name='quota']").on('change', function(e) {
            changeBirthDateValidation();
        });

        function checkIfAnyRadioButtonSelected(radioButtonName) {
            return $("input:radio[name='" + radioButtonName + "']").is(":checked");
        }

        function setValidationToDateField(element, maxAge) {

            $.validator.addMethod("check_date_of_birth", function(value, element) {
                var date = new Date(value);
                day = date.getDay();
                month = date.getMonth();
                year = date.getFullYear();

                var mydate = moment(new Date(year, month, day));

                var maxDate = new Date();

                maxDate.setFullYear(maxDate.getFullYear() - parseInt(maxAge));
                maxDate = moment(maxDate);
                errorMessage = `{{ trans('job-application.age_error_message') }}` + " " + maxAge;

                if (mydate.format("YYYY-MM-DD") < maxDate.format("YYYY-MM-DD")) {
                    $.validator.messages.check_date_of_birth = errorMessage
                    return false;
                }
                return true;
            });

            $(element).rules("remove", "check_date_of_birth");

            $(element).rules("add", {
                check_date_of_birth: true
            });
        }

        $(document).ready(function() {
            $('select').select2({
                placeholder: "{{ __('labels.select', [], 'en') }}"
            });

            $("#birth_date, .date").pickadate({
                selectYears: 50,
                selectMonths: true,
                min: new Date(1900, 1, 1),
                max: new Date()
            });

            $("#payment_date").pickadate({
                max: new Date(),
                min: -90,
            });

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");


            jQuery.validator.addMethod(
                "nid-validation-count",
                function(value, element, params) {
                    let validNumbers = params.split(",");

                    validNumbers = validNumbers.map(function(number) {
                        return parseInt(number);
                    });

                    return value.length === 0 ? true : validNumbers.includes(value.length);
                },
                'Nid should be equal to 10 or 13 or 17.'
            );

            $('#job-application').validate({

                ignore: 'input[type=hidden]', // ignore hidden fields
                errorClass: 'danger',
                successClass: 'success',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function(error, element) {
                    if (element.attr('type') == 'radio') {
                        if (element.attr('name') === 'organization_purpose') {
                            error.insertBefore(element.parents().siblings(
                                '.radio-error-organization-purpose'));
                        } else {

                            error.insertBefore(element.parents().siblings('.radio-error'));
                        }

                    } else if (element[0].tagName == "SELECT") {
                        error.insertAfter(element.siblings('.select2-container'));
                    } else if (element.attr('id') == 'start_date' || element.attr('id') == 'end_date') {
                        error.insertAfter(element.parents('.input-group'));
                    } else {
                        error.insertAfter(element);
                    }
                    if ($('input[name="national_id"]').val() == '' && $(
                            'input[name="birth_certificate_no"]').val() == '') {
                        $('.err-msg').html(`{{ trans('job-application.fill_at_least_one') }}`);
                    }
                },
                rules: {},
            });
        });

        function dateInitialization() {
            $(".date").pickadate({
                selectYears: 50,
                selectMonths: true,
                min: new Date(1900, 1, 1),
                max: new Date()
            });
        }
    </script>

@endpush
