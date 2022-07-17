<div class="row">

    <div class="col-6">
        <div class="form-group">

                {!! Form::label('medicine_lavel', trans('mms::medicine_inventory.medicine_name'),
                   ['class' => 'form-label required']) !!}
                {!! Form::select('medicine_id', $medicine, $page == "edit" ? $medicine ? $medicine_info->medicine_id : null : null,
                ['class' => 'form-control  dropdown-name select2 required',
                'data-msg-required'=> __('labels.This field is required'),
                'id'=>'medicine-dropdown'
                ]) !!}
                <!-- error message -->
                    @if ($errors->has('medicine_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('medicine_id') }}
                        </div>
                    @endif
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
        {!! Form::label('quantity_lavel', trans('labels.quantity'), ['class' => 'form-label required']) !!}
        {!! Form::number('quantity', $page == "edit" ? $medicine_info->quantity : null, ['class' =>
        'form-control required',
        'placeholder' => trans('labels.quantity'),
        'data-msg-required'=> __('labels.This field is required'),
        'data-rule-max' => 10000,
        'data-msg-max'=> trans('labels.Please enter a value less than or equal to 10000'),
        'data-rule-maxlength' => 5,
        'data-msg-maxlength'=> trans('labels.At most 5 characters'),
        'min' => 1,
        'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1') ])!!}
        <!-- error message -->
            @if ($errors->has('quantity'))
                <div class="help-block text-danger">
                    {{ $errors->first('quantity') }}
                </div>
            @endif
        </div>
    </div>
    {{-- <div class="col-4">
        <div class="form-group">
            {!! Form::label('expiry_lavel', trans('mms::medicine_inventory.expiry_date'), ['class' => 'form-label required']) !!}
        {!! Form::text('expiry_date', $page == "edit" ? $medicine_info->quantity : null, ['class' =>
        'form-control required datepicker',
        'placeholder' => trans('mms::medicine_inventory.expiry_date'),
        'data-msg-required'=> __('labels.This field is required'),
       ])!!}
        <!-- error message -->
            @if ($errors->has('expiry_date'))
                <div class="help-block text-danger">
                    {{ $errors->first('expiry_date') }}
                </div>
            @endif
        </div>
    </div> --}}

</div>

@push('page-js')
   <!-- datepicker -->
   {{-- <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
   <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function () {
  $('.datepicker').datepicker({
                    dateFormat: "yy-mm-dd",
                    minDate: new Date()
                });
    });
</script> --}}
@endpush

