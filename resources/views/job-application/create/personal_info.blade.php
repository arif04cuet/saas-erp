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
            {{ Form::text('father_name', null, ['class' => 'form-control', 'placeholder' => '']) }}
            @if ($errors->PersonalInfo->has('father_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('father_name') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('mother_name') ? ' error' : '' }}">
            {{ Form::label('mother_name', trans('hrm::personal_info.mother_name'), ['class' => 'required']) }}
            {{ Form::text('mother_name', null, ['class' => 'form-control', 'placeholder' => '', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('mother_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('mother_name') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('husband_name') ? ' error' : '' }}">
            {{ Form::label('husband_name', trans('hrm::personal_info.husband_name')) }}
            {{ Form::text('husband_name', null, ['class' => 'form-control', 'placeholder' => '']) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('husband_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('husband_name') }}</div>
            @endif
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', trans('hrm::personal_info.title_name')) }}
            {{ Form::select('title',$employeeTitles,  null, ['class' => 'form-control', 'placeholder' => trans('labels.select')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('nid_number') ? ' error' : '' }}">
            {{ Form::label('nid_number', trans('hrm::personal_info.nid_number'), ['class' => 'required']) }}
            {{ Form::number('nid_number',  null, ['class' => 'form-control', 'placeholder' => 'NID/Smart Card No',
            'minlength' => '10', 'maxlength' => '17',
            'data-validation-minlength-message' => trans('validation.minlength', ['attribute' => 'জাতীয় পরিচয়পত্র/স্মার্টকার্ড নম্বর','min' => 10]),
            'data-validation-maxlength-message' => trans('validation.maxlength', ['attribute' => 'জাতীয় পরিচয়পত্র/স্মার্টকার্ড নম্বর', 'max' => 17]),
            'data-validation-required-message'=>trans('labels.This field is required')]) }}
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
            {{ Form::text('date_of_birth', null, [ 'class' => 'form-control required' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'Pick end date']) }}

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
            {{ Form::text('job_joining_date',  null, ['class' => 'form-control', 'placeholder' => 'Pick end date', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
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
            {{ Form::text('current_position_joining_date',  null, ['class' => 'form-control', 'placeholder' => 'Pick end date']) }}
        </div>
    </div>

    <!-- Current Position Expire Date -->
    <div class="col-md-6">
        <div clarclass="form-group">
            {{ Form::label('current_position_expire_date', trans('hrm::personal_info.current_position_expire_date')) }}
            {{ Form::text('current_position_expire_date',  null, ['class' => 'form-control', 'placeholder' => 'Pick end date']) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('salary_scale', trans('hrm::personal_info.salary_scale')) }}
            {{ Form::select('salary_scale',  $employeeSalaryScale, null, ['class' => 'form-control', 'placeholder' => trans('labels.select')]) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('total_salary', trans('hrm::personal_info.current_basic_pay')) }}
            {{ Form::number('total_salary',  null, ['class' => 'form-control', 'placeholder' => 'Number']) }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group {{ $errors->PersonalInfo->has('marital_status') ? ' error' : '' }}">
            {{ Form::label('marital_status', trans('hrm::personal_info.marital_status'), ['class' => 'required']) }}
            {{ Form::select('marital_status',  Config('constants.marital_status') ,  null, ['placeholder' => trans('labels.select'), 'class' => 'form-control', 'data-validation-required-message'=>trans('labels.This field is required')]) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('marital_status'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('marital_status') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('number_of_children', trans('hrm::personal_info.number_of_children')) }}
            {{ Form::number('number_of_children',  null, ['class' => 'form-control']) }}
        </div>
    </div>
    @if(isset($employee->id))
        {{ Form::hidden('employee_id', isset($employee->id) ? $employee->id : null)   }}
    @else($employee_id)
        {{ Form::hidden('employee_id', isset($employee_id) ? $employee_id : null) }}
    @endif
    {{ Form::hidden('id', isset($employee->employeePersonalInfo->id) ? $employee->employeePersonalInfo->id : null) }}

    <hr>

    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            <div id="father-husband-error-msg" class="text-danger font-weight-bold"></div>
            {{ Form::button('<i class="la la-check-square-o"></i>'.trans('labels.save'), ['type' => 'button', 'onclick' => 'submitFormPersonal()', 'class' => 'btn btn-primary'] )  }}
            <a href="{{ url('/hrm/employee') }}">
                <button type="button" class="btn btn-warning mr-1">
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
        function submitFormPersonal() {
            let fatherName = $('input[name=father_name]').val();
            let husbandNameValue = $('input[name=husband_name]').val();

            if (fatherName || husbandNameValue) {
                $('#personal').find('form').submit();
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
        let minJoiningYear = 10;
        let maxJobExpireYear = 5;
        let birthDate = $('#date_of_birth').pickadate({
            selectYears: true,
            selectMonths: true,
            selectYears: 15,
            min: new Date(1950, 1, 1),
            max: new Date(),
            onSet: function () {
                changeJoiningDate(this);
            },
        });
        let joiningDate = $('#job_joining_date').pickadate({
            selectYears: true,
            selectMonths: true,
            selectYears: 15,
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
            selectYears: true,
            selectMonths: true,
            selectYears: 15,
            min: new Date(1950, 1, 1),
            max: new Date(),
            onSet: function () {
                changeCurrPosExpireDate(this);
            },
        });
        let currentPosExpireDate = $('#current_position_expire_date').pickadate({
            selectYears: true,
            selectMonths: true,
            selectYears: 15,
            min: new Date(1950, 1, 1),
            max: new Date(),
        });

        function changeJoiningDate(obj) {
            let minJoiningDate = new Date(obj.get('select', 'yyyy-mm-dd'));
            minJoiningDate.setFullYear(minJoiningDate.getFullYear() + minJoiningYear);
            joiningDate.pickadate('picker').set({
                'min': minJoiningDate,
                'max': new Date()
            })
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
@endpush