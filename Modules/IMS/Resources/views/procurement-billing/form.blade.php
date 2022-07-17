<div class="card-body">
    @if($page == 'create')
        {!! Form::open(['route' =>  'procurement-billings.store', 'class' => 'form', 'novalidate']) !!}
    @else
        {!! Form::open(['route' =>  ['procurement-billings.update', $procurement->id], 'class' => 'form']) !!}
        @method('PUT')
    @endif
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i
                class="la la-tag"></i>@lang('ims::procurement.form_title')</h4>

        <!-- Procurement Information -->
        <div class="row">
            <!-- Title  -->
            <div class="col-6">
                <div class="form-group">
                    {!! Form::label('title', trans('labels.title'), ['class' => 'form-label required']) !!}
                    {{ Form::text('title', $page == 'create'? old('title') : $procurement->title, ['class' => 'form-control',
                     'placeholder' => __('labels.title'), 'required', 'data-validation-required-message' => __('labels.This field is required')]) }}
                    <div class="help-block"></div>
                </div>
                <!-- error message -->
                @if ($errors->has('title'))
                    <div class="help-block text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>

            <!-- Bill Date  -->
            <div class="col-3">
                <div class="form-group">
                    {!! Form::label('bill_date', trans('labels.date'), ['class' => 'form-label required']) !!}
                    {{ Form::text('bill_date', $page == 'create'? old('bill_date') : $procurement->bill_date, ['class' => 'form-control pickadate',
                     'placeholder' => __('labels.date'), 'required', 'data-validation-required-message' => __('labels.This field is required')]) }}
                    <div class="help-block"></div>
                </div>
                <!-- error message -->
                @if ($errors->has('bill_date'))
                    <div class="help-block text-danger">
                        {{ $errors->first('bill_date') }}
                    </div>
                @endif
            </div>

            <!-- Inventory Location -->
            <div class="col-3">
                <div class="form-group">
                    {!! Form::label('to_location_id', trans('ims::inventory.inventory_location'), ['class' => 'form-label required']) !!}
                    {!! Form::select('to_location_id', $locations, $page == 'create'? old('to_location_id') :
                    $procurement->vendor_id, ['class' => "form-control", 'required',
                    'data-validation-required-message' => __('labels.This field is required')]) !!}
                    <div class="help-block"></div>
                    <!-- error message -->
                    @if ($errors->has('to_location_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('to_location_id') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vendor -->
            <div class="col-6">
                <div class="form-group">
                {!! Form::label('vendor_id', trans('ims::vendor.vendor'), ['class' => 'form-label required']) !!}
                {!! Form::select('vendor_id', $vendors, $page == 'create'? old('vendor_id') :
                $procurement->vendor_id, ['class' => "form-control select2 general-selector", 'required',
                'data-validation-required-message' => __('labels.This field is required')]) !!}
                <!-- error message -->
                    <div class="help-block"></div>
                    @if ($errors->has('vendor_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('vendor_id') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bill Settings -->
            <div class="col-3">
                <div class="form-group">
                    {!! Form::label('bill_setting_id', trans('ims::procurement.settings.title'), ['class' => 'form-label required']) !!}
                    @if(!$settings)
                        <a href="{{route('procurement-bill-settings.create')}}" class="pull-right">
                            + @lang('labels.create')
                        </a>
                    @endif
                    {!! Form::select('bill_setting_id', $settings, $page == 'create'? old('vendor_id') ??
                        optional($defaultSetting)->id : $procurement->bill_setting_id,
                        ['class' => "form-control select2 general-selector", 'required',
                        'data-validation-required-message' => __('labels.This field is required')]) !!}
                    {!! Form::hidden('vat_rate', optional($defaultSetting)->vat_percentage ?? 0) !!}
                <!-- error message -->
                    <div class="help-block"></div>
                    @if ($errors->has('vendor_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('vendor_id') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pay Method -->
            <div class="col-3">
                <div class="form-group">
                {!! Form::label('pay_type', trans('ims::procurement.pay_type'), ['class' => 'form-label required']) !!}
                {!! Form::select('pay_type', App::isLocale('bn') ? config('constants.journal_entry.dropdown.payment_type_bn') :
                   config('constants.journal_entry.dropdown.payment_type') , old('pay_type'),
                    ['class' => "form-control", 'required',
                    'data-validation-required-message' => __('labels.This field is required')]) !!}
                <!-- error message -->
                    <div class="help-block"></div>
                    @if ($errors->has('pay_type'))
                        <div class="help-block text-danger">
                            {{ $errors->first('pay_type') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Procurement Item Details -->
        <h4 class="form-section"><i
                class="la la-tag"></i>@lang('ims::procurement.item_details')</h4>
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="table table-bordered table-striped repeater-procurement-items">
                    <thead>
                    <tr class="text-center">
                        <th style="width: 100px">@lang('labels.code') <i class="text-danger">*</i></th>
                        <th style="width: 250px">@lang('ims::inventory.item_category') <i class="red">*</i></th>
                        <th style="width: 150px">@lang('ims::inventory.item.title') @lang('labels.name')</th>
                        <th style="width: 80px">@lang('ims::inventory.quantity') <i class="red">*</i></th>
                        <th style="width: 150px">@lang('ims::inventory.item.unit_price') <i class="red">*</i></th>
                        <th style="width: 60px">@lang('ims::procurement.vat') %</th>
                        <th style="width: 60px">@lang('ims::procurement.it') %</th>
                        <th style="width: 100px">@lang('ims::procurement.vat')</th>
                        <th style="width: 100px">@lang('ims::procurement.it')</th>
                        <th style="width: 150px">@lang('labels.total')</th>
                        <th>
                            <i data-repeater-create class="la la-plus-circle text-info"
                               style="cursor: pointer; display: none"
                               id="repeater_create"></i>
                        </th>
                    </tr>

                    </thead>
                    <tbody data-repeater-list="procurement_item_entries">

                    @if($page == 'edit')
                        @foreach($procurement->items as $item)
                            <tr data-repeater-item>

                                <!-- TODO:: add existing items for edit -->

                            </tr>
                        @endforeach
                    @endif
                    <tr data-repeater-item>
                        <!-- Item Category Information -->
                        <td>
                            <div class="form-group">
                                {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 100, 'required',
                                'data-validation-required-message' => __('labels.required_short_message')]) !!}
                                <div class="help-block"></div>
                            </div>
                        </td>

                        <td>
                            <div class="form-group">
                                {!! Form::select('inventory_item_category_id', $itemCategories, null, ['class' =>
                                "form-control item-category-selector", "required",
                                'data-validation-required-message' => __('labels.This field is required')])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>

                        <td>{!! Form::text('item_name', null,['class' => 'form-control'])!!}</td>
                        <td>
                            <div class="form-group">
                                {!! Form::number('quantity', null,['class' => 'form-control', 'required',
                                'data-validation-required-message' => __('labels.required_short_message'),
                                'data-validation-min-min' => 1,
                                'data-validation-min-message' => __('validation.min.numeric',
                                ['attribute' => __('labels.quantity'), 'min' => __('labels.digits.1')]),
                                'data-validation-number-message' => __('validation.numeric', ['attribute' => __('labels.quantity')]),
                                'onkeyup' =>  'calculateTotal(this.name)'])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::number('unit_price', null,['class' => 'form-control', 'required',
                                'data-validation-required-message' => __('labels.required_short_message'),
                                'data-validation-min-min' => 1,
                                'data-validation-min-message' => __('validation.min.numeric',
                                ['attribute' => __('ims::inventory.item.unit_price'), 'min' => __('labels.digits.1')]),
                                'data-validation-number-message' => __('validation.numeric', ['attribute' => __('ims::inventory.item.unit_price')]),
                                'onkeyup' =>  'calculateTotal(this.name)' ])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>

                        <!-- Vat and Total -->
                        <td>
                            <div class="form-group">
                                {!! Form::number('vat_percentage', null,['class' => 'form-control', 'step' => 0.01,
                                'data-validation-min-min' => 0, 'maxlength'=> 13,
                                'data-validation-min-message' => __('validation.min.numeric',
                                 ['attribute' => __('ims::procurement.vat'), 'min' => __('labels.digits.0')]),
                                 'data-validation-maxlength-message' => __('validation.maxlength',
                                 ['attribute' => __('ims::procurement.vat'), 'max' => __('labels.digits.13')]),
                                 'data-validation-number-message' => __('validation.numeric', ['attribute' => __('ims::procurement.vat')]),
                                'onkeyup' => 'calculateVat(this.name.match(/\d+/).toString(), true)'])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <!-- Vat and Total -->
                        <td>
                            <div class="form-group">
                                {!! Form::number('it_percentage', null,['class' => 'form-control', 'step' => 0.01,
                                'data-validation-min-min' => 0, 'maxlength'=> 4,
                                'data-validation-min-message' => __('validation.min.numeric',
                                 ['attribute' => __('ims::procurement.it'), 'min' => __('labels.digits.0')]),
                                 'data-validation-maxlength-message' => __('labels.At most 4 characters'),
                                 'data-validation-number-message' => __('validation.numeric', ['attribute' => __('ims::procurement.it')]),
                                'onkeyup' => 'calculateIt(this.name.match(/\d+/).toString(), true)'])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>

                        <!-- Vat IT and Total -->
                        <td>
                            <div class="form-group">
                                {!! Form::text('vat', null,['class' => 'form-control vat-amount', 'step' => 0.01,
                                'data-validation-min-min' => 0, 'maxlength'=> 13, 'readonly',
                                'data-validation-min-message' => __('validation.min.numeric',
                                 ['attribute' => __('ims::procurement.vat'), 'min' => __('labels.digits.0')])
                                 ])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>

                        <td>
                            <div class="form-group">
                                {!! Form::text('it', null,['class' => 'form-control it-amount', 'step' => 0.01,
                                'data-validation-min-min' => 0, 'maxlength'=> 13, 'readonly',
                                'data-validation-min-message' => __('validation.min.numeric',
                                 ['attribute' => __('ims::procurement.it'), 'min' => __('labels.digits.0')]),
                                 ])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>

                        <td> {!! Form::number('total', null,['class' => 'form-control total-amount', 'readonly'])!!}</td>

                        <td><i data-repeater-delete class="la la-trash-o text-danger"
                               style="cursor: pointer"></i>
                        </td>
                    </tr>
                    </tbody>

                    <tr class="bg-gradient-radial-grey-blue white">
                        <td></td>
                        <td></td>
                        <td colspan="5" class="font-weight-bold text-right">@lang('labels.grand_total')</td>
                        <td class="text-right">
                            <div class="font-weight-bold" id="total_vat"></div>
                        </td>
                        <td class="text-right">
                            <div class="font-weight-bold" id="total_it"></div>
                        </td>
                        <td class="text-right">
                            <div class="font-weight-bold" id="grand_total"></div>
                        </td>
                        <td></td>
                    </tr>

                </table>

            </div>
        </div>

        <!--/ Procurement Item Details -->
    </div>
    <div class="card-body">

        <button class="btn btn-sm btn-primary" style="cursor: pointer" type="button"
                onclick="$('#repeater_create').trigger('click');">
            <i class="ft ft-plus"></i>@lang('labels.add')
        </button>
    </div>
    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success">
            <i class="la la-check-square"></i>
            @if($page == 'create')
                @lang('labels.save')
            @else
                @lang('labels.edit')
            @endif
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('budgets.index')}}">
            <i class="la la-times"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-js')
    <script>

        function calculateTotal(name) {
            $index = name.match(/\d+/).toString();
            $quantity = $("input[name='procurement_item_entries[" + $index + "][quantity]']");
            $unitPrice = $("input[name='procurement_item_entries[" + $index + "][unit_price]']");
            $totalAmountObj = $("input[name='procurement_item_entries[" + $index + "][total]']");
            $totalAmount = Number($quantity.val()) * Number($unitPrice.val());
            $totalAmountObj.val($totalAmount);
            calculateIt($index);
            calculateVat($index);
            showTotal();
        }

        function showTotal() {
            let totalVat = 0;
            let totalIt = 0;
            let grandTotal = 0;
            $('.vat-amount').each(function () {
                totalVat += Number($(this).val());
            });

            $('.it-amount').each(function () {
                totalIt += Number($(this).val());
            });

            $('.total-amount').each(function () {
                grandTotal += Number($(this).val());
            });
            $('#total_vat').html(totalVat);
            $('#total_it').html(totalIt);
            $('#grand_total').html(grandTotal);
                console.log('total vat=' + totalVat + 'total it = ' + totalIt + 'grand total = ' + grandTotal)
        }

        function calculateVat(index, viewTotal = false) {
            $totalAmount = $("input[name='procurement_item_entries[" + index + "][total]']").val();
            $vatAmountObj = $("input[name='procurement_item_entries[" + index + "][vat]']");
            $vatPercentage = $("input[name='procurement_item_entries[" + index + "][vat_percentage]']").val();
            //$vatPercentage = $("input[name=vat_rate]").val();
            $vatAmountObj.val((Number($vatPercentage) * Number($totalAmount)) / 100);
            if (viewTotal) {
                showTotal();
            }
        }

        function calculateIt(index, viewTotal = false) {
            $totalAmount = $("input[name='procurement_item_entries[" + index + "][total]']").val();
            $itAmountObj = $("input[name='procurement_item_entries[" + index + "][it]']");
            $itPercentage = $("input[name='procurement_item_entries[" + index + "][it_percentage]']").val();
            $itAmountObj.val((Number($itPercentage) * Number($totalAmount)) / 100);
            if (viewTotal) {
                showTotal();
            }
        }

        {{--$('#bill_setting_id').change(function () {--}}
        {{--    let responseUrl = "{{url('ims/procurement-bill-settings/ajax/get-data')}}/" + $('#bill_setting_id').val();--}}
        {{--    $.get(responseUrl, function (response) {--}}
        {{--        $('input[name=vat_rate]').val(response['vat_percentage']);--}}
        {{--        $('.vat-amount').each(function () {--}}
        {{--            $thisIndex = $(this).attr('name').match(/\d+/).toString();--}}
        {{--            $totalAmount = $("input[name='procurement_item_entries[" + $thisIndex + "][total]']").val();--}}
        {{--            $vatPercentage = response['vat_percentage'];--}}
        {{--            $(this).val((Number($vatPercentage) * Number($totalAmount))/100);--}}
        {{--            showTotal();--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}

        $('.form').submit(function () {
            return confirm('{{__('labels.confirm_action')}}');
        });
    </script>

@endpush
