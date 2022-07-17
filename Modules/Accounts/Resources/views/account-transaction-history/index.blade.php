@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.history.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::account-transaction-history.report-form')
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
                                                <h4 class="card-title">@lang('accounts::journal.history.index')</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table
                                                        class="table table-striped table-bordered text-center"
                                                        id="transaction-history-table">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('accounts::journal.history.economy_code')</th>
                                                            <th>@lang('accounts::journal.history.fiscal_year')</th>
                                                            <th>@lang('accounts::journal.history.previous_balance')</th>
                                                            <th>@lang('accounts::journal.history.updated_balance')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($accountTransactionHistories as $accountTransactionHistory)
                                                            <tr>
                                                                <th scope="row">{{$loop->iteration}}</th>

                                                                @if(app()->isLocale('en'))
                                                                    <td>
                                                                        <a href="{{route('journal.entry.show',$accountTransactionHistory->journalEntryDetail->journalEntry->id )}}">
                                                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($accountTransactionHistory->journalEntryDetail->economyCode->code,false)}}
                                                                            -
                                                                            {{$accountTransactionHistory->journalEntryDetail->economyCode->english_name ?? trans('labels.not_found')}}
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{route('journal.entry.show',$accountTransactionHistory->journalEntryDetail->journalEntry->id )}}">
                                                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($accountTransactionHistory->journalEntryDetail->economyCode->code,false)}}
                                                                            -
                                                                            {{$accountTransactionHistory->journalEntryDetail->economyCode->bangla_name ?? trans('labels.not_found')}}
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                <td>{{$accountTransactionHistory->fiscalYear->name ?? trans('labels.not_found')}}</td>
                                                                <td>{{$accountTransactionHistory->previous_balance ?? trans('labels.not_found')}}</td>
                                                                <td>{{$accountTransactionHistory->updated_balance ?? trans('labels.not_found')}}</td>
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

        let table = $('#transaction-history-table').dataTable({});

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
            let testUrl = `{{route('account-transaction-history.filter')}}`;
            let data = $("#transaction-history-form").serialize();
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
                let url = `{!! route('journal.entry.show',":journal_entry_id")!!}`;
                url = url.replace(':journal_entry_id', obj.journal_entry_id);
                table.fnAddData([
                    obj.index,
                    '<a href="' + url + '">' + obj.code + '</a>',
                    obj.fiscal_year_name,
                    obj.previous_balance,
                    obj.updated_balance,
                ]);
            }
        }

    </script>

@endpush
