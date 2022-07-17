<h6>@lang('hrm::appraisal.dg_final_comment')</h6>
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
                    <td>@lang('hrm::appraisal.department')</td>
                    <td>{{ $employee->employeeDepartment->name }}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.section')</td>
                    <td>
                        @foreach($employee->employeeDepartment->sections as $section)
                            {{ $section->name }},
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td>@lang('hrm::appraisal.pay_scale')</td>
                    <td>{{ $employee->employeePersonalInfo->salary_scale ?? '' }} @lang('labels.bdt')</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.name_of_reporter_officer')</td>
                    <td>ড. এম মিজানুর রহমান</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.number_obtained_in_100')</td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.name_of_signer_officer')</td>
                    <td>ড. মোঃ আবদুল করিম</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.signer_modified_value')</td>
                    <td>80</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="remarks" class="required">@lang('labels.remarks')</label>
                {{ Form::textarea('remarks', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.dg_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reporter_officer_signature" class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('reporter_officer_signature',[
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reporter_officer_seal" class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('reporter_officer_seal',[
                                        'class' => 'form-control ',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'id' => 'imageUpload',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('seal'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('seal') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date" class="required">@lang('labels.date'):</label>
                        {{ Form::text('date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'required' => 'required',
                            'disabled'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>


