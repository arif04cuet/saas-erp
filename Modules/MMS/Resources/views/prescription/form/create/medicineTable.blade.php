<div id="medicineTable" class="table-responsive form-group">
    <table class="table table-bordered repeater-medicine">
        <thead>
        <tr>
            <th width="26%">@lang('mms::prescription.medicine')</th>
            <th width="17.4%">@lang('mms::prescription.table.dose')</th>
            <th width="10.4%">@lang('mms::prescription.table.in_stock')</th>
            <th width="17.4%">@lang('mms::prescription.table.total_medicine')</th>
            <th class="text-center" style="width: 2%">
                <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
            </th>
        </tr>
        </thead>
        <tbody data-repeater-list="medicine">
        <tr data-repeater-item>
            <td>
                <div class="form-group">
                    <div class="medicine_id" name="medicine_id">
                    {!! Form::select('medicine_id', $medicine, $page == "edit" ? $medicine ? $medicine_info->medicine_id : null : null,
                    ['class' => ' select2 form-control item-category-select dropdown-name select2 required',
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
                        <button type="button" class="btn btn-sm btn-success pull-right mt-1" name="addText"
                                onclick="addMedicineNewName(this)">Add
                        </button>
                    </div>
                    <div class="medicine_name hidden" name="medicine_name">
                    {!! Form::text('medicine_name', $page == "edit" ? $company->name : null, ['class' =>
                'form-control required',
                'placeholder' => trans('mms::prescription.medicine'),
                'data-msg-required'=> __('labels.This field is required'),
                'data-rule-maxlength' => 255,
                'data-msg-maxlength'=> trans('labels.At most 255 characters') ])!!}
                    <!-- error message -->
                        @if ($errors->has('medicine_name'))
                            <div class="help-block text-danger">
                                {{ $errors->first('medicine_name') }}
                            </div>
                        @endif
                    </div>

                </div>
                <input type="hidden" name="type" value="0">

            </td>

            <td><input class="form-control " name="dose" type="text" placeholder="1 + 1 + 1"></td>
            <td><input class="form-control " name="in_stock" type="number">
                <label class="success" name="max"></label>
            </td>
            <td><input class="form-control required" name="total_medicine" type="number"></td>
            <td class="text-center align-middle">
                <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center" style="width: 2%">
                <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<script>

    function addMedicineNewName(element) {
        let divName = element.name;
        let divId = divName.match(/(\d+)/);
        let medicineId = '[name*="medicine[' + divId[0] + '][medicine_id]"]';
        $(medicineId).addClass('hidden');
        $('[name*="medicine[' + divId[0] + '][medicine_name]"]').addClass('show').removeClass('hidden');
        $('[name*="medicine[' + divId[0] + '][type]"]').val(1);
        $('[name*="medicine[' + divId[0] + '][in_stock]"]').addClass('hidden');
    }

</script>

