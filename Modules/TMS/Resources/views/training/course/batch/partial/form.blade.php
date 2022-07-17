<div class="row">
    <div class="table-responsive">
        <table class="master table table-bordered">
            <thead>
            <tr>
                <th>@lang('tms::batch.title')</th>
                <th>@lang('tms::batch.start_date')</th>
                <th>@lang('tms::batch.end_date')</th>
                <th>@lang('tms::batch.no_of_trainees')</th>
            </tr>
            </thead>
            <tbody>
            @if($batches->count())
                @foreach($batches as $key => $batch)
                    <tr>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "title[old][$batch->id]",
                                    $batch->title,
                                    [
                                        'class' => 'form-control form-control-sm required' . ($errors->has('title.old.' . $batch->id) ? ' is-invalid' : ''),
                                        'data-msg-required' => trans('labels.This field is required'),
                                        'data-index' => $batch->id,
                                        'data-type' => "old",
                                        'data-rule-if-exists' => "start_date,end_date,no_of_trainees",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('title.old.' . $batch->id))
                                <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('title.old.' . $batch->id) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "start_date[old][$batch->id]",
                                    $batch->start_date ? \Carbon\Carbon::parse($batch->start_date)->format('j F, Y') : null,
                                    [
                                        'class' => 'form-control form-control-sm training-course-batch-start-date' . ($errors->has('start_date.old.' . $batch->id) ? ' is-invalid' : ''),
                                        'data-index' => $batch->id,
                                        'data-type' => "old",
                                        'data-rule-if-exists' => "title",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('start_date.old.' . $batch->id))
                                <span class="help-block" role="alert">
                                    <strong
                                        class="text-danger">{{ $errors->first('start_date.old.' . $batch->id) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "end_date[old][$batch->id]",
                                    $batch->end_date ? \Carbon\Carbon::parse($batch->end_date)->format('j F, Y') : null,
                                    [
                                        'class' => 'form-control form-control-sm training-course-batch-end-date' . ($errors->has('end_date.old.' . $batch->id) ? ' is-invalid' : ''),
                                        'data-index' => $batch->id,
                                        'data-type' => "old",
                                        'data-rule-if-exists' => "title",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('end_date.old.' . $batch->id))
                                <span class="help-block" role="alert">
                                    <strong
                                        class="text-danger">{{ $errors->first('end_date.old.' . $batch->id) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::number(
                                    "no_of_trainees[old][$batch->id]",
                                    $batch->no_of_trainees,
                                    [
                                        'class' =>
                                        'form-control form-control-sm' . ($errors->has('no_of_trainees.old.' . $batch->id) ? ' is-invalid' : ''),
                                        'data-index' => $batch->id,
                                        'data-type' => "old",
                                        'data-rule-if-exists' => "title",
                                        'data-rule-number' => true,
                                        'data-msg-number' => trans('labels.Please enter a valid number'),
                                        'data-rule-max' => $training->no_of_trainee,
                                        'data-msg-max' => trans('tms::batch.validations.fields.no_of_trainees.max', ['attribute' => convert_number($training->no_of_trainee)]),
                                        'data-rule-min' => 1,
                                        'data-msg-min' => trans('tms::batch.validations.fields.no_of_trainees.min', ['attribute' => convert_number(1)]),
                                    ]
                                )}}
                            </div>
                            @if($errors->has('no_of_trainees.old.' . $batch->id))
                                <div class="help-block" role="alert">
                                    <strong
                                        class="text-danger">{{ $errors->first('no_of_trainees.old.' . $batch->id) }}</strong>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @php
                    $index = -1;
                @endphp
                @while(($training->no_of_batches - $batches->count()) > 0)
                    @php
                        $index++;
                    @endphp
                    <tr>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "title[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm' . ($errors->has('title.new.' . $index) ? 'is-invalid' : ''),
                                        'data-index' => $index,
                                        'data-type' => "new",
                                        'data-rule-if-exists' => "start_date,end_date,no_of_trainees",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('title.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('title.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "start_date[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm training-course-batch-start-date' . ($errors->has('start_date.new.' . $index) ? 'is-invalid' : ''),
                                        'data-index' => $index,
                                        'data-type' => "new",
                                        'data-rule-if-exists' => "title",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('start_date.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong
                                        class="text-danger">{{ $errors->first('start_date.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "end_date[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm training-course-batch-end-date' . ($errors->has('end_date.new.' . $index) ? 'is-invalid' : ''),
                                        'data-index' => $index,
                                        'data-type' => "new",
                                        'data-rule-if-exists' => "title",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('end_date.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('end_date.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::number(
                                    "no_of_trainees[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm' . ($errors->has('no_of_trainees.new.' . $index) ? 'is-invalid' : ''),
                                        'data-index' => $index,
                                        'data-type' => "new",
                                        'data-rule-if-exists' => "title",
                                        'data-rule-number' => true,
                                        'data-msg-number' => trans('labels.Please enter a valid number'),
                                        'data-rule-max' => $training->no_of_trainee,
                                        'data-msg-max' => trans('tms::batch.validations.fields.no_of_trainees.max', ['attribute' => convert_number($training->no_of_trainee)]),
                                        'data-rule-min' => 1,
                                        'data-msg-min' => trans('tms::batch.validations.fields.no_of_trainees.min', ['attribute' => convert_number(1)]),
                                    ]
                                )}}
                            </div>
                            @if($errors->has('no_of_trainees.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong
                                        class="text-danger">{{ $errors->first('no_of_trainees.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @php
                        $training->no_of_batches--;
                    @endphp
                @endwhile
            @else
                @php
                    $noOfBatches = $training->no_of_batches;
                @endphp
                @while($training->no_of_batches--)
                    <tr>
                        <td>
                            <div class="form-group">
                                @php
                                    $index = $noOfBatches - ($training->no_of_batches+1);
                                @endphp
                                {{ Form::text(
                                    "title[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm' . ($errors->has('title.new.' . $index) ? 'is-invalid' : ''),
                                         'data-index' => $index,
                                         'data-type' => "new",
                                        'data-rule-if-exists' => "start_date,end_date,no_of_trainees",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('title.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('title.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "start_date[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm training-course-batch-start-date' . ($errors->has('start_date.new.' . $index) ? 'is-invalid' : ''),
                                        'data-index' => $index,
                                        'data-type' => "new",
                                        'data-rule-if-exists' => "title"
                                    ]
                                )}}
                            </div>
                            @if($errors->has('start_date.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong
                                        class="text-danger">{{ $errors->first('start_date.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::text(
                                    "end_date[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm training-course-batch-end-date' . ($errors->has('end_date.new.' . $index) ? 'is-invalid' : ''),
                                        'data-index' => $index,
                                        'data-type' => "new",
                                        'data-rule-if-exists' => "title",
                                    ]
                                )}}
                            </div>
                            @if($errors->has('end_date.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong class="text-danger">{{ $errors->first('end_date.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="form-group">
                                {{ Form::number(
                                    "no_of_trainees[new][$index]",
                                    null,
                                    [
                                        'class' => 'form-control form-control-sm' . ($errors->has('no_of_trainees.new.' . $index) ? 'is-invalid' : ''),
                                        'data-index' => $index,
                                        'data-type' => "new",
                                        'data-rule-if-exists' => "title",
                                        'data-rule-max' => $training->no_of_trainee,
                                        'data-msg-max' => trans('tms::batch.validations.fields.no_of_trainees.max', ['attribute' => convert_number($training->no_of_trainee)]),
                                        'data-rule-min' => 1,
                                        'data-msg-min' => trans('tms::batch.validations.fields.no_of_trainees.min', ['attribute' => convert_number(1)]),
                                    ]
                                )}}
                            </div>
                            @if($errors->has('no_of_trainees.new.' . $index))
                                <span class="help-block" role="alert">
                                    <strong
                                        class="text-danger">{{ $errors->first('no_of_trainees.new.' . $index) }}</strong>
                                </span>
                            @endif
                        </td>
                    </tr>
                @endwhile
            @endif
            </tbody>
        </table>
    </div>
</div>

