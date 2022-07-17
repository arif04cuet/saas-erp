<h4><i
        class="la la-tag"></i>@lang('accounts::journal.entry.title')</h4>

<div class="col">
    <div class="row tms-journal-entry-repeater">
        <div class="table-responsive">
            <table class="master table table-bordered text-center table-responsive-lg repeater-journal-items">
                <thead>
                <tr class="d-flex">
                    <th class="col-2">@lang('labels.remarks')</th>
                    <th class="col-2">@lang('accounts::journal.entry.detail.transaction_type.title')</th>
                    <th class="col-3">@lang('tms::tms_journal_entry.journal_entry_details.form_elements.tms_code')</th>
                    <th class="col-2">@lang('accounts::journal.entry.debit')</th>
                    <th class="col-2">@lang('accounts::journal.entry.credit')</th>
                    <th class="col-2">@lang('tms::tms_journal_entry.journal_entry_details.form_elements.vat')</th>
                    <th class="col-2">@lang('tms::tms_journal_entry.journal_entry_details.form_elements.tax')</th>
                    <th class="col-3">@lang('tms::tms_journal_entry.journal_entry_details.form_elements.employee')</th>
                    <th class="col-1" id="custom-repeater-add" data-repeater-create width="1%"><i
                            class="la la-plus-circle text-info"
                            style="cursor: pointer"></i>
                    </th>
                </tr>
                </thead>
                <tbody data-repeater-list="tms_journal_entries">
                @if(old('tms_journal_entries') && old('cash_book_entries'))
                    @include('tms::accounts.journal-entry.partial.old-repeater-row');
                @else
                    <tr data-repeater-item class="d-flex">
                        <!-- description -->
                        <td class="col-2">
                            <div class="form-group">
                                {!! Form::text('remark', null,
                                        [
                                            'class' => 'form-control form-control-sm text-remark',
                                            'data-rule-maxlength' => 50
                                        ])
                                !!}
                            </div>
                        </td>
                        <!--  Transaction type -->
                        <td class="col-2">
                            <div class="form-group">
                                {!! Form::select('transaction_type',
                                       $transactionTypes,
                                       null,
                                       [
                                           'class' => "form-control form-control-sm transaction-select required",
                                           'placeholder'=>trans('labels.select'),
                                           'onchange'=>'getElement(this)',
                                           'data-msg-required'=> __('labels.This field is required'),
                                       ]
                                    )
                                !!}
                            </div>
                        </td>
                        <!-- sub-sector-code dropdown -->
                        <td class="col-3">
                            <div class="form-group">
                                {!! Form::select('tms_sub_sector_id',
                                        $tmsSubSectors,
                                        null,
                                        ['class' => "form-control form-control-sm sub-sector-select required select2",
                                         'data-msg-required'=> trans('labels.This field is required'),
                                         'placeholder'=> trans('labels.select'),
                                         'onchange'=>'addMaxValidationToCredit(this)'
                                        ]
                                     )
                            !!}
                            </div>
                        </td>

                        <!-- Debit Amount -->
                        <td class="col-2">
                            <div class="form-group">
                                {!! Form::number('debit_amount', 0,[
                                           'class' => 'form-control form-control-sm debit-amount required',
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
                                {!! Form::number('credit_amount', 0,[
                                            'class' => 'form-control form-control-sm credit-amount required',
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
                                {!! Form::number('vat_amount', 0,[
                                            'class' => 'form-control form-control-sm vat-amount required',
                                            'min'=>0,
                                            'max'=>99999,
                                            'onchange'=>"adjustVatAndTaxAmount(this)",
                                            'data-msg-required'=> __('labels.This field is required')
                                ])!!}
                            </div>
                        </td>
                        <!-- Tax Amount -->
                        <td class="col-2">
                            <div class="form-group">
                                {!! Form::number('tax_amount', 0,[
                                            'class' => 'form-control form-control-sm tax-amount required',
                                            'min'=>0,
                                            'max'=>99999,
                                            'onchange'=>"adjustVatAndTaxAmount(this)",
                                            'data-msg-required'=> __('labels.This field is required')
                                ])!!}
                            </div>
                        </td>
                        <!-- Employee dropdown-->
                        <td class="col-3">
                            <div class="form-group">
                                {!! Form::select('employee_id',
                                        $employees ?? [],
                                        null,
                                        ['class' => "form-control form-control-sm employee-select  select2",
                                         'placeholder'=> trans('labels.select'),
                                        ]
                                     )
                            !!}
                            </div>
                        </td>

                        <!-- hidden field to detect cash Book entry -->
                        {!! Form::hidden('is_cash_book_entry', '0') !!}
                        <td class="col-1"><i data-repeater-delete class="la la-trash-o text-danger"
                                             style="cursor: pointer"></i></td>
                    </tr>
                </tbody>
                <tfoot class="table table-hover bg-accent-2">
                @include('tms::accounts.journal-entry.cash-bank-entry-form')
                </tfoot>
                @endif

            </table>
            <button type="button" data-repeater-create class="master btn btn-sm btn-primary mb-1">
                <i class="ft-plus"
                   style="cursor: pointer">
                </i>@lang('labels.add')
            </button>
        </div>
    </div>
</div>
