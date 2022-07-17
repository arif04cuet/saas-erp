<!-- Striped row layout section start -->
<section id="striped-row-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="striped-row-layout-basic">@lang('tms::training.evaluation.title')</h4>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        {{ Form::open(['route' =>  'public.speakers.evaluations.store',
                             'class' => 'form form-horizontal form-bordered speaker-evaluation-form',
                             'method' => 'post'
                        ]) }}
                        {{ Form::hidden('trainee_id', $trainee->id) }}
                        {{ Form::hidden('training_course_id', $course->id) }}
                        {{ Form::hidden('training_course_resource_id', $speaker->id) }}
                        {{ Form::hidden('training_course_module_session_id', $session->id) }}

                        <h4 class="form-section"><i
                                    class="la la-table"></i>@lang('tms::training.evaluation.general_info_title')
                        </h4>
                        <div class="form-group row">
                            <label for="speaker_name"
                                   class="required label-control col-md-3">
                                @lang('tms::training.evaluation.speaker_name')
                            </label>
                            <div class="col-md-9">
                                {{ Form::text(null, $speaker->getResourceName(), [
                                    'class' => 'form-control',
                                    'disabled'
                                ]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course_name"
                                   class="required label-control col-md-3">
                                @lang('tms::training.evaluation.course_name')
                            </label>
                            <div class="col-md-9">
                                {{ Form::text(null, $course->name, [
                                    'class' => 'form-control',
                                    'disabled'
                                ]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="session_name"
                                   class="required label-control col-md-3">
                                @lang('tms::training.evaluation.session_name')
                            </label>
                            <div class="col-md-9">
                                {{ Form::text(null, $session->title, [
                                    'class' => 'form-control',
                                    'disabled'
                                ]) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control">@lang('tms::training.module_name')</label>
                            <div class="col-md-9">
                                {{ Form::text(null, optional($session->module)->title, [
                                    'class' => 'form-control',
                                    'disabled',
                                ]) }}
                            </div>
                        </div>
                        <!-- Date -->
                        <div class="form-group row">
                            {{ Form::label('date', trans('labels.date'),
                            ['class' => 'col-md-3 label-control required']) }}
                            <div class="col-md-9">
                                {{ Form::text(null, date('j F, Y'), ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>

                        <h4 class="form-section"><i
                                    class="la la-table"></i>@lang('tms::training.evaluation.questions')</h4>

                        <!-- Questions & Options -->
                        <div class="card-body">

                            <!--  Readonly Grade -->
                            <div class="form-group row">

                            </div>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    @forelse($assessmentQuestionsTypes as $assessmentQuestionsType)
                                        <p class="font-weight-bold">@lang('tms::assessment_questions.' . $assessmentQuestionsType->name)</p>
                                        <ul class="list-group">
                                            @foreach($assessmentQuestionsType->assessmentQuestions as $questionKey => $assessmentQuestion)
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            @lang('tms::assessment_questions.' . $assessmentQuestion->name)
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            @foreach(config('tms.options') as $key => $value)
                                                                <div class="form-check form-check-inline">
                                                                    <label>
                                                                        {{ Form::radio("assessmentQA[$assessmentQuestion->id]",
                                                                            $value,
                                                                            null,
                                                                            [
                                                                                'class'=>'scores',
                                                                                'required',
                                                                                'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                            ]
                                                                        ) }} {{ trans('tms::training.verdict.' . $key) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="{{ $questionKey }}" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                            @endforeach
                                        </ul>
                                    @empty
                                        <p class="info"> No Question Found ! </p>
                                    @endforelse
                                </li>
                            </ul>
                            <div class="form-group row">
                                {{ Form::label('average_score', trans('tms::training.evaluation.overall_evaluation'), [
                                    'class' => 'col-md-3 label-control float-left required'
                                ]) }}
                                <div class="col-md-9">
                                    {{ Form::text('average_score', null, [
                                          'class' => 'form-control' . ($errors->has('assessmentQA') ? ' is-invalid' : ''),
                                          'readonly'
                                    ]) }}

                                    @if($errors->has('assessmentQA'))
                                        <div class="help-block danger">
                                            {{ $errors->first('assessmentQA') }}
                                        </div>
                                    @endif
                                <!-- Hidden Actual Score -->
                                    {{ Form::hidden('score', 0.00, ['class' => 'score']) }}
                                </div>
                            </div>

                        </div>

                        <h4 class="form-section"><i
                                    class="la la-table"></i>@lang('tms::training.evaluation.comment')
                        </h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('recommendation', trans('tms::training.evaluation.recommendation'), ['class' => '']) }}
                                    {{ Form::textarea('recommendation', null, [
                                            'class' => 'form-control' . ($errors->has('recommendation') ? ' is-invalid' : ''),
                                            'data-rule-maxlength' => 255, 
                                            'data-msg-maxlength'=>trans('labels.At most 255 characters')
                                    ]) }}

                                    @if($errors->has('recommendation'))
                                        <div class="help-block danger">
                                            {{ $errors->first('recommendation') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('good_parts', trans('tms::training.evaluation.good_parts'), ['class' => '']) }}
                                    
                                    {{ Form::textarea('good_parts', null, [
                                            'class' => 'form-control' . ($errors->has('good_parts') ? ' is-invalid' : ''),
                                            'data-rule-maxlength' => 255, 
                                            'data-msg-maxlength'=>trans('labels.At most 255 characters')
                                    ]) }}

                                    @if($errors->has('good_parts'))
                                        <div class="help-block danger">
                                            {{ $errors->first('good_parts') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Submit & Cancel Button -->
                        <div class="form-actions text-center">
                            <button type="submit" class="btn btn-primary assessment-form-submit-button" disabled>
                                <i class="la la-check-square-o"></i> @lang('labels.submit')
                            </button>
                            <a class="btn btn-warning mr-1" role="button"
                               href="{{route('trainings.public.index')}}">
                                <i class="ft-x"></i> @lang('labels.cancel')
                            </a>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <style type="text/css">
        .error-container>label {
            width: 100%;
            text-align: center;
        }
    </style>
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script>
        $(function () {
            $('.form-check').click(function (event) {
                let total = 0;
                $('.scores:checked').each(function () {
                    total += parseInt($(this).val());
                });
                let result = calculateGrade(total);
                $('#average_score').val(calculateGrade(total));
            });

            function calculateGrade(dividend) {
                let divisor = $('.scores').length;
                let score = 1;
                score = (dividend / divisor) * 100;
                score = Math.floor(score).toFixed(2);
                $('.score').val(score);

                switch (true) {
                    case score == 100:
                        return "{{ trans('tms::training.verdict.Excellent') }}";
                    case score >= 80 && score <= 99:
                        return "{{ trans('tms::training.verdict.Good') }}";
                    case score >= 60 && score <= 79:
                        return "{{ trans('tms::training.verdict.Average') }}";
                    case score >= 40 && score <= 59:
                        return "{{ trans('tms::training.verdict.Poor') }}";
                    case score <= 39:
                        return "{{ trans('tms::training.verdict.Very Poor') }}";
                    default:
                        return "{{ trans('tms::training.verdict.Very Poor') }}";
                }
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            let assessmentFormSubmitButton = $('.assessment-form-submit-button');
            assessmentFormSubmitButton.attr('disabled', false);

            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

            let speakerEvaluationForm = $('.speaker-evaluation-form');

            speakerEvaluationForm.validate({
                ignore: ":disabled,:hidden",
                errorClass: 'danger',
                successClass: 'success',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function (error, element) {
                    if (element.attr('type') === 'radio') {
                        error.insertBefore(element.parent().parent().parent().siblings('div.error-container').find('.radio-error'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {},
                submitHandler: function (form, event) {
                    assessmentFormSubmitButton.attr('disabled', true);
                    form.submit();
                }
            });
        });
    </script>
@endpush
