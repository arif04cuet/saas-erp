<h4 class="form-section"><i class="la la-tag"></i>@lang('labels.details')</h4>

<div class="col">
    <div class="row publication-journal-entry-repeater">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-responsive-lg repeater-journal-items">
                <thead>
                    <tr class="d-flex">
                        <th class="col-3">@lang('labels.remarks')</th>
                        <th class="col-2">@lang('accounts::journal.entry.detail.transaction_type.title')</th>
                        <th class="col-3">@lang('accounts::accounts.title')</th>
                        <th class="col-2">@lang('accounts::journal.entry.debit')</th>
                        <th class="col-2">@lang('accounts::journal.entry.credit')</th>
                        <th class="col-1" id="custom-repeater-add" data-repeater-create width="1%"><i
                                class="la la-plus-circle text-info" style="cursor: pointer"></i>
                        </th>
                    </tr>
                </thead>
                <tbody data-repeater-list="publication_journal_entries">
                    <tr data-repeater-item class="d-flex">
                        <!-- description -->
                        <td class="col-3">
                            <div class="form-group">
                                {!! Form::text('remark', null, [
    'class' => 'form-control text-remark',
    'data-rule-maxlength' => 50,
    'placeholder' => trans('labels.remarks'),
]) !!}
                            </div>
                        </td>

                        <!--  Transaction type -->
                        <td class="col-2">
                            <div class="form-group">
                                {!! Form::select('account_transaction_type', $accountTransactionTypes, null, [
    'class' => 'form-control transaction-select required',
    'placeholder' => trans('labels.select'),
    'onchange' => 'getElement(this)',
    'data-msg-required' => __('labels.This field is required'),
]) !!}
                            </div>
                        </td>
                        <!-- sub-sector-code dropdown -->
                        <td class="col-3">
                            <div class="form-group">
                                {!! Form::select('economy_code', $economyCodes, null, ['class' => 'form-control sub-sector-select required select2', 'data-msg-required' => trans('labels.This field is required'), 'onchange' => 'expenseLimit(this.name)']) !!}
                            </div>
                        </td>
                        <!-- Debit Amount -->
                        <td class="col-2">
                            <div class="form-group">
                                {!! Form::number('debit_amount', 0, [
    'class' => 'form-control debit-amount required',
    'readonly',
    'min' => 0,
    'max' => 0,
    'onkeyup' => 'calculateBalance()',
    'data-msg-required' => __('labels.This field is required'),
    'onblur' => 'checkExpenseLimit(this.name)',
]) !!}
                                <input type="number" class="hidden" name="debit_max">
                                <input type="text" style="border: 0" class="warning" readonly name="debit_message">
                            </div>
                        </td>
                        <!-- Credit Amount -->
                        <td class="col-2">
                            <div class="form-group">
                                {!! Form::number('credit_amount', 0, [
    'class' => 'form-control credit-amount required',
    'readonly',
    'min' => 0,
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
                </tbody>
                <tfoot class="table table-hover bg-accent-2">
                    @include('publication::income-expense-entry.cash-bank-entry-form')
                </tfoot>
            </table>
            <button type="button" data-repeater-create class="btn btn-sm btn-primary ">
                <i class="ft-plus" style="cursor: pointer">
                </i>@lang('labels.add')
            </button>
        </div>
    </div>
</div>
