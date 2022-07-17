@if($langPreference == $langOptions['only_english'])
    <div class="col-md-6">
        <div class="form-group">
            <label for="firstName1" class="required">@lang('tms::training.fathers_name') : </label>
            {!! Form::text('fathers_name', old('fathers_name'),[
                'class' => 'form-control required' . ($errors->has('fathers_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'Abdul Mutaleb',
                'data-rule-regex-en' => config('regex.en'),
                'data-rule-maxlength' => 70,
                'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ])!!}

            @if ($errors->has('fathers_name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fathers_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@elseif($langPreference == $langOptions['only_bangla'])
    <div class="col-md-6">
        <div class="form-group">
            <label for="firstNameBn" class="required">@lang('tms::training.fathers_name_bn') : </label>
            {!!Form::text('fathers_name_bn', old('fathers_name_bn'),[
                'class' => 'form-control required' . ($errors->has('fathers_name_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'আব্দুল মোতালেব',
                'data-rule-regex-bn' => config('regex.bn'),
                'data-rule-maxlength' => 70,
                'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ])!!}

            @if ($errors->has('fathers_name_bn'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fathers_name_bn') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@else
    <div class="col-md-6">
        <div class="form-group">
            <label for="firstName1" class="required">@lang('tms::training.fathers_name') : </label>
            {!! Form::text('fathers_name', old('fathers_name'),[
                'class' => 'form-control required' . ($errors->has('fathers_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'Abdul Mutaleb',
                'data-rule-regex-en' => config('regex.en'),
                'data-rule-maxlength' => 70,
                'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ])!!}

            @if ($errors->has('fathers_name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fathers_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="firstNameBn" class="required">@lang('tms::training.fathers_name_bn') : </label>
            {!!Form::text('fathers_name_bn', old('fathers_name_bn'),[
                'class' => 'form-control required' . ($errors->has('fathers_name_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'আব্দুল মোতালেব',
                'data-rule-regex-bn' => config('regex.bn'),
                'data-rule-maxlength' => 70,
                'data-msg-maxlength'=>Lang::get('labels.At most 70 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ])!!}

            @if ($errors->has('fathers_name_bn'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fathers_name_bn') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@endif

