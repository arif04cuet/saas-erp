@component('tms::training.course.partial.layout.create_edit_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'edit'
])
    <div class="col-md-8">
        {{ Form::open(['route' => ['trainings.courses.administrations.update', $training->id, $course->id],
            'method' => 'PUT'
        ]) }}

        @include('tms::training.course.administration.partial.form')

        <div class="form-actions">
            <button type="submit" class="master btn btn-primary">
                <i class="ft-check-square"></i> {{ trans('labels.save') }}
            </button>
            <a href="{{ route('trainings.courses.administrations.show', [$training->id, $course->id]) }}"
               class="master btn btn-warning">
                <i class="ft-x"></i> {{ trans('labels.cancel') }}
            </a>
        </div>
        {{ Form::close() }}
    </div>
@endcomponent
