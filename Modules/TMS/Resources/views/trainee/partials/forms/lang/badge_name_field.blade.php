@if($langPreference == $langOptions['only_bangla'])
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('tms::training.short_name_for_name_badge_bn') :</label>
            {!! Form::text('badge_name_bn', null, [
                'class' => 'form-control required' . ($errors->has('badge_name_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                 'data-rule-regex-bn' => config('regex-bn'),
                'data-rule-maxlength' => 100,
                'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                ])
            !!}
            @if ($errors->has('badge_name_bn'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('badge_name_bn') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@elseif($langPreference == $langOptions['only_english'])
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('tms::training.short_name_for_name_badge') :</label>
            {!! Form::text('badge_name', null, [
                'class' => 'form-control required' . ($errors->has('badge_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'data-rule-regex-en' => config('regex-en'),
                'data-rule-maxlength' => 100,
                'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                ])
            !!}
            @if ($errors->has('badge_name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('badge_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@else
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('tms::training.short_name_for_name_badge') :</label>
            {!! Form::text('badge_name', null, [
                'class' => 'form-control required' . ($errors->has('badge_name') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                'data-rule-regex-en' => config('regex-en'),
                'data-rule-maxlength' => 100,
                'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                ])
            !!}
            @if ($errors->has('badge_name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('badge_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('tms::training.short_name_for_name_badge_bn') :</label>
            {!! Form::text('badge_name_bn', null, [
                'class' => 'form-control required' . ($errors->has('badge_name_bn') ? ' is-invalid' : ''),
                'data-msg-required' => Lang::get('labels.This field is required'),
                 'data-rule-regex-bn' => config('regex-bn'),
                'data-rule-maxlength' => 100,
                'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                ])
            !!}
            @if ($errors->has('badge_name_bn'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('badge_name_bn') }}</strong>
                        </span>
            @endif
        </div>
    </div>
@endif
