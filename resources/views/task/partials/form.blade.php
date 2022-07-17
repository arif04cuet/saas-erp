<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> {{ trans('pms::task.create_form_title') }}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ trans('pms::task.task_for') }}: <span
                            class="badge bg-blue-grey">{{ $taskable->title }}</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="task_id" class="form-label required">{{ trans('pms::task.task_name') }}</label>
                {{ Form::text('name', isset($task) ? $task->name : null, ['class' => 'form-control required' . ($errors->has('name') ? ' is-invalid' : '')]) }}

                <div class="help-block"></div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">

                <label for="expected_start_time"
                       class="form-label required">{{trans('pms::task.expected_start_date')}}</label>
                <div class="input-group">
                    {{ Form::text('expected_start_time', isset($task) ? $task->expected_start_time : null, [
                        'id' => "expected_start_time",
                        'class' => 'form-control required' . ($errors->has('end_date') ? ' is-invalid' : ''),
                        'data-validation-required-message' => trans('validation.required', ['attribute' => trans('pms::task.start_date')]),
                        'required'
                    ]) }}
                </div>
                <div class="help-block"></div>
                @if ($errors->has('expected_start_time'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('expected_start_time') }}</strong>
                    </span>
                @endif

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="training_end_date required"
                       class="form-label required">{{trans('pms::task.expected_end_date')}}</label>
                <div class="input-group">
                    {{ Form::text('expected_end_time', isset($task) ? $task->expected_end_time : null, [
                        'id' => 'expected_end_time',
                        'class' => 'form-control required' . ($errors->has('expected_end_time') ? ' is-invalid' : ''),
                        'data-validation-required-message' => trans('validation.required', ['attribute' => trans('pms::task.expected_end_date')]),
                        'required'
                    ]) }}
                    <div class="help-block"></div>
                    @if ($errors->has('expected_end_time'))
                        <span class="invalid-feedback"
                              role="alert"><strong>{{ $errors->first('expected_end_time') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Task End Time -->
    @if(isset($is_edit))
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="actual_end_time required"
                           class="form-label">{{trans('pms::task.start_date')}}</label>
                    <div class="input-group">
                        {{ Form::text('actual_start_time', isset($task) ? $task->actual_start_time : null, [
                            'id' => 'actual_start_time',
                            'class' => 'form-control required' . ($errors->has('actual_start_time') ? ' is-invalid' : ''),
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('actual_start_time'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('actual_start_time') }}</strong></span>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="actual_end_time required"
                           class="form-label">{{trans('pms::task.end_date')}}</label>
                    <div class="input-group">
                        {{ Form::text('actual_end_time', isset($task) ? $task->actual_end_time : null, [
                            'id' => 'actual_end_time',
                            'class' => 'form-control required' . ($errors->has('actual_end_time') ? ' is-invalid' : ''),
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('actual_end_time'))
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $errors->first('actual_end_time') }}</strong></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="description"
                   class="form-label required">{{trans('pms::task.task_description')}}</label>
            <textarea name="description" id="description"
                      class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}">{{ isset($task) ? $task->description : null }}</textarea>

            <div class="help-block"></div>
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="attachments"
                   class="form-label">{{trans('labels.attachments')}}</label>
            @if(isset($task))
                <div class="delete-attachments">
                    <ul class="list-inline">
                        @foreach($task->attachments as $attachment)
                            <li class="list-group-item" id="{{ $attachment->id }}">
                                <a class="btn-close pull-right" title="Remove Attachment"
                                   onclick="deleteAttachment({{ $attachment->id }}); style.display='none';"><i
                                            class="ft-x"></i></a> <br>
                                <span class="badge bg-info">{{ $attachment->file_name }}</span><br>
                                <span class="label"><strong>{{ $attachment->file_ext }}</strong> file</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="repeat-attachments">
                <input type="file"
                       class="form-control"
                       name="attachments[]" id="attachments">
            </div>
            <div class="pull-right"><br>
                <button type="button" class="btn btn-primary" id="add"><i class="ft-plus"></i></button>
            </div>
            <div class="help-block"></div>
            @if ($errors->has('attachments'))
                <span class="invalid-feedback"
                      role="alert"><strong>{{ $errors->first('attachments') }}</strong></span>
            @endif
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{ trans('labels.save') }}
    </button>
    <a class="btn btn-warning" href="{{ URL::previous() }}">
        <i class="ft-x"></i> {{ trans('labels.cancel') }}
    </a>
</div>
</div>
