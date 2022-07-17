{!! Form::open([
    'url' => route('leaves.store'),
    'class' => 'form leave-application-form',
    'method' => 'post',
    'enctype' => 'multipart/form-data',
]) !!}
<div class="form-body">
    <h5 class="form-section"><i class="ft-calendar"></i> {{ trans('hrm::leave.leave_application_form_title') }}
    </h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="leave_type" class="form-label required">{{ trans('hrm::leave.leave_type') }}</label>
                {{ Form::select('leave_type_id', $leaveTypeOptions->pluck('name', 'id'), null, [
    'id' => 'leave_type',
    'class' => 'form-control required select2',
    'placeholder' => trans('labels.select'),
    'data-msg-required' => __('labels.This field is required'),
]) }}
                <div class="help-block"></div>
                @if ($errors->has('leave_type_id'))
                    <span class="invalid-feedback"
                        role="alert"><strong>{{ $errors->first('leave_type_id') }}</strong></span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="attachments" class="form-label">{{ trans('labels.attachments') }}</label>
                <input name="attachments[]" id="attachments" class="form-control" type="file" multiple>
                <div class="help-block"></div>
                @if ($errors->has('attachments.*'))
                    <span class="invalid-feedback"
                        role="alert"><strong>{{ $errors->first('attachments.*') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 text-center form-group" id="balance_info">

        </div>
    </div>

    <div class="row form-group" id="purpose-div">
        <!-- html injected based leave type select -->
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="leave_start_date"
                    class="form-label required">{{ trans('hrm::leave.leave_start_date') }}</label>
                <input type="text" class="form-control required {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                    name="start_date" placeholder="{{ trans('labels.pick_a_date') }}" id="leave_start_date"
                    value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}" onchange="dateDifference()"
                    data-msg-required="{{ trans('validation.required', ['attribute' => trans('hrm::leave.leave_start_date')]) }}" />
                <div class="help-block"></div>
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('start_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="duration" class="form-label required">{{ trans('hrm::leave.leave_duration') }}</label>
                <input type="number"
                    class="form-control required {{ $errors->has('duration') ? ' is-invalid' : '' }}" min="1"
                    max="840" name="duration" placeholder="{{ trans('hrm::leave.leave_duration_placeholder') }}"
                    id="duration" value="{{ old('duration') }}" onkeyup="dateDifference()" onwheel="dateDifference()"
                    data-msg-required="{{ trans('validation.required', ['attribute' => trans('tms::training.start_date')]) }}" />
                <div class="help-block"></div>
                @if ($errors->has('duration'))
                    <span class="invalid-feedback"
                        role="alert"><strong>{{ $errors->first('duration') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="leave_end_date"
                    class="form-label required">{{ trans('hrm::leave.leave_end_date') }}</label>
                <input type='text' class="form-control required" value="{{ old('end_date') }}"
                    placeholder="{{ trans('labels.pick_a_date') }}" id="leave_end_date" name="end_date" disabled
                    data-msg-required="{{ trans('validation.required', ['attribute' => trans('hrm::leave.leave_end_date')]) }}" />
                <div class="help-block"></div>
                @if ($errors->has('end_date'))
                    <span class="invalid-feedback"
                        role="alert"><strong>{{ $errors->first('end_date') }}</strong></span>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label required">@lang('hrm::leave.leave_reason')</label>
                <textarea name="reason" class="form-control required"
                    placeholder="{{ trans('hrm::leave.leave_reason_placeholder') }}"
                    data-msg-required="{{ __('labels.This field is required') }}">{{ old('reason') }}</textarea>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary submit">
        <i class="ft-check-square"></i> {{ trans('hrm::leave.apply') }}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{ route('leaves.index') }}'">
        <i class="ft-x"></i> {{ trans('labels.cancel') }}
    </button>
</div>
{!! Form::close() !!}

@push('page-js')
    <script type="text/javascript">

    </script>
@endpush
