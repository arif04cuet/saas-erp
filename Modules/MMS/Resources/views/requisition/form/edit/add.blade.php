<tr data-repeater-item>
    <td>
        <div class="form-group">
        {!! Form::select('medicine_id', $medicine, $page == "edit" ? $medicine ? $medicine_info->medicine_id : null : null,
        ['class' => 'form-control item-category-select dropdown-name select2 required',
        'data-msg-required'=> __('labels.This field is required'),
        'id'=>'medicine-dropdown',
        'onchange' => 'loadItems(this)'
        ]) !!}
        <!-- error message -->
            @if ($errors->has('medicine_id'))
                <div class="help-block text-danger">
                    {{ $errors->first('medicine_id') }}
                </div>
            @endif
        </div>

    </td>
    <td>
    {!! Form::number('piece', $page == "edit" ? 1 : null, ['class' =>
            'form-control required',
            'placeholder' => __('labels.quantity'),
            'data-msg-required'=> __('labels.This field is required'),
            'data-rule-max' => 10000,
            'data-msg-max'=> __('labels.Please enter a value less than or equal to 100'),
            'min' => 1,
            'data-msg-min' => trans('labels.Please enter a value greater than or equal to 1') ])!!}
    <!-- error message -->
        <br>
        <label class="success" name="max"></label>
        @if ($errors->has('piece'))
            <div class="help-block text-danger">
                {{ $errors->first('piece') }}
            </div>
        @endif

    </td>

    <td class="text-center align-middle">
        <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
    </td>
</tr>
