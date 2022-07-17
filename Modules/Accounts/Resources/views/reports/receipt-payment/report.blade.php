<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    @lang('accounts::accounts.report.receipt_payment')
                    @lang('accounts::accounts.report.title') @lang('labels.show')</h4>
                <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements" style="top: 5px;">
                    <ul class="list-inline mb-1">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="col-md-10">
                        <table class="table table-borderless">
                            <tr>
                                <th>@lang('labels.title')</th>
                                <td>{{$budget->title}}</td>
                                <th>@lang('accounts::fiscal-year.title')</th>
                                <td>{{$budget->fiscalYear->name}}</td>
                                <th>@lang('accounts::accounts.report.month')</th>
                                <td>{{$month}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                    {{--<a href="{{route('cost-center.create',1)}}" class="btn btn-primary btn-sm"><i--}}
                    {{--class="ft-plus white"></i> {{ trans('accounts::cost-center.create') }}--}}
                    {{--</a>--}}
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-top-border no-hover-bg">
                            <li class="nav-item">
                                <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                                   href="#tab11" aria-expanded="true">@lang('accounts::budget.sector')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12"
                                   href="#tab12"
                                   aria-expanded="false">@lang('accounts::budget.cost_center.title')</a>
                            </li>

                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                                 aria-labelledby="base-tab11">
                                <!-- Receipt and Payment Data -->
                                <h4 class="card-title">@lang('accounts::budget.sectors')</h4>
                                <table class="table table-bordered" id="data_table">
                                    <thead>
                                    <tr class="text-center">
                                        <td colspan="4">
                                            <strong>
                                                @lang('accounts::accounts.report.receipt_payment_receipt')
                                            </strong>
                                        </td>
                                        <td colspan="4">
                                            <strong>
                                                @lang('accounts::accounts.report.receipt_payment_expense')
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>@lang('labels.serial')</strong>
                                        </td>
                                        <td>
                                            <strong>@lang('accounts::budget.sector_details')</strong>
                                        </td>
                                        <td>
                                            <strong>@lang('accounts::accounts.report.income')</strong>
                                        </td>
                                        <td>
                                            <strong>@lang('accounts::accounts.report.total_expense')</strong>
                                        </td>
                                        <td>
                                            <strong>@lang('labels.serial')</strong>
                                        </td>
                                        <td>
                                            <strong>@lang('accounts::budget.sector_details')</strong>
                                        </td>
                                        <td>
                                            <strong>@lang('accounts::accounts.report.expenditure')</strong>
                                        </td>
                                        <td>
                                            <strong>@lang('accounts::accounts.report.total_expense')</strong>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="category">
                                    @php
                                        $totalMonthlyExpense = 0;
                                        $totalExpense = 0;
                                        $totalMonthlyReceipt = 0;
                                        $totalReceipt = 0;
                                        $receiptSerial = 1;
                                        $expenseSerial = 1;
                                    @endphp
                                    @foreach($expenditures as $key => $expenditure)
                                        @php
                                            $totalMonthlyExpense += $expenditure['expenditure'];
                                            $totalExpense += $expenditure['total_expenditure'];
                                            $totalMonthlyReceipt += $receipts[$key]['receipt']?? 0;
                                            $totalReceipt += $receipts[$key]['total_receipt']?? 0;
                                            $count = 0;
                                        @endphp
                                        <tr>
                                            @if(!empty($receipts[$key]))
                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receiptSerial++, false)}}</td>
                                                <td>
                                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($receipts[$key]['code'], false)}}
                                                    - {{$receipts[$key]['name']}}
                                                </td>
                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receipts[$key]['receipt'])}}</td>
                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receipts[$key]['total_receipt'])}}</td>
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            @endif
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($expenseSerial++, false)}}
                                            </td>
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($expenditure['code'], false)
                                    .' - '.$expenditure['name']}}
                                            </td>
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($expenditure['expenditure'])}}
                                            </td>
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($expenditure['total_expenditure'])}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receiptSerial++, false)}}</td>
                                        <td>@lang('accounts::accounts.report.academy_total_receipt')</td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyReceipt)}}</td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalReceipt)}}</td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($expenseSerial++, false)}}</td>
                                        <td>@lang('accounts::accounts.report.academy_total_expense')</td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyExpense)}}</td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalExpense)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receiptSerial++, false)}}</td>
                                        <td>
                                            <strong>@lang('accounts::accounts.report.temporary_receipts')</strong>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($expenseSerial++, false)}}</td>
                                        <td>
                                            <strong>@lang('accounts::accounts.report.temporary_expense')</strong>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @php
                                        $totalMonthlyTempExpense = 0;
                                        $totalTempExpense = 0;
                                        $totalMonthlyTempReceipt = 0;
                                        $totalTempReceipt = 0;
                                    @endphp
                                    @foreach($temporaries as $temporary)
                                        @php
                                            $totalMonthlyTempExpense += $temporary['expenditure'];
                                            $totalTempExpense += $temporary['total_expenditure'];
                                            $totalMonthlyTempReceipt += $temporary['receipt']?? 0;
                                            $totalTempReceipt += $temporary['total_receipt']?? 0;
                                            $count = 0;
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration, false)}}
                                                .
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['code'], false)
                                    .' - '.$temporary['name']}}
                                            </td>
                                            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['receipt'])}}</td>
                                            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['total_receipt'])}}</td>

                                            <td></td>
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration, false)}}
                                                .
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['code'], false)
                                    .' - '.$temporary['name']}}
                                            </td>
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['expenditure'])}}
                                            </td>
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['total_expenditure'])}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td><strong>@lang('accounts::accounts.report.total_temporary_receipts')</strong>
                                        </td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyTempReceipt)}}</td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalTempReceipt)}}</td>
                                        <td></td>
                                        <td><strong>@lang('accounts::accounts.report.total_temporary_expense')</strong>
                                        </td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyTempExpense)}}</td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalTempExpense)}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receiptSerial++, false)}}</td>
                                        <td><strong>@lang('accounts::accounts.report.academy_total_receipt')</strong>
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyReceipt + $totalMonthlyTempReceipt)}}
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalReceipt + $totalTempReceipt)}}
                                        </td>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($expenseSerial++, false)}}</td>
                                        <td><strong>@lang('accounts::accounts.report.academy_total_expense')</strong>
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyExpense + $totalMonthlyTempExpense)}}
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalExpense + $totalTempExpense)}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                                <h4 class="card-title">@lang('accounts::budget.cost_center.index')</h4>
                                @foreach($budget->budgetCostCenters as $budgetCostCenter)
                                    @php
                                        $costCenterSectors = $costCenterData[$budgetCostCenter->economy_code];
                                        $economyCode = $budgetCostCenter->economyCode;
                                    @endphp
                                    <table class="table repeater-category-request table-bordered">
                                        <thead>
                                        <tr>
                                            <th colspan="5" class="text-center">
                                                <a href="{{route('budget-cost-centers.edit',
                                                        $budgetCostCenter->id)}}" target="_blank">
                                                    @if(App::getLocale() == 'bn')
                                                        {{$economyCode->bangla_name}}
                                                    @else
                                                        {{$economyCode->english_name}}
                                                    @endif
                                                </a>

                                                , @lang('accounts::budget.allocation'):
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($budgetCostCenter->budget_amount)}}
                                                /-
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('accounts::budget.cost_center.sector')</th>
                                            <th>@lang('accounts::budget.cost_center.amount_bdt')</th>
                                            <th>@lang('accounts::accounts.report.monthly_expense')</th>
                                            <th>@lang('accounts::accounts.report.total_expense')</th>
                                        </tr>
                                        </thead>
                                        <tbody data-repeater-list="category">
                                        @foreach($costCenterSectors as $costCenterSector)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$costCenterSector['title']}}</td>
                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector['budget'])}}</td>
                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector['monthly_expense'])}}</td>
                                                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector['total_expense'])}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" onclick="printDiv()">
                        <i class="la la-print"></i> @lang('labels.print')
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- DataTable Card -->
</div>

<div id="print_report" class="hidden">
    @include('accounts::reports.receipt-payment.printable',
['budget' => $budget, 'reportData' => $expenditures, 'month' => $month])
</div>
@push('page-js')
    <script>

        $('#data_table  ').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy', className: 'copyButton',
                    title: "{{"Report: ".$budget? $budget->title : ''}}",
                    messageTop: "Month: {{$month?? ''}}",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                    }
                },
                {
                    extend: 'excel', className: 'excel',
                    title: "{{"Report: ".$budget? $budget->title : ''}}",
                    messageTop: "Month: {{$month?? ''}}",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                    }
                },
            ],
            ordering: false,
            paging: false,
            searching: false,
            "bDestroy": true,
        });

        let categoryRepeater = $(`.repeater-category-request`).repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }
        });

    </script>
@endpush

<script type="text/javascript">
    function printDiv() {
        var divToPrint = document.getElementById('print_report');

        var newWin = window.open('Budget Report Print', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }
</script>
