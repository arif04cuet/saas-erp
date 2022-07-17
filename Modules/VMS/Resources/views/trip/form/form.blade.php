<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>

<div class="col">
    <!-- Trip Title and No-of-Passenger  -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                {!! Form::text('title', old('title') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('labels.name'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('title'))
                    <div class="help-block text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('no_of_passenger', trans('vms::trip.form_elements.no_of_passenger'), ['class' => 'form-label required']) !!}
                {!! Form::number('no_of_passenger', 0,[
                        'class' => 'form-control required',
                        'min'=>0,
                        'max'=>999999999,
                        'data-rule-number'=>true,
                        'data-msg-number'=> trans('labels.Please enter a valid number'),
                        'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                        'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                        'data-msg-required'=> __('labels.This field is required'),
                ])!!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('no_of_passenger'))
                    <div class="help-block text-danger">
                        {{ $errors->first('no_of_passenger') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Passenger Selection and Checkbox  -->
    <div class="row">
        <!-- Vehicle Type -->
        <div class="col-6">
            <div class="form-group">
            {!! Form::label('passengers', trans('vms::trip.form_elements.passengers'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('passengers[]', $employees ?? [],null, [
                        'class' => 'form-control required select2',
                        'multiple'=>'multiple',
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('passengers'))
                    <div class="help-block text-danger">
                        {{ $errors->first('passengers') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Include yourself as the passenger -->
        <div class="col-6">
            <div class="form-group">
                <div class="skin skin-flat">
                    <fieldset>
                        {!! Form::label('is_requester_passenger', trans('vms::trip.form_elements.is_requester_passenger'), ['class' => 'form-label']) !!}
                        {!! Form::checkbox('is_requester_passenger')!!}
                    </fieldset>
                </div>

            </div>
        </div>
    </div>

    <!-- Trip Type and Dynamic Dropdown -->
    <div class="row">
        <!-- Trip Type -->
        <div class="col-6">
            {!! Form::label('type', trans('vms::trip.type.title'), ['class' => 'form-label required']) !!}
            <div class="radio-options">
                <div class="row">
                    <div class="form-group col-12 ">
                        <div class="row">
                            @foreach($reasons as $reason)
                                <div class="col-md-auto">
                                    <div class="skin skin-flat">
                                        {!! Form::radio('type', $reason,null,
                                                [
                                                    'class' => 'required trip-type',
                                                     'data-msg-required'=>trans('labels.This field is required')
                                                ])
                                         !!}
                                        <label
                                            for="type">
                                            @lang('vms::trip.type.'.$reason)
                                        </label>
                                    </div>
                                    <div class="radio-error"></div>
                                </div>
                            @endforeach

                        <!-- error message -->
                            @if ($errors->has('type'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <!-- Billed To -->
            <div class="col-12">
                <div class="form-group billed_to">
                {!! Form::label('billed_to', trans('vms::trip.form_elements.billed_to'), ['class' => 'form-label required']) !!}
                {{
                       Form::select('billed_to', $employees ?? [], $defaultBilledTo, [
                            'class' => 'form-control required select2',
                            'placeholder'=>trans('labels.select'),
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
                <!-- error message -->
                    @if ($errors->has('billed_to'))
                        <div class="help-block text-danger">
                            {{ $errors->first('billed_to') }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Training Dropdown -->
            <div class="col-12">
                <div class="form-group training_id">
                {!! Form::label('training_id', trans('tms::training.title'), ['class' => 'form-label required']) !!}
                {{
                       Form::select('training_id', $trainings ?? [], null, [
                            'class' => 'form-control  select2',
                            'placeholder'=>trans('labels.select'),
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
                <!-- error message -->
                    @if ($errors->has('training_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('training_id') }}
                        </div>
                    @endif
                </div>
            </div>
            <!-- Project Dropdown -->
            <div class="col-12">
                <div class="form-group project_id">
                {!! Form::label('project_id', trans('pms::project.title'), ['class' => 'form-label required']) !!}
                {{
                       Form::select('project_id', $projects ?? [], null, [
                            'class' => 'form-control  select2',
                            'placeholder'=>trans('labels.select'),
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
                <!-- error message -->
                    @if ($errors->has('project_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('project_id') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Trip Details -->

<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('vms::trip.details')
</h4>

<div class="col">
    <!-- Trip Time and Return Time -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('start_date_time', trans('vms::trip.form_elements.start_date_time'), ['class' => 'form-label required']) !!}
                {{
                       Form::text('start_date_time', old('start_date_time') ?? date('YYYY-MM-DD hh::mm::ss'), [
                            'class' => 'form-control required start-date-time',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('saveVehicleInformation'))
                <div class="help-block text-danger">
                    {{ $errors->first('saveVehicleInformation') }}
                </div>
            @endif
        </div>
        <!--  Return date and time -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('end_date_time', trans('vms::trip.form_elements.end_date_time'), ['class' => 'form-label required']) !!}
                {!! Form::text('end_date_time', old('end_date_time') ?? date('YYYY-MM-DD hh::mm::ss'),
                [
                    'class' => "form-control required end-date-time",
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('end_date_time'))
                    <div class="help-block text-danger">
                        {{ $errors->first('end_date_time') }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('destination', trans('vms::trip.form_elements.destination'), ['class' => 'form-label required']) !!}
                {!! Form::text('destination', old('destination') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::trip.form_elements.destination'),
                        'data-rule-maxlength'=> 500,
                        'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('destination'))
                    <div class="help-block text-danger">
                        {{ $errors->first('destination') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-6">
            {!! Form::label('distance', trans('vms::trip.form_elements.distance'), ['class' => 'form-label required']) !!}
            <div class="radio-options">
                <div class="row">
                    <div class="form-group col-md-6 col-xl-6">
                        <div class="row">
                            @foreach($distanceOptions as $distance)
                                <div class="col-md-auto">
                                    <div class="skin skin-flat">
                                        {!! Form::radio('distance', $distance,null,
                                                [
                                                    'class' => 'required',
                                                     'data-msg-required'=>trans('labels.This field is required')
                                                ])
                                         !!}
                                        <label
                                            for="type">
                                            @lang('vms::trip.distance.'.$distance)
                                        </label>
                                    </div>
                                    <div class="radio-error"></div>
                                </div>
                            @endforeach

                        <!-- error message -->
                            @if ($errors->has('type'))
                                <div class="help-block text-danger">
                                    {{ $errors->first('type') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! Form::label('reason', trans('vms::trip.form_elements.reason'), ['class' => 'form-label required']) !!}

            {{ Form::textarea('reason', null, [
                  'class' => 'form-control required',
                  'placeholder' => __('ims::inventory.message.placeholder'),
                  'data-msg-required'=> __('labels.This field is required'),
                  'rows' => 5
            ]) }}
            @if ($errors->has('reason'))
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('reason') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<!-- Vehicle Details -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('vms::vehicle.title')
</h4>

<div class="col">
    <!-- Vehicle Type -->
    <div class="col-6">
        <div class="form-group">
        {!! Form::label('vehicle_type_id', trans('vms::vehicle.form_elements.vehicle_type_id'), ['class' => 'form-label required']) !!}
        {{
               Form::select('vehicle_type_id', $vehicleTypes ?? [], $selectedVehicleType->id ?? null, [
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
</div>


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-primary">
        <i class="la la-check-square"></i>@lang('labels.submit')
    </button>
    <a class="btn btn-outline-warning mr-1" role="button" href="#">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>



