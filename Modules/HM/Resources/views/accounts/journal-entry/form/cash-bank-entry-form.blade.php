<tr class="d-flex">
    <!-- Cash Bank Entry  -->
    <td class="col-3">
        <div class="row ">
            <div class="col text-center">
                <strong>@lang('accounts::journal.entry.cash_bank_entry')</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <!--  Cash -->
            <div class="col-6">
                <div class="skin skin-flat">
                    {!! Form::radio('cash_book_entries[payment_type]', 'cash',null,
                    ['class' => 'required', 'data-msg-required'=> __('labels.This field is required')]) !!}
                    <label
                        for="payment_type">
                        {{ $paymentTypes['cash'] ?? trans('labels.not_found')}}
                    </label>
                </div>
                <div class="radio-error"></div>
            </div>

            <!-- Bank -->
            <div class="col-6">
                <div class="skin skin-flat">
                    {!! Form::radio('cash_book_entries[payment_type]', 'bank', null,
                                ['class' => 'required', 'data-msg-required'=> __('labels.This field is required')]) !!}
                    <label
                        for="payment_type">
                        {{$paymentTypes['bank'] ?? trans('labels.not_found')}}
                    </label>
                </div>
                <div class="radio-error"></div>
            </div>

        </div>
    </td>
    <!--  Transaction type -->
    <td class="col-2">
        <div class="form-group">
            {!! Form::select('cash_book_entries[transaction_type]',
                  $transactionTypes ?? [],
                   null,
                   [
                       'class' => "form-control form-control-sm cash-bank-transaction-type required",
                       'placeholder'=>trans('labels.select'),
                       'readonly',
                       'data-msg-required'=> __('labels.This field is required'),
                   ]
                )
            !!}
        </div>
    </td>
    <!-- Sub-Sector-Code Dropdown -->
    <td class="col-3">
        <div class="form-group">
            {!! Form::select('cash_book_entries[hostel_budget_section_id]',
                    $hostelBudgetSections ?? [],
                    null,
                    ['class' => "form-control form-control-sm select2 required ",
                     'placeholder'=> trans('labels.select'),
                     'data-msg-required'=> __('labels.This field is required'),
                    ]
                 )
        !!}
        </div>
    </td>
    <!-- Debit Amount -->
    <td class="col-2">
        <div class="form-group">
            {!! Form::number('cash_book_entries[debit_amount]', 0,[
                       'class' => 'form-control form-control-sm required',
                       'readonly',
                       'min'=>0,
                       'max'=>999999999,
                       'data-rule-number'=>true,
                       'data-msg-number'=> trans('labels.Please enter a valid number'),
                       'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                       'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                       'data-msg-required'=> __('labels.This field is required'),
            ])!!}
        </div>
    </td>
    <!-- Credit Amount -->
    <td class="col-2">
        <div class="form-group">
            {!! Form::number('cash_book_entries[credit_amount]', 0,[
                         'class' => 'form-control form-control-sm required',
                         'readonly',
                         'min'=>0,
                         'max'=>999999999,
                         'data-rule-number'=>true,
                         'data-msg-number'=> trans('labels.Please enter a valid number'),
                         'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                         'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                         'data-msg-required'=> __('labels.This field is required'),
            ])!!}
        </div>
    </td>
    <!-- hidden field to detect cash Book entry -->
    {!! Form::hidden('cash_book_entries[is_cash_book_entry]', '1') !!}
    <td class="col-1">
    </td>
</tr>
