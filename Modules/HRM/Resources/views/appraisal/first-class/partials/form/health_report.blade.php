<h6>@lang('hrm::appraisal.health_exam_report')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>@lang('hrm::appraisal.name_of_reporting_officer')</td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                </tr>
                <tr>
                    <td>@lang('labels.designation')</td>
                    <td>{{ $employee->designation->name }}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.age')</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($employee->employeePersonalInfo)->age }} @lang('hrm::appraisal.years')</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="height" class="required">@lang('hrm::appraisal.height') (@lang('hrm::appraisal.cm'))</label>
                {{ Form::text('height', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="weight" class="required">@lang('hrm::appraisal.weight') (@lang('hrm::appraisal.kg'))</label>
                {{ Form::text('weight', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="blood_group" class="required">@lang('hrm::appraisal.blood_group')</label>
                {{ Form::text('blood_group', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="blood_pressure" class="required">@lang('hrm::appraisal.blood_pressure')</label>
                {{ Form::text('blood_pressure', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="eye_vision_power" class="required">@lang('hrm::appraisal.eye_vision_power')</label>
                {{ Form::text('eye_vision_power', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="x_ray_report" class="required">@lang('hrm::appraisal.x_ray_report')</label>
                {{ Form::text('x_ray_report', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="ecg_report" class="required">@lang('hrm::appraisal.ecg_report')</label>
                {{ Form::text('ecg_report', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="medical_class_category" class="required">@lang('hrm::appraisal.medical_class_category')</label>
                {{ Form::text('medical_class_category', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="health_impairment" class="required">@lang('hrm::appraisal.health_impairment')/@lang('hrm::appraisal.nature_of_disability') (@lang('hrm::appraisal.in_short'))</label>
                {{ Form::textarea('health_impairment', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.health_officer')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>@lang('labels.name'):</label>&nbsp Dr. Shazahan Dewan
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>@lang('hrm::appraisal.designation'):</label>&nbsp Health Officer
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="health_officer_signature" class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('health_officer_signature',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'id' => 'imageUpload',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('signature'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('signature') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="h_o_date" class="required">@lang('labels.date'):</label>
                        {{ Form::text('h_o_date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'required' => 'required',
                            'disabled'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('h_o_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('h_o_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>



