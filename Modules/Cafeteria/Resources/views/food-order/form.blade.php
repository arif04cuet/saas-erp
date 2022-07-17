<div class="card-body">
    @if ($page == "create")
        {!! Form::open(['route' => 'food-orders.store', 'class' => 'form food-order-form']) !!}
    @else
        {!! Form::open(['route' => ['food-orders.update', $foodOrderItem->id], 'class' => 'form food-order-form']) !!}
        @method('PUT')
    @endif

    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::food-order.order_info')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {!! Form::text('title', $page == "edit" ? $foodOrderItem->title : old('title'), ['class' =>
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
                    {!! Form::label('order date', trans('labels.date'), ['class' => 'form-label required']) !!}
                    {!! Form::text('order_date', $page == "edit"
                        ? $foodOrderItem->order_date
                        : date('Y-m-d'), ['class' =>'form-control',])!!}
                </div>
            </div>

            <!-- Type -->
            <div class="col-md-6">
                {!! Form::label('type',
                    trans('cafeteria::raw-material.type.title'),
                    ['class' => 'form-label required']) !!}
                    <p></p>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'employee', $page == "edit" ?
                        $foodOrderItem->reference_type == "employee" ? true : false
                        : '',
                        ['class' => 'required']) !!}
                    <label>@lang('cafeteria::food-order.type.personal')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'training', $page == "edit" ?
                        $foodOrderItem->reference_type == "training" ? true : false
                        : '',
                        ['class' => 'required',]) !!}
                    <label>@lang('cafeteria::food-order.type.training')</label>
                </div>
                <div class="form-check-inline skin skin-flat">
                    {!! Form::radio('reference_type', 'official', $page == "edit" ?
                        $foodOrderItem->reference_type == "official" ? true : false
                        : '',
                        ['class' => 'required']) !!}
                    <label>@lang('cafeteria::food-order.type.official')</label>
                </div>
            </div>

            <div class="col-md-6 dropdown-element mb-2">
            {!! Form::label('bill_to', trans('cafeteria::sales.bill_to'), ['class' => 'form-label required']) !!}
            {!! Form::select('bill_to', [], null, ['class' =>
                "form-control bill-to-dropdown required",
                'data-msg-required'=> __('labels.This field is required'),
                'placeholder' => trans('labels.select'),
                'onChange' => 'getEmployeeSalaryGrade(this.value)',
            ])!!}
            <!-- hidden field only for edit -->
                {!! Form::hidden('bill_to_id', $page == "edit" ? $foodOrderItem->bill_to : null) !!}
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remarks', trans('cafeteria::food-order.order_instruction'), ['class' => 'form-label order-remarks']) !!}
                    {!! Form::textarea('remarks', $page == "edit"
                        ? $foodOrderItem->remarks
                        : old('remarks'), ['class' =>
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

        @include('cafeteria::food-order.repeater-form')
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <div class="notice-text" style="display: none">
            <p class="text-left text-warning">* @lang('cafeteria::food-order.notice_text')</p>
        </div>
        <button type="submit" class="btn btn-info" name="status" value="draft">
            <i class="ft-check-square"></i>
            @lang('cafeteria::purchase-list.draft')
        </button>
        <button type="submit" class="btn btn-success" name="status" value="pending">
            <i class="ft-check-square"></i>
            @lang('labels.submit')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('food-orders.index')}}">
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
        function calculateTotal(name) {
            $index = name.match(/\d+/).toString();
            $quantity = $("input[name='food-order-entries[" + $index + "][quantity]']");
            $unitPrice = $("input[name='food-order-entries[" + $index + "][unit_price]']");
            $totalPrice = $("input[name='food-order-entries[" + $index + "][total_price]']");
            $vat = $("input[name='food-order-entries[" + $index + "][vat]']");

            $totalAmount = Number($quantity.val()) * Number($unitPrice.val());
            $vatAmount = Math.floor($totalAmount * vat / 100);
            $totalAmount += $vatAmount;

            $totalPrice.val($totalAmount);
            $vat.val($vatAmount);

            showGrandTotal();
        }

        /** calculate total amount of total items */
        function showGrandTotal() {
            let grandTotal = 0;
            $('.total-price').each(function () {
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

        /** we get also material price and vat data by this method */
        function getUnitByMaterial(name) {
            $index = name.match(/\d+/).toString();
            $rawMateial = $("select[name='food-order-entries[" + $index + "][raw_material_id]']");
            $unit = $("select[name='food-order-entries[" + $index + "][unit_id]']");
            $unit_price = $("input[name='food-order-entries[" + $index + "][unit_price]']");
            $quantity = $("input[name='food-order-entries[" + $index + "][quantity]']");
            $quantityInStock = $("label[name='food-order-entries[" + $index + "][in-stock]']");
            $reference_type = $('input[name=reference_type]:checked').val();

            let url = "{{ url('cafeteria/get-unit-by-material/') }}" ;
            $.get( url +'/'+ $rawMateial.val(), function (data) {
                $($unit).find('option').remove();
                $($unit).append(`<option value="${data.unit_id}">${data.unit_name}</option>`);

                getVatAndPriceBasedOnType($reference_type, $unit_price, data);
                calculateTotal(name);
            });

        }

        function getVatAndPriceBasedOnType($reference_type, $unit_price, data) {
            /**
                * index given according to unit_price sequence at constant
                * 0 == regular, 1 == subsidized-officers, 2 == subsidized-staffs
            */
            if ($reference_type == 'training') {
                vat = data.unit_prices[0].vat;
                $unit_price.val(data.unit_prices[0].price);
            } else {
                if (employeeSalaryGrade > 10) {
                    setValueInVatAndPrice(2, data, $unit_price);
                } else {
                    setValueInVatAndPrice(1, data, $unit_price);
                }
            }
        }

        function setValueInVatAndPrice(index, data, $unit_price) {
            vat = data.unit_prices[index].vat;
            $unit_price.val(data.unit_prices[index].price);
            $unit_price.attr('readOnly', true);
        }

        $('input[name=reference_type]').on('ifClicked', function () {
            $(this).val() == "training" ? $('.notice-text').show() : $('.notice-text').hide();
            $(this).val() == "official" ? $('.order-remarks').html('@lang('cafeteria::food-order.project_name')')
                                        : $('.order-remarks').html('@lang('cafeteria::food-order.order_instruction')');
            resetAll();
            getBillToData($(this).val());
        });

        function getBillToData(value) {
            let url = "{{ url('cafeteria/sales/get-bill-to-data/') }}";
            let data = { type: value }

            $.get( url, data, function (data) {
                $('.bill-to-dropdown').find('option').not(':first').remove();
                $.map(data, function(value, key) {
                    let billToId = $('input[name="bill_to_id"]').val();
                    let selected = key == billToId ? 'selected' : '';

                    $('.bill-to-dropdown').append(`<option value="${key}" ${selected}>${value}</option>`);
                })
            });
        }

        function getEmployeeSalaryGrade(id) {
            $reference_type = $('input[name=reference_type]:checked').val();

            if ($reference_type == 'employee' || $reference_type == 'official') {

                resetAll();

                let url = "{{ url('cafeteria/sales/get-employee-salary-grade/') }}"
                $.get( url + '/' + id, function(grade) {
                    employeeSalaryGrade = grade;
                });
            }
        }

        function resetAll() {
            $('.material-dropdown-select, .unit-dropdown-select').val(null).trigger('change');
            $('.quantity, .unit-price, .vat, .total-price').val('');
        }

    </script>
@endpush
