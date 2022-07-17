<h6>{{ trans('tms::training.trainee_service') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <!-- designation -->
                @include('tms::public.training-registration.partials.lang.designation')
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="organization" class="required">@lang('tms::training.organization') : </label>
                        {!! Form::text('organization', old('organization'), ['class' => 'form-control required' . ($errors->has('designation') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Organization Name', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                        @if ($errors->has('organization'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="service_code" class="">@lang('tms::training.service_code') :</label>
                        {!! Form::text('service_code', old('service_code'), ['class' => 'form-control' . ($errors->has('service_code') ? ' is-invalid' : ''), 'placeholder' => 'Service Code', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),]) !!}

                        @if ($errors->has('service_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('service_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="joining_date" class="required">@lang('tms::training.joining_date') :</label>
                            {{ Form::text('joining_date', null, [
                            'class' => 'form-control required',
                            'id'=>'dateOfJoining', 'data-msg-required' => trans('labels.This field is required'),
                            'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                            ]) }}

                            @if ($errors->has('joining_date'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('joining_date') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="experience" class="required">@lang('tms::training.experience') :</label>
                        {!! Form::text(
                            'experience',
                            old('experience'),
                            [
                                'class' => 'form-control required' . ($errors->has('experience') ? ' is-invalid' : ''),
                                'placeholder' => '2',
                                'data-msg-required' => Lang::get('labels.This field is required'),
                                'data-rule-regex-number' => '^(' . trans('tms::trainee.registration.validations.experience') . ')+$',
                                'data-rule-max-experience' => "",
                            ])
                        !!}

                        @if ($errors->has('experience'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('experience') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="address" class="required">@lang('tms::training.address') :</label>
                    {!! Form::textarea('address', null, ['id' => '', 'data-rule-maxlength' => 500, 'data-msg-required' => Lang::get('labels.This field is required'),'data-msg-maxlength'=>Lang::get('labels.At most 500 characters'), 'rows' => 4, 'class' => 'form-control required', 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
</fieldset>

