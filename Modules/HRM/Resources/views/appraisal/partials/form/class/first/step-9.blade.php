<h6>
    @if(get_user_designation($appraisal->finisher->user)->short_name == "ADG")
        @lang('hrm::appraisal.adg_final_comment')
    @else
        @lang('hrm::appraisal.dg_final_comment')
    @endif
</h6>
<fieldset>
    <h3>
        @if(get_user_designation($appraisal->finisher->user)->short_name == "DA")
            @lang('hrm::appraisal.da_final_comment')
        @else
            @lang('hrm::appraisal.dg_final_comment')
        @endif
    </h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="required">@lang('labels.remarks')</label>
                {{ Form::textarea(
                    'finisher_officer_remarks', null,
                    [
                        'class' => 'form-control required',
                        'placeholder' => '',
                        'data-msg-required' => trans('labels.This field is required')
                    ]
                ) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <h3>
        @if(get_user_designation($appraisal->finisher->user)->short_name == "DA")
            @lang('hrm::appraisal.da_signature_seal')
        @else
            @lang('hrm::appraisal.dg_signature_seal')
        @endif
    </h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('finisher_officer_signature',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('finisher_officer_signature'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('finisher_officer_signature') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('finisher_officer_seal',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('finisher_officer_seal'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('finisher_officer_seal') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('labels.date'):</label>
                        {{ Form::text('finisher_officer_date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'required' => 'required',
                            'readOnly'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('finisher_officer_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('finisher_officer_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
{{ Form::hidden('state', $appraisal->state) }}