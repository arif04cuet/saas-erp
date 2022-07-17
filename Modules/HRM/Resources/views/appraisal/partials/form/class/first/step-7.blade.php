<h6>@lang('hrm::appraisal.advice')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="advice_on_reporting_officer" class="required">@lang('hrm::appraisal.advice_on_reporting_officer')</label>
                {{ Form::textarea('reporter_officer_advice_on_reporting_officer', null, ['class' => 'form-control required', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="work_should_be_focused_on" class="required">@lang('hrm::appraisal.work_should_be_focused_on')</label>
                {{ Form::textarea('reporting_officer_work_should_be_focused_on', null, ['class' => 'form-control required', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="type_of_responsibility_can_be_appropriate" class="required">@lang('hrm::appraisal.type_of_responsibility_can_be_appropriate')</label>
                {{ Form::textarea('reporter_officer_type_of_responsibility_can_be_appropriate', null, ['class' => 'form-control required', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="kind_of_training_guidance_need" class="required">@lang('hrm::appraisal.kind_of_training_guidance_need')</label>
                {{ Form::textarea('reporter_officer_kind_of_training_guidance_need', null, ['class' => 'form-control required', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="any_other_advice">@lang('hrm::appraisal.any_other_advice')</label>
                {{ Form::textarea('reporter_officer_any_other_advice', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.reporter_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reporter_officer_signature" class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('reporter_officer_signature',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('reporter_officer_signature'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('reporter_officer_signature') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reporter_officer_seal" class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('reporter_officer_seal',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('reporter_officer_seal'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('reporter_officer_seal') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="reporter_officer_date" class="required">@lang('labels.date'):</label>
                        {{ Form::text('reporter_officer_date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'required' => 'required',
                            'readOnly'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('reporter_officer_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('reporter_officer_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.signer_officer')</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">@lang('hrm::appraisal.department')</label>
                {{ Form::select('signer_department_id', $departments, null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control required'.($errors->has('signer_department_id') ? ' is-invalid' : ''),
                        'id' => 'signer_department',
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                }}

                @if ($errors->has('signer_department_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('signer_department_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="required">@lang('labels.name')</label>
                {{ Form::select('signer_id', $availableSigners, null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control required'.($errors->has('signer_id') ? ' is-invalid' : ''),
                        'id' => 'signer',
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                }}

                @if ($errors->has('signer_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('signer_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</fieldset>



