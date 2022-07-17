@component('tms::training.course.partial.layout.create_edit_layout',
    [
        'training' => $training,
        'course' => $course,
        'action' => 'edit',
    ])
    <div class="col-md-12">
        {{ Form::open(['route' => ['training.courses.resources.update', $training->id, $course->id], 'method' => 'PUT']) }}
        {{-- {{ dd($employees, $employeeResources, $guestResources) }} --}}
        @include('tms::training.course.resource.partials.form')
        <div class="form-actions">
            <button type="submit" class="master btn btn-primary">
                <i class="ft-check-square"></i> {{ trans('labels.save') }}
            </button>
            <a href="{{ route('training.courses.resources.show', [$training->id, $course->id]) }}" class="master btn btn-warning">
                <i class="ft-x"></i> {{ trans('labels.cancel') }}
            </a>
        </div>
        {{ Form::close() }}
    </div>
@endcomponent
