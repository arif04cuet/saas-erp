<td>
    <div class="form-group">
        {{ Form::text('start_time',
            null,
            [
                'class' => 'form-control start-time required',
                'data-msg-required' => trans('labels.This field is required'),
            ]
        ) }}
        @if ($errors->has('start_time'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('start_time') }}</strong>
        @endif
    </div>
</td>
<td>
    <div class="form-group">
        {{ Form::text('end_time',
            null,
            [
                'class' => 'form-control end-time required',
                'data-msg-required' => trans('labels.This field is required'),
            ]
        ) }}
        @if ($errors->has('end_time'))
            <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('end_time') }}</strong>
        @endif
    </div>
</td>
