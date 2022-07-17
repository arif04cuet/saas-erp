<div class="card-body">
    {!! Form::open(['route' => ['purchase-lists.approval', $purchaseItem->id ], 'class' => 'form']) !!}
    @method('PUT')
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::purchase-list.purchase_info')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {!! Form::text('title', $purchaseItem->title , ['class' =>
                    "form-control",
                    "required",
                    'placeholder' => trans('labels.title')
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('purchase date', trans('labels.date'), ['class' => 'form-label required']) !!}
                    {!! Form::text('purchase_date', $purchaseItem->purchase_date, ['class' =>
                    'form-control',
                    'required',
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark', $purchaseItem->remark, ['class' =>
                    'form-control',
                    'readOnly',
                    'rows' => 2,
                    ])!!}
                </div>
            </div>
            <div>
                {!! Form::hidden('purchase_list_id', $purchaseItem->id )!!}
            </div>
        </div>

        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::purchase-list.details')</h4>
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="table table-bordered text-center purchase-list-items">
                    <thead>
                        <tr>
                            <th>{!! Form::checkbox(null, null, false, ['id' => 'checkAll']) !!}</th>
                            <th>@lang('cafeteria::purchase-list.name')</th>
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
                        @foreach ($purchaseItem->purchaseItemLists as $item)
                        <tr data-repeater-item>
                            {{ Form::hidden('item_id', $item->id) }}
                            <td>
                                {!! Form::checkbox('status', null, null, ['class' => 'approvalCheck']) !!}
                            </td>
                            <td width="25%">
                                {!! Form::select('raw_material_id', $rawMaterials, $item->raw_material_id,
                                ['class' =>
                                "form-control material-dropdown-select",
                                "required",
                                'onChange' => 'getUnitByMaterial(this.name)',
                                ])!!}
                            </td>

                            <td> {!! Form::number('quantity', $item->quantity, ['class' =>
                                'form-control spin',
                                'required',
                                'onkeyup' => 'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.quantity')
                                ])!!}
                            </td>
                            @php
                                $unitName =  app()->isLocale('en') ? $item->unit->en_name : $item->unit->bn_name;
                            @endphp
                            <td class="unit"> {!! Form::select('unit_id', [$item->unit_id => $unitName], null, ['class' => '
                                form-control unit-dropdown-select',
                                'required'
                                ])!!}
                            </td>

                            <td> {!! Form::number('unit_price', $item->unit_price,['class' =>
                                'form-control spin',
                                'required',
                                'onkeyup' => 'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::purchase-list.unit_price') ])!!}
                            </td>

                            <td> {!! Form::number('total_price', $item->total_price,['class' =>
                                'form-control total-price',
                                'required',
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('approval_note', trans('cafeteria::purchase-list.approval_note'), ['class' =>
                    'form-label']) !!}
                    {!! Form::textarea('approval_note', null, ['class' =>
                    'form-control',
                    'rows' => 2,
                    ])!!}
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success approveBtn" name="status" value="approved"  onclick="return confirm('Are you sure to approve?')">
            <i class="la la-check-square-o"></i>
            @lang('labels.approve')
        </button>
        <button type="submit" class="btn btn-danger" name="status" value="rejected" onclick="return confirm('Are you sure to reject?')">
            <i class="la la-check-square-o"></i>
            @lang('labels.reject')
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
        /** calculate total price of individual purchase-list items */
        function calculateTotal(name)
        {
            $index = name.match(/\d+/).toString();
            $quantity = $("input[name='purchase-list-entries[" + $index + "][quantity]']");
            $unitPrice = $("input[name='purchase-list-entries[" + $index + "][unit_price]']");
            $totalPrice = $("input[name='purchase-list-entries[" + $index + "][total_price]']");
            $totalAmount = Number($quantity.val()) * Number($unitPrice.val());
            $totalPrice.val($totalAmount);
            showGrandTotal();
        }

        /** calculate total amount of total items */
        function showGrandTotal()
        {
            let grandTotal = 0;
            $('.total-price').each(function() {
                grandTotal += Number($(this).val());

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

        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
            toogleApprovalBtn(this);
        });

        $('.approvalCheck').click(function() {
            toogleApprovalBtn(this);
        });

        function toogleApprovalBtn(data) {
            if ($(data).is(':checked')) {
                $('.approveBtn').prop("disabled", false);
            } else {
                if ($('.approvalCheck').filter(':checked').length < 1){
                    $('.approveBtn').attr('disabled',true);}
            }
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
