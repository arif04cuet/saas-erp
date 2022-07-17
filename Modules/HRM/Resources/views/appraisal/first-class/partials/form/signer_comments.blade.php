<h6>@lang('hrm::appraisal.signer_officer_comments')</h6>
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
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="comment_on_reporting_officer_evaluation" class="required">@lang('hrm::appraisal.comment_on_reporting_officer_evaluation')</label>
                {{ Form::textarea('comment_on_reporting_officer_evaluation', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reason_and_actual_evaluation" class="required">@lang('hrm::appraisal.reason_and_actual_evaluation')</label>
                {{ Form::textarea('reason_and_actual_evaluation', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="signer_evaluation_value" class="required">@lang('hrm::appraisal.signer_evaluation_value')</label>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row skin skin-flat">
                            <div class="col-md-12 col-sm-12">
                                <fieldset>
                                    <input type="radio" name="signer_evaluation_value" id="input-radio-15">
                                    <label for="unique_general">@lang('hrm::appraisal.unique_general')</label>
                                </fieldset>
                                <fieldset>
                                    <input type="radio" name="signer_evaluation_value" id="input-radio-16">
                                    <label for="excellent">@lang('hrm::appraisal.excellent')</label>
                                </fieldset>
                                <fieldset>
                                    <input type="radio" name="signer_evaluation_value" id="input-radio-15">
                                    <label for="good">@lang('hrm::appraisal.good')</label>
                                </fieldset>
                                <fieldset>
                                    <input type="radio" name="signer_evaluation_value" id="input-radio-16">
                                    <label for="aggregate">@lang('hrm::appraisal.aggregate')</label>
                                </fieldset>
                                <fieldset>
                                    <input type="radio" name="signer_evaluation_value" id="input-radio-16" checked>
                                    <label for="unsatisfactory">@lang('hrm::appraisal.unsatisfactory')</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="help-block"></div>
                        @if ($errors->has('signer_evaluation_value'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('signer_evaluation_value') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="special_comment">@lang('hrm::appraisal.special_comment')</label>
                {{ Form::textarea('special_comment', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.signer_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="signer_officer_signature" class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('signer_officer_signature',[
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
                        <label for="signer_officer_seal" class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('signer_officer_seal',[
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
                        <label for="signer_officer_date" class="required">@lang('labels.date'):</label>
                        {{ Form::text('signer_officer_date', date('j F, Y'), [
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


