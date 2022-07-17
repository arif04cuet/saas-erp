@if($langPreference == $langOptions['only_english'])
    <div class="col-md-6">
    <div class="form-group">
        <label for="lastName1" class="required">@lang('tms::training.mothers_name') : </label>
        {!! Form::text('mothers_name',
        old('mothers_name'),
        [
            'class' => 'form-control required' . ($errors->has('mothers_name') ? ' is-invalid' : ''),
            'data-msg-required' => Lang::get('labels.This field is required'),
            'placeholder' => 'Safia Mutaleb',
            'data-rule-regex-en' => config('regex.en'),
            'data-rule-maxlength' => 70,
            'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
            'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
        ]
        )!!}

        @if ($errors->has('mothers_name'))
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mothers_name') }}</strong>
                        </span>
        @endif
    </div>
</div>
@elseif($langPreference == $langOptions['only_bangla'])
    <div class="col-md-6">
    <div class="form-group">
        <label for="lastNameBN" class="required">@lang('tms::training.mothers_name_bn') : </label>
        {!! Form::text('mothers_name_bn', old('mothers_name_bn'), [
            'class' => 'form-control required' . ($errors->has('mother_name_bn') ? ' is-invalid' : ''),
            'data-msg-required' => Lang::get('labels.This field is required'),
            'placeholder' => 'সুফিয়া মোতালেব',
            'data-rule-regex-bn' => config('regex.bn'),
            'data-rule-maxlength' => 70,
            'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
            'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
        ]) !!}

        @if ($errors->has('mothers_name_bn'))
            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mothers_name_bn') }}</strong>
                        </span>
        @endif
    </div>
</div>
@else
    <div class="col-md-6">
        <div class="form-group">
            <label for="lastName1" class="required">@lang('tms::training.mothers_name') : </label>
            {!! Form::text('mothers_name',
            old('mothers_name'),
            [
                'class' => 'form-control required' . ($errors->has('mothers_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'Safia Mutaleb',
                'data-rule-regex-en' => config('regex.en'),
                'data-rule-maxlength' => 70,
                'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]
            )!!}

            @if ($errors->has('mothers_name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mothers_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lastNameBN" class="required">@lang('tms::training.mothers_name_bn') : </label>
            {!! Form::text('mothers_name_bn', old('mothers_name_bn'), [
                'class' => 'form-control required' . ($errors->has('mother_name_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'সুফিয়া মোতালেব',
                'data-rule-regex-bn' => config('regex.bn'),
                'data-rule-maxlength' => 70,
                'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) !!}

            @if ($errors->has('mothers_name_bn'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mothers_name_bn') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@endif

