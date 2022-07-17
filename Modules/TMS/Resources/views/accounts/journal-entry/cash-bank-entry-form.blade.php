<tr class="d-flex">
    <!-- Cash Bank Entry  -->
    <td class="col-2">
        <div class="row ">
            <div class="col text-center">
                <strong>@lang('accounts::journal.entry.cash_bank_entry')</strong>
            </div>
        </div>
        <hr>
        <div class="row">
        @php
            $paymentType = isset($tmsJournalEntry['payment_type']) ? $tmsJournalEntry['payment_type'] : null;
        @endphp
        <!--  Cash -->
            <div class="col-6">
                <div class="skin skin-flat">
                    {!! Form::radio('cash_book_entries[payment_type]', 'cash',$paymentType == 'cash' ? 1 : null ,
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
                    {!! Form::radio('cash_book_entries[payment_type]', 'bank', $paymentType == 'bank' ? 1 : null,
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
                  $transactionTypes,
                   $tmsJournalEntry['transaction_type'] ?? null,
                   [
                       'class' => "form-control cash-bank-transaction-type required",
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
            {!! Form::select('cash_book_entries[tms_sub_sector_id]',
                    $tmsSubSectors,
                    $tmsJournalEntry['tms_sub_sector_id'] ?? null,
                    ['class' => "form-control select2 required ",
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
            {!! Form::number('cash_book_entries[debit_amount]', $tmsJournalEntry['debit_amount'] ?? 0,[
                       'class' => 'form-control required',
                       'readonly',
                       'min'=>0,
                       'data-msg-required'=> __('labels.This field is required'),
            ])!!}
        </div>
    </td>
    <!-- Credit Amount -->
    <td class="col-2">
        <div class="form-group">
            {!! Form::number('cash_book_entries[credit_amount]', $tmsJournalEntry['credit_amount'] ?? 0,[
                         'class' => 'form-control required',
                         'readonly',
                         'min'=>0,
                         'data-msg-required'=> __('labels.This field is required'),
            ])!!}
        </div>
    </td>
    <!-- hidden field to detect cash Book entry -->
    {!! Form::hidden('cash_book_entries[is_cash_book_entry]', '1') !!}
    <td class="col-8">
    </td>
</tr>
