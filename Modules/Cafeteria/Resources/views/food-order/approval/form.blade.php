<div class="card-body">
    {!! Form::open(['route' => ['food-orders.approval', $foodOrderItem->id ], 'class' => 'form food-order-form']) !!}
    @method('PUT')
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::food-order.order_info')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {!! Form::text('title', $foodOrderItem->title , ['class' =>
                    "form-control",
                    "required",
                    'placeholder' => trans('labels.title')
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('order date', trans('labels.date'), ['class' => 'form-label required']) !!}
                    {!! Form::text('order_date', $foodOrderItem->order_date, ['class' =>
                    'form-control',
                    'required',
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    @if ($foodOrderItem->reference_type == "employee")
                        @php $bill_to = $foodOrderItem->employee->employee_id . ' - '
                                                . $foodOrderItem->employee->first_name
                                                    . ' ' . $foodOrderItem->employee->last_name @endphp
                    @else
                        @php $bill_to = $foodOrderItem->training->title @endphp
                    @endif
                    {!! Form::label('bill', trans('cafeteria::sales.bill_to'), ['class' => 'form-label required']) !!}
                    {!! Form::text('null', $bill_to, ['class' =>
                    'form-control',
                    'required',
                    'readOnly' => true
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('requester', trans('cafeteria::food-order.requester'), ['class' => 'form-label required']) !!}
                    {!! Form::text('null', $foodOrderItem->user->name, ['class' =>
                    'form-control',
                    'required',
                    'readOnly' => true
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remarks', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remarks', $foodOrderItem->remarks, ['class' =>
                    'form-control',
                    'readOnly',
                    'rows' => 2,
                    ])!!}
                </div>
            </div>
            <div>
                {!! Form::hidden('cafeteria_food_order_id', $foodOrderItem->id )!!}

                <!-- refernece and reference type for generate sales bill -->
                {{ Form::hidden('reference_type', $foodOrderItem->reference_type) }}
                {{ Form::hidden('reference', $foodOrderItem->bill_to) }}
                {{ Form::hidden('employee_grade', $foodOrderItem->reference_type == "employee" ? $foodOrderItem->employee->getEmployeeSalaryGrade() : 0) }}

            </div>
        </div>

        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::purchase-list.details')</h4>
        @include('cafeteria::food-order.approval.repeater-form')
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <div class="notice-text">
            <p class="text-left text-warning">* @lang('cafeteria::food-order.approve_text')</p>
        </div>
        <button type="submit" class="btn btn-success approveBtn" name="status" value="approved" onclick="return confirm('Are you sure?')">
            <i class="ft ft-check-square"></i>
            @lang('labels.approve')
        </button>
        <button type="submit" class="btn btn-danger" name="status" value="rejected"
                onclick="return confirm('Are you sure?')">
            <i class="ft ft-check-square"></i>
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
        let employeeSalaryGrade = $('input[name="employee_grade"]').val();

        /** calculate total price of individual purchase-list items */
        function calculateTotal(name) {
            $index = name.match(/\d+/).toString();
            $quantity = $("input[name='food-order-entries[" + $index + "][quantity]']");
            $unitPrice = $("input[name='food-order-entries[" + $index + "][unit_price]']");
            $totalPrice = $("input[name='food-order-entries[" + $index + "][total_price]']");
            $vat = $("input[name='food-order-entries[" + $index + "][vat]']");
            $vat_percentage = $("input[name='food-order-entries[" + $index + "][vat_percentage]']").val();

            $totalAmount = Number($quantity.val()) * Number($unitPrice.val());
            $vatAmount = Math.floor($totalAmount * $vat_percentage / 100);
            $totalAmount += $vatAmount;

            $totalPrice.val($totalAmount);
            $vat.val($vatAmount);

            showGrandTotal();
        }

        /** calculate total amount of total items */
        function showGrandTotal() {
            let grandTotal = 0;
            $('.total-price').each(function() {
                grandTotal += Number($(this).val());

                // due total for generate sales bill
                $('.due-input').val(grandTotal);

                @if(app()->isLocale('en'))
                $('.grand-total').html(bnToEnNumber(`${grandTotal}`));
                $('.grand-total-in-words').html(convertToEnWords.convert(grandTotal));
                @else
                $('.grand-total').html(enToBnNumber(`${grandTotal}`));
                $('.grand-total-in-words').html(convertToBnWords.convert(grandTotal) + ` @lang('cafeteria::cafeteria.taka')`);
                @endif
            })
        }

        function getUnitByMaterial(name) {
            $index = name.match(/\d+/).toString();
            $rawMaterial = $("select[name='food-order-entries[" + $index + "][raw_material]']");

            $unit = $("select[name='food-order-entries[" + $index + "][unit_id]']");
            $unit_price = $("input[name='food-order-entries[" + $index + "][unit_price]']");
            $vat_percentage = $("input[name='food-order-entries[" + $index + "][vat_percentage]']");

            /** set hidden value */
            $rawMaterialId = $("input[name='food-order-entries[" + $index + "][raw_material_id]']");
            $rawMaterialId.val($rawMaterial.val());

            $reference_type = $('input[name=reference_type]').val();


            let url = "{{ url('cafeteria/get-unit-by-material/') }}" ;
            $.get( url +'/'+ $rawMaterial.val(), function (data) {
                $($unit).find('option').remove();
                $($unit).append(`<option value="${data.unit_id}">${data.unit_name}</option>`);

                setFoodQuantityValidation(data);

                getVatAndPriceBasedOnType($reference_type, $vat_percentage, $unit_price, data);
                calculateTotal(name);
            });
        }

        function setFoodQuantityValidation(data) {
            $quantity = $("input[name='food-order-entries[" + $index + "][quantity]']");
            $quantityInStock = $("label[name='food-order-entries[" + $index + "][in-stock]']");

            let convertAmount = 0;
            @if(app()->isLocale('en'))
                convertAmount =  bnToEnNumber(`${data.available_amount}`)
            @else
                convertAmount = enToBnNumber(`${data.available_amount}`)
            @endif;
            let maxText = `@lang('cafeteria::cafeteria.remain') : ${convertAmount}`;

            $($quantity).attr('max', data.available_amount);
            $($quantityInStock).text(maxText);
        }

        function getVatAndPriceBasedOnType($reference_type, $vat_percentage, $unit_price,  data) {
            /**
             * index given according to unit_price sequence at constant file
             * 0 == regular, 1 == subsidized-officers, 2 == subsidized-staffs
             */
            if ($reference_type == 'training') {
                let vat = data.unit_prices[0].vat;
                $vat_percentage.val(vat);
                $unit_price.val(data.unit_prices[0].price);
            } else {
                if (employeeSalaryGrade > 10) {
                   setValueInVatAndPrice(2, data, $unit_price, $vat_percentage);
                } else {
                    setValueInVatAndPrice(1, data, $unit_price, $vat_percentage);
                }
            }
        }

        function setValueInVatAndPrice(index, data, $unit_price, $vat_percentage) {
            let vat = data.unit_prices[index].vat;
            $vat_percentage.val(vat);
            $unit_price.val(data.unit_prices[index].price);
        }

        /** Approval Btn Toggle */
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
    </script>
@endpush
