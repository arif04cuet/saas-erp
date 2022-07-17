<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-bordered text-center order-items">
            <thead>
            <tr>
                <th>{!! Form::checkbox(null, null, false, ['id' => 'checkAll']) !!}</th>
                <th>@lang('cafeteria::purchase-list.name')</th>
                <th width="15%">@lang('cafeteria::purchase-list.quantity')</th>
                <th width="20%">@lang('cafeteria::purchase-list.unit')</th>
                <th>@lang('cafeteria::purchase-list.unit_price')</th>
                <th>@lang('cafeteria::sales.vat')</th>
                <th>@lang('cafeteria::purchase-list.total_price')</th>
                <th width="1%">
                    <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                       id="repeater_create"></i>
                </th>
            </tr>
            </thead>
            <tbody data-repeater-list="food-order-entries">
            @foreach ($foodOrderItem->foodOrderItems as $item)
                <tr data-repeater-item>
                    {{ Form::hidden('id', $item->id) }}
                    <td>
                        {!! Form::checkbox('status', null, null, ['class' => 'approvalCheck']) !!}
                    </td>
                    <td width="25%">
                        {!! Form::select('raw_material', $rawMaterials, $item->raw_material_id,
                        ['class' =>
                        "form-control material-dropdown-select raw-material",
                        "required",
                        'disabled' => true,
                        'onChange' => 'getUnitByMaterial(this.name)',
                        ])!!}
                        <!-- If a field is disabled , the value of the field is not sent to the server when the form is submitted -->
                        {{ Form::hidden('raw_material_id', $item->raw_material_id) }}
                    </td>

                    <td> {!! Form::number('quantity', $item->quantity, ['class' =>
                                'form-control spin',
                                'required',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-msg-max'=> trans('cafeteria::sales.quantity_validate'),
                                'onkeyup' => 'calculateTotal(this.name)',
                                'min' => 0,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'placeholder' => trans('cafeteria::purchase-list.quantity')
                                ])!!}
                        <label class="warning d-block" name="in-stock"></label>
                    </td>
                    @php
                        $unitName =  app()->isLocale('en') ? $item->unit->en_name : $item->unit->bn_name;
                    @endphp
                    <td class="unit"> {!! Form::select('unit_id', [$item->unit_id => $unitName], null, ['class' => '
                                form-control unit-dropdown-select unit_id',
                                'required',
                                'disabled' => true
                                ])!!}
                    </td>

                    <td> {!! Form::number('unit_price', $item->unit_price,['class' =>
                                'form-control spin',
                                'required',
                                'readonly' => true,
                                'onkeyup' => 'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.unit_price') ])!!}
                    </td>
                    <td> {!! Form::number('vat', $item->vat,['class' =>
                                'form-control',
                                'required',
                                'readonly' => true,
                                'placeholder' => trans('cafeteria::sales.vat') ])!!}
                        {{ Form::hidden('vat_percentage', 0) }}
                    </td>

                    <td> {!! Form::number('total_price', $item->total_price,['class' =>
                                'form-control total-price',
                                'required',
                                'readonly' => true,
                                'placeholder' => trans('cafeteria::purchase-list.total_price')
                                ])!!}
                    </td>

                    <td class="support-td"></td>

                    <td class="delBtn" style="display: none"><i data-repeater-delete class="la la-trash-o text-danger"
                                                                style="cursor: pointer"></i>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>@lang('labels.total')</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th class="grand-total"></th>
                <th></th>
                <th class="hidden">
                    {{ Form::hidden('due', 0, ['class' => 'due-input']) }}
                </th>
            </tr>
            <tr>
                <th>@lang('cafeteria::purchase-list.in_words')</th>
                <th colspan="6" class="grand-total-in-words text-right"></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-md-5">
        <label for="note">@lang('cafeteria::food-order.note')</label>
        <textarea name="note" id="note" cols="30" rows="2" class="form-control"></textarea>
    </div>
</div>

