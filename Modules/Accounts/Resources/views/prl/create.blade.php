@extends('accounts::layouts.master')
@section('title', trans('accounts::prl.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('accounts::prl.form')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::prl.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script>
        // global variables
        let selectPlaceholder = '{!! trans('labels.select') !!}';
        $(document).ready(function () {
            setEmployeeSelect2();
            $('.employee-select').on('change', function () {
                let employeeId = $(this).find('option:selected').val().trim();
                setEmployeeData(employeeId);
            });
        });

        function setEmployeeSelect2() {
            $('.employee-select').val('select').select2({  // select2 initialization
                placeholder: selectPlaceholder,
            });
        }

        function setEmployeeData(employeeId) {
            let url = '{{route('prl.json.show',":id")}}';
            url = url.replace(":id", employeeId);
            $.get(url, function (data) {
                setSalaryField(data.basic_salary);
                setEligibleMonthField(data.eligible_month);
                setDateField(data.start_date, data.end_date);
                setTotalAmount();
            });
        }

        function setSalaryField(salary) {
            let basicSalaryField = $('#basic_salary');
            basicSalaryField.val(salary);
        }

        function setEligibleMonthField(month) {
            let eligibleMonthField = $('#eligible_month');
            eligibleMonthField.val(month);
        }

        function setTotalAmount() {
            let basicSalary = parseInt($('#basic_salary').val());
            let eligibleMonth = parseInt($('#eligible_month').val());
            let totalAmount = $('#total_amount');
            totalAmount.val(basicSalary * eligibleMonth);
        }

        function setDateField(start_date, end_date) {
            let startDateField = $('#start_date');
            let endDateField = $('#end_date');
            startDateField.val(start_date.split(' ')[0]);
            endDateField.val(end_date.split(' ')[0]);
        }

        $('#eligible_month').on('change', function () {
            setEndDate();
            setTotalAmount();
        });

        function setEndDate() {
            let startDate = new Date($('#start_date').val());
            if (isNaN(parseInt(startDate.getMonth() + 1))) {
                alert('Select an employee first');
                return;
            }
            let endDateField = $('#end_date');
            let eligibleMonth = $('#eligible_month').val();
            startDate.setMonth((startDate.getMonth()) + parseInt(eligibleMonth));
            // yyyy-mm--dd format
            let formatted_date = startDate.getFullYear() + "-" + getMonthFormatted(startDate) + "-" + startDate.getDate();
            endDateField.val(formatted_date);
        }

        function getMonthFormatted(date) {
            month = date.getMonth() + 1;
            return month < 10 ? ("0" + (month)) : month;
        }

    </script>
@endpush
