<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Vehicle Type and Date -->
    <div class="row">

        <!-- Actual Start Date Time   -->
        <div class="col-4">
            <div class="form-group">
                {!! Form::label('actual_start_date_time', trans('vms::trip.feedback.form_elements.actual_start_date_time'), ['class' => 'form-label']) !!}
                {{
                       Form::text('actual_start_date_time', old('actual_start_date_time') ?? $trip->actual_start_date_time, [
                            'class' => 'form-control actual-start-date-time required',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('actual_start_date_time'))
                <div class="help-block text-danger">
                    {{ $errors->first('actual_start_date_time') }}
                </div>
            @endif
        </div>

        <!--  Actual End Date Time  -->
        <div class="col-4">
            <div class="form-group">
                {!! Form::label('actual_end_date_time', trans('vms::trip.feedback.form_elements.actual_end_date_time'), ['class' => 'form-label']) !!}
                {{
                       Form::text('actual_end_date_time', old('actual_end_date_time') ?? $trip->actual_end_date_time, [
                            'class' => 'form-control actual-end-date-time required',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('actual_end_date_time'))
                <div class="help-block text-danger">
                    {{ $errors->first('actual_end_date_time') }}
                </div>
            @endif
        </div>

        <!-- Completed Distance -->
        <div class="col-4">
            <div class="form-group">
                {!! Form::label('completed_distance', trans('vms::trip.feedback.form_elements.completed_distance'), ['class' => 'form-label']) !!}
                {{
                       Form::number('completed_distance', old('completed_distance') ?? $trip->completed_distance,
                       [
                         'class' => 'form-control required',
                         'min'=>0,
                         'max'=>999999999,
                         'data-rule-number'=>true,
                         'data-msg-number'=> trans('labels.Please enter a valid number'),
                         'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                         'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                         'data-msg-required'=> __('labels.This field is required')
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('completed_distance'))
                <div class="help-block text-danger">
                    {{ $errors->first('completed_distance') }}
                </div>
            @endif
        </div>
        {!! Form::hidden('trip_id',$trip->id) !!}

    </div>
    <!--/General Information -->

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-outline-primary">
            <i class="la la-search"></i>@lang('labels.submit')
        </button>
        <a href="{{route('vms.trip.index')}}" class="btn btn-outline-warning">
            <i class="la la-times"></i>@lang('labels.cancel')
        </a>


    </div>
</div>

