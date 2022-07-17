<h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::purchase-list.details')</h4>
<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-bordered text-center food-order-items">
            <thead>
                <tr>
                    <th width="20%">@lang('cafeteria::purchase-list.name')</th>
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
            <!-- edit form start -->
            @if ($page == "edit")
                @foreach ($foodOrderItem->foodOrderItems as $item)
                    <tr data-repeater-item>
                        {{ Form::hidden('id', $item->id) }}
                        <td>
                            {!! Form::select('raw_material_id', $rawMaterials, $item->raw_material_id, ['class' =>
                                "form-control material-dropdown-select required raw-material-edit",
                                'data-msg-required'=> __('labels.This field is required'),
                                'onChange' =>  'getUnitByMaterial(this.name)'
                            ])!!}
                        </td>

                        <td> {!! Form::number('quantity', $item->quantity, ['class' =>
                                'form-control required quantity spin',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-msg-max'=> trans('cafeteria::sales.quantity_validate'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'onkeyup' =>  'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.quantity')
                                ])!!}
                                <label class="warning d-block" name="in-stock"></label>
                        </td>
                        @php
                            $unitName =  app()->isLocale('en') ? $item->unit->en_name : $item->unit->bn_name;
                        @endphp
                        <td class="unit"> {!! Form::select('unit_id', [$item->unit_id => $unitName], null, ['class' => '
                                form-control unit-dropdown-select required',
                                'data-msg-required'=> __('labels.This field is required')
                                ])!!}
                        </td>

                        <td> {!! Form::number('unit_price', $item->unit_price, ['class' =>
                                'form-control required unit-price spin',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-rule-maxlength' => 11,
                                'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'onkeyup' =>  'calculateTotal(this.name)',
                                'readonly' => true,
                                'placeholder' => trans('cafeteria::purchase-list.unit_price') ])!!}
                        </td>

                        <td> {!! Form::number('vat', $item->vat,['class' =>
                                'form-control required vat',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-rule-maxlength' => 7,
                                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                                'min' => 0,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 0'),
                                'placeholder' => trans('cafeteria::sales.vat'),
                                'readOnly' => true
                            ])!!}
                        </td>

                        <td> {!! Form::number('total_price', $item->total_price, ['class' =>
                                'form-control total-price required',
                                'data-msg-required'=> __('labels.This field is required'),
                                'placeholder' => trans('cafeteria::purchase-list.total_price')
                                ])!!}
                        </td>

                        <td><i data-repeater-delete class="la la-trash-o text-danger"
                               style="cursor: pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr data-repeater-item>
                    <td>
                        {!! Form::select('raw_material_id', $rawMaterials, null, ['class' =>
                            "form-control material-dropdown-select required",
                            'data-msg-required'=> __('labels.This field is required'),
                            'onChange' =>  'getUnitByMaterial(this.name)'
                        ])!!}
                    </td>

                    <td> {!! Form::number('quantity', null,['class' =>
                            'form-control required quantity spin',
                            'data-msg-required'=> __('labels.This field is required'),
                            'data-msg-max' => trans('cafeteria::sales.quantity_validate'),
                            'min' => 1,
                            'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                            'onkeyup' =>  'calculateTotal(this.name)',
                            'placeholder' => trans('cafeteria::purchase-list.quantity')
                        ])!!}
                        <label class="warning d-block" name="in-stock"></label>
                    </td>

                    <td class="unit">
                        {!! Form::select('unit_id', [], null, ['class' => '
                            form-control unit-dropdown-select required',
                            'data-msg-required'=> __('labels.This field is required') ])!!}
                    </td>

                    <td> {!! Form::number('unit_price', null, ['class' =>
                            'form-control unit-price spin',
                            'data-msg-required'=> __('labels.This field is required'),
                            'data-rule-maxlength' => 11,
                            'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                            'min' => 1,
                            'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                            'onkeyup' =>  'calculateTotal(this.name)',
                            'placeholder' => trans('cafeteria::purchase-list.unit_price'),
                            'readOnly' => true ])
                        !!}
                    </td>

                    <td> {!! Form::number('vat', null,['class' =>
                            'form-control required vat',
                            'data-msg-required'=> __('labels.This field is required'),
                            'data-rule-maxlength' => 7,
                            'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                            'min' => 0,
                            'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 0'),
                            'placeholder' => trans('cafeteria::sales.vat'),
                            'readOnly' => true
                        ])!!}
                    </td>


                    <td> {!! Form::text('total_price', null, ['class' =>
                            'form-control total-price ',
                            'data-msg-required'=> __('labels.This field is required'),
                            'placeholder' => trans('cafeteria::purchase-list.total_price'),
                            'readOnly' => true
                        ])!!}
                    </td>

                    <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                    </td>
                </tr>
            @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>@lang('labels.grand_total')</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="grand-total"></th>
                    <th></th>
                </tr>
                <tr>
                    <th>@lang('cafeteria::purchase-list.in_words')</th>
                    <th colspan="5" class="grand-total-in-words text-right"></th>
                    <th></th>
                </tr>
            </tfoot>

        </table>

        <button class="btn btn-sm btn-primary" style="cursor: pointer" type="button"
                onclick="$('#repeater_create').trigger('click');">
            <i class="ft ft-plus"></i>@lang('labels.add')
        </button>
    </div>
</div>
