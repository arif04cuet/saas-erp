<div class="form-body">
    <h4 class="form-section"><i class="ft-user"></i> {{ $cardTitle }}</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>{{ trans('monthly-update.update_for') }}: <span
                            class="badge bg-blue-grey">{{ $monthlyUpdatable->title }}</span></label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label required">{{ trans('labels.date') }}</label>
                {{ Form::text('date', isset($monthlyUpdate) ? \Carbon\Carbon::parse($monthlyUpdate->date)->format('F Y') : \Carbon\Carbon::today()->format('F Y'), [
                    'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''),
                    'autocomplete' => 'off',
                    'required'
                ]) }}

                @if ($errors->has('date'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="tasks[]" class="form-label required">{{ trans('monthly-update.related_tasks') }}</label>
                {{ Form::select('tasks[]', $monthlyUpdatable->tasks->pluck('name', 'id'), isset($monthlyUpdate) ? explode(', ', $monthlyUpdate->tasks) : null, [
                    'class' => 'form-control select2',
                    'multiple' => 'true'
                ]) }}

                <div class="help-block"></div>
                @if ($errors->has('tasks'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('tasks') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">{{trans('monthly-update.plannings')}}</label>
                {{ Form::textarea('planning', isset($monthlyUpdate) ? $monthlyUpdate->planning : null, [
                    'class' => 'form-control' . ($errors->has('planning') ? ' is-invalid' : ''),
                    'data-validation-required-message' => trans(
                        'validation.required',
                        ['attribute' => trans('monthly-update.plannings')]
                    )
                ]) }}

                <div class="help-block"></div>
                @if ($errors->has('planning'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('planning') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label">{{ trans('monthly-update.achievement') }}</label>
                {{ Form::textarea('achievement', isset($monthlyUpdate) ? $monthlyUpdate->achievement : null, [
                    'class' => 'form-control' . ($errors->has('achievement') ? ' is-invalid' : '')
                ]) }}

                <div class="help-block"></div>
                @if ($errors->has('achievement'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('achievement') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="attachments"
                       class="form-label required">{{ trans('labels.attachments') }}</label>
                @if(isset($monthlyUpdate->attachments))
                    <ul class="list-inline">
                        @foreach($monthlyUpdate->attachments as $attachment)
                            <li class="list-group-item" id="{{$attachment->id}}">
                                <a class="btn-close pull-right" title="Remove Attachment"
                                   onclick="deleteAttachment({{$attachment->id}}); style.display='none';"><i
                                            class="ft-x"></i></a> <br>
                                <span class="badge bg-info">{{$attachment->file_name}}</span><br>
                                <span class="label"><strong>{{$attachment->file_ext}}</strong> file</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div id="repeat-attachments">
                    <input type="file" class="form-control {{ $errors->has('attachments') ? ' is-invalid' : '' }}"
                           name="attachments[]" id="attachments" value="{{ old('attachments') }}">
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
    @if($module == 'rms')
        <a href="{{ route('research.show', $monthlyUpdatable->id) }}" class="btn btn-warning"><i
                    class="ft-x"></i> {{ trans('labels.cancel') }}</a>
    @else
        <a href="{{ route('project.show', $monthlyUpdatable->id) }}" class="btn btn-warning"><i
                    class="ft-x"></i> {{ trans('labels.cancel') }}</a>
    @endif
</div>
