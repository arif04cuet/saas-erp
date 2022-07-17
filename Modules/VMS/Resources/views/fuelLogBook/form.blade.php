<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'vms.fuel.log.store', 'class' => 'form company-form']) !!}
    @else
        {!! Form::open(['route' => ['vms.fuel.log.update', $fuelLog->id], 'class' => 'form company-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('vms::fuelLogBook.title') @lang('labels.form')</h4>
        <!-- Vehicle Type -->
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('date_label', trans('labels.date'),
                     ['class' => 'form-label required']) !!}
                    {!! Form::text('date', $page == "edit"
                                ? date('d M Y', strtotime($fuelLog->date))
                                : date('d M Y'), ['class' =>'form-control required datepicker','data-validation-required-message'=> __('labels.This field is required')])!!}
                    @if ($errors->has('date'))
                        <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-6">
            {!! Form::label('vehicle_id_label', trans('vms::fuelLogBook.form_elements.vehicle'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('vehicle_id', $vehicle, $page == "edit" ? $vehicle ? $fuelLog->vehicle_id : null : null, [
                        'class' => 'form-control required select2',
                        'placeholder' => trans('labels.select') ,
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

        <!-- Vehicle Type -->
        <div class="row">
            <div class="col-6">

            {!! Form::label('vehicle_type_id', trans('vms::fuelLogBook.form_elements.type'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('vehicle_type_id', $vehicleTypes, $page == "edit" ? $vehicleTypes ? $fuelLog->vehicle_type_id : null : null, [
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

            {!! Form::label('fuel_type', trans('vms::fuelLogBook.form_elements.fuel_type'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('fuel_type', $fuelTypes, $page == "edit" ? $fuelTypes ? $fuelLog->fuel_type : null : null,  [
                        'class' => 'form-control required select2',
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
        <div class="row mt-1">


            <div class="col-6">
            {!! Form::label('fuel_quantity_label', trans('vms::fuelLogBook.form_elements.fuel_quantity'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('fuel_quantity', $page == "edit" ? $fuelLog->fuel_quantity : null, ['class' =>
            'form-control required',
            'placeholder' => trans('vms::fuelLogBook.form_elements.fuel_quantity'),
            'data-msg-required'=> __('labels.This field is required'),
            'data-rule-maxlength' => 8,
            'data-msg-maxlength'=> trans('labels.At most 7 characters') ,'max-length'=>8])!!}
            <!-- error message -->
                @if ($errors->has('fuel_quantity'))
                    <div class="help-block text-danger">
                        {{ $errors->first('fuel_quantity') }}
                    </div>
                @endif

            </div>

            <div class="col-6">
            {!! Form::label('filling_station_label', trans('vms::fuelLogBook.form_elements.filling_station'), ['class' => 'form-label required']) !!}
            {{
                   Form::select('filling_station_id', $fillingStation, $page == "edit" ? $fillingStation ? $fuelLog->filling_station_id : null : null, [
                        'class' => 'form-control required select2',
                        'placeholder' => trans('labels.select') ,
                        'data-msg-required'=> __('labels.This field is required'),
                   ])
            }}
            <!-- error message -->
                @if ($errors->has('filling_station_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('filling_station_id') }}
                    </div>
                @endif
            </div>


        </div>

        <div class="row mt-1">
            <div class="col-6">
            {!! Form::label('amount_label', trans('vms::fuelLogBook.form_elements.amount'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('amount', $page == "edit" ? $fuelLog->amount : null, ['class' =>
            'form-control required',
            'placeholder' => trans('vms::fuelLogBook.form_elements.amount'),
            'data-msg-required'=> __('labels.This field is required'),
            'data-rule-maxlength' => 8,
            'data-msg-maxlength'=> trans('labels.At most 8 characters') ])!!}
            <!-- error message -->
                @if ($errors->has('amount'))
                    <div class="help-block text-danger">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
            </div>
            <div class="col-6">
            {!! Form::label('voucher_number', trans('vms::fuelLogBook.form_elements.voucher_number'), ['class' => 'form-label']) !!}
            {!! Form::text('voucher_number', $page == "edit" ? $fuelLog->voucher_number : null, ['class' =>
            'form-control',
            'placeholder' => trans('vms::fuelLogBook.form_elements.voucher_number'),
             'data-msg-required'=> __('labels.This field is required'),
            'data-rule-maxlength' => 60,
            'data-msg-maxlength'=> trans('labels.At most 60 characters') ])!!}
            <!-- error message -->
                @if ($errors->has('voucher_number'))
                    <div class="help-block text-danger">
                        {{ $errors->first('voucher_number') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('labels.save')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{ route('vms.fuel.log.index') }}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>
@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script>
        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: true,
            format: 'd mmm yyyy'
        });
    </script>
@endpush
