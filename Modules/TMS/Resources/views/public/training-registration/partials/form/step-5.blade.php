<h6>{{ trans('tms::training.emergency_contact') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="required">@lang('tms::training.name') : </label>
                        {!! Form::text('name', old('name'), ['class' => 'form-control required' . ($errors->has('name') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Abdul Mutaleb', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile_no" class="required">@lang('tms::training.mobile') : </label>
                        {!! Form::text(
                            'mobile_no',
                            old('mobile_no'),
                            [
                                'class' => 'form-control required' . ($errors->has('mobile_no') ? ' is-invalid' : ''),
                                'data-rule-minlength' => 11,
                                'data-msg-minlength' => trans('labels.mobile_no_validation', ['attribute'=>trans('labels.digits.11')]),
                                'data-rule-maxlength' => 11,
                                'data-msg-maxlength' => trans('labels.mobile_no_validation', ['attribute'=>trans('labels.digits.11')]),
                                'data-rule-regex' => '^([^\xE6-\xEF]|[0-9])+$',
                                'data-rule-unique-mobile' => 'true',
                                'data-msg-number' => trans('labels.Please enter a valid number'),
                                'data-msg-required' => Lang::get('labels.This field is required'),
                                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                'placeholder' => '01XXXXXXXXX',
                            ]
                        )!!}

                        @if ($errors->has('mobile_no'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mobile_no') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="relation" class="required">@lang('tms::training.relation') :</label>
                        {!! Form::text('relation', old('relation'), ['class' => 'form-control required' . ($errors->has('relation') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Father', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                        @if ($errors->has('relation'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('relation') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="contact_address" class="required">@lang('tms::training.address') :</label>
                    {!! Form::textarea(
                        'contact_address',
                        null,
                        [
                            'id' => '',
                            'data-msg-required' => Lang::get('labels.This field is required'),
                            'data-rule-maxlength' => 500,
                            'data-msg-maxlength'=> trans('labels.At most 500 characters'),
                            'rows' => 4,
                            'class' => 'form-control required',
                            'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                        ]
                    )!!}

                    @if ($errors->has('contact_address'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contact_address') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
</fieldset>

