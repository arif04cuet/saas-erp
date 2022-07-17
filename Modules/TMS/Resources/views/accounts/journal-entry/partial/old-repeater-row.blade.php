
@foreach(old('tms_journal_entries') as $tmsJournalEntry)

    <tr data-repeater-item class="d-flex">
        <!--description -->
        <td class="col-2">
            <div class="form-group">
            {!! Form::text('remark', $tmsJournalEntry['remark'],
                    [
                        'class' => 'form-control text-remark',
                        'data-rule-maxlength' => 50
                    ])
            !!}
            <!-- error message -->
                @if ($errors->has('tms_journal_entries'.$loop->index.'remark'))
                    <div class="help-block text-danger">
                        {{ $errors->first('tms_journal_entries'.$loop->index.'remark') }}
                    </div>
                @endif
            </div>
        </td>
        <!--  Transaction type -->
        <td class="col-2">
            <div class="form-group">
            {!! Form::select('transaction_type',
                   $transactionTypes,
                   $tmsJournalEntry['transaction_type'],
                   [
                       'class' => "form-control transaction-select required",
                       'placeholder'=>trans('labels.select'),
                       'onchange'=>'getElement(this)',
                       'data-msg-required'=> __('labels.This field is required'),
                   ]
                )
            !!}
            <!-- error message -->
                @if ($errors->has('tms_journal_entries.'.$loop->index.'.transaction_type'))
                    <div class="help-block text-danger">
                        {{ $errors->first('tms_journal_entries.'.$loop->index.'.transaction_type') }}
                    </div>
                @endif
            </div>
        </td>
        <!-- sub-sector-code dropdown -->
        <td class="col-3">
            <div class="form-group">
            {!! Form::select('tms_sub_sector_id',
                    $tmsSubSectors,
                    $tmsJournalEntry['tms_sub_sector_id'],
                    ['class' => "form-control sub-sector-select required select2",
                     'data-msg-required'=> trans('labels.This field is required'),
                     'placeholder'=> trans('labels.select'),
                     'onchange'=>'addMaxValidationToCredit(this)'
                    ]
                 )
            !!}
            <!-- error message -->
                @if ($errors->has('tms_journal_entries'.$loop->index.'tms_sub_sector_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('tms_journal_entries'.$loop->index.'tms_sub_sector_id') }}
                    </div>
                @endif
            </div>
        </td>
        <!-- Debit Amount -->
        <td class="col-2">
            <div class="form-group">
                {!! Form::number('debit_amount', $tmsJournalEntry['debit_amount'],[
                           'class' => 'form-control debit-amount required',
                           'readonly',
                           'min'=>0,
                           'onkeyup'=>"calculateBalance()",
                           'data-msg-required'=> __('labels.This field is required'),
                ])!!}
            </div>
        </td>
        <!-- Credit Amount -->
        <td class="col-2">
            <div class="form-group">
                {!! Form::number('credit_amount', $tmsJournalEntry['credit_amount'],[
                            'class' => 'form-control credit-amount required',
                            'readonly',
                            'min'=>0,
                            'onkeyup'=>"calculateBalance()",
                            'data-msg-required'=> __('labels.This field is required')
                ])!!}
            </div>
        </td>
        <!-- Vat Amount -->
        <td class="col-2">
            <div class="form-group">
                {!! Form::number('vat_amount', $tmsJournalEntry['vat_amount'],[
                            'class' => 'form-control vat-amount required',
                            'min'=>0,
                            'max'=>99999,
                            'data-msg-required'=> __('labels.This field is required')
                ])!!}
            </div>
        </td>
        <!-- Tax Amount -->
        <td class="col-2">
            <div class="form-group">
                {!! Form::number('tax_amount', $tmsJournalEntry['tax_amount'],[
                            'class' => 'form-control tax-amount required',
                            'min'=>0,
                            'max'=>99999,
                            'data-msg-required'=> __('labels.This field is required')
                ])!!}
            </div>
        </td>
        <!-- Employee dropdown-->
        <td class="col-3">
            <div class="form-group">
                {!! Form::select('employee_id',
                        $employees ?? [],
                        $tmsJournalEntry['employee_id'],
                        ['class' => "form-control employee-select  select2",
                         'placeholder'=> trans('labels.select'),
                        ]
                     )
            !!}
            </div>
        </td>

        <!-- hidden field to detect cash Book entry -->
        {!! Form::hidden('is_cash_book_entry', $tmsJournalEntry['is_cash_book_entry']) !!}
        <td class="col-1"><i data-repeater-delete class="la la-trash-o text-danger"
                             style="cursor: pointer"></i></td>
    </tr>

    @endforeach

    @foreach(old('cash_book_entries') as $tmsJournalEntry)
    </tbody>
    <tfoot class="table table-hover bg-accent-2">
    @include('tms::accounts.journal-entry.cash-bank-entry-form')
    </tfoot>
@endforeach




