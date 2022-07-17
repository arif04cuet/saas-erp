@if($questionnaire->type == 'radio')
    @include('tms::training.assessment.course_evaluation.partials.form.steps.types.radio', ['options' => $subSection->options, 'subSection' => $subSection])
@elseif($questionnaire->type == 'checkbox')
    @include('tms::training.assessment.course_evaluation.partials.form.steps.types.checkbox', ['options' => $subSection->options, 'subSection' => $subSection])
@elseif($questionnaire->type == 'text')
    @include('tms::training.assessment.course_evaluation.partials.form.steps.types.text')
@elseif($questionnaire->type == 'textarea')
    @include('tms::training.assessment.course_evaluation.partials.form.steps.types.textarea')
@endif
