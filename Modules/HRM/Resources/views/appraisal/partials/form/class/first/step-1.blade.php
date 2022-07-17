<h6>@lang('hrm::appraisal.bio_data')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>@lang('labels.name')</td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.fathers_name')</td>
                    <td>{{ $employee->employeePersonalInfo->father_name ?? trans('labels.not_available') }}</td>
                </tr>
                <tr>
                    <td>@lang('labels.designation')</td>
                    <td>{{ $employee->designation->name ?? trans('labels.not_available')}}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.date_of_birth')</td>
                    @if($employee->employeePersonalInfo)
                        @if($employee->employeePersonalInfo->date_of_birth)
                            <td>{{ date('jS F Y', strtotime($employee->employeePersonalInfo->date_of_birth)) }}</td>
                        @else
                            <td>@lang('labels.not_available')</td>
                        @endif
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.job_joining_date')</td>
                    @if($employee->employeePersonalInfo)
                        @if($employee->employeePersonalInfo->job_joining_date)
                            <td>{{ date('jS F Y', strtotime($employee->employeePersonalInfo->job_joining_date)) }}</td>
                        @else
                            <td>@lang('labels.not_available')</td>
                        @endif
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.current_position_joining_date')</td>
                    @if($employee->employeePersonalInfo)
                        @if($employee->employeePersonalInfo->current_position_joining_date)
                            <td>{{ date('jS F Y', strtotime($employee->employeePersonalInfo->current_position_joining_date)) }}</td>
                        @else
                            <td>@lang('labels.not_available')</td>
                        @endif
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.pay_scale')</td>
                    @if($employee->employeePersonalInfo)
                        <td>{{ $employee->employeePersonalInfo->salary_scale }} </td>
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.current_base_salary')</td>
                    @if($employee->employeePersonalInfo)
                        <td>{{$employee->employeePersonalInfo->total_salary ?? ''}} @lang('labels.bdt')</td>
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <h3 class="">@lang('hrm::appraisal.job_duration_under_reporter_officer')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required">@lang('hrm::appraisal.start_date')</label>
                            <div class="input-group">
                                {{ Form::text('reporting_officer_job_duration_start_date', date('j F, Y'), [
                                    'class' => 'form-control pickadate required' . ($errors->has('job_duration_start_date') ? ' is-invalid' : ''),
                                    'id' => 'jobDurationStartDate',
                                    'placeholder' => 'Pick start date',
                                    'required' => 'required'
                                ]) }}
                                @if ($errors->has('reporting_officer_job_duration_start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reporting_officer_job_duration_start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required">@lang('hrm::appraisal.end_date')</label>
                            <div class="input-group">
                                {{ Form::text('reporting_officer_job_duration_end_date', date('j F, Y'), [
                                    'class' => 'form-control pickadate required' . ($errors->has('job_duration_end_date') ? ' is-invalid' : ''),
                                    'id' => 'jobDurationEndDate',
                                    'placeholder' => 'Pick start date',
                                    'required' => 'required',
                                    'data-rule-greaterThan' => '#jobDurationStartDate'
                                ]) }}

                                @if ($errors->has('reporting_officer_job_duration_end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reporting_officer_job_duration_end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.educational_qualification')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;">@lang('labels.serial')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.academic_degree')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.academic_department')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.passing_year')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.1'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.1.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[1][department]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.department'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[1][passing_year]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.passing_year'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.2'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.2.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[2][department]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.department'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[2][passing_year]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.passing_year'),
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.3'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.3.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[3][department]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.department'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[3][passing_year]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.passing_year'),
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.4'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.4.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[4][department]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.department'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[4][passing_year]',
                                        null,
                                        [
                                            'class' => 'form-control required educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.passing_year'),
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.5'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.5.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[5][department]',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.department'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_educational_qualifications[5][passing_year]',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications',
                                            'placeholder' => trans('hrm::appraisal.educational_qualifications.passing_year'),
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.medium_of_graduate_postgraduate')</h3>
    <div class="row">
        <div class="col-6">
            <label>@lang('hrm::appraisal.medium_of_graduate_postgraduate')</label>
            {!! Form::text(
                'reporting_officer_medium_of_graduate_postgraduate',
                null,
                [
                    'class' => "form-control required",
                    "placeholder" => __('hrm::appraisal.medium'),
                    'data-msg-required' => trans('labels.This field is required')
                ]
            ) !!}
            <div class="help-block"></div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.significant_training') (@lang('hrm::appraisal.during_full_employment'))</h3>
    <h4><b>@lang('hrm::appraisal.significant_trainings.1.serial')) @lang('hrm::appraisal.significant_trainings.1.title')</b></h4>
    <div class="row significant-trainings-local-repeater">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.course_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.organization_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.country')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.duration') (@lang('hrm::appraisal.weekly'))</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.training_year')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('labels.delete')</th>
                    </tr>
                    </thead>
                    <tbody data-repeater-list="reporting_officer_significant_trainings_local">
                    <tr data-repeater-item>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'course',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.course_name'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'organization',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.organization_name'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'country',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.country'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'duration',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.duration'),
                                            'style' => 'width: 100%; border-radius: 0;','number' => 'true',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 100,
                                            'data-msg-max' => trans("labels.Field can't be geater than 100"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'year',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.training_year'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            <button style="width: 100%; border-radius: 0; background: none;" type="button" class="btn" data-repeater-delete><i class="ft-trash-2"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <button type="button" data-repeater-create="" class="btn btn-primary float-right"><i
                        class="ft-plus"></i> @lang('labels.add')
            </button>
        </div>
    </div>
    <h4><b>@lang('hrm::appraisal.significant_trainings.2.serial')) @lang('hrm::appraisal.significant_trainings.2.title')</b></h4>
    <div class="row significant-trainings-international-repeater">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.course_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.organization_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.country')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.duration') (@lang('hrm::appraisal.weekly'))</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.training_year')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('labels.delete')</th>
                    </tr>
                    </thead>
                    <tbody data-repeater-list="reporting_officer_significant_trainings_international">
                    <tr data-repeater-item>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'course',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.course_name'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'organization',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.organization_name'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'country',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.country'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'duration',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.duration'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 100,
                                            'data-msg-max' => trans("labels.Field can't be geater than 100"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'year',
                                        null,
                                        [
                                            'class' => 'form-control educational_qualifications required',
                                            'placeholder' => trans('hrm::appraisal.training_year'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-year-length' => '4',
                                            'data-msg-year-length' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            <button style="width: 100%; border-radius: 0; background: none;" type="button" class="btn" data-repeater-delete><i class="ft-trash-2"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <button type="button" data-repeater-create="" class="btn btn-primary float-right"><i
                        class="ft-plus"></i> @lang('labels.add')
            </button>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.publications_info')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('labels.serial')</th>
                        <th>@lang('hrm::appraisal.type_of_publication')</th>
                        <th>@lang('hrm::appraisal.publication_information.total')</th>
                        <th>@lang('hrm::appraisal.publication_information.total_this_year')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.1'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.1.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'reporting_officer_publications_qualification[1][total]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'number' => 'true',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 100,
                                            'data-msg-max' => trans("labels.Field can't be geater than 100"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_publications_qualification[1][total_this_year]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.2'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.2.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'reporting_officer_publications_qualification[2][total]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'number' => true,
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 100,
                                            'data-msg-max' => trans("labels.Field can't be geater than 100"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_publications_qualification[2][total_this_year]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.3'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.3.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'reporting_officer_publications_qualification[3][total]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'number' => true,
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 100,
                                            'data-msg-max' => trans("labels.Field can't be geater than 100"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_publications_qualification[3][total_this_year]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.4'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.4.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'reporting_officer_publications_qualification[4][total]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'number' => true,
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 100,
                                            'data-msg-max' => trans("labels.Field can't be geater than 100"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_publications_qualification[4][total_this_year]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.5'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.5.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'reporting_officer_publications_qualification[5][total]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'number' => true,
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 100,
                                            'data-msg-max' => trans("labels.Field can't be geater than 100"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::text(
                                        'reporting_officer_publications_qualification[5][total_this_year]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;" colspan="2"><b>@lang('labels.total')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'reporting_officer_publications_qualification[grand][total]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'min' => 1,
                                            'data-msg-min' => trans("labels.Please enter a value greater than or equal to 1"),
                                            'max' => 500,
                                            'data-msg-max' => trans("labels.Field can't be geater than 500"),
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'data-msg-required' => trans('labels.This field is required'),
                                            'readOnly'
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::number(
                                        'reporting_officer_publications_qualification[grand][total_this_year]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-number' => 'true',
                                            'data-msg-number' => trans('labels.Please enter a valid number'),
                                            'readOnly'
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.perform_research_duties_while_considering')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.1.title')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.2.title')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.3.title')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.4.title')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::textarea(
                                        'reporting_officer_conducting_responsibilities[training]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => trans('hrm::appraisal.conducting_responsibilities.1.placeholder'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-maxlength' => 500,
                                            'data-msg-maxlength' => trans('labels.At most 500 characters'),
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::textarea(
                                        'reporting_officer_conducting_responsibilities[research]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => trans('hrm::appraisal.conducting_responsibilities.2.placeholder'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-maxlength' => 500,
                                            'data-msg-maxlength' => trans('labels.At most 500 characters'),
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::textarea(
                                        'reporting_officer_conducting_responsibilities[project]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => trans('hrm::appraisal.conducting_responsibilities.3.placeholder'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-maxlength' => 500,
                                            'data-msg-maxlength' => trans('labels.At most 500 characters'),
                                        ]
                                    ) }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ Form::textarea(
                                        'reporting_officer_conducting_responsibilities[administrative]',
                                        null,
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => trans('hrm::appraisal.conducting_responsibilities.4.placeholder'),
                                            'style' => 'width: 100%; border-radius: 0;',
                                            'data-rule-maxlength' => 500,
                                            'data-msg-maxlength' => trans('labels.At most 500 characters'),
                                        ]
                                    ) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <label for="" class="required" style="font-size: 1.51rem">@lang('hrm::appraisal.marital_status')</label>
            <div class="row">
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('reporting_officer_marital_status', 'married', false, ['class' => 'required reporting_officer_marital_status', 'data-msg-required' => trans('labels.This field is required')]) !!}
                            <label>@lang('hrm::appraisal.married')</label>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('reporting_officer_marital_status', 'unmarried', false, ['class' => 'required reporting_officer_marital_status', 'data-msg-required' => trans('labels.This field is required')]) !!}
                            <label>@lang('hrm::appraisal.unmarried')</label>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('reporting_officer_marital_status', 'widower', false, ['class' => 'required reporting_officer_marital_status', 'data-msg-required' => trans('labels.This field is required')]) !!}
                            <label>@lang('hrm::appraisal.widower')</label>
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            {!! Form::radio('reporting_officer_marital_status', 'widow', false, ['class' => 'required reporting_officer_marital_status', 'data-msg-required' => trans('labels.This field is required')]) !!}
                            <label>@lang('hrm::appraisal.widow')</label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row radio-error"></div>
            @if ($errors->has('reporting_officer_marital_status'))
                <div class="small danger">
                    <strong>{{ $errors->first('reporting_officer_marital_status') }}</strong>
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required" style="font-size: 1.51rem">@lang('hrm::appraisal.no_of_current_children')</label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                {!! Form::radio('reporting_officer_number_of_children', '1', false, ['class' => 'required reporting_officer_no_of_children', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                <label>@lang('hrm::appraisal.one_children')</label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                {!! Form::radio('reporting_officer_number_of_children', '2', false, ['class' => 'required reporting_officer_no_of_children', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                <label>@lang('hrm::appraisal.two_children')</label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                {!! Form::radio('reporting_officer_number_of_children', '3', false, ['class' => 'required reporting_officer_no_of_children', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                <label>@lang('hrm::appraisal.more_than_two_children')</label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                {!! Form::radio('reporting_officer_number_of_children', '0', false, ['class' => 'required reporting_officer_no_of_children', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                <label>@lang('hrm::appraisal.childless')</label>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="row radio-error"></div>
                @if ($errors->has('reporting_officer_number_of_children'))
                    <div class="small danger">
                        <strong>{{ $errors->first('reporting_officer_number_of_children') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.reporting_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('reporting_officer_signature',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('reporting_officer_signature'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('reporting_officer_signature') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('reporting_officer_seal',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('reporting_officer_seal'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('reporting_officer_seal') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('labels.date'):</label>
                        {{ Form::text('reporting_officer_date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'readOnly'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('reporting_officer_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('reporting_officer_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.medical_officer')</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">@lang('hrm::appraisal.medical_officer')</label>
                {{ Form::text('medical_reporter', $medicalOfficer->getName(). ' - ' . $medicalOfficer->getDesignation() . ' - ' . $medicalOfficer->getDepartment(), [
                            'id' => 'date',
                            'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'readOnly'
                        ]) }}
                {!! Form::hidden('medical_reporter_id', $medicalOfficer->id) !!}

                @if ($errors->has('medical_reporter_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('medical_reporter_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <hr>
</fieldset>
{{ Form::hidden('reporting_employee_id', auth()->user()->id) }}
{{ Form::hidden('initiator_id', auth()->user()->id) }}
{{ Form::hidden('type', $class) }}



