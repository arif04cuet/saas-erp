<!-- Card Header -->
<div class="card-header">
    <h4 class="card-title">{{ trans('labels.create') }}</h4>
    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
</div>

<div class="card-content collapse show">
    <div class="card-body">

        <div id="invoice-items-details" class="">
            <h4 class="form-section"><i
                    class="la la-tag"></i>@lang('accounts::accounts.general_information')</h4>

            <!-- Date  and  Journal Dropdown -->
            <div class="row">
                <!-- Date  -->
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('date', trans('labels.date'), ['class' => 'form-label required']) !!}
                        {{ Form::text('date', date('Y-m-d'), ['class' => 'form-control']) }}
                    </div>
                    <!-- error message -->
                    @if ($errors->has('date'))
                        <div class="help-block text-danger">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                </div>

                <!-- Journal -->
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('journal', trans('accounts::journal.title'), ['class' => 'form-label']) !!}
                        {!! Form::select('journal_id', $journals, null,
                        ['class' => "form-control dropdown-select", "placeholder" => trans('ims::location.department'),
                        ]) !!}
                        <div class="help-block"></div>
                    </div>
                </div>
            </div>

            <!-- Reference and Fiscal Year Dropdown -->
            <div class="row">
                <!-- Reference -->
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('reference', trans('accounts::journal.entry.reference'), ['class' => 'form-label required']) !!}
                        {!! Form::text('reference', null,
                        ['class' => "form-control", "required", "placeholder" => trans('accounts::journal.entry.reference'),
                        'data-rule-maxlength' => 100,  'data-msg-required' => Lang::get('labels.This field is required'),
                        ]) !!}
                        <div class="help-block"></div>

                        <!-- error message -->
                        @if ($errors->has('reference'))
                            <div class="help-block text-danger">
                                {{ $errors->first('reference') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Fiscal Year -->
                <div class="col-6">
                    <div class="form-group">
                        {!! Form::label('fiscal_year_id',trans('accounts::fiscal-year.title'), ['class' => 'form-label']) !!}
                        {!! Form::select('fiscal_year_id', $fiscalYears, null,
                        [
                            'class' => "form-control dropdown-select"
                        ]) !!}
                        <div class="help-block"></div>

                        <!-- error message -->
                        @if ($errors->has('fiscal_year_id'))
                            <div class="help-block text-danger">
                                {{ $errors->first('fiscal_year_id') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
            {{--                <!-- Advanced Payment Checkbox -->--}}
            {{--                <div class="col-6">--}}
            {{--                    <div class="row icheck-checkbox">--}}
            {{--                        <div class="col-md-12">--}}
            {{--                            <div class="skin skin-flat">--}}
            {{--                                <fieldset>--}}
            {{--                                    {!!--}}
            {{--                                        Form::label('advance_payment',--}}
            {{--                                        trans('accounts::journal.entry.table.advance_payment'))--}}
            {{--                                    !!}--}}
            {{--                                    {!! Form::checkbox('advance_payment',null)!!}--}}
            {{--                                </fieldset>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            <!-- Advance Payment Radio Buttons  -->
                <div class="form-group col-md-6 col-xl-6">
                    <label
                        class="">@lang('accounts::journal.entry.advance_payment.title')</label>
                    <div class="row">
                        <!--  Advance Payment -->
                        <div class="col-md-auto">
                            <div class="skin skin-flat">
                                {!! Form::radio('advance_entry', 'advance_payment',null, ['class' => 'required']) !!}
                                <label
                                    for="advance_entry">
                                    @lang('accounts::journal.entry.advance_payment.radio_button.payment')
                                </label>
                            </div>
                        </div>
                        <!-- Payment Adjustment -->
                        <div class="col-md-auto">
                            <div class="skin skin-flat">
                                {!! Form::radio('advance_entry', 'advance_adjustment', null, ['class' => 'required']) !!}
                                <label
                                    for="advance_entry">
                                    @lang('accounts::journal.entry.advance_payment.radio_button.adjustment')
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Dropdown  -->
                <div class="col-6">
                    <div class="form-group employee-dropdown">
                        {!! Form::label('employee_id', trans('accounts::journal.entry.table.employee'),
                            ['class' => 'form-label'])
                        !!}
                        {!! Form::select('employee_id', $employees, null,
                        [
                            'class' => "form-control dropdown-select", "placeholder" => trans('accounts::journal.entry.table.employee'),
                        ])
                        !!}
                        <div class="help-block"></div>
                        <!-- error message -->
                        @if ($errors->has('fiscal_year_id'))
                            <div class="help-block text-danger">
                                {{ $errors->first('fiscal_year_id') }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <!-- Journal Items Details -->
            <h4 class="form-section"><i
                    class="la la-tag"></i>@lang('accounts::journal.entry.title')</h4>
            <div class="row">
                <div class="table-responsive col-sm-12">
                    <table class="table table-bordered text-center repeater-journal-items">
                        <thead>

                        <tr>
                            <th>@lang('accounts::journal.entry.detail.source.title')</th>
                            <th>@lang('accounts::journal.entry.detail.transaction_type.title')</th>
                            <th>{{trans('accounts::accounts.title')}}</th>
                            <th>{{trans('accounts::configuration.journal.description')}}</th>
                            <th>@lang('accounts::journal.entry.debit')</th>
                            <th>@lang('accounts::journal.entry.credit')</th>
                            <th id="custom-repeater-add" data-repeater-create width="1%"><i
                                    class="la la-plus-circle text-info"
                                    style="cursor: pointer"></i>
                            </th>
                        </tr>

                        </thead>
                        <tbody data-repeater-list="journal_entries">
                        <tr data-repeater-item>
                            <!-- Source Dropdown -->
                            <td width="10%">
                                {!! Form::select('source',
                                            $accountTransactionSources,
                                            null,
                                            [
                                                'class' => "form-control", "required",
                                            ]
                                         )
                                !!}
                            </td>
                            <!-- Account transaction type -->
                            <td width="10%">
                                {!! Form::select('account_transaction_type',
                                            $accountTransactionTypes,
                                            null,
                                            [
                                                'class' => "form-control transaction-select", "required",
                                                'onchange'=>"getEntryIndex(this)",
                                                'placeholder'=>trans('labels.select')
                                            ]
                                         )
                                !!}
                            </td>
                            <!-- account dropdown -->
                            <td width="20%">

                                {!! Form::select('economy_code',
                                                $economyCodes,
                                                null,
                                                ['class' => "form-control account-dropdown-select ",
                                                "required",
                                                'onchange' => 'expenseLimit(this.name)'
                                                ]
                                             )
                                    !!}
                            </td>

                            <!-- description -->
                            <td width="20%"> {!! Form::text('remark', null,['class' => 'form-control'])!!}</td>

                            <!-- Debit Amount -->
                            <td width="20%">
                                {!! Form::number('debit_amount', 0,[
                                                'class' => 'form-control debit-amount',
                                                'readonly',
                                                'min'=>0,
                                                'max' => 0,
                                                'onkeyup' => 'calculateBalance()',
                                                'onblur' => 'checkExpenseLimit(this.name)',
                                ])!!}
                                <input type="number" class="hidden" name="debit_max">
                                <input type="text" style="border: 0" class="warning" readonly
                                       name="debit_message">
                            </td>

                            <!-- Credit Amount -->
                            <td width="20%">
                                {!! Form::number('credit_amount', 0,[
                                            'class' => 'form-control credit-amount',
                                            'readonly',
                                            'min'=>0,
                                            'onkeyup'=>"calculateBalance()"
                                ])!!}
                            </td>
                            <!-- hidden field to detect cash Book entry -->
                            {!! Form::hidden('is_cash_book_entry', '0') !!}

                            <td><i data-repeater-delete class="la la-trash-o text-danger"
                                   style="cursor: pointer"></i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Journal Item Details -->
            <h4 class="form-section"><i
                    class="la la-tag"></i>@lang('accounts::journal.entry.cash_bank_entry')</h4>
            <div class="row">

                <!-- Final Account transaction type  -->
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('receipt_and_payment_id',
                              trans('accounts::journal.entry.detail.transaction_type.title')
                                ,['class' => 'form-label'])
                        !!}
                        {!! Form::select('receipt_and_payment_id',
                                    $accountTransactionTypes,
                                    null,
                                    [
                                        'class' => "form-control receipt-payment-select ",
                                         'data-repeater-create',
                                         'placeholder'=>trans('labels.select'),
                                    ]
                        )!!}
                        <div class="help-block"></div>
                    </div>
                </div>

                <!-- Final Payment type  -->
                <div class="col-4">
                    <div class="form-group">
                        {!! Form::label('payment_type',
                              trans('accounts::journal.entry.detail.payment_type.title'),
                              ['class' => 'form-label'])
                        !!}
                        {!! Form::select('payment_type',
                                    $paymentTypes,
                                    null,
                                    [
                                        'class' => "form-control",
                                    ]
                        )!!}
                        <div class="help-block"></div>
                    </div>
                </div>

                <!-- balance integer field -->
                <div class="col-4">
                    {!! Form::label('balance', trans('accounts::journal.entry.balance'),
                            ['class' => 'form-label'])
                     !!}
                    {!! Form::number('balance', 0,['class' => 'form-control','readonly'])!!}
                </div>


            </div>
        </div>

        <!-- Save & Cancel Button -->
        <div class="form-actions text-center">
            <button type="submit" class="btn btn-success">
                <i class="la la-check-square-o"></i>@lang('labels.save')
            </button>
            <a class="btn btn-warning mr-1" role="button" href="{{route('journal.entry.index')}}">
                <i class="ft-x"></i> @lang('labels.cancel')
            </a>
        </div>
    </div>
</div>
