<div class="card-body">
    {!! Form::open(['route' => 'special-group-bills.store', 'class' => 'form special-group-bill-form'])!!}
    <div id="invoice-items-details" class="">
        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::special-service.bill.title') @lang('cafeteria::cafeteria.information')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('group', trans('cafeteria::cafeteria.group'), ['class' => 'form-label required']) !!}
                    {!! Form::select('special_group_id', $groups, null, 
                        ['class' => 'form-control groups-dropdown required',
                        'data-msg-required'=> __('labels.This field is required'),
                        'onChange' => 'getGroupData(this.value)'
                    ])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('remark', trans('labels.remarks'), ['class' => 'form-label']) !!}
                    {!! Form::textarea('remark', null, ['class' =>
                        'form-control',
                        'rows' => 2,
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                </div>
            </div>
        </div>

        <h4 class="form-section"><i class="la la-tag"></i>@lang('cafeteria::cafeteria.details')</h4>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered text-center special-group-bill">
                    <thead>
                    <tr>
                        <th>@lang('labels.date')</th>
                        <th>@lang('cafeteria::cafeteria.member')</th>
                        <th>@lang('cafeteria::special-service.bill.charge')</th>
                        <th>@lang('labels.total')</th>
                        <th width="1%">
                            <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                               id="repeater_create"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody data-repeater-list="bill-entries">
                    <tr data-repeater-item>
                        <td>
                            {!! Form::text('bill_date', date('Y-m-d'), ['class' =>
                                "form-control bill-date required",
                                'data-msg-required'=> __('labels.This field is required'),
                            ])!!}
                        </td>

                        <td> 
                            {!! Form::number('member', null, ['class' =>
                                'form-control member required spin',
                                'data-msg-required'=> __('labels.This field is required'),
                                'data-rule-maxlength' => 7,
                                'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                                'min' => 1,
                                'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 1'),
                                'onkeyup' =>  'calculateTotal(this.name)',
                                'placeholder' => trans('cafeteria::cafeteria.member')
                            ])!!}
                        </td>
                        <td> 
                            {!! Form::number('charge', null, ['class' => '
                                form-control required charge',
                                'readOnly' =>  true
                            ])!!}
                        </td>
                        <td> 
                            {!! Form::text('total_charge', null, ['class' =>
                                'form-control total_charge required',
                                'data-msg-required'=> __('labels.This field is required'),
                                'placeholder' => trans('labels.total'),
                                'readOnly' => true
                            ])!!}
                        </td>

                        <td><i data-repeater-delete class="la la-trash-o text-danger" style="cursor: pointer"></i>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                        <tr class="d-none rent-tr">
                            <th>@lang('cafeteria::special-service.special_group.rent')</th>
                            <th></th>
                            <th></th>
                            <th class="rent"></th>
                            <th></th>
                        </tr>
                        <tr class="d-none advance-amount-tr">
                            <th>@lang('cafeteria::special-service.special_group.advance_amount')</th>
                            <th></th>
                            <th></th>
                            <th class="advance_amount"></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>@lang('labels.grand_total')</th>
                            <th></th>
                            <th></th>
                            <th class="grand-total"></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>@lang('cafeteria::purchase-list.in_words')</th>
                            <th colspan="3" class="grand-total-in-words text-right"></th>
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

        <h4 class="form-section mt-4"><i class="la la-tag"></i>@lang('cafeteria::special-service.bill.title') @lang('cafeteria::special-service.bill.payment')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('payment', trans('cafeteria::special-service.bill.payment'), ['class' => 'form-label required']) !!}
                    {!! Form::text('payment', null, ['class' =>
                        'form-control payment required',
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 7,
                        'data-msg-maxlength'=> trans('labels.At most 7 characters'),
                        'min' => 0,
                        'data-msg-min'=> trans('labels.Please enter a value greater than or equal to 0'),
                        'placeholder' => trans('cafeteria::special-service.bill.payment'),
                        'onkeyup' => 'calculatePayment()' 
                    ])!!}
                </div>
            </div>
            {{-- Advance Amount --}}
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('advance_amount', trans('cafeteria::special-service.special_group.advance_amount'), ['class' => 'form-label']) !!}
                    {!! Form::text('advance_amount', null, ['class' =>
                        'form-control advance_amount required',
                        'data-msg-required'=> __('labels.This field is required'),
                        'placeholder' => trans('cafeteria::special-service.special_group.advance_amount'),
                        'readOnly' => true
                    ])!!}
                </div>
            </div>
           
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('due total', trans('cafeteria::special-service.bill.due_total'), ['class' => 'form-label']) !!}
                    {!! Form::text('due_total', null, ['class' =>
                        'form-control due-total required',
                        'data-msg-required'=> __('labels.This field is required'),
                        'placeholder' => trans('cafeteria::special-service.bill.due_total'),
                        'readOnly' => true
                    ])!!}
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn btn-success button-element">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('special-group-bills.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>
@push('page-js')
    <script src="{{asset('js/utility/NumberConverter.js')}}" type="text/javascript"></script>
    <script>
        let rent = 0;
        let advanceAmount = 0;

        /** calculate total price of individual purchase-list items*/
        function calculateTotal(name) {
            $index = name.match(/\d+/).toString();
            $totalMember = $("input[name='bill-entries[" + $index + "][member]']");
            $charge = $("input[name='bill-entries[" + $index + "][charge]']");
            $totalPrice = $("input[name='bill-entries[" + $index + "][total_charge]']");
            $totalAmount = Math.ceil(Number($totalMember.val()) * Number($charge.val()));
            $totalPrice.val($totalAmount);
            showGrandTotal();
        }

        /** calculate total amount of total items */
        function showGrandTotal() {
            let total = 0;
            $('.total_charge').each(function () {
                total += Math.ceil(Number($(this).val()));
                let grandTotal = total + rent -advanceAmount;
                if(grandTotal <= 0){
                    grandTotal = 0;
                }
                $due_total = $("input[name='due_total'");
                $due_total.val(grandTotal);

                @if(app()->isLocale('en'))
                    $('.grand-total').html(bnToEnNumber(`${grandTotal}`));
                    let numAsEn = convertToEnWords.convert(grandTotal).replace('only', 'taka only');
                    let sentenceCase = numAsEn.charAt(0).toUpperCase() + numAsEn.substr(1).toLowerCase();   
                    $('.grand-total-in-words').html(numAsEn == 'Zero' ? `${numAsEn} Taka` : sentenceCase)
                @else
                    $('.grand-total').html(enToBnNumber(`${grandTotal}`));
                    $('.grand-total-in-words').html(convertToBnWords.convert(grandTotal) + ` @lang('cafeteria::cafeteria.taka')`);
                @endif
            })
        }

        function calculatePayment() {
            showGrandTotal(); //calculate grandTotal for get exact due total
            $due_amount = $("input[name='due_total'");
            $payment = $("input[name='payment'");
            $due_taka = Number($due_amount.val()) - Number($payment.val());
            $due_amount.val($due_taka);
        }

        function getGroupData(id) {
            let url = "{{ route('get-group-data') }}"
            let data = { group_id : id}

            $.get(url, data, function (response) {
                $('.member').val(response.total_no);
                $('.charge').val(response.charge);
                $('.total_charge').val(response.total_no * response.charge);
                // if(response.advance_amount){
                   
                // }
               
                if (response.rent != null) {
                    $('.rent-tr').removeClass('d-none');
                    @if(app()->isLocale('en'))
                        $('.rent').html(bnToEnNumber(`${response.rent}`));
                    @else
                        $('.rent').html(enToBnNumber(`${response.rent}`));
                    @endif
                    rent = response.rent;
                } else {
                    $('.rent-tr').addClass('d-none');
                    rent = 0;
                }

                if (response.advance_amount != null) {

                    $('.advance_amount').val(response.advance_amount);
                    advanceAmount = response.advance_amount;

                    $('.advance-amount-tr').removeClass('d-none');
                    @if(app()->isLocale('en'))
                        $('.advance_amount').html(bnToEnNumber(`${response.advance_amount}`));
                    @else
                        $('.advance_amount').html(enToBnNumber(`${response.advance_amount}`));
                    @endif
                } else {
                    $('.advance-amount-tr').addClass('d-none');
                    advanceAmount = 0;
                }

                /** calculate first element */
                calculateTotal('0');
            });
        }
    </script>
@endpush
