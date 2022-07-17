{!! Form::open(['url' =>  route('employee-leave.store'), 'class' => 'form', 'novalidate', 'method' => 'post']) !!}
<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i>@lang('hrm::employee.new_punishment_record_form')</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="leave_type" class="form-label required">{{trans('hrm::employee.employee_punishment_type')}}</label>
                <select name="leave_type" id="leave_type" class="form-control">
                    <option value=""> - @lang('hrm::employee.select_employee_punishment_type') -</option>
                    <option value="suspension">Suspended</option>
                    <option value="penalty">Penalty</option>
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
        <div class="col-md-3">
            <div class="form-group">
                <label for="leave_start_date" class="form-label required">{{trans('hrm::employee.punishment_start')}}</label>
                <input type="text" class="form-control required {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                       name="start_date" placeholder="{{trans('labels.pick_a_date')}}" id="leave_start_date" value="{{ old('start_date') }}" onchange="dateDifference()" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::leave.leave_start_date')])}}">
                <div class="help-block"></div>
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('start_date') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="leave_end_date" class="form-label required">{{trans('hrm::employee.punishment_end')}}</label>
                <input type='text' onchange="dateDifference()" class="form-control required" value="{{ old('end_date') }}"
                       placeholder="{{trans('labels.pick_a_date')}}" id="leave_end_date" name="end_date" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('hrm::leave.leave_end_date')])}}">
                <div class="help-block"></div>
                @if ($errors->has('end_date'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('end_date') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="duration" class="form-label required">{{trans('hrm::employee.punishment_duration')}}</label>
                <input type="text" class="form-control required {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                       name="duration" placeholder="{{trans('hrm::employee.punishment_duration')}}" id="duration" value="{{ old('start_date') }}" onchange="dateDifference()" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('tms::training.start_date')])}}">
                <div class="help-block"></div>
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('start_date') }}</strong></span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" >@lang('hrm::employee.punishment_reason')</label>
                <textarea name="reason" class="form-control" placeholder="{{trans('hrm::employee.punishment_reason_placeholder')}}"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{trans('hrm::employee.new_punishment_record_submit')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{route('training.index')}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>
</div>
{!! Form::close() !!}
