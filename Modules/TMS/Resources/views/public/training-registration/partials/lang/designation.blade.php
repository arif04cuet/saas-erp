@if($langPreference == $langOptions['only_english'])
    <!-- english -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="designation" class="required">@lang('tms::training.designation') : </label>
            {!! Form::text('designation', old('designation'), [
                'class' => 'form-control required' . ($errors->has('designation') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'teacher',
                'data-rule-regex-en' => '^([\x3Aa-zA-Z0-9\u002D\u0020])+$',
                'data-rule-maxlength' => 25,
                'data-msg-maxlength'=>Lang::get('labels.At most 25 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                ])
            !!}

            @if ($errors->has('designation'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('designation') }}</strong>
                            </span>
            @endif
        </div>
    </div>
@elseif($langPreference == $langOptions['only_bangla'])
    <!-- bangla -->
    <div class="col-md-12">
        <div class="form-group">
            <label for="designation" class="required">@lang('tms::training.designation_bn') : </label>
            {!! Form::text('designation_bn', old('designation_bn'), [
                'class' => 'form-control required' . ($errors->has('designation_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'শিক্ষক',
                'data-rule-regex-bn' => '^([\u0980-\u09FF\u0020\u002D])+$',
                'data-rule-maxlength' => 25,
                'data-msg-maxlength'=>Lang::get('labels.At most 25 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) !!}

            @if ($errors->has('designation'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('designation') }}</strong>
                            </span>
            @endif
        </div>
    </div>
@else
    <!-- english -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="designation" class="required">@lang('tms::training.designation') : </label>
            {!! Form::text('designation', old('designation'), [
                'class' => 'form-control required' . ($errors->has('designation') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'teacher',
                'data-rule-regex-en' => '^([\x3Aa-zA-Z0-9\u002D\u0020])+$',
                'data-rule-maxlength' => 25,
                'data-msg-maxlength'=>Lang::get('labels.At most 25 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                ])
            !!}

            @if ($errors->has('designation'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('designation') }}</strong>
                            </span>
            @endif
        </div>
    </div>
    <!-- bangla -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="designation" class="required">@lang('tms::training.designation_bn') : </label>
            {!! Form::text('designation_bn', old('designation_bn'), [
                'class' => 'form-control required' . ($errors->has('designation_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'placeholder' => 'শিক্ষক',
                'data-rule-regex-bn' => '^([\u0980-\u09FF\u0020\u002D])+$',
                'data-rule-maxlength' => 25,
                'data-msg-maxlength'=>Lang::get('labels.At most 25 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
            ]) !!}

            @if ($errors->has('designation'))
                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('designation') }}</strong>
                            </span>
            @endif
        </div>
    </div>
@endif
