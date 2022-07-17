{!! Form::open(['url' =>  route('appraisals.update', ['appraisal'=>$appraisal->id]), 'class' => 'wizard-circle appraisal-steps', 'enctype' => 'multipart/form-data']) !!}
@include('hrm::appraisal.partials.form.class.first.show.step-1')

@if($appraisal->status == "initialized" && $appraisal->stateHistory()->get()->last()->from == "new")
    @include('hrm::appraisal.partials.form.class.first.step-2')
@else
    @include('hrm::appraisal.partials.form.class.first.show.step-2')
@endif

@if($appraisal->status == "verified" || ($appraisal->status == "initialized" && $appraisal->stateHistory()->get()->last()->from == "verified"))
    @include('hrm::appraisal.partials.form.class.first.step-3')
@endif

@if($appraisal->status == "initialized" && $appraisal->stateHistory()->get()->last()->from == "verified")
    @include('hrm::appraisal.partials.form.class.first.step-4')
    @include('hrm::appraisal.partials.form.class.first.step-5')
    @include('hrm::appraisal.partials.form.class.first.step-6')
    @include('hrm::appraisal.partials.form.class.first.step-7')
@endif

@if($appraisal->status == "reported")
    @include('hrm::appraisal.partials.form.class.first.show.step-3')
    @include('hrm::appraisal.partials.form.class.first.show.step-4')
    @include('hrm::appraisal.partials.form.class.first.show.step-5')
    @include('hrm::appraisal.partials.form.class.first.show.step-6')
    @include('hrm::appraisal.partials.form.class.first.show.step-7')
    @include('hrm::appraisal.partials.form.class.first.step-8')
@endif

@if($appraisal->status == "signed")
    @include('hrm::appraisal.partials.form.class.first.show.step-3')
    @include('hrm::appraisal.partials.form.class.first.show.step-4')
    @include('hrm::appraisal.partials.form.class.first.show.step-5')
    @include('hrm::appraisal.partials.form.class.first.show.step-6')
    @include('hrm::appraisal.partials.form.class.first.show.step-7')
    @include('hrm::appraisal.partials.form.class.first.show.step-8')
    @include('hrm::appraisal.partials.form.class.first.step-9')
@endif
{{ Form::close() }}

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/scripts/tables/components/table-components.js') }}"></script>
    <script>
        let appraisalForm = '.appraisal-steps';
        var form = $(appraisalForm).show();

        function setTotalPointForStep5() {
            $('#totalPoint-5').html($('#totalPoint').text());

            function removeCheckedClass() {
                $('input[name=reporter_officer_overall_evaluation]').each(function (iteration, val) {
                    $(val).prop('checked', false);
                    $(val).parent().removeClass('checked');
                });

            }

            function radioPropChecked(range) {

                $('input[name=reporter_officer_overall_evaluation][value="' + range + '"]').prop('checked', true);
            }

            let totalPointsID = document.getElementById('totalPoint-5');
            let totalPoints = "";
            if (totalPointsID) {
                totalPoints = parseInt(totalPointsID.innerHTML);
                console.log(totalPoints);
            }
            switch (true) {
                case totalPoints >= 91:
                    removeCheckedClass();
                    radioPropChecked("91-100");
                    $('input[name=reporter_officer_overall_evaluation][value="91-100"]').parent().toggleClass('checked').siblings().removeClass('checked');
                    break;
                case totalPoints >= 76:
                    removeCheckedClass();
                    radioPropChecked("76-90");
                    $('input[name=reporter_officer_overall_evaluation][value="76-90"]').parent().toggleClass('checked').siblings().removeClass('checked');
                    break;
                case totalPoints >= 56:
                    removeCheckedClass();
                    radioPropChecked("56-75");
                    $('input[name=reporter_officer_overall_evaluation][value="56-75"]').parent().toggleClass('checked').siblings().removeClass('checked');
                    break;
                case totalPoints >= 40:
                    removeCheckedClass();
                    radioPropChecked("40-55");
                    $('input[name=reporter_officer_overall_evaluation][value="40-55"]').parent().toggleClass('checked').siblings().removeClass('checked');
                    break;
                default:
                    removeCheckedClass();
                    radioPropChecked("91-100");
                    $('input[name=reporter_officer_overall_evaluation][value="01-39"]').parent().toggleClass('checked').siblings().removeClass('checked');
                    break;
            }
        }

        $(appraisalForm).steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: '{!! trans('labels.save') !!}',
                next: '{!! trans('labels.next') !!}',
                previous: '{!! trans('labels.previous') !!}',
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                // Always allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                //Pass the value of totalPoint to step-5
                if (newIndex == 4) {
                    setTotalPointForStep5();
                }
                // Forbid next action on "Warning" step if the user is to young
                if (newIndex === 3 && $("#age").val() == 18) {
                    return false;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                $('.appraisal-steps').submit();
            }
        });
    </script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('select').select2();

            {{--jQuery.validator.addMethod(--}}
            {{--"greaterThanOrEqual",--}}
            {{--function(value, elements, params) {--}}
            {{--let comparingDate = params === '#start_date' ? $(params).val() : params;--}}
            {{--return Date.parse(value) >= Date.parse(comparingDate);--}}
            {{--},--}}
            {{--'{{ trans('labels.greaterThanOrEqual', ['name' => trans('hrm::appraisal.start_date')]) }}'--}}
            {{--);--}}

            jQuery.validator.addMethod(
                "overall-evaluation",
                function (value, elements, params) {
                    let selectedOverallEvaluation = $('input[type=radio][name=' + params + ']:checked').val();
                    return !(selectedOverallEvaluation === '91-100' && (value === undefined || value === null || value === ''));
                },
                '{{ trans('labels.This field is required') }}'
            );

            $('.appraisal-steps').validate({
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
                        if ((element.hasClass('reporter_officer_eligibility'))
                            || (element.hasClass('reporter_officer_overall_evaluation'))
                            || (element.hasClass('reporter_officer_eligibility_for_promotion'))
                            || (element.hasClass('signer_evaluation_value'))
                        ) {
                            if (element.hasClass('reporter_officer_eligibility_for_promotion')) {
                                error.insertBefore($('div').find("[data-radio-field-name='" + element.attr('name') + "']"));
                            } else if (element.hasClass('signer_evaluation_value')) {
                                error.insertBefore($('div').find("[data-radio-field-name='" + element.attr('name') + "']"));
                            } else {

                                error.insertAfter(element.parents().siblings('.radio-error'));
                            }
                        } else {
                            error.insertBefore($('div').find("[data-radio-field-name='" + element.attr('name') + "']"));
                        }

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));
                        re
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
                },
            });

            // datepicker
            $('#start_date, #end_date').pickadate();


            $('#rank').change(function () {
                var value = $(this).val();
                if (value == 1 || value == 4) {
                    $('.employee_graph').hide();
                } else {
                    $('.employee_graph').show();
                }
            });
        });
    </script>

    <script>
        $("#department_id").change(function () {
            $.get("{{url('hrm/appraisal/getEmployees/')}}/" + $(this).val(), function (employeesObj) {
                $("#reporter").html("");
                Object.keys(employeesObj).forEach(function (empId) {
                    $("#reporter").append('<option value = "' + empId + '">' + employeesObj[empId] + '</option>');
                });
            });
        });
    </script>

    <script>
        $("#signer_department").change(function () {
            $.get("{{url('hrm/appraisal/getEmployees/')}}/" + $(this).val(), function (employeesObj) {
                $("#signer").html("");
                Object.keys(employeesObj).forEach(function (empId) {
                    $("#signer").append('<option value = "' + empId + '">' + employeesObj[empId] + '</option>');
                });
            });
        });
    </script>
@endpush
