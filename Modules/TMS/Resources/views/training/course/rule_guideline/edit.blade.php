@component('tms::training.course.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'edit'
])
    <div class="col-md-8">
        {{ Form::open(['route' => ['trainings.courses.rules-guidelines.update', $training->id, $course->id],
            'method' => 'PUT'
        ]) }}

        @include('tms::training.course.rule_guideline.partial.form')
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="ft-check-square"></i> {{ trans('labels.save') }}
            </button>
            <a href="{{ route('trainings.courses.rules-guidelines.show', [$training->id, $course->id]) }}"
               class="btn btn-warning">
                <i class="ft-x"></i> {{ trans('labels.cancel') }}
            </a>
        </div>
        {{ Form::close() }}
    </div>
@endcomponent
