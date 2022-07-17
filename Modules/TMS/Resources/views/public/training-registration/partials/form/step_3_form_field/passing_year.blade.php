<div class="form-group">
    {{ Form::label('passing_year', trans('tms::training.passing_year'), ['class' => 'required']) }}
    {!! Form::number(
        'passing_year',
        old('passing_year'),
        [
            'class' => 'form-control required' . ($errors->has('passing_year') ? ' is-invalid' : ''),
            'data-msg-required' => Lang::get('labels.This field is required'),
            'placeholder' => 'xxxx',
            'data-rule-regex' => '^[0-9]$',
            'data-msg-regex' => 'This field mast be a number',
            'data-msg-number' => trans('labels.Please enter a valid number'),
            'data-rule-maxlength' => 4,
            'data-msg-maxlength'=>Lang::get('labels.At least 4 characters'),
            'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
        ]
    )!!}

    @if ($errors->has('passing_year'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('passing_year') }}</strong>
        </span>
    @endif
</div>
