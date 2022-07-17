<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'sales.store', 'class' => 'form sales-form']) !!}
    @else
        {!! Form::open(['route' => ['sales.update', $sales->id], 'class' => 'form sales-form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::sales.sales_info')</h4>
        <div class="row">
            <div class="col-md-6 text-element">
                <div class="form-group">
                    {!! Form::label('bill_to', trans('cafeteria::sales.bill_to'), ['class' => 'form-label required']) !!}
                    {!! Form::text('reference', $page == 'edit' ? $sales->reference : null, ['class' =>
                    "form-control required bill-to-text",
                    'placeholder' => trans('labels.name'),
                    'data-msg-required'=> __('labels.This field is required'),
                    'data-rule-maxlength' => 50,
                    'data-msg-maxlength'=> trans('labels.At most 50 characters'),
                     ])!!}
                </div>
            </div>

            <div class="col-md-6 dropdown-element mb-2" style="display: none">
                {!! Form::label('bill_to', trans('cafeteria::sales.bill_to'), ['class' => 'form-label required']) !!}
                {!! Form::select('', [], null, ['class' =>
                    "form-control bill-to-dropdown",
                    'data-msg-required'=> __('labels.This field is required'),
                    'placeholder' => trans('labels.select'),
                    'onChange' => 'getEmployeeSalaryGrade(this.value)',
                ])!!}
                <!-- hidden field only for edit -->
                {!! Form::hidden('bill_to_id', $page == "edit" ? $sales->reference : null) !!}
            </div>

            <!-- Type -->
            <div class="col-md-6">
                {!! Form::label('type',
                trans('cafeteria::raw-material.type.title'),
                ['class' => 'form-label required']) !!}
                <p></p>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'employee', 
                    $page == "edit" ? $sales->reference_type == "employee" ? true : false : false,
                    ['class' => 'required']) !!}
                    <label>@lang('cafeteria::sales.type.employee')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'training', 
                    $page == "edit" ? $sales->reference_type == "training" ? true : false : false,
                    ['class' => 'required',]) !!}
                    <label>@lang('cafeteria::sales.type.training')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'regular', 
                    $page == "edit" ? $sales->reference_type == "regular" ? true : false : true,
                    ['class' => 'required',]) !!}
                    <label>@lang('cafeteria::sales.type.regular')</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('sales date', trans('labels.date'), ['class' => 'form-label required']) !!}
                    {!! Form::text('sales_date', $page == "edit" ? $sales->sales_date : date('Y-m-d'), ['class' =>
                    'form-control',
                    ])!!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark', $page == "edit" ? $sales->remark : null, ['class' =>
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

        @include('cafeteria::sales.repeater-form')

        @include('cafeteria::sales.payment-form')
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('sales.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-js')
    <script src="{{asset('js/utility/NumberConverter.js')}}" type="text/javascript"></script>
    <script>
        let vat = 0;
        let employeeSalaryGrade = 0;
      
        /** calculate total price with vat of individual sales-list items*/
        function calculateTotal(name) 
        {
            $index = name.match(/\d+/).toString();
            $quantity = $("input[name='sales-entries[" + $index + "][quantity]']");
            $unitPrice = $("input[name='sales-entries[" + $index + "][unit_price]']");
            $totalPrice = $("input[name='sales-entries[" + $index + "][total_price]']");
            $vat = $("input[name='sales-entries[" + $index + "][vat]']");

            $totalAmount = Math.ceil(Number($quantity.val()) * Number($unitPrice.val()));
            $vatAmount = Math.ceil($totalAmount * vat / 100);
            $totalAmount += $vatAmount;

            $totalPrice.val($totalAmount);
            $vat.val($vatAmount);

            showGrandTotal();
        }

        /** calculate total amount of total items */
        function showGrandTotal() 
        {
            let grandTotal = 0;
            $('.total-price').each(function () {
                grandTotal += Math.ceil(Number($(this).val()));
                $due_total = $("input[name='due'");
                $paidEditValue = $("input[name='paid-edit'");
                if($paidEditValue.val() > 0) {
                    $due_total.val(grandTotal - $paidEditValue.val());
                    $("input[name='paid']").attr('max', grandTotal - $paidEditValue.val());
                } else {
                    $due_total.val(grandTotal);
                    $("input[name='paid']").attr('max', grandTotal);
                }

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

        function calculatePayment() {
            showGrandTotal(); //calculate grandTotal for get exact due total
            $due_amount = $("input[name='due'");
            $payment = $("input[name='paid'");
            $due_taka = Number($due_amount.val()) - Number($payment.val());
            $due_amount.val($due_taka);
        }

        /** we get also material price and vat data by this method */
        function getUnitByMaterial(name) 
        {
            $index = name.match(/\d+/).toString();
            $rawMateial = $("select[name='sales-entries[" + $index + "][raw_material_id]']");
            $unit = $("select[name='sales-entries[" + $index + "][unit_id]']");
            $unit_price = $("input[name='sales-entries[" + $index + "][unit_price]']");
            $quantity = $("input[name='sales-entries[" + $index + "][quantity]']");
            $quantityInStock = $("label[name='sales-entries[" + $index + "][in-stock]']");
            $reference_type = $('input[name=reference_type]:checked').val();

            let url = "{{ url('cafeteria/get-unit-by-material/') }}" ;

            $.get( url +'/'+ $rawMateial.val(), function (data) {

                $($unit).find('option').remove();
                $($unit).append(`<option value="${data.unit_id}">${data.unit_name}</option>`);

                let convertAmount = 0;
                @if(app()->isLocale('en'))
                    convertAmount =  bnToEnNumber(`${data.available_amount}`)
                @else
                    convertAmount = enToBnNumber(`${data.available_amount}`)
                @endif;

                let maxText = `@lang('cafeteria::cafeteria.remain') : ${convertAmount}`;
                $($quantityInStock).text(maxText);

                @if ($page == "edit")
                    data.available_amount = $quantity.val() > data.available_amount 
                                            ? $quantity.val() 
                                            : data.available_amount;
                @endif
                $($quantity).attr('max', data.available_amount);

                getVatAndPriceBasedOnType($reference_type, $unit_price, data);
                calculateTotal(name);
            });

        }

        function getVatAndPriceBasedOnType($reference_type, $unit_price, data) 
        {
            /**
                * index given according to unit_price sequence at constant
                * 0 == regular, 1 == subsidized-officers, 2 == subsidized-staffs
            */
            if ($reference_type == 'regular') {
                setValueInVatAndPrice(0, data, $unit_price);
            } else if ($reference_type == 'training') {
                vat = data.unit_prices[0].vat;
                $unit_price.attr('readOnly', false);
                @if($page == "create") 
                    $unit_price.val('');
                @endif
            } else {
                if(employeeSalaryGrade > 10) {
                    setValueInVatAndPrice(2, data, $unit_price);
                } else {
                    setValueInVatAndPrice(1, data, $unit_price);
                }
            }
        }

        function setValueInVatAndPrice(index, data, $unit_price) 
        {
            vat = data.unit_prices[index].vat;
            $unit_price.val(data.unit_prices[index].price);
            $unit_price.attr('readOnly', true);
        }

        $('input[name=reference_type]').on('ifClicked', function () { 
            resetAll();
            visiableElement($(this).val());
        });

        function visiableElement(value) {
            let txtElement = $('.text-element');
            let dropdownElement = $('.dropdown-element');
            let billToDropdown = $('.bill-to-dropdown');
            let billToText = $('.bill-to-text');

            if (value == "regular") {

                txtElement.show();
                billToText.addClass('required').attr('name', 'reference');
                dropdownElement.hide();
                billToDropdown.removeClass('required').removeAttr('name', '');

            } else {
                if(value == "training") {
                    $('.unit-price').attr('readOnly', false);
                } 

                txtElement.hide();
                billToText.removeClass('required').removeAttr('name', 'reference');
                dropdownElement.show();
                billToDropdown.addClass('required').attr('name', 'reference');

                getBillToData(value);
            }
        }

        function getBillToData(value) {
            let url = "{{ url('cafeteria/sales/get-bill-to-data/') }}";
            let data = { type: value }
            
            $.get( url, data, function (data) {
                $('.bill-to-dropdown').find('option').not(':first').remove();
                $.map(data, function(value, key) {
                    let billToID = $("input[name='bill_to_id']").val();
                    let selected =  key == billToID ? 'selected' : '';
                    $('.bill-to-dropdown').append(`<option value="${key}" ${selected}>${value}</option>`);
                })
            });
        }

        function getEmployeeSalaryGrade(id) 
        {
            $reference_type = $('input[name=reference_type]:checked').val();

            if($reference_type == 'employee') {

                resetAll();

                let url = "{{ url('cafeteria/sales/get-employee-salary-grade/') }}"

                $.get( url + '/' + id, function(grade) {
                    employeeGrade = grade;
                });
            }
        }

        function resetAll() 
        {
            $('.material-dropdown-select, .unit-dropdown-select').val(null).trigger('change');
            $('.quantity, .unit-price, .vat, .total-price').val('');
        }

    </script>
@endpush
