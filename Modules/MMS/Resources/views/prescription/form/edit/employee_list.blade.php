<div class="col-md-12 d-flex p-0">
    <div class="col-md-6 training-list">
        <div class="form-group">
            <label class="form-label required">@lang('mms::patient.patients_name')</label>
            {!! Form::select('patient_id', $patient, $page == "edit" ? $patient ? $prescription->patient_id : null : null,
                                    ['class' => 'form-control employee-select training_id',
                                    'data-msg-required'=> __('labels.This field is required'),
                                    'placeholder'=> __('labels.select') ]) !!}
        </div>
    </div>
    <div class="col-md-6">
{{--        <div class="form-group">--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::label('date_lavel', trans('mms::medicine_distribution.date'),--}}
{{--                 ['class' => 'form-label required']) !!}--}}
{{--                {!! Form::text('date', $page == "edit"--}}
{{--                            ? date('d M Y', strtotime($prescription->date))--}}
{{--                            : date('d M Y'), ['class' =>'form-control required datepicker','data-validation-required-message'=> __('labels.This field is required')])!!}--}}
{{--                @if ($errors->has('date'))--}}
{{--                    <span class="invalid-feedback">{{ $errors->first('date') }}</span>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('date_lavel', trans('mms::medicine_distribution.date'),
                 ['class' => 'form-label required']) !!}
                {!! Form::text('date', $page == "edit"
                            ? date('d M Y', strtotime($prescription->date))
                            : date('d M Y'), ['class' =>'form-control required datepicker','data-validation-required-message'=> __('labels.This field is required')])!!}
                @if ($errors->has('date'))
                    <span class="invalid-feedback">{{ $errors->first('date') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
