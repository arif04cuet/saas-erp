{!! Form::open(['url' =>  route('appraisals.store'), 'class' => 'wizard-circle appraisal-steps', 'enctype' => 'multipart/form-data']) !!}

    @include('hrm::appraisal.partials.form.class.fourth.step-1')

    @include('hrm::appraisal.partials.form.class.fourth.step-2')

    @include('hrm::appraisal.partials.form.class.fourth.step-3')
    @if(in_array($class, ['second', 'third']))
        @include('hrm::appraisal.partials.form.class.fourth.step-7')
    @endif
    <!-- Step 4 -->
    @include('hrm::appraisal.partials.form.class.fourth.step-4')

    {{--@include('hrm::appraisal.partials.form.class.fourth.step-5')--}}

    {{--@include('hrm::appraisal.partials.form.class.fourth.step-6')--}}
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
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex)
                {
                    return true;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                $('.appraisal-steps').submit();
            }
        });
    </script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script>
        $( document ).ready(function() {

            $('select').select2();

            jQuery.validator.addMethod(
                "greaterThan",
                function(value, elements, params) {
                    let comparingDate = params === '#start_date' ? $(params).val() : params;
                    return (Date.parse(value) - Date.parse(comparingDate)) > (30000*24*60*60);
                },
                '{{ trans('labels.greaterThan', ['name' => trans('hrm::appraisal.start_date')]) }}'
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
                        if((element.hasClass('reporter_officer_eligibility'))) {
                            error.insertAfter(element.parents().siblings('.radio-error'));
                        }else {
                            error.insertBefore($('div').find("[data-radio-field-name='" + element.attr('name') + "']"));
                        }

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));

                    }else {

                        error.insertAfter(element);
                    }
                },
                rules: {
                    end_date: {
                        greaterThan: '#start_date'
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
            $('#start_date').pickadate({
                max: new Date(),
                selectYears: 70,
                selectMonths: true
            });

            $('#end_date').pickadate({
                max: new Date(),
                selectYears: 70,
                selectMonths: true
            });

            $('#rank').change(function(){
                var value = $(this).val();
                if (value == 1 || value == 4){
                    $('.employee_graph').hide();
                }else {
                    $('.employee_graph').show();
                }
            });
        });
    </script>

    <script>
        $("#department_id").change(function () {
            $.get("{{url('hrm/appraisal/getEmployees/')}}/" + $(this).val(), function (employeesObj) {
                $("#signer").html("");
                for (let empId in employeesObj){
                    $("#signer").append('<option value = "' + empId + '">' + employeesObj[empId] + '</option>');
                }
            });
        });
    </script>
@endpush
