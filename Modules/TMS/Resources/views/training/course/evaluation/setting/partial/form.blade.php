<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('status') ? 'error' : '' }}">
            <label for="">@lang('tms::course_evaluation.settings.form.edit.labels.status')</label>
            <div class="skin">
                {{ Form::checkbox(
                    'status',
                    1,
                    $currentStatus ?: false,
                    [
                        'class' => 'form-control course-evaluation-setting-status' . ($errors->has('status') ? ' is-invalid' : ''),
                    ]
                ) }}
                <label for="">
                    @lang('tms::course_evaluation.settings.form.edit.fields.status')
                </label>
                @if($errors->has('status'))
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('start_date') ? 'error' : '' }}">
            <label for="">@lang('tms::course_evaluation.settings.form.edit.labels.start_date')</label>
            {{ Form::text(
                'start_date',
                $currentStartDate,
                [
                    'class' => 'form-control course-evaluation-setting-start-date' . ($errors->has('start_date') ? ' is-invalid' : ''),
                    'data-rule-required-if' => 'status',
                    'data-msg-required-if' => trans('labels.This field is required'),
                    'readOnly',
                ]
            ) }}
            @if($errors->has('start_date'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('end_date') ? 'error' : '' }}">
            <label for="">@lang('tms::course_evaluation.settings.form.edit.labels.end_date')</label>
            {{ Form::text(
                'end_date',
                $currentEndDate,
                [
                    'class' => 'form-control course-evaluation-setting-end-date' . ($errors->has('end_date') ? ' is-invalid' : ''),
                    'data-rule-required-if' => 'status',
                    'data-msg-required-if' => trans('labels.This field is required'),
                    'readOnly',
                ]
            ) }}
            @if($errors->has('end_date'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-actions">
            <div class="pull-right">
                {{ Form::button(
                    '<i class="la la-check-square-o"></i>' . trans('labels.update'),
                    [
                        'type' => 'submit',
                        'id' => 'course-evaluation-setting-submit-button',
                        'class' => 'btn btn-primary'
                    ]
                ) }}
                <a href="{{ route('trainings.courses.evaluations.settings.show', ['training' => $training, 'course' => $course]) }}"
                   class="btn btn-danger">
                    <i class="ft ft-x"></i> @lang('labels.cancel')
                </a>
            </div>
        </div>
    </div>
</div>
