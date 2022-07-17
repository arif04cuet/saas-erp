@extends('ims::layouts.master')
@section('title', trans('ims::auction.auction_sales'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <h4 class="form-section"><i
                                        class="la  la-building-o"></i> @lang('ims::auction.auction_sales_form')
                            </h4>
                            <hr>
                            {{ Form::open([
                                'id' => 'auctionSaleForm',
                                'route' => ['auctions.sales.store', $auction->id],
                                'onkeyup' => "$(this).trigger('change')",
                                'onchange' => "calculateFormChanges()"
                            ]) }}
                            {{ Form::hidden('auction_id', $auction->id) }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">@lang('ims::auction.vendor')</label>
                                            {{ Form::select('vendor_id',
                                                $vendorDropdownOptions,
                                                null,
                                                [
                                                    'class' => 'form-control' . ($errors->has('vendor_id') ? ' is-invalid' : ''),
                                                    'placeholder' => trans('labels.select'),
                                                    'required',
                                                    'data-msg-required' => trans('labels.This field is required')
                                                ]
                                            ) }}

                                            @if($errors->has('vendor_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('vendor_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">@lang('labels.date')</label>
                                            {{ Form::text('date', date('d/m/Y'), [
                                                'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : '')
                                            ]) }}

                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="repeater-sales table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('ims::inventory.inventory_item_category')</th>
                                        <th>@lang('labels.quantity')</th>
                                        <th>@lang('ims::auction.unit_price')</th>
                                        <th>@lang('ims::auction.tax')</th>
                                        <th>@lang('ims::auction.vat')</th>
                                        <th>@lang('labels.total')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="sales">
                                    @if(old('sales'))
                                        @php
                                            $sumVat = 0;
                                            $sumTax = 0;
                                            $sumTotal = 0;
                                        @endphp
                                        @foreach(old('sales') as $oldSale)
                                            @php
                                                $sumVat += $oldSale['vat'];
                                                $sumTax += $oldSale['tax'];
                                                $total = $oldSale['quantity'] * $oldSale['unit_price'];
                                                $sumTotal += $total;
                                            @endphp
                                            <tr data-repeater-item>
                                                <td>
                                                    <div class="form-group">
                                                        {{ Form::select('inventory_item_category_id',
                                                            $inventoryItemCategoryOptions,
                                                            $oldSale['inventory_item_category_id'],
                                                            [
                                                                'class' => 'form-control' . ($errors->has("sales.$loop->index.inventory_item_category_id") ? ' is-invalid' : ''),
                                                                'placeholder' => trans('labels.select'),
                                                                'required',
                                                                'data-msg-required' => trans('labels.This field is required'),
                                                            ]
                                                        ) }}

                                                        @if($errors->has("sales.$loop->index.inventory_item_category_id"))
                                                            <div class="invalid-feedback">
                                                                <strong>{{ $errors->first("sales.$loop->index.inventory_item_category_id") }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        {{ Form::number('quantity', $oldSale['quantity'], [
                                                            'class' => 'form-control' . ($errors->has("sales.$loop->index.quantity") ? ' is-invalid' : ''),
                                                            'min' => 1,
                                                            'required',
                                                            'data-msg-required' => trans('labels.This field is required'),
                                                            'data-rule-min' => 1,
                                                            'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                            'data-msg-number' => trans('labels.Please enter a valid number')
                                                        ]) }}

                                                        @if($errors->has("sales.$loop->index.quantity"))
                                                            <div class="invalid-feedback">
                                                                <strong>{{ $errors->first("sales.$loop->index.quantity") }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        {{ Form::number('unit_price', $oldSale['unit_price'], [
                                                            'class' => 'form-control' . ($errors->has("sales.$loop->index.unit_price") ? ' is-invalid' : ''),
                                                            'min' => 1,
                                                            'required',
                                                            'data-msg-required' => trans('labels.This field is required'),
                                                            'data-rule-min' => 1,
                                                            'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                            'data-msg-number' => trans('labels.Please enter a valid number')
                                                        ]) }}

                                                        @if($errors->has("sales.$loop->index.unit_price"))
                                                            <div class="invalid-feedback">
                                                                <strong>{{ $errors->first("sales.$loop->index.unit_price") }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        {{ Form::number('tax', $oldSale['tax'], [
                                                            'class' => 'form-control' . ($errors->has("sales.$loop->index.tax") ? ' is-invalid' : ''),
                                                            'min' => 1,
                                                            'required',
                                                            'data-msg-required' => trans('labels.This field is required'),
                                                            'data-rule-min' => 1,
                                                            'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                            'data-msg-number' => trans('labels.Please enter a valid number')
                                                        ]) }}

                                                        @if($errors->has("sales.$loop->index.tax"))
                                                            <div class="invalid-feedback">
                                                                <strong>{{ $errors->first("sales.$loop->index.tax") }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        {{ Form::number('vat', $oldSale['vat'], [
                                                            'class' => 'form-control' . ($errors->has("sales.$loop->index.vat") ? ' is-invalid' : ''),
                                                            'min' => 1,
                                                            'required',
                                                            'data-msg-required' => trans('labels.This field is required'),
                                                            'data-rule-min' => 1,
                                                            'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                            'data-msg-number' => trans('labels.Please enter a valid number')
                                                        ]) }}

                                                        @if($errors->has("sales.$loop->index.vat"))
                                                            <div class="invalid-feedback">
                                                                <strong>{{ $errors->first("sales.$loop->index.vat") }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="total">
                                                    {{ $total }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger"
                                                            data-repeater-delete><i
                                                                class="ft-x"></i> @lang('labels.delete')</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr data-repeater-item>
                                            <td>
                                                <div class="form-group">
                                                    {{ Form::select('inventory_item_category_id',
                                                        $inventoryItemCategoryOptions,
                                                        null,
                                                        [
                                                            'class' => 'form-control category-type-select',
                                                            'required',
                                                            'data-msg-required' => trans('labels.This field is required')
                                                        ]
                                                    ) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    {{ Form::number('quantity', null, [
                                                        'class' => 'form-control',
                                                        'min' => 1,
                                                        'required',
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                        'data-rule-min' => 1,
                                                        'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                        'data-msg-number' => trans('labels.Please enter a valid number')
                                                    ]) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    {{ Form::number('unit_price', null, [
                                                        'class' => 'form-control',
                                                        'min' => 1,
                                                        'required',
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                        'data-rule-min' => 1,
                                                        'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                        'data-msg-number' => trans('labels.Please enter a valid number')
                                                    ]) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    {{ Form::number('tax', null, [
                                                        'class' => 'form-control',
                                                        'min' => 1,
                                                        'required',
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                        'data-rule-min' => 1,
                                                        'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                        'data-msg-number' => trans('labels.Please enter a valid number')
                                                    ]) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    {{ Form::number('vat', null, [
                                                        'class' => 'form-control',
                                                        'min' => 1,
                                                        'required',
                                                        'data-msg-required' => trans('labels.This field is required'),
                                                        'data-rule-min' => 1,
                                                        'data-msg-min' => trans('labels.Must be greater than or equal to', ['attribute' => 1]),
                                                        'data-msg-number' => trans('labels.Please enter a valid number')
                                                    ]) }}
                                                </div>
                                            </td>
                                            <td class="total">
                                                0
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-repeater-delete><i
                                                            class="ft-x"></i> @lang('labels.delete')</button>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="3"
                                            class="text-right">@lang('labels.grand_total')
                                        </th>
                                        <th id="sum-tax">{{ empty($sumTax) ? 0 : $sumTax }}</th>
                                        <th id="sum-vat">{{ empty($sumVat) ? 0 : $sumVat }}</th>
                                        <th id="sum-total">{{ empty($sumTotal) ? 0 : $sumTotal }}</th>
                                        <th class="text-center">
                                            <button id="addSaleProduct" type="button" class="btn btn-primary" data-repeater-create>
                                                <i class="ft ft-plus"></i> @lang('labels.add')
                                            </button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <button class="btn btn-success" type="submit"><i
                                                    class="ft ft-check"></i> @lang('labels.save')</button>
                                        <a href="{{ route('auctions.sales.index') }}" class="btn btn-danger"><i
                                                    class="ft ft-x"></i> @lang('labels.cancel')</a>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script>
        function getRowTotal(element) {
            let quantity = 0;
            let unitPrice = 0;

            if (element.name.includes('quantity')) {
                quantity = element.value;
                unitPrice = $(element).closest('tr').find('input[name*=unit_price]').val();
            } else {
                quantity = $(element).closest('tr').find('input[name*=quantity]').val();
                unitPrice = element.value;
            }

            return quantity * unitPrice;
        }

        function setSumHtml(sales, property, selector) {
            let sum = sales.reduce((accumulator, sale) => {
                return accumulator + Number(sale[property]);
            }, 0);
            $(selector).html(sum);
        }

        function setSumTotalHtml(sales) {
            let sumTotal = sales.reduce((accumulator, sale) => {
                return accumulator + (Number(sale['quantity'] * Number(sale['unit_price'])));
            }, 0);
            $('#sum-total').html(sumTotal);
        }

        function setRowTotal(element) {
            if (!element.hasAttribute('name')) return;

            if ((element.name.includes('quantity') || element.name.includes('unit_price'))) {
                let rowTotal = getRowTotal(element);

                $(element).closest('tr')
                    .find('td.total')
                    .html(rowTotal);
            }
        }

        function calculateFormChanges() {
            let element = event.target;

            setRowTotal(element);

            let sales = $('.repeater-sales').repeaterVal().sales;

            setSumHtml(sales, 'tax', '#sum-tax');
            setSumHtml(sales, 'vat', '#sum-vat');
            setSumTotalHtml(sales);
        }

        $(document).ready(function () {
            $('input, select, textarea').jqBootstrapValidation('destroy');

            $('input[name=date]').pickadate({
                max: new Date(),
                format: 'dd/mm/yyyy'
            });

            $('.repeater-sales').repeater({
                isFirstItemUndeletable: true,
                show: function () {
                    $(this).find('.is-invalid').each(function () {
                        $(this).removeClass('is-invalid')
                    });

                    $(this).find('.invalid-feedback').each(function () {
                        $(this).remove();
                    });

                    $(this).find('.total').html(0);

                    $(this).slideDown();

                    let addSaleProduct = $('#addSaleProduct'),
                        allValues = @json(array_keys($inventoryItemCategoryOptions->toArray())),
                        scrapProducts = JSON.parse('@json($inventoryItemCategoryOptions->toArray())');


                    let allSelectedValues = [],
                        difference = [],
                        categoryTypeSelect = $('.category-type-select');

                    console.log(categoryTypeSelect.length);

                    categoryTypeSelect.not(':last').each(function (i, val) {
                        // this returns only the selected value
                        let selectedValue = $(this).val();

                        console.log(selectedValue);

                        if (selectedValue) {
                            allSelectedValues.push(parseInt(selectedValue));
                        }
                    });

                    // get the difference between the two array
                    difference = allValues.filter(x => !allSelectedValues.includes(x));
                    lastSelectElement = categoryTypeSelect.last();

                    lastSelectElement.empty();

                    if (difference === undefined || difference.length === 0) {
                        lastSelectElement.append('<option value="null"> No More Item is Available </option>')
                    } else {
                        difference.forEach(element => {
                            lastSelectElement.append('<option value="' + element + '">' + scrapProducts[element] + '</option>')
                        });
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('{{ trans("labels.confirm_delete") }}')) {
                        $(this).slideUp(deleteElement);
                        let $sumTax = $('#sum-tax');
                        let $sumVat = $('#sum-vat');
                        let $sumTotal = $('#sum-total');

                        let removedSale = $(this).repeaterVal().sales[0];

                        let oldSumTax = Number($sumTax.html());
                        let oldSumVat = Number($sumVat.html());
                        let oldSumTotal = Number($sumTotal.html());

                        $sumTax.html(oldSumTax - removedSale.tax);
                        $sumVat.html(oldSumVat - removedSale.vat);
                        $sumTotal.html(oldSumTotal - (removedSale.quantity * removedSale.unit_price));
                    }
                }
            });

            $('#auctionSaleForm').validate({
                errorClass: 'is-invalid',
                errorPlacement: function(error, element) {
                    error.addClass('danger');
                    error.insertAfter(element);
                },
            });

            let inventoryItemOptions = JSON.parse('{!! $inventoryItemCategoryOptions !!}');
            let selectedOptions = [];
            $('select[name*=inventory_item_category_id]').on('change', function () {
                let val = $(this).val();
                selectedOptions.push(val);
            });
        });


    </script>
@endpush