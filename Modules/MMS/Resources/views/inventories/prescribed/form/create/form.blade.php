<div class="row">
    <div class="col-6">
        <div class="form-group">
            <div class="form-group">
            {!! Form::label('patient_lavel', trans('mms::medicine_distribution.patient_id'),
               ['class' => 'form-label required']) !!}
            {!! Form::select('patient_id', $patient, $prescriptionId,
            ['class' => 'form-control select2 required',
            'data-msg-required'=> __('labels.This field is required'),
            'id'=>'medicine-dropdown',
            ]) !!}
            <!-- error message -->
                @if ($errors->has('patient_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('patient_id') }}
                    </div>
                @endif


            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('date_lavel', trans('mms::medicine_distribution.date'),
                 ['class' => 'form-label required']) !!}
                {!! Form::text('date', $page == "edit"
                            ? null
                            : date('d M Y'), ['class' =>'form-control required datepicker','data-validation-required-message'=> __('labels.This field is required')])!!}
                @if ($errors->has('date'))
                    <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                @endif
            </div>
        </div>
    </div>


</div>
