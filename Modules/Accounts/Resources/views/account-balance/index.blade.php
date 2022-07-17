@extends('accounts::layouts.master')
@section('title', trans('accounts::account-balance.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::account-balance.report-form')
                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <section id="payslip-list">
                                <div class="row">
                                    <div class="col-xl-12 ">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">@lang('accounts::account-balance.index')</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table
                                                        class="table table-striped table-bordered text-center"
                                                        id="account-balance-table">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('accounts::account-balance.economy_code')</th>
                                                            <th>@lang('accounts::account-balance.fiscal_year')</th>
                                                            <th>@lang('accounts::account-balance.total_receipt')</th>
                                                            <th>@lang('accounts::account-balance.total_payment')</th>
                                                            <th>@lang('accounts::journal.entry.cash_book.status')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($accountBalances as $accountBalance)
                                                            <tr>
                                                                <th scope="row">{{$loop->iteration}}</th>
                                                                <td>
                                                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($accountBalance->fiscalYear->name,false)}}
                                                                </td>
                                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($accountBalance->economy_code,false)}}</td>
                                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($cashBookEntry->total_receipt,false)}}</td>
                                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($cashBookEntry->total_payment,false)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script type="text/javascript">
            @if(app()->isLocale('en'))
        let selectPlaceholder = 'All';
            @else
        let selectPlaceholder = 'সকল';
            @endif

        let table = $('#account-balance-table').dataTable({});

        let myInterval;

        $("#search").click(function (e) {
            e.preventDefault();
            loadData();
        });

        function stopLoadingInfo(buttonRef) {
            buttonRef.removeClass("btn-warning").addClass("btn-success");
            buttonRef.text(`{{trans('accounts::payroll.payslip_report.form_elements.search')}}`);
            clearInterval(myInterval);
        }

        function loadData() {
            let buttonRef = $('#search').text(`{{trans('accounts::payroll.payslip_report.form_elements.search')}}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let testUrl = `{{route('account-balance.filter')}}`;
            let data = $("#account-balance-form").serialize();
            loadingInfo();
            $.post(testUrl, data, function (data) {
                table.DataTable().clear().draw();
                populateDatatable(data);
                stopLoadingInfo(buttonRef);
            });
        }

        function loadingInfo() {
            let placeholder = `{{trans('accounts::payroll.payslip_report.form_elements.searching')}}`;
            let buttonRef = $('#search').html(placeholder);
            let counter = 1;
            myInterval = setInterval(function () {
                if (counter > 0 && counter < 4) {
                    buttonRef.append('.')
                } else {
                    counter = 0;
                    buttonRef.html(placeholder);
                }
                counter++;
            }, 200);
        }

        function populateDatatable(data) {
            for (let row = 0; row < data.length; row++) {
                let obj = data[row];
                table.fnAddData([
                    obj.index,
                    obj.code,
                    obj.fiscal_year_name,
                    obj.total_receipt,
                    obj.total_payment,
                    obj.status
                ]);
            }
        }
    </script>

@endpush
