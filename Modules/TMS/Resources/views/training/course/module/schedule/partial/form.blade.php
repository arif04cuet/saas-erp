<div class="row mt-2">
    <div class="col-md-12">
        <div class="form-actions float-right">
            <a class="master btn btn-primary" href="{{route('trainings.courses.modules.batches.sessions.schedules.show', [
                    'training' => $training,
                    'course' => $course,
                    'module' => $module,
                    'batch' => $batch
                ])}}">
                <i class="ft ft-monitor"></i>
                @lang('tms::session.preview')
            </a>
            <button type="submit" class="master btn btn-success">
                <i class="ft ft-check-square"></i> @lang('labels.save')
            </button>
            <a href="{{ route('trainings.courses.modules.show', ['training' => $training, 'course' => $course]) }}"
               class="master btn btn-warning">
                <i class="ft ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
    </div>
</div>
