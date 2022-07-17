<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::journal.entry.title')</h4>

<div class="col">
    <div class="row hm-journal-entry-repeater">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-responsive-lg repeater-journal-items">
                <thead>
                    <tr class="d-flex">
                        <th class="col-3">@lang('labels.remarks')</th>
                        <th class="col-2">@lang('accounts::journal.entry.detail.transaction_type.title')</th>
                        <th class="col-3">@lang('hm::hostel_budget.section')</th>
                        <th class="col-2">@lang('accounts::journal.entry.debit')</th>
                        <th class="col-2">@lang('accounts::journal.entry.credit')</th>
                        <th class="col-1" id="custom-repeater-add" data-repeater-create width="1%"><i
                                class="la la-plus-circle text-info" style="cursor: pointer"></i>
                        </th>
                    </tr>
                </thead>
                <tbody data-repeater-list="hm_journal_entries">
                    @if (old('hm_journal_entries')->count())
                        @include('hm::accounts.journal-entry.form.old-form-repeater');
                    @else
                        <tr data-repeater-item class="d-flex">
                            <!-- description -->
                            <td class="col-3">
                                <div class="form-group">
                                    {!! Form::text('remark', null, [
                                        'class' => 'form-control form-control-sm text-remark',
                                        'data-rule-maxlength' => 50,
                                    ]) !!}
                                </div>
                            </td>
                            <!--  Transaction type -->
                            <td class="col-2">
                                <div class="form-group">
                                    {!! Form::select('transaction_type', $transactionTypes ?? [], null, [
                                        'class' => 'form-control form-control-sm transaction-select required',
                                        'placeholder' => trans('labels.select'),
                                        'onchange' => 'getElement(this)',
                                        'data-msg-required' => __('labels.This field is required'),
                                    ]) !!}
                                </div>
                            </td>
                            <!-- hostel-section dropdown -->
                            <td class="col-3">
                                <div class="form-group">
                                    {!! Form::select('hostel_budget_section_id', $hostelBudgetSections ?? [], null, ['class' => 'form-control form-control-sm select-hostel-section required select2', 'data-msg-required' => trans('labels.This field is required'), 'placeholder' => trans('labels.select'), 'onchange' => 'addMaxValidationToCredit(this)']) !!}
                                </div>
                            </td>
                            <!-- Debit Amount -->
                            <td class="col-2">
                                <div class="form-group">
                                    {!! Form::number('debit_amount', 0, [
                                        'class' => 'form-control form-control-sm debit-amount required',
                                        'readonly',
                                        'min' => 0,
                                        'max' => 999999999,
                                        'data-rule-number' => true,
                                        'data-msg-number' => trans('labels.Please enter a valid number'),
                                        'data-msg-max' => __('labels.max_validate_equal_or_less', ['max' => 999999999]),
                                        'data-msg-min' => __('labels.min_validate_equal_or_greater', ['min' => 0]),
                                        'onkeyup' => 'calculateBalance()',
                                        'data-msg-required' => __('labels.This field is required'),
                                    ]) !!}
                                </div>
                            </td>
                            <!-- Credit Amount -->
                            <td class="col-2">
                                <div class="form-group">
                                    {!! Form::number('credit_amount', 0, [
                                        'class' => 'form-control form-control-sm credit-amount required',
                                        'readonly',
                                        'min' => 0,
                                        'max' => 999999999,
                                        'data-rule-number' => true,
                                        'data-msg-number' => trans('labels.Please enter a valid number'),
                                        'data-msg-max' => __('labels.max_validate_equal_or_less', ['max' => 999999999]),
                                        'data-msg-min' => __('labels.min_validate_equal_or_greater', ['min' => 0]),
                                        'onkeyup' => 'calculateBalance()',
                                        'data-msg-required' => __('labels.This field is required'),
                                    ]) !!}
                                </div>
                            </td>
                            <!-- hidden field to detect cash Book entry -->
                            {!! Form::hidden('is_cash_book_entry', '0') !!}
                            <td class="col-1"><i data-repeater-delete class="la la-trash-o text-danger"
                                    style="cursor: pointer"></i></td>
                        </tr>
                    @endif

                </tbody>
                <tfoot class="table table-hover bg-accent-2">
                    @include('hm::accounts.journal-entry.form.cash-bank-entry-form')
                </tfoot>
            </table>
            <button type="button" data-repeater-create class="master btn btn-sm btn-primary mb-1">
                <i class="ft-plus" style="cursor: pointer">
                </i>@lang('labels.add')
            </button>
        </div>
    </div>
</div>
