@php
$training_course_lang = 'tms::training_course.tab';
@endphp
<ul class="nav nav-tabs nav-underline" id="course-tabs">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('trainings.courses.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang("$training_course_lang.general_info")</a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.objectives.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang("$training_course_lang.objective")
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.evaluation_result.' . 'show', [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang("$training_course_lang.course_evaluation_result")
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.methods.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang("$training_course_lang.methods_and_tech")
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.rules-guidelines.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang("$training_course_lang.rules_and_guidelines")
        </a>
    </li>
    @if (isset($training) && $training->through_training == 'online')
        <li class="nav-item">
            <a class="nav-link"
                href="{{ route('trainings.courses.payment.' . $action, [$training->id, $course->id]) }}">
                <i class="ft ft-file-text"></i> @lang("$training_course_lang.course_payment")
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.breaks.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang("$training_course_lang.break_schedules")
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.batches.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang('tms::batch.batch')
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.administrations.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang('tms::course.course_administration')
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.grade.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang('tms::course.grading')
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.marks.allotments.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang('tms::course.mark_allotment')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainees.courses.marks.values.show', [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang('tms::course.mark_achieved')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('training.courses.resources.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang('tms::course.resource')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
            href="{{ route('trainings.courses.modules.' . $action, [$training->id, $course->id]) }}">
            <i class="ft ft-file-text"></i> @lang('tms::module.title')
        </a>
    </li>
</ul>

@push('page-js')
    <script>
        $(document).ready(function() {
            let currentUrl = document.URL;

            $('#course-tabs').find('li a').each(function(index, anchorTag) {
                if (anchorTag.href === currentUrl) {
                    $(anchorTag).addClass('active');
                }
            });
        });
    </script>
@endpush
