<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Vehicle Type and Date -->
    <div class="row">
        <!-- Vehicle Type -->
        <div class="col-6">
            <div class="form-group">
            {!! Form::label('vehicle_type_id', trans('vms::vehicle.form_elements.vehicle_type_id'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('vehicle_type_id', $vehicleTypes, $selectedVehicleType->id ?? null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('vehicle_type_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('vehicle_type_id') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('start_date_time', trans('labels.pick_a_date'), ['class' => 'form-label']) !!}
                {{
                       Form::text('start_date_time', old('start_date_time') ?? date('Y-m-d'), [
                            'class' => 'form-control required start-date-time',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('start_date_time'))
                <div class="help-block text-danger">
                    {{ $errors->first('start_date_time') }}
                </div>
            @endif
        </div>
    </div>

</div>
<!--/General Information -->

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-primary">
        <i class="la la-search"></i>@lang('labels.search')
    </button>
</div>

