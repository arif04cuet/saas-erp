<!-- todo:: for each repeater item -->

@foreach(old('hm_journal_entries') as $hmJournalEntry)

    <tr data-repeater-item class="d-flex">

        <!--description -->
        <td class="col-3">
            <div class="form-group">
            {!! Form::text('remark', $hmJournalEntry['remark'],
                    [
                        'class' => 'form-control text-remark',
                        'data-rule-maxlength' => 50
                    ])
            !!}
            <!-- error message -->
                @if ($errors->has('hm_journal_entries'.$loop->index.'remark'))
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
                   $hmJournalEntry['transaction_type'],
                   [
                       'class' => "form-control transaction-select required",
                       'placeholder'=>trans('labels.select'),
                       'onchange'=>'getElement(this)',
                       'data-msg-required'=> __('labels.This field is required'),
                   ]
                )
            !!}
            <!-- error message -->
                @if ($errors->has('hm_journal_entries.'.$loop->index.'.transaction_type'))
                    <div class="help-block text-danger">
                        {{ $errors->first('hm_journal_entries.'.$loop->index.'.transaction_type') }}
                    </div>
                @endif
            </div>
        </td>
        <!-- sub-sector-code dropdown -->
        <td class="col-3">
            <div class="form-group">
            {!! Form::select('hostel_budget_section_id',
                    $hostelBudgetSections,
                    $hmJournalEntry['hostel_budget_section_id'],
                    ['class' => "form-control sub-sector-select required select2",
                     'data-msg-required'=> trans('labels.This field is required'),
                     'placeholder'=> trans('labels.select'),
                     'onchange'=>'addMaxValidationToCredit(this)'
                    ]
                 )
            !!}
            <!-- error message -->
                @if ($errors->has('hm_journal_entries'.$loop->index.'hostel_budget_section_id'))
                    <div class="help-block text-danger">
                        {{ $errors->first('hm_journal_entries'.$loop->index.'hostel_budget_section_id') }}
                    </div>
                @endif
            </div>
        </td>
        <!-- Debit Amount -->
        <td class="col-2">
            <div class="form-group">
            {!! Form::number('debit_amount', $hmJournalEntry['debit_amount'],[
                       'class' => 'form-control debit-amount required',
                       'readonly',
                       'min'=>0,
                       'max'=>999999999,
                       'data-rule-number'=>true,
                       'data-msg-number'=> trans('labels.Please enter a valid number'),
                       'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                       'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                       'onkeyup'=>"calculateBalance()",
                       'data-msg-required'=> __('labels.This field is required'),
            ])!!}

            <!-- error message -->
                @if ($errors->has('hm_journal_entries'.$loop->index.'debit_amount'))
                    <div class="help-block text-danger">
                        {{ $errors->first('hm_journal_entries'.$loop->index.'debit_amount') }}
                    </div>
                @endif
            </div>
        </td>
        <!-- Credit Amount -->
        <td class="col-2">
            <div class="form-group">
            {!! Form::number('credit_amount', $hmJournalEntry['credit_amount'],[
                        'class' => 'form-control credit-amount required',
                        'readonly',
                        'min'=>0,
                        'max'=>999999999,
                        'data-rule-number'=>true,
                        'data-msg-number'=> trans('labels.Please enter a valid number'),
                        'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                        'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                        'onkeyup'=>"calculateBalance()",
                        'data-msg-required'=> __('labels.This field is required')
            ])!!}

            <!-- error message -->
                @if ($errors->has('hm_journal_entries'.$loop->index.'credit_amount'))
                    <div class="help-block text-danger">
                        {{ $errors->first('hm_journal_entries'.$loop->index.'credit_amount') }}
                    </div>
                @endif
            </div>
        </td>
        <!-- hidden field to detect cash Book entry -->
        {!! Form::hidden('is_cash_book_entry', $hmJournalEntry['is_cash_book_entry']) !!}
        <td class="col-1"><i data-repeater-delete class="la la-trash-o text-danger"
                             style="cursor: pointer"></i></td>
    </tr>

@endforeach

