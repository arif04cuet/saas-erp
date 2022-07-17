<div class="row justify-content-center align-items-center">
    <div class="col-md-6">
        <h3 class="text-center">@lang('tms::check.header')</h3>
        <div class="form-group">
            <label for="phoneNumber1" class="required">@lang('tms::training.mobile') :</label>
            {!! Form::text(
                'mobile',
                old('mobile'),
                [
                    'class' => 'form-control required' . ($errors->has('mobile') ? ' is-invalid' : ''),
                    'data-rule-minlength' => 11,
                    'data-msg-minlength' => trans('labels.mobile_no_validation', ['attribute'=>trans('labels.digits.11')]),
                    'data-rule-maxlength' => 11,
                    'data-msg-maxlength' => trans('labels.mobile_no_validation',['attribute'=>trans('labels.digits.11')]),
                    'data-msg-required' => Lang::get('labels.This field is required'),
                    'data-rule-regex-number' => '^([\u09E6-\u09EF]|[0-9])+$',
                    'placeholder' => '01XXXXXXXXX',
                    'readOnly' => session('mobile') ? true : false
                ]
            )!!}

            @if ($errors->has('mobile'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
            @endif
        </div>
    </div>
    {{ Form::hidden('training_id', $training->id)}}
</div>
<div class="row justify-content-center align-items-center">
    <div class="col-md-6">
        <button type="submit" class="btn btn-sm btn-primary">
            <i class="ft ft-check-square"></i> @lang('tms::check.submit_button')
        </button>
    </div>
</div>
