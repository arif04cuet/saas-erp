@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.entry.cash_book.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('accounts::cash-book-entry.report-form')
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
                                                <h4 class="card-title">@lang('accounts::journal.entry.cash_book.index')
                                                </h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table
                                                        class="table table-striped table-bordered text-center"
                                                        id="cash-book-entry-table">
                                                        <thead>

                                                        <tr>
                                                            <th rowspan="2">@lang('labels.serial')</th>
                                                            <th rowspan="2">@lang('accounts::journal.entry.cash_book.journal_reference')</th>
                                                            <th rowspan="2">@lang('accounts::journal.entry.cash_book.transaction_type')</th>
                                                            <th colspan="2">@lang('accounts::journal.entry.cash_book.payment_type')</th>
                                                            <th rowspan="2">@lang('accounts::journal.entry.cash_book.status')</th>
                                                            <th rowspan="2">@lang('labels.action')</th>
                                                        </tr>
                                                        <tr>
                                                            <th>@lang('accounts::journal.entry.detail.payment_type.cash')</th>
                                                            <th>@lang('accounts::journal.entry.detail.payment_type.bank')</th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>
                                                        @foreach ($cashBookEntries as $cashBookEntry)

                                                            <tr>
                                                                <td scope="row">{{$loop->iteration}}</td>
                                                                <!-- journal reference -->
                                                                <td width="10%">
                                                                    <a href="{{route('journal.entry.show',$cashBookEntry->journal_entry_id)}}">
                                                                        {{$cashBookEntry->reference}}
                                                                    </a>
                                                                </td>
                                                                <!-- transaction type -->
                                                                <td width="10%">
                                                                    {{
                                                                        $cashBookEntry->account_transaction_type
                                                                        ?? trans('labels.not_found')
                                                                    }}
                                                                </td>
                                                                <td>{{ $cashBookEntry->cash_amount }}</td>
                                                                <td>{{ $cashBookEntry->bank_amount }}</td>
                                                                <td>
                                                                    @if ($cashBookEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[2])
                                                                        <p class="btn btn-danger btn-sm">{{trans('labels.rejected')}}</p>
                                                                    @elseif($cashBookEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[1])
                                                                        <p class="btn btn-success btn-sm">{{trans('labels.approved')}}</p>
                                                                    @else
                                                                        <p class="btn btn-warning btn-sm">{{trans('labels.draft')}}</p>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($cashBookEntry->status == 'draft')
                                                                        <p>
                                                                            <a href="{{route('cash-book-entry.status',
                                                                                [
                                                                                    $cashBookEntry->id,
                                                                                    array_keys(config('constants.journal_entry.statuses'))[1]
                                                                                ])}}"
                                                                               class="btn btn-success btn-sm"
                                                                               title="{{trans('labels.approve')}}">
                                                                                <i class="la la-check-circle"></i></a>
                                                                            <a href="{{route('cash-book-entry.status',
                                                                                [
                                                                                    $cashBookEntry->id,
                                                                                    array_keys(config('constants.journal_entry.statuses'))[2]
                                                                                ])}}" class="btn btn-danger btn-sm"
                                                                               title="{{trans('labels.reject')}}">
                                                                                <i class="la la-times-circle"></i></a>
                                                                        </p>
                                                                </td>
                                                                @else
                                                                    <p></p>
                                                                @endif
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
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')

    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}" type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script type="text/javascript">
        @if (app()->isLocale('en'))
            let selectPlaceholder = 'All';
        @else
            let selectPlaceholder = 'সকল';
        @endif

        let table = $('#cash-book-entry-table').dataTable({});

        let myInterval;

        $("#search").click(function(e) {
            e.preventDefault();
            loadData();
        });

        function stopLoadingInfo(buttonRef) {
            buttonRef.removeClass("btn-warning").addClass("btn-success");
            buttonRef.text(`{{ trans('accounts::payroll.payslip_report.form_elements.search') }}`);
            clearInterval(myInterval);
        }

        function loadData() {
            let buttonRef = $('#search').text(`{{ trans('accounts::payroll.payslip_report.form_elements.search') }}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let testUrl = `{{ route('cash-book-entry.filter') }}`;
            let data = $("#cash-book-entry-form").serialize();
            loadingInfo();
            $.post(testUrl, data, function(data) {
                console.log(data);
                table.DataTable().clear().draw();
                populateDatatable(data);
                stopLoadingInfo(buttonRef);
            });
        }

        function loadingInfo() {
            let placeholder = `{{ trans('accounts::payroll.payslip_report.form_elements.searching') }}`;
            let buttonRef = $('#search').html(placeholder);
            let counter = 1;
            myInterval = setInterval(function() {
                if (counter > 0 && counter < 4) {
                    buttonRef.append('.')
                } else {
                    counter = 0;
                    buttonRef.html(placeholder);
                }
                counter++;
            }, 200);
        }

        function getActionUrl(id, status) {
            actionUrl = `{!! route('cash-book-entry.status', [':id', ':status']) !!}`;
            actionUrl = actionUrl.replace(':id', id);
            if (status == 'approved') {
                actionUrl = actionUrl.replace(':status', 'approved');
                return actionUrl;
            }
            if (status == 'rejected') {
                actionUrl = actionUrl.replace(':status', 'rejected');
                return actionUrl;
            }
            return "";
        }


        function getActionString(obj) {
            if (obj.status != 'draft') {
                return "";
            }
            approveActionUrl = getActionUrl(obj.journal_entry_id, 'approved');
            rejectActionUrl = getActionUrl(obj.journal_entry_id, 'rejected');
            approveButton = '<a href="' + approveActionUrl + '"class="btn btn-success btn-sm" title="' +
                `'{{ trans('labels.approve') }}'` +
                '"><i class= "la la-check-circle"></i></a>';
            rejectButton = '<a href="' + rejectActionUrl + '"class="btn btn-danger btn-sm" title="' +
                `'{{ trans('labels.reject') }}'` +
                '"><i class= "la la-times-circle"></i></a>';

            return approveButton + " " + rejectButton;
        }

        function getStatusString(status) {
            var statusString = '<p class="btn btn-warning btn-sm">' + `{{ trans('labels.draft') }}` + '</p';
            if (status == 'rejected') {
                statusString = '<p class="btn btn-danger btn-sm">' + `{{ trans('labels.rejected') }}` + '</p';
            }
            if (status == 'approved') {
                statusString = '<p class="btn btn-success btn-sm">' + `{{ trans('labels.approved') }}` + '</p';
            }
            return statusString;
        }

        function populateDatatable(data) {
            
            for (let row = 0; row < data.length; row++) {
                obj = data[row];
                url = `{!! route('journal.entry.show', ':journal_entry_id') !!}`;
                url = url.replace(':journal_entry_id', obj.journal_entry_id);
                actionString = getActionString(obj);
                statusString = getStatusString(obj.status);
                table.fnAddData([
                    obj.index,
                    '<a href="' + url + '">' + obj.reference + '</a>',
                    obj.account_transaction_type,
                    obj.cash_amount,
                    obj.bank_amount,
                    statusString,
                    actionString
                ]);
            }
        }
    </script>

@endpush
