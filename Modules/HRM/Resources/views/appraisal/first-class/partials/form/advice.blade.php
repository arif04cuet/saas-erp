<h6>@lang('hrm::appraisal.advice')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="advice_on_reporting_officer" class="required">@lang('hrm::appraisal.advice_on_reporting_officer')</label>
                {{ Form::textarea('advice_on_reporting_officer', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="work_should_be_focused_on" class="required">@lang('hrm::appraisal.work_should_be_focused_on')</label>
                {{ Form::textarea('work_should_be_focused_on', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="type_of_responsibility_can_be_appropriate" class="required">@lang('hrm::appraisal.type_of_responsibility_can_be_appropriate')</label>
                {{ Form::textarea('type_of_responsibility_can_be_appropriate', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="kind_of_training_guidance_need" class="required">@lang('hrm::appraisal.kind_of_training_guidance_need')</label>
                {{ Form::textarea('kind_of_training_guidance_need', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="any_other_advice">@lang('hrm::appraisal.any_other_advice')</label>
                {{ Form::textarea('any_other_advice', null, ['class' => 'form-control', 'placeholder' => '']) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    {{--<h3>@lang('hrm::appraisal.reporter_officer_signature_seal')</h3>
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
                        <label for="reporter_officer_date" class="required">@lang('labels.date'):</label>
                        {{ Form::text('reporter_officer_date', date('j F, Y'), [
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
    </div>--}}
</fieldset>



