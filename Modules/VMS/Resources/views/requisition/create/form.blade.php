<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'vms.requisition.store', 'class' => 'form maintenanceIteForm']) !!}
    @else
        {!! Form::open(['route' => ['vms.maintenance.item.update', $item->id], 'class' => 'form maintenanceIteForm']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('vms::maintenanceItem.menu.sub_menu_items') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                {!! Form::label('requisition_label', trans('vms::requisition.form.requisition_id'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('requisition', $page == "edit" ? $item->requisition : $requisitionNumber, ['class' =>
                'form-control required',
                'placeholder' => trans('vms::requisition.form.requisition_id'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                <!-- error message -->
                    @if ($errors->has('requisition'))
                        <div class="help-block text-danger">
                            {{ $errors->first('requisition') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('date_label', trans('labels.date'),
                ['class' => 'form-label required']) !!}
                {!! Form::text('date', $page == "edit"  ? null : date('d M Y'), ['class' =>
                'form-control required datepicker',
                'placeholder' => trans('labels.date'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters'),'readonly' ])!!}
                <!-- error message -->
                    @if ($errors->has('date'))
                        <div class="help-block text-danger">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('vehicle_id_label',trans('vms::requisition.form.transport'),
                ['class' => 'form-label required']) !!}
                {{
                Form::select('vehicle_id', $vehiclesForDropdown, $page == "edit" ? $vehiclesForDropdown ? $fuelLog->filling_station_id : null : null, [
                 'class' => 'form-control required select2',
                 'data-msg-required'=> __('labels.This field is required'),
                 'id'=>'filling_station_id'
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

            <div class="col-md-6">
                <div class="form-group">
                {!! Form::label('driver_id_lavel',trans('vms::requisition.form.driver'), ['class' => 'form-label required']) !!}
                    {{ Form::select('driver_id', $driversForDropdown, $page == "edit" ? $driversForDropdown ? $fuelLog->filling_station_id : null : null, [
                    'class' => 'form-control required select2',
                    'data-msg-required'=> __('labels.This field is required'),
                    'id'=>'filling_station_id'
                    ])
                    }}
                <!-- error message -->
                    @if ($errors->has('driver_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('driver_id') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @include('vms::requisition.create.itemTable')

    <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="ft-check-square"></i>
                @lang('labels.save')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{ route('vms.requisition.index') }}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
        {!! Form::close() !!}
        <br>
    </div>
</div>

@push('page-js')

@endpush
