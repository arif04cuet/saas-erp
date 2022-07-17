<br>
<ul class="list-group">
    <li class="list-group-item">
        @if($subSection->is_option_enabled)
            <h4 class="text-center mb-2 mt-2 mt-sm-0" style="font-weight: 500;"> {!! $subSection->title_en !!} </h4>
        @endif
        @if(!$key)
            {{--                {{ dd($courseObjectives) }}--}}
            @foreach($courseObjectives as $key =>  $questionnaire)
                @php
                    $questionnaire->type = 'radio';
                    $questionnaire->title_en = $questionnaire->content;
                    $questionnaire->is_objective = true;
                @endphp
                @include('tms::training.assessment.course_evaluation.partials.form.steps.questionnaire', ['questionnaire' => $questionnaire, 'subSection' => $subSection])
            @endforeach
        @elseif($subSection->questionnaires->count())
            @foreach($subSection->questionnaires as $questionnaire)
                @include('tms::training.assessment.course_evaluation.partials.form.steps.questionnaire', ['questionnaire' => $questionnaire, 'subSection' => $subSection])
            @endforeach
        @endif


        {{--            @if($subSection->questionnaires->count())--}}
        {{--                @foreach($subSection->questionnaires as $questionnaire)--}}
        {{--                    @include('tms::training.assessment.course_evaluation.partials.form.steps.questionnaire', ['questionnaire' => $questionnaire, 'subSection' => $subSection])--}}
        {{--                @endforeach--}}
        {{--            @endif--}}
    </li>
</ul>
