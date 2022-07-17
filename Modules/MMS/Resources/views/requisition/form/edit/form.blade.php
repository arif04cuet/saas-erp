<div class="row">
    <div class="col-6">
        <div class="form-group">
            <div class="form-group">
            {!! Form::label('patient_lavel', trans('mms::requisition.requisition_id'),
               ['class' => 'form-label required']) !!}

            {!! Form::text('requisition_id', $page == "edit" ? $medicine_info->requisition_id : null,
            ['class' => 'form-control required',
            'placeholder' => trans('mms::requisition.requisition_id'),
            'data-msg-required'=> __('labels.This field is required'),
            'id'=>'medicine-dropdown',
            ]) !!}
            <!-- error message -->
                @if ($errors->has('requisition_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('requisition_id') }}
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
                {!! Form::text('date',  $page == "edit" ? date('d M Y', strtotime($medicine_info->date))
                            : date('d M Y'), ['class' =>'form-control required datepicker','data-validation-required-message'=> __('labels.This field is required')])!!}
                @if ($errors->has('date'))
                    <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                @endif
            </div>
        </div>
    </div>


</div>
