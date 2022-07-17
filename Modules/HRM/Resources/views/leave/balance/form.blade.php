{!! Form::open([
    'url' =>  route('leaves.update_employee_leave'),
    'class' => 'form leave-application-form',
    'method' => 'post',
    'enctype' => 'multipart/form-data'
]) !!}
@method('post')
@csrf
<div class="form-body">
    <h5 class="form-section"><i class="ft-calendar"></i> {{trans('hrm::leave.leave_update_form_title')}}</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="leave_type" class="form-label required">{{trans('hrm::leave.leave_type')}}</label>
                {{ Form::select('leave_type_id', $leaveTypeOptions->pluck('name', 'id'), null, [
                    'id' => 'leave_type',
                    'class' => 'form-control required select2',
                    'placeholder' => trans('labels.select'),
                    'data-msg-required' => __('labels.This field is required')
                ]) }}
                <div class="help-block"></div>
                @if ($errors->has('leave_type_id'))
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $errors->first('leave_type_id') }}</strong></span>
                @endif
                <input type="hidden" name="requester_id" value="{{ $employeeId }}">
            </div>
        </div>
        <div class="col-md-6">
            <label for="leave_type" class="form-label required">{{trans('hrm::leave.action')}}</label>
           <div class="row">
               <div class="col-md-3">
                   <div class="radio">
                       <label>
                           <input type="radio"
                                  name="status"
                                  value="added"
                                  class = "required leave-type-purpose-id",
                                  checked = "checked"
                           /> @lang("hrm::leave.add")
                       </label>
                   </div>
               </div>
               <div class="col-md-3">
                   <div class="radio">
                       <label>
                           <input type="radio"
                                  name="status"
                                  value="approved"
                                  class = "required leave-type-purpose-id"
                           /> @lang("hrm::leave.deduct")
                       </label>
                   </div>
               </div>
           </div>
        </div>
    </div>

    <div class="row form-group" id="purpose-div">
        <!-- html injected based leave type select -->
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="duration" class="form-label required">{{trans('hrm::leave.leave_duration')}}</label>
                <input type="number" class="form-control required {{ ($errors->has('duration') ? ' is-invalid' : '') }}"
                       min="1"
                       max="840"
                       name="duration"
                       placeholder="{{trans('hrm::leave.leave_duration_placeholder')}}"
                       id="duration"
                       value="{{ old('duration') }}"
                       onkeyup="dateDifference()"
                       onwheel="dateDifference()"
                       data-msg-required="{{trans('validation.required', ['attribute' => trans('tms::training.start_date')])}}"
                />
                <div class="help-block"></div>
                @if ($errors->has('duration'))
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $errors->first('duration') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary submit">
        <i class="ft-check-square"></i> {{trans('labels.submit')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{route('leaves.index')}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>
{!! Form::close() !!}
