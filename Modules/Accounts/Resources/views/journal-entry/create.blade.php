@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.title'))
@section('content')
    {!! Form::open(['route' =>  'journal.entry.store', 'class' => 'form journal-entry-form']) !!}
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('accounts::journal-entry.form')
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')

    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/journal-entry/journal-entry.js') }}"></script>

    <script>
        $(document).ready(function () {
            InitAllDropDown();
            makeSaveButtonToggle(true);
            changeEmployeeDropdownVisibility(false);
        });

        $('input[name=advance_entry]').on('ifClicked', function () {
            if ($(this).is(":checked")) {
                changeEmployeeDropdownVisibility(false)
            } else {
                changeEmployeeDropdownVisibility(true);
            }
        });

        let source = @json(Config('constants.journal_entry.source'));
        let transactionType = @json(Config('constants.journal_entry.account_transaction_type'));
        // let sourceKeyArray = Object.keys(source);   // Source= [local,revenue]
        // let transactionTypeKeyArray = Object.keys(transactionType);    // TransactionType = ['receipt','payment']

        let journalItemsRepeater = $(`.repeater-journal-items`).repeater({
            show: function () {
                InitAllDropDown();
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    let obj = $(this).repeaterVal().journal_entries[0];
                    let entryType = obj.entry_type_id;
                    let removedAmount = 0;
                    let totalAmount = 0;
                    if (entryType == transactionType[0]) {     // if receipt
                        removedAmount = parseInt(obj.credit_amount);
                        totalAmount = getBalance() + removedAmount;
                    } else {
                        removedAmount = parseInt(obj.debit_amount);
                        totalAmount = getBalance() - removedAmount;
                    }
                    setBalance(totalAmount);
                    $(this).slideUp(deleteElement);
                }
            },
            defaultValues: {
                'source': 'local',
                'entry_type_id': 0,
                'debit_amount': 0,
                'credit_amount': 0,
                'is_cash_book_entry': '0',
            },
            isFirstItemUndeletable: true
        });

        //date picker init
        $('input[name=date]').pickadate({
            format: 'yyyy-mm-dd',
            drops: 'up',
        });

        $('.receipt-payment-select').change(function () {
            let val = $(this).val();
            if (val == 0) {
                return;
            }
            makeSaveButtonToggle(false);
            let element = getLastTableRow();
            if (!$(element).attr("readonly")) {
                $('#custom-repeater-add')[0].click();
            }
            // modify last select element
            element = getLastTableRow();
            let indexNumber = getNumberFromString($(element).prop('name'));
            modifyLastSelectElement(indexNumber, val);
            makeLastDescriptionDisable(indexNumber);
            $(getLastTableHeader()).hide();
            makeRepeaterDeleteHidden();
            toggleCashBookEntryFlag(true, indexNumber);
            // set last balance
            let balance = Math.abs(getBalance());
            setBalance(0);
            if (val == transactionType[0]) {  // if its receipt  -- then for final transaction --> then debit
                $('input[name="journal_entries[' + indexNumber + '][debit_amount]"]').val(balance);
                $('input[name="journal_entries[' + indexNumber + '][credit_amount]"]').val(0);
            } else {                          // if its payment -- then for final transaction ---> then credit
                $('input[name="journal_entries[' + indexNumber + '][credit_amount]"]').val(balance);
                $('input[name="journal_entries[' + indexNumber + '][debit_amount]"]').val(0);
            }
        });

        // debit and credit amount check
        $('.journal-entry-form').on('submit', function () {
            let debitValue = calculateDebitAmount();
            let creditValue = calcualateCreditAmount();
            // Checking if any of the debit amount is exceeding the limit
            let $overflow = false;
            let $debitLength = $('.debit-amount').length;
            $('.debit-amount').each(function (index, value) {
                if (index < ($debitLength - 1)) {
                    $debitAmount = $(this).prop('name');
                    $economyCode = $("input[name='" + $debitAmount.replace('debit_amount', 'economy_code') + "'");
                    $debitMax = $("input[name='" + $debitAmount.replace('debit_amount', 'debit_max') + "'");
                    if ($(this).val() != 0 && parseFloat($(this).val()) > parseFloat($debitMax.val())) {
                        $(this).css('border', '1px solid red');
                        $overflow = true;
                    }
                }
            });
            if ($overflow == true) {
                alert("{{__('accounts::journal.validation.each_debit_overflow')}}");
                return false;
            }
            if (parseInt(debitValue) != parseInt(creditValue)) {
                alert('Debit and Credit Amount Should Match');
                return false;
            }
            // if all the validation is passed, show a confirmation alert
            if (confirm('Are you sure ?')) {
                return true;
            } else {
                return true;
            }

        });

        function expenseLimit(name) {
            $code = $("select[name='" + name + "']");
            let $debitAmount = $("input[name='" + name.replace('economy_code', 'debit_amount') + "'");
            let $debitMessage = $("input[name='" + name.replace('economy_code', 'debit_message') + "'");
            let $debitMax = $("input[name='" + name.replace('economy_code', 'debit_max') + "'");
            $.ajax({
                url: '{{url('accounts/journals/get-expense-limit')}}/' + $code.val() + '/' + $('#fiscal_year_id').val(),
                type: 'get',
                dataType: 'text',
                success: function (data) {
                    $debitMax.val(data);
                    $debitAmount.attr('max', data);
                },
                complete: function () {
                    if ($debitAmount.is('[readonly]')) {
                        $debitMessage.val('');
                    }
                }
            });
        }

        function checkExpenseLimit(itemName) {
            $item = $("input[name='" + itemName + "']");
            let $debitMax = $("input[name='" + itemName.replace('debit_amount', 'debit_max') + "'");
            let $debitMessage = $("input[name='" + itemName.replace('debit_amount', 'debit_message') + "'");
            if ($item.val() != "" && parseFloat($item.val()) > parseFloat($debitMax.val())) {
                alert("{{__('accounts::journal.validation.debit_overflow')}}");
                $debitMessage.val('Maximum: ' + $debitMax.val());
                $item.focus();
                $item.val($debitMax.val());
                calculateBalance();
            }
        }
    </script>

@endpush
