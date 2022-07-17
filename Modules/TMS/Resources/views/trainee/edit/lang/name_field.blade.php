@if($langPreference == $langOptions['only_english'])
    <!-- english name -->
    <div class="col-md-12">
        <div class="form-group">
            <label class="required">@lang('tms::training.full_name') : (@lang('tms::training.in_english')
                )</label>
            {!! Form::text('english_name', old('english_name') ?? $trainee->english_name, [
                'class' => 'form-control required' . ($errors->has('english_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'Hamidur Rahman', 'data-rule-maxlength' => 50,
                'data-rule-regex-en' => config('regex.en'),
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) !!}

            @if ($errors->has('english_name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('english_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@elseif($langPreference == $langOptions['only_bangla'])
    <!-- bangla name -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="bangla_name" class="required">@lang('tms::training.full_name') :
                (@lang('tms::training.in_bangla')
                )</label>
            {!! Form::text('bangla_name', old('bangla_name') ?? $trainee->bangla_name, [
                'class' => 'form-control required' . ($errors->has('bangla_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'হামিদুর রহমান', 'data-rule-maxlength' => 50,
                'data-rule-regex-bn' => config('regex.bn'),
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
             ]) !!}

            @if ($errors->has('bangla_name'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bangla_name') }}</strong>
                            </span>
            @endif
        </div>
    </div>
@else
    <!-- bangla name -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="bangla_name" class="required">@lang('tms::training.full_name') :
                (@lang('tms::training.in_bangla')
                )</label>
            {!! Form::text('bangla_name', old('bangla_name') ?? $trainee->bangla_name, [
                'class' => 'form-control required' . ($errors->has('bangla_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'হামিদুর রহমান', 'data-rule-maxlength' => 50,
                'data-rule-regex-bn' => config('regex.bn'),
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
             ]) !!}

            @if ($errors->has('bangla_name'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bangla_name') }}</strong>
                            </span>
            @endif
        </div>
    </div>
    <!-- english name -->
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('tms::training.full_name') : (@lang('tms::training.in_english')
                )</label>
            {!! Form::text('english_name', old('english_name') ?? $trainee->english_name, [
                'class' => 'form-control required' . ($errors->has('english_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'Hamidur Rahman', 'data-rule-maxlength' => 50,
                'data-rule-regex-en' => config('regex.en'),
                'data-msg-maxlength'=>Lang::get('labels.At most 50 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) !!}

            @if ($errors->has('english_name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('english_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@endif
