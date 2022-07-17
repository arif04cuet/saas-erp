<h6>@lang('hrm::appraisal.health_exam_report')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>@lang('hrm::appraisal.name_of_reporting_officer')</td>
                    <td>{{ $appraisal->reportingEmployee->first_name }} {{ $appraisal->reportingEmployee->last_name }}</td>
                </tr>
                <tr>
                    <td>@lang('labels.designation')</td>
                    <td>{{ $appraisal->reportingEmployee->designation->name ?? null }}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.age')</td>
                    @if($appraisal->reportingEmployee->employeePersonalInfo)
                        @if($appraisal->reportingEmployee->employeePersonalInfo->date_of_birth)
                            <td>{{ \Illuminate\Support\Carbon::parse($appraisal->reportingEmployee->employeePersonalInfo->date_of_birth)->age }} @lang('hrm::appraisal.years')</td>
                        @else
                            <td>0 @lang('hrm::appraisal.years')</td>
                        @endif
                    @else
                        <td>0 @lang('hrm::appraisal.years')</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="reporting_officer_height" class="required">@lang('hrm::appraisal.height') (@lang('hrm::appraisal.cm'))</label>
                {{ Form::text(
                    'reporting_officer_height',
                    null,
                    [
                        'class' => 'form-control required',
                        'placeholder' => '',
                        'data-msg-required' => trans('labels.This field is required'),
                        'number' => 'true',
                        'min' => 100,
                        'data-msg-min' => trans('labels.Please enter a valid number'),
                        'max' => 250,
                        'data-msg-max' => trans('labels.Please enter a valid number'),
                        'data-msg-number' => trans('labels.Please enter a valid number')
                    ]
                )}}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="reporting_officer_weight" class="required">@lang('hrm::appraisal.weight') (@lang('hrm::appraisal.kg'))</label>
                {{ Form::text(
                    'reporting_officer_weight',
                    null,
                    [
                        'class' => 'form-control required',
                        'placeholder' => '',
                        'data-msg-required' => trans('labels.This field is required'),
                        'number' => 'true',
                        'min' => 1,
                        'data-msg-min' => trans('labels.Please enter a valid number'),
                        'max' => 200,
                        'data-msg-max' => trans('labels.Please enter a valid number'),
                        'data-msg-number' => trans('labels.Please enter a valid number')
                    ]
                ) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="reporting_officer_blood_group" class="required">@lang('hrm::appraisal.blood_group')</label>
                {{ Form::select(
                    'reporting_officer_blood_group',
                    [
                        'A+' => 'A+',
                        'B+' => 'B+',
                        'AB+' => 'AB+',
                        'O+' => 'O+',
                        'A-' => 'A-',
                        'B-' => 'B-',
                        'AB-' => 'AB-',
                        'O-' => 'O-'
                    ],
                    null,
                    [
                        'class' => 'form-control required',
                        'placeholder' => trans('labels.select'),
                        'data-msg-required' => trans('labels.This field is required')
                    ]
                ) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="reporting_officer_blood_pressure" class="required">@lang('hrm::appraisal.blood_pressure')</label>
                {{ Form::text('reporting_officer_blood_pressure', null, ['class' => 'form-control required', 'placeholder' => '', 'data-msg-required' => trans('labels.This field is required')]) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="reporting_officer_eye_vision_power" class="required">@lang('hrm::appraisal.eye_vision_power')</label>
                {{ Form::text('reporting_officer_eye_vision_power', null, ['class' => 'form-control required', 'placeholder' => '', 'data-msg-required' => trans('labels.This field is required')]) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="reporting_officer_x_ray_report" class="required">@lang('hrm::appraisal.x_ray_report')</label>
                {{ Form::textarea('reporting_officer_x_ray_report', null, ['class' => 'form-control required', 'placeholder' => '', 'data-msg-required' => trans('labels.This field is required')]) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="reporting_officer_ecg_report" class="required">@lang('hrm::appraisal.ecg_report')</label>
                {{ Form::textarea('reporting_officer_ecg_report', null, ['class' => 'form-control required', 'placeholder' => '', 'data-msg-required' => trans('labels.This field is required')]) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="reporting_officer_medical_class_category" class="required">@lang('hrm::appraisal.medical_class_category')</label>
                {{ Form::text('reporting_officer_medical_class_category', null, ['class' => 'form-control required', 'placeholder' => '', 'data-msg-required' => trans('labels.This field is required')]) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="reporting_officer_health_impairment">@lang('hrm::appraisal.health_impairment')/@lang('hrm::appraisal.nature_of_disability') (@lang('hrm::appraisal.in_short'))</label>
                {{ Form::textarea('reporting_officer_health_impairment', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.health_officer')</h3>
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $appraisal->medicalReporter->first_name . " " . $appraisal->medicalReporter->last_name }} ({{ $appraisal->medicalReporter->designation ? $appraisal->medicalReporter->designation->name : '' }})</h4>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.medical_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="health_officer_signature" class="required">@lang('hrm::appraisal.signature'):</label>
                {!! Form::file('health_officer_signature',[
                                'class' => 'form-control required',
                                'accept' => '.png, .jpg, .jpeg',
                                'id' => 'imageUpload',
                                'data-msg-required' => trans('labels.Picture field is required')
                                ]) !!}
                <div class="help-block"></div>
                @if ($errors->has('health_officer_signature'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('health_officer_signature') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="health_officer_seal" class="required">@lang('hrm::appraisal.seal'):</label>
                {!! Form::file('health_officer_seal',[
                                'class' => 'form-control required',
                                'accept' => '.png, .jpg, .jpeg',
                                'data-msg-required' => trans('labels.Picture field is required')
                                ]) !!}
                <div class="help-block"></div>
                @if ($errors->has('health_officer_seal'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('health_officer_seal') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="h_o_date" class="required">@lang('labels.date'):</label>
                {{ Form::text('health_officer_date', date('j F, Y'), [
                    'id' => 'date',
                    'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                    'placeholder' => 'Pick start date',
                    'required' => 'required',
                    'readOnly'
                ]) }}
                <div class="help-block"></div>
                @if ($errors->has('health_officer_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('health_officer_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <hr>
</fieldset>
