{{--{{ dd($errors->PersonalInfo->has('father_name') ) }}--}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('father_name') ? ' error' : '' }}">
            {{ Form::label('father_name', 'Father\'s name') }}
            {{ Form::text('father_name', null, ['class' => 'form-control', 'placeholder' => '', 'data-validation-required-message'=>'Please enter father\'s name']) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('father_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('father_name') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('mother_name') ? ' error' : '' }}">
            {{ Form::label('mother_name', 'Mother\'s name') }}
            {{ Form::text('mother_name', null, ['class' => 'form-control', 'placeholder' => '', 'data-validation-required-message'=>'Please enter mother\'s name ']) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('mother_name'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('mother_name') }}</div>
            @endif
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('title', 'Title Name') }}
            {{ Form::select('title',  $employeeTitles, null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('date_of_birth') ? ' error' : '' }}">
            {{ Form::label('date_of_birth', 'Date of Birth') }}
            {{ Form::date('date_of_birth',  null, ['class' => 'form-control DatePicker', 'placeholder' => 'Pick the date', 'data-validation-required-message'=>'Please enter joining date ']) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('date_of_birth'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('date_of_birth') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->PersonalInfo->has('job_joining_date') ? ' error' : '' }}">
            {{ Form::label('job_joining_date', 'Joining Date') }}
            {{ Form::date('job_joining_date',  null, ['class' => 'form-control DatePicker', 'placeholder' => 'Pick the date', 'data-validation-required-message'=>'Please enter joining date ']) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('job_joining_date'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('job_joining_date') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('current_position_joining_date', 'Current Position Joining Date') }}
            {{ Form::date('current_position_joining_date',  null, ['class' => 'form-control DatePicker', 'placeholder' => 'Pick the date']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('current_position_expire_date', 'Current Position Expire Date') }}
            {{ Form::date('current_position_expire_date',  null, ['class' => 'form-control DatePicker', 'placeholder' => 'Pick the date']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('salary_scale', 'Salary Scale') }}
            {{ Form::select('salary_scale',  $employeeSalaryScale, null, ['class' => 'form-control', 'placeholder' => 'Select salary scale']) }}
            {{--{{ Form::text('salary_scale',  null, ['class' => 'form-control', 'placeholder' => '']) }}--}}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('total_salary', 'Current Basic Pay') }}
            {{ Form::text('total_salary',  null, ['class' => 'form-control', 'placeholder' => '']) }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group {{ $errors->PersonalInfo->has('marital_status') ? ' error' : '' }}">
            {{ Form::label('marital_status', 'Marital Status') }}
            {{ Form::select('marital_status',  Config('constants.marital_status') ,  null, ['class' => 'form-control', 'data-validation-required-message'=>'Please select marital status']) }}
            <div class="help-block"></div>
            @if ($errors->PersonalInfo->has('marital_status'))
                <div class="help-block">  {{ $errors->PersonalInfo->first('marital_status') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('number_of_children', 'Number of Children') }}
            {{ Form::number('number_of_children',  null, ['class' => 'form-control']) }}
        </div>
    </div>
    {{ Form::hidden('employee_id', isset($employee->id) ? $employee->id : null)   }}
    {{ Form::hidden('id', isset($employee->employeePersonalInfo->id) ? $employee->employeePersonalInfo->id : null) }}


    <hr>

    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            {{ Form::button('<i class="la la-check-square-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
            <a href="{{ url('/hrm/employee') }}">
                <button type="button" class="btn btn-warning mr-1">
                    <i class="la la-times"></i> Cancel
                </button>
            </a>

        </div>

    </div>
</div>