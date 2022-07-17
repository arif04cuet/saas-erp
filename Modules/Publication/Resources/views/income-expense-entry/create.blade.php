@extends('publication::layouts.master')
@section('title', trans('accounts::journal.title'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('labels.create') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @include('publication::income-expense-entry.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
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

    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- custom -->
    <script src="{{ asset('js/publication-accounts/journal-entry.js') }}"></script>
    <script>
        const placeholder = @json(trans('labels.select'));
        $(document).ready(function() {
            initAllRepeater('.publication-journal-entry-repeater');
            validateForm('.publication-journal-entry-form');
            $('input[name="date"]').pickadate({
                format: 'yyyy-mm-dd',
                drops: 'up',
            });
            makeDropdownNotSelectable();

        });

        function expenseLimit(name) {
            $code = $("select[name='" + name + "']");
            let $debitAmount = $("input[name='" + name.replace('economy_code', 'debit_amount') + "'");
            let $debitMessage = $("input[name='" + name.replace('economy_code', 'debit_message') + "'");
            let $debitMax = $("input[name='" + name.replace('economy_code', 'debit_max') + "'");
            $.ajax({
                url: '{{ url('accounts/journals/get-expense-limit') }}/' + $code.val() + '/0/' + $('#date')
                    .val(),
                type: 'get',
                dataType: 'text',
                success: function(data) {
                    $debitMax.val(data);
                    $debitAmount.attr('max', data);
                },
                complete: function() {
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
                alert("{{ __('accounts::journal.validation.debit_overflow') }}");
                $debitMessage.val('Maximum: ' + $debitMax.val());
                $item.focus();
                $item.val($debitMax.val());
                calculateBalance();
            }
        }
    </script>
@endpush
