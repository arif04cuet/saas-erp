<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-5 ">
                <h4 style="font-weight: 600;">
                    {{--                    {{ dd($questionnaire) }}--}}
                    <label class="required">{{ $questionnaire->title_en }}</label>
                </h4>
            </div>
            <div class="col-12 col-md-5 col-lg-7 mt-1 mt-md-0">
                <div class="row">
                    @if($options->count())
                        @foreach($options->reverse() as $option)
                            @if($questionnaire->is_objective)
                                @include('tms::training.assessment.course_evaluation.partials.form.steps.objective_option_radio', ['option' => $option])
                            @else
                                @include('tms::training.assessment.course_evaluation.partials.form.steps.option_radio', ['option' => $option])
                            @endif
                        @endforeach
                    @endif
                </div>
                @if($errors->has('questionnaires.' . $questionnaire->id))
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $errors->first('questionnaires.' . $questionnaire->id) }}</strong>
                    </span>
                @endif
            </div>
            <div class="error-container" style="width: 100%; text-align: center;">
                <div data-question-id="" class="radio-error" style="text-align: center;"></div>
            </div>
        </div>

    </li>
</ul>
