<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Vehicle Type -->
    <div class="row">
        <div class="col-6">
        {!! Form::label('driver_id', trans('vms::driver.title'), ['class' => 'form-label required']) !!}
        {{
               Form::select('driver_id', $driversForDropdown, old('driver_id') ?? null, [
                    'class' => 'form-control required select2',
                    'placeholder'=>trans('labels.select'),
                    'data-msg-required'=> __('labels.This field is required'),
               ])
        }}
        <!-- error message -->
            @if ($errors->has('driver_id'))
                <div class="help-block text-danger">
                    {{ $errors->first('driver_id') }}
                </div>
            @endif
        </div>
        <div class="col-6">
        {!! Form::label('vehicle_id', trans('vms::vehicle.title'), ['class' => 'form-label required']) !!}
        {{
               Form::select('vehicle_id', $vehiclesForDropdown, old('vehicle_id')
                                                            ? old('vehicle_id')
                                                            : (isset($vehicle))
                                                            ? $vehicle->id
                                                            :null,[
                    'class' => 'form-control required select2',
                    'placeholder'=>trans('labels.select'),
                    'data-msg-required'=> __('labels.This field is required'),
               ])
        }}
        <!-- error message -->
            @if ($errors->has('vehicle_id'))
                <div class="help-block text-danger">
                    {{ $errors->first('vehicle_id') }}
                </div>
            @endif
        </div>

    </div>
</div>
<!--/General Information -->

<div class="dynamic-content">
    @if(isset($vehicle) && !is_null($vehicle))
        @include('vms::vehicle.driver-assign.partial.vehicle-information')
    @endif
</div>

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('vms.vehicles.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

