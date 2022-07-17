<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Name and Model -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('name', trans('vms::vehicle.form_elements.name'), ['class' => 'form-label required']) !!}
                {!! Form::text('name', old('name') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('labels.name'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('name'))
                    <div class="help-block text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('model', trans('vms::vehicle.form_elements.model'), ['class' => 'form-label required']) !!}
                {!! Form::text('model', old('model') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::vehicle.form_elements.model'),
                        'data-rule-maxlength'=> 500,
                        'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('model'))
                    <div class="help-block text-danger">
                        {{ $errors->first('model') }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Registration Number and Price -->
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('registration_number', trans('vms::vehicle.form_elements.registration_number'), ['class' => 'form-label required']) !!}
                {!! Form::text('registration_number', old('registration_number') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('vms::vehicle.form_elements.registration_number'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('registration_number'))
                    <div class="help-block text-danger">
                        {{ $errors->first('registration_number') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('price', trans('vms::vehicle.form_elements.price'), ['class' => 'form-label required']) !!}
                {!! Form::number('price', old('price') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::vehicle.form_elements.price'),
                        'min'=>0,
                        'max'=>999999999,
                        'data-rule-number'=>true,
                        'data-msg-number'=> trans('labels.Please enter a valid number'),
                        'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                        'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('price'))
                    <div class="help-block text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- CC and Seat -->
    <div class="row">

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('cc', trans('vms::vehicle.form_elements.cc'), ['class' => 'form-label required']) !!}
                {!! Form::text('cc', old('cc') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('labels.name'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('cc'))
                    <div class="help-block text-danger">
                        {{ $errors->first('cc') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('seat', trans('vms::vehicle.form_elements.seat'), ['class' => 'form-label required']) !!}
                {!! Form::number('seat', old('seat') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::vehicle.form_elements.seat'),
                        'min'=>0,
                        'max'=>999999999,
                        'data-rule-number'=>true,
                        'data-msg-number'=> trans('labels.Please enter a valid number'),
                        'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                        'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('seat'))
                    <div class="help-block text-danger">
                        {{ $errors->first('seat') }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Purchase Date & Chassis Number -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('purchase_date', trans('vms::vehicle.form_elements.purchase_date'), ['class' => 'form-label required']) !!}
                {{
                       Form::text('purchase_date', old('purchase_date') ?? date('Y-m-d'), [
                            'class' => 'form-control required',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('purchase_date'))
                <div class="help-block text-danger">
                    {{ $errors->first('purchase_date') }}
                </div>
            @endif
        </div>
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('chassis_number', trans('vms::vehicle.form_elements.chassis_number'), ['class' => 'form-label required']) !!}
                {!! Form::number('chassis_number', old('chassis_number') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::vehicle.form_elements.chassis_number'),
                        'min'=>0,
                        'max'=>999999999,
                        'data-rule-number'=>true,
                        'data-msg-number'=> trans('labels.Please enter a valid number'),
                        'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                        'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('chassis_number'))
                    <div class="help-block text-danger">
                        {{ $errors->first('chassis_number') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Insurance and Fitness -->
    <!-- Registration Number and Price -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('insurance', trans('vms::vehicle.form_elements.insurance'), ['class' => 'form-label required']) !!}
                {!! Form::text('insurance', old('insurance') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('vms::vehicle.form_elements.insurance'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('insurance'))
                    <div class="help-block text-danger">
                        {{ $errors->first('insurance') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('fitness', trans('vms::fuelLogBook.form_elements.fitness'), ['class' => 'form-label required']) !!}
                {!! Form::text('fitness', old('fitness') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('vms::vehicle.form_elements.fitness'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('registration_number'))
                    <div class="help-block text-danger">
                        {{ $errors->first('registration_number') }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <!-- Vehicle Type -->
    <div class="row">
        <div class="col-6">
        {!! Form::label('vehicle_type_id', trans('vms::vehicle.form_elements.vehicle_type_id'), ['class' => 'form-label required']) !!}
        {{
               Form::select('vehicle_type_id', $vehicleTypes ?? [], old('vehicle_type_id') ?? null, [
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
        <div class="col-6">
        {!! Form::label('fuel_type', trans('vms::vehicle.form_elements.fuel_type'), ['class' => 'form-label required']) !!}
        {{
               Form::select('fuel_type', $fuelTypes ?? [] , old('fuel_type') ?? null, [
                    'class' => 'form-control required',
                    'data-msg-required'=> __('labels.This field is required'),
               ])
        }}
        <!-- error message -->
            @if ($errors->has('fuel_type'))
                <div class="help-block text-danger">
                    {{ $errors->first('fuel_type') }}
                </div>
            @endif
        </div>

    </div>
</div>
<!--/General Information -->

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('vms.vehicles.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

