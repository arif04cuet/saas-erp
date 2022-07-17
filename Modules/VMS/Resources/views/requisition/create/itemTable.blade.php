<div class="row">
    <div class="col-12 mt-3 mt-lg-5">

        <div id="medicineTable" class="table-responsive form-group">
            <table class="table table-bordered repeater-medicine">
                <thead>
                <tr>
                    <th width="28%">@lang('vms::requisition.form.maintenance_item')</th>
                    <th width="17.4%">@lang('vms::requisition.form.quantity')</th>
                    <th class="text-center" style="width: 2%">
                        <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
                    </th>
                </tr>
                </thead>
                <tbody data-repeater-list="requisition_item">
                <tr data-repeater-item>
                    <td>
                        {{ Form::select('item_id', $maintenanceItemForDropdown, $page == "edit" ? $maintenanceItemForDropdown ? $fuelLog->filling_station_id : null : null, [
                        'class' => 'form-control required select2',
                        'data-msg-required'=> __('labels.This field is required')
                        ])
                        }}
                    </td>
                    <td>
                    {!! Form::number('quantity', $page == "edit"  ? null : null, ['class' =>
           'form-control required',
           'placeholder' => trans('vms::requisition.form.quantity'),
           'data-msg-required'=> __('labels.This field is required'),
           'data-rule-maxlength' => 1000,
           'data-msg-maxlength'=> trans('labels.At most 11 characters') ])!!}
                    <!-- error message -->
                        @if ($errors->has('quantity'))
                            <div class="help-block text-danger">
                                {{ $errors->first('quantity') }}
                            </div>
                        @endif
                    </td>

                    <td class="text-center align-middle">
                        <i data-repeater-delete class="la la-trash-o text-danger cursor-pointer"></i>
                    </td>
                </tr>


                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center" style="width: 2%">
                        <i data-repeater-create class="la la-plus-circle text-info cursor-pointer"></i>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

