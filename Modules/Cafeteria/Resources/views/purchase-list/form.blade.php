<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'purchase-lists.store', 'class' => 'form purchase-list-form']) !!}
    @else
        {!! Form::open(['route' => ['purchase-lists.update', $purchaseItem->id ], 'class' => 'form purchase-list-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::purchase-list.purchase_info')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {!! Form::text('title', $page == "edit" ? $purchaseItem->title : old('title'), ['class' =>
                    "form-control required",
                    'placeholder' => trans('labels.title'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('purchase date', trans('labels.date'), ['class' => 'form-label required']) !!}
                    {!! Form::text('purchase_date', $page == "edit" ? $purchaseItem->purchase_date : date('Y-m-d'), ['class' =>
                    'form-control',
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark',  $page == "edit" ? $purchaseItem->remark : null, ['class' =>
                    'form-control',
                    'rows' => 2,
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <div class="help-block"></div>
                    @if ($errors->has('remark'))
                        <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::purchase-list.details')</h4>
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="table table-bordered text-center purchase-list-items">
                    <thead>
                    <tr>
                        <th width="20%">@lang('cafeteria::purchase-list.name')</th>
                        <th>@lang('cafeteria::purchase-list.quantity')</th>
                        <th width="20%">@lang('cafeteria::purchase-list.unit')</th>
                        <th>@lang('cafeteria::purchase-list.unit_price')</th>
                        <th>@lang('cafeteria::purchase-list.total_price')</th>
                        <th width="1%">
                            <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                               id="repeater_create"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody data-repeater-list="purchase-list-entries">
                    <!-- edit form start -->
                    @if ($page == "edit")
                        @foreach ($purchaseItem->purchaseItemLists as $item)
                            <tr data-repeater-item>
                                {{ Form::hidden('item_id', $item->id) }}
                                <td>
                                    {!! Form::select('raw_material_id', $rawMaterials, $item->raw_material_id, ['class' =>
                                    "form-control material-dropdown-select required",
                                    'data-msg-required'=> __('labels.This field is required'),
                                    'onChange' =>  'getUnitByMaterial(this.name)'
                                    ])!!}
                                </td>

                                <td> {!! Form::number('quantity', $item->quantity, ['class' =>
                                        'form-control required spin',
                                        'data-msg-required'=> __('labels.This field is required'),
                                        'data-rule-maxlength' => 7,
                                        'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                                        'min' => 1,
                                        'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                        'onkeyup' =>  'calculateTotal(this.name)',
                                        'placeholder' => trans('cafeteria::purchase-list.quantity')
                                        ])!!}
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
                                        'form-control required spin',
                                        'data-msg-required'=> __('labels.This field is required'),
                                        'data-rule-maxlength' => 7,
                                        'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                                        'min' => 1,
                                        'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                        'onkeyup' =>  'calculateTotal(this.name)',
                                        'placeholder' => trans('cafeteria::purchase-list.unit_price') ])!!}
                                </td>

                                <td> {!! Form::number('total_price', $item->total_price, ['class' =>
                                        'form-control total-price required',
                                        'data-msg-required'=> __('labels.This field is required'),
                                        'placeholder' => trans('cafeteria::purchase-list.total_price'),
                                        'readOnly' => true
                                        ])!!}
                                </td>

                                <td><i data-repeater-delete class="la la-trash-o text-danger"
                                       style="cursor: pointer"></i>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <!-- edit form end -->
                    <tr data-repeater-item>
                        <td>
                            {!! Form::select('raw_material_id', $rawMaterials, null, ['class' =>
                            "form-control material-dropdown-select required",
                            'data-msg-required'=> __('labels.This field is required'),
                            'onChange' =>  'getUnitByMaterial(this.name)'
                            ])!!}
                        </td>

                        <td> {!! Form::number('quantity', null,['class' =>
                                'form-control required spin',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-rule-maxlength' => 7,
                                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'onkeyup' =>  'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.quantity')
                                ])!!}
                        </td>

                        <td class="unit"> {!! Form::select('unit_id', $units, null, ['class' => '
                                form-control unit-dropdown-select required',
                                'data-msg-required'=> __('labels.This field is required')
                                ])!!}
                        </td>

                        <td> {!! Form::number('unit_price', null, ['class' =>
                                'form-control required spin',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-rule-maxlength' => 7,
                                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'onkeyup' =>  'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.unit_price') ])!!}
                        </td>

                        <td> {!! Form::text('total_price', null, ['class' =>
                                'form-control total-price required',
                                'data-msg-required'=> __('labels.This field is required'),
                                'placeholder' => trans('cafeteria::purchase-list.total_price'),
                                'readOnly' => true
                                ])!!}
                        </td>

                        <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>@lang('labels.grand_total')</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="grand-total"></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>@lang('cafeteria::purchase-list.in_words')</th>
                        <th colspan="4" class="grand-total-in-words text-right"></th>
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
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-info" name="status" value="draft">
            <i class="ft-check-square"></i>
            @lang('cafeteria::purchase-list.draft')
        </button>
        <button type="submit" class="btn btn-success" name="status" value="pending">
            <i class="ft-check-square"></i>
            @lang('labels.submit')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('purchase-lists.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-js')
    <script src="{{asset('js/utility/NumberConverter.js')}}" type="text/javascript"></script>
    <script>
        /** calculate total price of individual purchase-list items*/
        function calculateTotal(name) {
            $index = name.match(/\d+/).toString();
            $quantity = $("input[name='purchase-list-entries[" + $index + "][quantity]']");
            $unitPrice = $("input[name='purchase-list-entries[" + $index + "][unit_price]']");
            $totalPrice = $("input[name='purchase-list-entries[" + $index + "][total_price]']");
            $totalAmount = Math.ceil(Number($quantity.val()) * Number($unitPrice.val()));
            $totalPrice.val($totalAmount);
            showGrandTotal();
        }

        /** calculate total amount of total items */
        function showGrandTotal() {
            let grandTotal = 0;
            $('.total-price').each(function () {
                grandTotal += Math.ceil(Number($(this).val()));

                @if(app()->isLocale('en'))
                    $('.grand-total').html(bnToEnNumber(`${grandTotal}`));
                    let numAsEn = convertToEnWords.convert(grandTotal).replace('only', 'taka only');
                    let sentenceCase = numAsEn.charAt(0).toUpperCase() + numAsEn.substr(1).toLowerCase();
                    $('.grand-total-in-words').html(numAsEn == 'Zero' ? `${numAsEn} Taka` : sentenceCase);
                @else
                    $('.grand-total').html(enToBnNumber(`${grandTotal}`));
                    $('.grand-total-in-words').html(convertToBnWords.convert(grandTotal) + ` @lang('cafeteria::cafeteria.taka')`);
                @endif
            })
        }


        function getUnitByMaterial(name) {
            $index = name.match(/\d+/).toString();
            $rawMateial = $("select[name='purchase-list-entries[" + $index + "][raw_material_id]']");
            $unit = $("select[name='purchase-list-entries[" + $index + "][unit_id]']");

            let url = "{{ url('cafeteria/get-unit-by-material/') }}" ;
            $.get( url +'/'+ $rawMateial.val(), function (data) {
                $($unit).find('option').remove();
                $($unit).append(`<option value="${data.unit_id}">${data.unit_name}</option>`)
            });
        }

    </script>
@endpush
