<!-- Striped row layout section start -->
<section id="striped-row-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="striped-row-layout-basic">@lang('tms::course.evaluation.title')</h4>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        {{ Form::open() }}
                        {{ Form::hidden('training_course_id', $course->id) }}

                        <h4 class="form-section"><i
                                    class="la la-table"></i>@lang('tms::training.evaluation.general_info_title')
                        </h4>

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

                            <div style="text-align: center; font-size: 20px">
                                <b>Relevance of the Course Objectives against Training Needs </b>
                            </div>
                            <br>
                            <ul class="list-group">

                                <li class="list-group-item">
                                        <p class="font-weight-bold">How relevant are the objectives of this course to your professional requirements? Please put tick mark (√) according to the scale 1-5 as follows:</p>

                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Inculcate a uniform perception in all officers by imparting theoretical and practical knowledge on administration and development of Bangladesh as a whole;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Build positive attitude among the officers so that they can create a congenial environment for people’s participation in all development activities;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Develop decision-making and analytical skills;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Help them acquire skills and techniques of modern management;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Familiarize participants with the changes taking place in different fields, specially in administration and development in Bangladesh and other parts of the world as well; and
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Build physical and mental fitness of the participants so that they can cope with arduous professional responsibilities.
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                </li>

                            </ul>
                            <br>
                            <ul class="list-group">

                                <li class="list-group-item">
                                        <p class="font-weight-bold">Extent of success of the training course in fulfilling its objectives. Please put tick mark (√) according to the scale 1-5 as follows:</p>

                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Inculcate a uniform perception in all officers by imparting theoretical and practical knowledge on administration and development of Bangladesh as a whole;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Build positive attitude among the officers so that they can create a congenial environment for people’s participation in all development activities;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Develop decision-making and analytical skills;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Help them acquire skills and techniques of modern management;
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Familiarize participants with the changes taking place in different fields, specially in administration and development in Bangladesh and other parts of the world as well; and
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>

                                                </li>
                                        </ul>


                                        <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            Build physical and mental fitness of the participants so that they can cope with arduous professional responsibilities.
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Extremely Relevant
                                                                </label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Highly Relevan
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Moderately Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Average Relevant
                                                                </label>
                                                            </div>


                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    {{ Form::radio("",
                                                                        ' ',
                                                                        null,
                                                                        [
                                                                            'class'=>'scores',
                                                                            'required',
                                                                            'data-msg-required' => trans('labels.choose_at_least_one_from_above')
                                                                        ]
                                                                    ) }}

                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <label>
                                                                    Little Relevan
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="error-container" style="width: 100%; text-align: center;">
                                                            <div data-question-id="" class="radio-error" style="text-align: center;"></div>
                                                        </div>
                                                    </div>
                                                </li>
                                        </ul>
                                </li>

                            </ul>

                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

