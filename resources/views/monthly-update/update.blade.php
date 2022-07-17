{!! Form::open(['url' => $action, 'class' => 'form', 'novalidate', 'method' => 'post', 'files'=>'true']) !!}
<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> {{trans('monthly-update.create_form_title')}}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{trans('monthly-update.update_for')}}: <span class="badge bg-blue-grey">{{$item->title}}</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="month" class="form-label required">{{trans('monthly-update.month')}}</label>
                <input type="text" class="form-control" readonly value="{{date('F, Y', strtotime($monthlyUpdate->year.'-'.$monthlyUpdate->month.'-01'))}}">

                <input type="hidden" name="update_for_id" value="{{$item->id}}">
                <input type="hidden" name="type" value="">
                <div class="help-block"></div>
                @if ($errors->has('month'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('month') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="task_id" class="form-label required">{{trans('monthly-update.related_tasks')}}</label>

                <select class="select2 form-control{{ $errors->has('send_to') ? ' is-invalid' : '' }}" name="tasks[]" multiple="multiple">
                    <option></option>
                    @php
                    $tasksAr = explode(',', $monthlyUpdate->tasks);
                    @endphp
                    @foreach($item->task as $taskName)
                        <option value="{{$taskName->id}}" {{(in_array($taskName->id, $tasksAr))? 'selected': ''}}>{{$taskName->taskName->name}}</option>
                    @endforeach
                </select>

                <div class="help-block"></div>
                @if ($errors->has('tasks'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('tasks') }}</strong></span>
                @endif
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""
                       class="form-label">{{trans('monthly-update.plannings')}}</label>
                <textarea name="plannings" class="form-control" data-validation-required-message="{{trans('validation.required', ['attribute' => trans('monthly-update.plannings')])}}">{{$monthlyUpdate->plannings}}</textarea>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for=""
                       class="form-label">{{trans('monthly-update.achievement')}}</label>
                <textarea name="achievements" class="form-control">{{$monthlyUpdate->achievements}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="attachments" class="form-label required">{{trans('labels.attachments')}}</label>

                <div id="repeat-attachments">
                    <input type="file" class="form-control {{ $errors->has('attachments') ? ' is-invalid' : '' }}"
                           name="attachments[]" id="attachments" value="{{old('attachments') }}">
                </div>

                <div class="pull-right"><br><button type="button" class="btn btn-primary" id="add"><i class="ft-plus"></i> </button></div>
                <div class="help-block"></div>
                @if ($errors->has('attachments'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('attachments') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{trans('labels.save')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{($monthlyUpdate->type == 'project') ? route('project-proposal-submitted.monthly-update',  $item->id) : route('research-proposal-submission.show', $item->id )}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>
</div>
{!!Form::close()!!}
