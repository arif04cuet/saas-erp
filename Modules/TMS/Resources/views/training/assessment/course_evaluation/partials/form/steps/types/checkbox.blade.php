<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-5 ">
                <h4 style="font-weight: 600;">{{ $questionnaire->title_en }}</h4>
            </div>
            <div class="col-12 col-md-5 col-lg-7 mt-1 mt-md-0">
                <div class="row">
                    @if($options->count())
                        @foreach($options->reverse() as $option)
                            @include('tms::training.assessment.course_evaluation.partials.form.steps.option_checkbox', ['option' => $option])
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="error-container" style="width: 100%; text-align: center;">
                <div data-question-id="" class="radio-error" style="text-align: center;"></div>
            </div>
        </div>

    </li>
</ul>
