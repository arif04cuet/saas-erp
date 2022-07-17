<div class="row">
    @if($errors->PersonalInfo->has('employee_id'))
        <div class="col-md-12">
            <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{$errors->PersonalInfo->first('employee_id')}}
            </div>
        </div>
    @endif

    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('father_name') ? ' error' : '' }}">
            {{ Form::label('father_name', trans('hrm::personal_info.father_name')) }}
            {{ Form::text('father_name', null, ['class' => 'form-control form-control-sm', 'placeholder' => '']) }}
            @if ($errors->PersonalInfo->has('father_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('father_name') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('mother_name') ? ' error' : '' }}">
            {{ Form::label('mother_name', trans('hrm::personal_info.mother_name'), ['class' => 'required']) }}
            {{ Form::text(
                'mother_name',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => '',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                    ]
              )
            }}

            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('mother_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('mother_name') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('husband_name') ? ' error' : '' }}">
            {{ Form::label('husband_name', trans('hrm::personal_info.husband_name')) }}
            {{ Form::text('husband_name', null, ['class' => 'form-control form-control-sm', 'placeholder' => '']) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('husband_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('husband_name') }}</div>
            @endif
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', trans('hrm::personal_info.title_name')) }}
            {{ Form::select(
                'title',
                $employeeTitles,
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => trans('labels.select')
                ]
             )
            }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('nid_number') ? ' error' : '' }}">
            {{ Form::label('nid_number', trans('hrm::personal_info.nid_number'), ['class' => 'required']) }}
            {{ Form::text(
                'nid_number',
                null,
                [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'NID/Smart Card No',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-rule-number' => 'true',
                    'data-msg-number' => trans('labels.Please enter a valid number'),
                    'data-rule-nid-validation-count' => '10,13,17',
                    'data-msg-nid-validation-count' => trans('labels.nid_validation_count_error_msg')
                ]
             )
            }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('nid_number'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('nid_number') }}</div>
            @endif
        </div>
    </div>

    <!-- Date of Birth -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('date_of_birth') ? ' error' : '' }}">
            {{ Form::label('date_of_birth', trans('hrm::personal_info.date_of_birth'), ['class' => 'required']) }}
            {{ Form::text(
                'date_of_birth',
                 null,
                [
                    'class' => 'form-control form-control-sm' . ($errors->has('end_date') ? ' is-invalid' : ''),
                    'placeholder' => 'Pick end date',
                    'required' => 'required',
                    'data-msg-required' => trans('labels.This field is required')
                ]
             )
            }}

            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('date_of_birth'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('date_of_birth') }}</div>
            @endif
        </div>
    </div>

    <!-- Joining Date -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('job_joining_date') ? ' error' : '' }}">
            {{ Form::label('job_joining_date', trans('hrm::personal_info.joining_date'), ['class' => 'required']) }}
            {{ Form::text(
                'job_joining_date',
                  null,
                  [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Pick end date',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                    ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('job_joining_date'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('job_joining_date') }}</div>
            @endif
        </div>
    </div>

    <!-- Current Position Joining Date -->
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('current_position_joining_date', trans('hrm::personal_info.current_position_joining_date')) }}
            {{ Form::text(
                'current_position_joining_date',
                 null,
                 [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Pick end date'
                ]
              )
            }}
        </div>
    </div>

    <!-- Current Position Expire Date -->
    <div class="col-md-6">
        <div clarclass="form-group">
            {{ Form::label('current_position_expire_date', trans('hrm::personal_info.current_position_expire_date')) }}
            {{ Form::text('current_position_expire_date',  null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Pick end date']) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('salary_scale', trans('hrm::personal_info.salary_scale')) }}
            {{ Form::select('salary_scale',  $employeeSalaryScale, null, ['class' => 'form-control form-control-sm', 'placeholder' => trans('labels.select')]) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('total_salary', trans('hrm::personal_info.current_basic_pay')) }}
            {{ Form::number('total_salary',  null, [
                'class' => 'form-control form-control-sm',
                'placeholder' => 'Number',
                'data-rule-min' => 1,
                'data-msg-min' => trans('labels.Please enter a valid number'),
                'data-rule-max' => 9999999,
                'data-msg-max' => trans('labels.Please enter a valid number'),
            ]) }}
            @if ($errors->PersonalInfo->has('total_salary'))
                <div class="help-block danger">  {{ $errors->PersonalInfo->first('total_salary') }}</div>
            @endif
        </div>
        @if(isset($employee) && !is_null(optional($employee->employeePersonalInfo)->date_of_birth))
            <div class="form-group">
                <div class="skin skin-flat">
                    {{ Form::checkbox('is_dead', 1, optional($employee->employeePersonalInfo)->is_dead ? true : false)  }}
                    <label>@lang('hrm::employee.is_dead')</label>
                </div>
                <div class="row col-md-12 radio-error">
                    @if ($errors->has('is_dead'))
                        <span class="small text-danger"><strong>{{ $errors->first('is_dead') }}</strong></span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->PersonalInfo->has('date_of_death') ? ' error' : '' }}">
                {{ Form::label('date_of_death', trans('hrm::personal_info.date_of_death'), ['class' => 'required']) }}
                {{ Form::text(
                    'date_of_death',
                     null,
                    [
                        'class' => 'form-control form-control-sm' . ($errors->has('date_of_death') ? ' is-invalid' : ''),
                        'placeholder' => 'Pick date of death',
                        'required' => 'required',
                        'data-msg-required' => trans('labels.This field is required')
                    ]
                 )
                }}

                <div class="help-block"></div>
                @if ($errors->PersonalInfo->has('date_of_death'))
                    <div class="help-block">  {{ $errors->PersonalInfo->first('date_of_death') }}</div>
                @endif
            </div>
        @endif
    </div>

    <div class="col-md-3">
        <div class="form-group {{ $errors->PersonalInfo->has('marital_status') ? ' error' : '' }}">
            {{ Form::label('marital_status', trans('hrm::personal_info.marital_status'), ['class' => 'required']) }}
            {{ Form::select(
                'marital_status',
                Config('constants.marital_status') ,
                null,
                [
                    'placeholder' => trans('labels.select'),
                    'class' => 'form-control form-control-sm select2',
                    'required' => 'required',
                    'data-msg-required'=>trans('labels.This field is required')
                ]
              )
            }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('marital_status'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('marital_status') }}</div>
            @endif
        </div>
    </div>
@if(isset($employee->id))
    {{ Form::hidden('employee_id', isset($employee->id) ? $employee->id : null)   }}
@else($employee_id)
    {{ Form::hidden('employee_id', isset($employee_id) ? $employee_id : null) }}
@endif
{{ Form::hidden('id', isset($employee->employeePersonalInfo->id) ? $employee->employeePersonalInfo->id : null) }}
<!-- house eligibility date -->
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('house_eligibility_date') ? ' error' : '' }}">
            {{ Form::label('house_eligibility_date', trans('hrm::personal_info.house_eligibility_date'), ['class' => '']) }}
            {{ Form::text(
                'house_eligibility_date',
                 null,
                [
                    'class' => 'form-control form-control-sm ' . ($errors->has('house_eligibility_date') ? ' is-invalid' : ''),
                    'id'=>'house_eligibility_date',
                    'placeholder' => 'Pick a date',
                ]
             )
            }}

            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('date_of_birth'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('date_of_birth') }}</div>
            @endif
        </div>
    </div>
    <hr>
    <!-- Action Buttons -->
    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            <div id="father-husband-error-msg" class="text-danger font-weight-bold"></div>
            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'submit', 'class' => 'master btn btn-primary'] )  }}
            <a href="{{ route('employee.index') }}">
                <button type="button" class="master btn btn-warning mr-1">
                    <i class="la la-times"></i> @lang('labels.cancel')
                </button>
            </a>
        </div>
    </div>
</div>

@push('page-js')

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script>
        function submitFormPersonal(form) {
            let fatherName = $('input[name=father_name]').val();
            let husbandNameValue = $('input[name=husband_name]').val();

            if (fatherName || husbandNameValue) {
                form.submit();
            } else {
                alert('Please fill father\'s or husband\'s name');
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('input[name=father_name], input[name=husband_name]').on('keyup', function () {
                $('#father-husband-error-msg').html('');
            });
        });
    </script>

    <!-- Date Initialization & Validation   -->
    <script type="text/javascript">
        let minJoiningYear = 18;
        let maxJobExpireYear = 10;
        let birthDate = $('#date_of_birth').pickadate({
            selectMonths: true,
            selectYears: 500,
            min: new Date(1900, 0, 1),
            max: new Date(new Date().getFullYear() - minJoiningYear - 1, 0, 1),
            onSet: function () {
                changeJoiningDate(this);
            },
        });
        let joiningDate = $('#job_joining_date').pickadate({
            selectMonths: true,
            selectYears: 500,
            min: new Date(1950, 1, 1),
            max: new Date(),
            onOpen: function () {
                checkIfBirthDateSelected(this);
            },
            onSet: function () {
                changeCurrPosJoiningDate(this);
            },
        });
        let currentPosJoiningDate = $('#current_position_joining_date').pickadate({
            selectMonths: true,
            selectYears: 500,
            min: new Date(1950, 1, 1),
            max: new Date(),
            onSet: function () {
                changeCurrPosExpireDate(this);
            },
        });
        let currentPosExpireDate = $('#current_position_expire_date').pickadate({
            selectMonths: true,
            selectYears: 30,
            min: new Date(1950, 1, 1),
            max: new Date(),
        });
        let houseEligibilityDate = $('#house_eligibility_date').pickadate({
            selectMonths: true,
            selectYears: 30,
            min: new Date(1950, 1, 1),
            max: new Date(),
        });

        function changeJoiningDate(obj) {
            let minJoiningDate = new Date(obj.get('select', 'yyyy-mm-dd'));
            minJoiningDate.setFullYear(minJoiningDate.getFullYear() + minJoiningYear);
            joiningDate.pickadate('picker').set({
                'min': minJoiningDate,
                'max': new Date()
            });

            if (typeof deathDate !== "undefined") {
                deathDate.pickadate('picker').set({
                    'min': minJoiningDate,
                    'max': new Date()
                });
            }
        }

        function changeCurrPosJoiningDate(obj) {
            let mincurrentPosJoiningDate = new Date(obj.get('select', 'yyyy-mm-dd'));
            currentPosJoiningDate.pickadate('picker').set({
                'min': mincurrentPosJoiningDate,
                'max': new Date()
            })
        }

        function changeCurrPosExpireDate(obj) {
            currentPosExpireDate.pickadate('picker').set({
                'min': new Date(),
                'max': new Date(new Date().setFullYear(new Date().getFullYear() + maxJobExpireYear))
            })
        }

        function checkIfBirthDateSelected(obj) {
            let birthDatePicker = birthDate.pickadate('picker');
            let value = birthDatePicker.get();
            if (!value) {
                alert("Date Of Birth Should Be Selected First");
                $('#date_of_birth').focus();
            }
        }
    </script>
    @if(isset($employee))
        @if(optional($employee)->employeePersonalInfo)
            <script type="text/javascript">
                $(document).ready(function () {

                    if ($('#date_of_death').length) {
                        let deathDate = $('#date_of_death').pickadate({
                            selectMonths: true,
                            selectYears: 500,
                            min: new Date(1950, 1, 1),
                            max: new Date(),
                            onOpen: function () {
                                checkIfBirthDateSelected(this);
                            }
                        });

                        let deathDateContainer = deathDate.parent(),
                            deadCheckBoxContainer = $('input[name=is_dead]');

                        let employeePersonalInfo = @json(optional($employee)->employeePersonalInfo, JSON_UNESCAPED_UNICODE),
                            isDead = employeePersonalInfo.is_dead,
                            dateOfDeath = employeePersonalInfo.date_of_death;

                        if (isDead === 0) {
                            deathDateContainer.slideUp();
                            deathDateContainer.find('input[name=date_of_death]').val(dateOfDeath).attr('type', 'hidden');
                        }

                        deadCheckBoxContainer.on('ifChanged', function () {
                            if ($(this).is(':checked') === true) {
                                deathDateContainer.slideDown();
                                deathDateContainer.find('input[name=date_of_death]').val(dateOfDeath).attr('type', 'text');
                            } else {
                                deathDateContainer.slideUp();
                                deathDateContainer.find('input[name=date_of_death]').val(dateOfDeath).attr('type', 'hidden');
                            }
                        });
                    }
                });
            </script>
        @endif
    @endif

    <script type="text/javascript">
        $(document).ready(function () {
            changeJoiningDate(birthDate.pickadate('picker'));
            changeCurrPosJoiningDate(joiningDate.pickadate('picker'));
            changeCurrPosExpireDate(currentPosJoiningDate.pickadate('picker'));

            jQuery.validator.addMethod(
                "nid-validation-count",
                function (value, element, params) {

                    let validNumbers = params.split(",");

                    validNumbers = validNumbers.map(function (number) {
                        return parseInt(number);
                    });

                    return value.length === 0 ? true : validNumbers.includes(value.length);
                },
                'Nid should be equal to 10 or 13 or 17.'
            );

            let hrmEmployeeCreateFormPersonal = $('.hrm-employee-create-form-personal');

            hrmEmployeeCreateFormPersonal.validate({
                ignore: 'input[type=hidden]',
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

                        error.insertBefore(element.parents().siblings('.radio-error'));

                    } else if (element[0].tagName === "SELECT") {

                        error.insertAfter(element.siblings('.select2-container'));

                    } else if (element.attr('id') === 'start_date' || element.attr('id') === 'end_date') {

                        error.insertAfter(element.parents('.input-group'));

                    } else if (element.attr('type') === 'file') {

                        error.insertAfter(element.parent().parent().find('.avatar-preview'));

                    } else {

                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    submitFormPersonal(form);
                }
            });

        });
    </script>
@endpush
