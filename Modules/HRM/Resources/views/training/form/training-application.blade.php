{!! Form::open(['url' =>  route('employee-leave.store'), 'class' => 'form', 'novalidate', 'method' => 'post']) !!}
<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('hrm::employee.employee_training_apply_form') </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="leave_type" class="form-label required">{{trans('hrm::employee.select_training')}}</label>
                <select name="leave_type" id="leave_type" class="form-control">
                    <option value=""> - @lang('labels.select')</option>
                    @foreach($trainings as $training)
                        <option value="{{$training->id}}">{{$training->training_title}}</option>
                    @endforeach
                </select>
                <div class="help-block"></div>
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('start_date') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="attachment" class="form-label required">{{trans('labels.attachments')}}</label>
                <input name="attachment" id="attachment" class="form-control" type="file">
                <div class="help-block"></div>
                @if ($errors->has('end_date'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('end_date') }}</strong></span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" >@lang('labels.remarks')</label>
                <textarea name="reason" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{trans('hrm::employee.employee_training_apply_btn')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{route('training.index')}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>

{!! Form::close() !!}
