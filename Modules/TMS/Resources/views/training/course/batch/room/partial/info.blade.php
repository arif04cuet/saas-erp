<table class="table">
    <tr>
        <th>@lang('tms::training.training_name')</th>
        <td>
            <a href="{{ route('training.show', $training->id) }}">{{ $training->getTitle() }}</a>
        </td>
    </tr>
    <tr>
        <th>@lang('tms::training.evaluation.course_name')</th>
        <td>
            <a href="{{ route('trainings.courses.show', [$training->id, $course->id]) }}">
                {{ $course->getName() }}
            </a>
        </td>
    </tr>
    <tr>
        <th>ব্যাচ</th>
        <td>
            <a href="{{ route('trainings.courses.batches.show', [
                                        $training->id,
                                        $course->id,
                                        $batch->id
                                    ]) }}">
                {{ $batch->title }}
            </a>
        </td>
    </tr>
</table>