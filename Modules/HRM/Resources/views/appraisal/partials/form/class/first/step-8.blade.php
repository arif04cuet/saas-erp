<h6>@lang('hrm::appraisal.signer_officer_comments')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="required">@lang('hrm::appraisal.comment_on_reporting_officer_evaluation')</label>
                {{ Form::textarea(
                    'signer_comment_on_reporting_officer_evaluation', null,
                    [
                        'class' => 'form-control required',
                        'placeholder' => '',
                        'data-msg-required' => trans('labels.This field is required')
                    ]
                 )
                }}
                <div class="help-block"></div>
                @if ($errors->has('signer_comment_on_reporting_officer_evaluation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('signer_comment_on_reporting_officer_evaluation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reason_and_actual_evaluation">@lang('hrm::appraisal.reason_and_actual_evaluation')</label>
                {{ Form::textarea('signer_reason_and_actual_evaluation', null, ['class' => 'form-control', 'placeholder' => '']) }}
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
                                    {{ Form::radio('signer_evaluation_value', '91-100', null, ['class' => 'required signer_evaluation_value', 'data-msg-required' => trans('labels.This field is required')]) }}
                                    <label for="unique_general">@lang('hrm::appraisal.unique_general_2') (@lang('hrm::appraisal.unique_general_key_2'))</label>
                                </fieldset>
                                <fieldset>
                                    {{ Form::radio('signer_evaluation_value', '76-90', null, ['class' => 'required signer_evaluation_value', 'data-msg-required' => trans('labels.This field is required')]) }}
                                    <label for="excellent">@lang('hrm::appraisal.excellent_2') (@lang('hrm::appraisal.excellent_key_2'))</label>
                                </fieldset>
                                <fieldset>
                                    {{ Form::radio('signer_evaluation_value', '56-75', null, ['class' => 'required signer_evaluation_value', 'data-msg-required' => trans('labels.This field is required')]) }}
                                    <label for="good">@lang('hrm::appraisal.good_2') (@lang('hrm::appraisal.good_key_2'))</label>
                                </fieldset>
                                <fieldset>
                                    {{ Form::radio('signer_evaluation_value', '40-55', null, ['class' => 'required signer_evaluation_value', 'data-msg-required' => trans('labels.This field is required')]) }}
                                    <label for="aggregate">@lang('hrm::appraisal.aggregate_2') (@lang('hrm::appraisal.aggregate_key_2'))</label>
                                </fieldset>
                                <fieldset>
                                    {{ Form::radio('signer_evaluation_value', '01-39', null, ['class' => 'required signer_evaluation_value', 'data-msg-required' => trans('labels.This field is required')]) }}
                                    <label for="unsatisfactory">@lang('hrm::appraisal.unsatisfactory_2') (@lang('hrm::appraisal.unsatisfactory_key_2'))</label>
                                </fieldset>
                                <div class="row radio-error" data-radio-field-name="signer_evaluation_value"></div>
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
                <label for="signer_special_comment">@lang('hrm::appraisal.special_comment')</label>
                {{ Form::textarea('signer_special_comment', null, ['class' => 'form-control', 'placeholder' => '']) }}
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
                        <label class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('signer_officer_signature',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('signer_officer_signature'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('signer_officer_signature') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('signer_officer_seal',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('signer_officer_seal'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('signer_officer_seal') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('labels.date'):</label>
                        {{ Form::text('signer_officer_date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'required' => 'required',
                            'readOnly'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('signer_officer_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('signer_officer_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>