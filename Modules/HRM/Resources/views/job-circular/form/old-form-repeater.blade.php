@if(is_null($jobCircular->jobCircularDetails))
    @include('hrm::job-circular.form.form-repeater')
@else
    <div class="job-circular-repeater">
        <div data-repeater-list="job-circular">
            @foreach($jobCircular->jobCircularDetails as $jobCircularDetail)
                <div data-repeater-item>
                    <!-- designation and grade & vacancy -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('job_nature') ? ' error' : '' }}">
                                {{ Form::label('designation_id', trans('labels.designation'), ['class' => 'required']) }}
                                {{ Form::select('designation_id', $designations ?? [], $jobCircularDetail->designation_id ?? null,
                                    [
                                        'placeholder' => trans('labels.select'),
                                        'class' => 'form-control select2 required',
                                        'data-msg-required' => trans('labels.This field is required')
                                    ])
                                }}
                                <div class="help-block"></div>
                                @if ($errors->has('designation_id'))
                                    <div class="help-block">  {{ $errors->first('designation_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- salary Grade -->
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('salary_grade') ? ' error' : '' }}">
                                {{ Form::label('salary_grade', trans('hrm::circular.grade'), ['class' => 'required']) }}
                                {{ Form::select('salary_grade', $grades ?? [], $jobCircularDetail->salary_grade ?? null,
                                    [
                                        'class' => 'form-control select2 required',
                                        'data-msg-required' => trans('labels.This field is required')
                                    ])
                                }}
                                <div class="help-block"></div>
                                @if ($errors->has('salary_grade'))
                                    <div class="help-block">  {{ $errors->first('salary_grade') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- Job Vacancy -->
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('vacancy_no') ? ' error' : '' }}">
                                {{ Form::label('vacancy_no', trans('hrm::circular.vacancy_no'), ['class' => 'required']) }}
                                {{ Form::number('vacancy_no',
                                    $jobCircularDetail->vacancy_no ?? 0,
                                    [
                                        'class' => 'form-control required',
                                        'placeholder' => '',
                                        'data-msg-required' => trans('labels.This field is required'),
                                        'data-msg-number' => trans('labels.Please enter a valid number'),
                                        'min' => 1,
                                        'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1'),
                                        'max' => 30,
                                        'data-msg-max' => trans('labels.Must be less than or equal to', ['attribute' => trans('labels.digits.30')]),
                                        'step' => 1,
                                        'data-msg-step' => trans('labels.Decimal numbers are not acceptable'),
                                    ])
                                }}
                                <div class="help-block"></div>
                                @if ($errors->has('vacancy_no'))
                                    <div class="help-block">  {{ $errors->first('vacancy_no') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- age row -->
                    <div class="row">
                        <!-- max age -->
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('max_age',
                                    trans('hrm::circular.max_age'),
                                    ['class' => 'form-label requried']) !!}
                                {!! Form::text('max_age', $jobCircularDetail->max_age ?? 0,
                                [
                                    'class' => 'form-control required',
                                    'placeholder' => trans('hrm::circular.max_age'),
                                    'max' => 100,
                                    'data-msg-max'=> trans('hrm::circular.max_age_msg'),
                                    'data-msg-required' => trans('labels.This field is required')
                                ]) !!}
                            </div>
                        </div>
                        <!-- max age divisional -->
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('max_age_divisional',
                                    trans('hrm::circular.max_age_divisional'),
                                    ['class' => 'form-label ']) !!}
                                {!! Form::text('max_age_divisional_employee', $jobCircularDetail->max_age_divisional_employee ?? 0,
                                [
                                    'class' => 'form-control ',
                                    'placeholder' => trans('hrm::circular.max_age_divisional'),
                                    'max' => 100,
                                    'data-msg-max'=> trans('hrm::circular.max_age_msg'),
                                ]) !!}
                            </div>
                        </div>
                        <!-- max age quota -->
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('max_age_quota_employee',
                                    trans('hrm::circular.max_age_quota'),
                                    ['class' => 'form-label requried']) !!}
                                {!! Form::text('max_age_quota_employee', $jobCircularDetail->max_age_quota_employee ?? 0,
                                [
                                    'class' => 'form-control required',
                                    'placeholder' => trans('hrm::circular.max_age_quota_employee'),
                                    'max' => 100,
                                    'data-msg-max'=> trans('hrm::circular.max_age_msg'),
                                    'data-msg-required' => trans('labels.This field is required')
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <!-- Educational and Experiment Requirement -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('educational_requirement') ? ' error' : '' }}">
                                {{ Form::label('educational_requirement', trans('hrm::circular.educational_requirement',[],'en'), ['class' => 'required']) }}
                                {{ Form::textarea('educational_requirement',
                                    $jobCircularDetail->educational_requirement ?? null,
                                    [
                                        'class' => 'form-control required',
                                        'data-msg-required'=>trans('labels.This field is required'),
                                        'data-rule-maxlength' => 1000,
                                        'data-msg-maxlength'=> trans('labels.At most 1000 characters'),
                                    ])
                                }}
                                <div class="help-block"></div>
                                @if ($errors->has('educational_requirement'))
                                    <div class="help-block">{{ $errors->first('educational_requirement') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('experience_requirement') ? ' error' : '' }}">
                                {{ Form::label('experience_requirement', trans('hrm::circular.experience_requirement'), ['class' => 'required']) }}
                                {{ Form::textarea('experience_requirement',
                                    $jobCircularDetail->experience_requirement ?? null,
                                    [
                                        'class' => 'form-control required',
                                        'data-msg-required'=>trans('labels.This field is required'),
                                        'data-rule-maxlength' => 1000,
                                        'data-msg-maxlength'=> trans('labels.At most 1000 characters'),
                                    ])
                                 }}
                                <div class="help-block"></div>
                                @if ($errors->has('experience_requirement'))
                                    <div class="help-block">{{ $errors->first('experience_requirement') }}</div>
                                @endif
                            </div>

                        </div>
                    </div>
                    <!-- Job Requirement -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('job_responsibility') ? ' error' : '' }}">
                                {{ Form::label('job_responsibility', trans('hrm::circular.job_responsibility'), ['class' => 'required']) }}
                                {{ Form::textarea('job_responsibility',
                                    $jobCircularDetail->job_responsibility ?? null,
                                    [
                                        'class' => 'form-control required',
                                        'data-msg-required'=>trans('labels.This field is required'),
                                        'data-rule-maxlength' => 1000,
                                        'data-msg-maxlength'=> trans('labels.At most 1000 characters'),
                                    ])
                                 }}
                                <div class="help-block"></div>
                                @if ($errors->has('job_responsibility'))
                                    <div class="help-block">{{ $errors->first('job_responsibility') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('common_qualification') ? ' error' : '' }}">
                                {{ Form::label('common_qualification', trans('hrm::circular.common_qualification')) }}
                                {{ Form::textarea('common_qualification',
                                    $jobCircularDetail->common_qualification ?? null,
                                    [
                                        'class' => 'form-control',
                                        'data-msg-required'=>trans('labels.This field is required'),
                                        'data-rule-maxlength' => 1000,
                                        'data-msg-maxlength'=> trans('labels.At most 1000 characters'),
                                    ])
                                 }}
                                <div class="help-block"></div>
                                @if ($errors->has('common_qualification'))
                                    <div class="help-block">{{ $errors->first('common_qualification') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- delete button -->
                        <div class="form-group col-sm-12 col-md-1 text-center mt-2">
                            <button type="button" class="btn btn-outline-danger"
                                    data-repeater-delete="">
                                <i class="ft-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <button type="button" data-repeater-create class="btn btn-sm btn-primary ">
            <i class="ft-plus"
               style="cursor: pointer">
            </i>@lang('labels.add')
        </button>
    </div>
@endif
