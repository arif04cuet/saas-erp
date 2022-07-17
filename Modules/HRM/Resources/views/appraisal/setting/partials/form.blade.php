<div class="form-group">
    <label>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.reporter')</label>
    {{ Form::select('reporter_id',
        $employees,
        isset($appraisalSetting) ? $appraisalSetting->reporter_id : null,
        [
            'class' => 'form-control' . ($errors->has('reporter_id') ? ' is-invalid' : ''),
            'placeholder' => trans('labels.select'),
            'required'
        ]
    ) }}

    @if($errors->has('reporter_id'))
        <div class="help-block danger">{{ $errors->first('reporter_id') }}</div>
    @endif
</div>
<div class="form-group">
    <label>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.signer')</label>
    {{ Form::select('signer_id',
        $employees,
        isset($appraisalSetting) ? $appraisalSetting->signer_id : null,
        [
            'class' => 'form-control' . ($errors->has('signer_id') ? ' is-invalid' : ''),
            'placeholder' => trans('labels.select'),
            'required'
        ]
    ) }}

    @if($errors->has('signer_id'))
        <div class="help-block danger">{{ $errors->first('signer_id') }}</div>
    @endif
</div>
<div class="form-group">
    <label>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.commenter')</label>
    {{ Form::select('commenter_id',
        $employees,
        isset($appraisalSetting) ? $appraisalSetting->commenter_id : null,
        [
            'class' => 'form-control' . ($errors->has('commenter_id') ? ' is-invalid' : ''),
            'placeholder' => trans('labels.select'),
            'required'
        ]
    ) }}

    @if($errors->has('commenter_id'))
        <div class="help-block danger">{{ $errors->first('commenter_id') }}</div>
    @endif
</div>
<div class="form-group">
    <label>@lang(constant('APPRAISAL_SETTING_LOCAL') . '.reviewees')</label>
    {{ Form::select('reviewees[]',
        $employees,
        isset($appraisalSetting) ? $appraisalSetting->reviewees->pluck('employee_id') : null,
        [
            'class' => 'form-control' . ($errors->has('reviewees') ? ' is-invalid' : ''),
            'multiple',
            'required'
        ]
    ) }}

    @if($errors->has('reviewees'))
        <div class="help-block danger">{{ $errors->first('reviewees') }}</div>
    @endif
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{ trans('labels.save') }}
    </button>
    <a href="{{ route('appraisals.settings.index') }}" class="btn btn-warning">
        <i class="ft-x"></i> {{ trans('labels.cancel') }}
    </a>
</div>