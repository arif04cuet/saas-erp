<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> {{ trans('pms::project-activity.activity.create-form.create_form_title') }}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ trans('pms::project-activity.activity.create-form.activity_for') }}: <span
                        class="badge bg-blue-grey">{{ isset($project) ? $project->title : null }}</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="task_id" class="form-label required">{{ trans('pms::project-activity.activity.create-form.name') }}</label>
                {{ Form::text('name', isset($activity) ? $activity->name : null, ['class' => 'form-control required' . ($errors->has('name') ? ' is-invalid' : '')]) }}

                <div class="help-block"></div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">

                <label for="expected_start_time"
                       class="form-label required">{{trans('pms::project-activity.activity.create-form.actual_start_date')}}</label>
                <div class="input-group">
                    {{ Form::text('actual_start_date', isset($activity) ? $activity->actual_start_date : null, [
                        'id' => "expected_start_time",
                        'class' => 'form-control required' . ($errors->has('end_date') ? ' is-invalid' : ''),
                        'data-validation-required-message' => trans('validation.required', ['attribute' => trans('pms::task.start_date')]),
                        'required'
                    ]) }}
                </div>
                <div class="help-block"></div>
                @if ($errors->has('actual_start_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('actual_start_date') }}</strong>
                    </span>
                @endif

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="training_end_date required"
                       class="form-label required">{{trans('pms::project-activity.activity.create-form.actual_end_date')}}</label>
                <div class="input-group">
                    {{ Form::text('actual_end_date', isset($activity) ? $activity->actual_end_date : null, [
                        'id' => 'expected_end_time',
                        'class' => 'form-control required' . ($errors->has('actual_end_date') ? ' is-invalid' : ''),
                        'data-validation-required-message' => trans('validation.required', ['attribute' => trans('pms::task.actual_end_date')]),
                        'required'
                    ]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('expected_end_time'))
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $errors->first('expected_end_time') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{ trans('labels.save') }}
    </button>
    <a class="btn btn-warning" href="{{ URL::previous() }}">
        <i class="ft-x"></i> {{ trans('labels.cancel') }}
    </a>
</div>
