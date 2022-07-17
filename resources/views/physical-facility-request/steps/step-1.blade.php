<h6>{{ trans('hm::booking-request.step_1') }}</h6>
<fieldset>
    <h4 class="form-section">
        <i class="la la-user"></i>{{ trans('hm::booking-request.facility.requester_information') }}
    </h4>
    <div class="row">
        <div class="col-md-6">
            <label class="required">{{ trans('hm::booking-request.facility.requester_name') }}</label>
            <div class="form-group">

                {{ Form::text('requester_name', null, [
                    'id' => 'requester_name',
                    'class' => 'form-control', 'autocomplete' => 'off', 'data-validation-required-message'
                    => __('labels.This field is required'), 'required']) }}
                <div class="help-block red" id="name-error"></div>
                @if ($errors->has('requester_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('requester_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">{{ trans('labels.email_address') }}</label>
            <div class="form-group">
                {{ Form::text('email', null, [
                    'id' => 'email',
                    'class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''),
                     'data-validation-email-message' =>
                    __('validation.email', ['attribute' => __('labels.email_address')])]) }}
                <div class="help-block"></div>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>
        </div>

        <div class="col-md-6">
            <label class="required">{{ trans('labels.mobile') }}</label>
            <div class="form-group">
                {{ Form::text('mobile_no', null, [
                    'id' => 'mobile_no',
                    'class' => 'form-control',
                    'placeholder' => __('labels.mobile'),
                    'data-validation-required-message' => __('labels.This field is required'),
                    'required'
                    ])
                }}
                <div class="help-block red" id="mobile-error"></div>
                @if ($errors->has('mobile_no'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('mobile_no') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label required">{{ trans('hm::booking-request.facility.organization') }}</label>
            <div class="form-group">
                {{ Form::text('organization', null, [
                    'id' => 'organization-name',
                    'class' => 'form-control',
                    'data-validation-required-message' => __('labels.This field is required'),
                    'required'
                    ])
                }}
                <div class="help-block red" id="organization-error"></div>
                @if ($errors->has('organization'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('organization') }}</strong>
                    </span>
                @endif

            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ trans('hm::booking-request.training') }}</label>
            <div class="form-group">
                <div class="input-group">
                    {{ Form::text('training', null, ['class' => 'form-control',
'data-validation-required-message' => __('labels.This field is required')]) }}
                    @if ($errors->has('training'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('training') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label class="required">{{ trans('hm::booking-request.facility.required_facility') }}</label>
            <div class="form-group">
                <div class="input-group">
                    <div class="skin skin-flat">
                        {{ Form::checkbox('hostel', 1, false, [
                        'id' =>  'hostel',
                        'class' => 'form-control checkRequest'
                        ]) }}
                        <label class="form-check-label">@lang('labels.bard_hostel')</label>&nbsp;
                        <label class="form-check-label"> </label>
                        {{ Form::checkbox('cafeteria', 1, false, [
                        'id' => 'cafeteria',
                        'class' => 'form-control checkRequest'
                        ]) }}
                        <label class="form-check-label">@lang('labels.Cafeteria')</label>
                    </div>

                    @if ($errors->has('end_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="help-block red check-error" ></div>

            </div>
        </div>

    </div>
</fieldset>
