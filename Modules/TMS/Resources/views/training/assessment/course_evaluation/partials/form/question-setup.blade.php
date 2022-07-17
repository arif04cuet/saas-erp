    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('training_id', trans('tms::training.training_name'), ['class' => 'required'] ) }}
                {{ Form::select(
                    'training_id',
                    $trainings,
                    null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control form-control-sm required select2',
                        'id' => 'training_id',
                        'data-msg-required' => trans('labels.This field is required')
                    ]
                ) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('course_id', trans('tms::course.name'), ['class' => 'required'] ) }}
                {{ Form::select(
                    'course_id',
                    $courses,
                    null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control form-control-sm required select2',
                        'id' => 'course_id',
                        'data-msg-required' => trans('labels.This field is required')
                    ]
                ) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('module_id', trans('module.name'), ['class' => 'required'] ) }}
                {{ Form::select(
                    'module_id',
                    $modules,
                    null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control form-control-sm required select2',
                        'id' => 'module_id',
                        'data-msg-required' => trans('labels.This field is required')
                    ]
                ) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="multi-question-ans">
                <div class="form-border p-1 border border-dark">
                    <div data-repeater-list="question_repeaters">
                        <div data-repeater-item>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    {{ Form::label('question', '১। প্রশ্ন:', ['class' => ' col-md-1'] ) }}
                                    {{ Form::text(
                                        'question',
                                        null,
                                        [
                                            'class' => 'form-control form-control-sm col-md-11 required',
                                            'data-msg-required' => trans('labels.This field is required')
                                        ]
                                    ) }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="answer-wrap pl-4">
                                    <div class="form-group row">
                                        <span class="customcheck"><input type="checkbox" name="answer" value="1" checked></span>
                                        {{ Form::label('answer_1', '১। উত্তর:', ['class' => ' col-md-1 p-0'] ) }}

                                        {{ Form::text(
                                            'answer',
                                            null,
                                            [
                                                'class' => 'form-control form-control-sm col-md-9 required',
                                                'data-msg-required' => trans('labels.This field is required')
                                            ]
                                        ) }}
                                        <div class="col-md-2"></div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="customcheck"><input type="checkbox" name="answer" value="1" ></span>
                                        {{ Form::label('answer_2', '2। উত্তর:', ['class' => ' col-md-1 p-0'] ) }}

                                        {{ Form::text(
                                            'answer',
                                            null,
                                            [
                                                'class' => 'form-control form-control-sm col-md-9 required',
                                                'data-msg-required' => trans('labels.This field is required')
                                            ]
                                        ) }}
                                        <div class="col-md-2"></div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="customcheck"><input type="checkbox" name="answer" value="1"></span>
                                        {{ Form::label('answer_3', '3। উত্তর:', ['class' => ' col-md-1 p-0'] ) }}

                                        {{ Form::text(
                                            'answer',
                                            null,
                                            [
                                                'class' => 'form-control form-control-sm col-md-9 required',
                                                'data-msg-required' => trans('labels.This field is required')
                                            ]
                                        ) }}
                                        <div class="col-md-2"></div>
                                    </div>
                                    <div class="add-multi-answer">
                                        <div data-repeater-list="add_answers">
                                            <div data-repeater-item>
                                                <div class="form-group row">
                                                    <span class="customcheck"><input type="checkbox" name="answer" value="1"></span>
                                                    {{ Form::label('answer_4', '4। উত্তর:', ['class' => ' col-md-1 p-0'] ) }}

                                                    {{ Form::text(
                                                        'answer',
                                                        null,
                                                        [
                                                            'class' => 'form-control form-control-sm col-md-9 required',
                                                            'data-msg-required' => trans('labels.This field is required')
                                                        ]
                                                    ) }}
                                                    {{-- <button type="button" data-repeater-create class="btn btn-primary btn-sm pull-right ml-1">
                                                        <i  class="ft ft-plus-circle" style="cursor: pointer;"></i>
                                                    </button> --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-md-2">
                                                <button type="button" data-repeater-create class="btn btn-primary btn-sm pull-right ml-1">
                                                    <i  class="ft ft-plus-circle" style="cursor: pointer;"></i>
                                                </button>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right mb-1">
                                <button data-repeater-delete type="button" class="btn btn-danger"><i class="ft ft-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" data-repeater-create class="btn btn-primary btn-sm pull-right mt-1">
                    <i  class="ft ft-plus-circle" style="cursor: pointer;"></i>
                    @lang('labels.add')
                </button>
            </div>
        </div>
    </div>