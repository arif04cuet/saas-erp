<h6></h6>
<fieldset>

    <!-- Striped row layout section start -->
    <section id="striped-row-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content collpase show">
                        <div class="card-body">

                            <!-- Questions & Options -->
                            <div class="card-body">

                                <!--  Readonly Grade -->
                                <div class="form-group row">
                                </div>

                                <div style="text-align: center; font-size: 20px">
                                    <b>Please give your opinion about the Satisfactoryness of overall coordination, physical facilities and informal events of the course.
                                    </b>
                                </div>
                                <br>
                                <ul class="list-group">

                                    <li class="list-group-item">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        Overall coordination
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                                                        Class room facilities
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                                                        Library reading facilities
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                                                        Hostel Accommodation and Service
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                                                        Cafeteria:
                                                        Food and Service
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                                                        Medical service
                                                        (If applicable)
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                                                        Sports and physical exercise
                                                        (If applicable)
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                                                        Recreational and Cultural Activities
                                                        (If applicable)
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
                                                                Extremely Satisfactory
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
                                                                Highly Satisfactory
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
                                                                Moderately Satisfactory
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
                                                                Average Satisfactory
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
                                                                Little Satisfactory
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</fieldset>
