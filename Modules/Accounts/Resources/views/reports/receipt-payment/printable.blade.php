<style>
    .report {
        border-collapse: collapse;
        width: 96%;
        margin-left: 10px;
        font-size: 9px;
    }
    .report td, th {
        border: 1px solid gray;
    }
</style>
<center>
    @php
        $monthArr = explode(' ', $month);
        $monthName = __('labels.months_name.'.strtolower($monthArr[0]));
        $year = \App\Utilities\EnToBnNumberConverter::en2bn($monthArr[1], false);
    @endphp
    <strong style="font-size: 16px;">{{__('labels.bard_title')}}</strong><br>
    <strong style="font-size: 12px;">@lang('labels.bard_address.kotbari'), @lang('labels.bard_address.address')</strong><br>
    <div style="font-size: 11px;">
        {{$budget->title}} @lang('accounts::accounts.report.receipt_payment_report')
    </div>
    <strong style="font-size: 12px; float: right; margin-right: 20px;">{{$monthName.' '.$year}}</strong>
</center>

<!-- Budget Sectors -->
<table class="report">
    <thead>
    <tr style="text-align: center">
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
    <tr style="text-align: center">
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
        <tr style="text-align: left">
            @if(!empty($receipts[$key]))
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receiptSerial++, false)}}</td>
                <td>{{$receipts[$key]['name']}}</td>
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
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration, false)}}.
                {{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['code'], false)
    .' - '.$temporary['name']}}
            </td>
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['receipt'])}}</td>
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($temporary['total_receipt'])}}</td>

            <td></td>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration, false)}}.
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
        <td><strong>@lang('accounts::accounts.report.total_temporary_receipts')</strong></td>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyTempReceipt)}}</td>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalTempReceipt)}}</td>
        <td></td>
        <td><strong>@lang('accounts::accounts.report.total_temporary_expense')</strong></td>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyTempExpense)}}</td>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalTempExpense)}}</td>
    </tr>
    <tr>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($receiptSerial++, false)}}</td>
        <td><strong>@lang('accounts::accounts.report.academy_total_receipt')</strong></td>
        <td>
            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyReceipt + $totalMonthlyTempReceipt)}}
        </td>
        <td>
            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalReceipt + $totalTempReceipt)}}
        </td>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($expenseSerial++, false)}}</td>
        <td><strong>@lang('accounts::accounts.report.academy_total_expense')</strong></td>
        <td>
            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyExpense + $totalMonthlyTempExpense)}}
        </td>
        <td>
            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalExpense + $totalTempExpense)}}
        </td>
    </tr>
    </tbody>
</table><br>

<div style="page-break-after: always"></div>
@foreach($budget->budgetCostCenters as $budgetCostCenter)
    @php
        $costCenterSectors = $costCenterData[$budgetCostCenter->economy_code];
        $economyCode = $budgetCostCenter->economyCode;
    @endphp
    <table class="report">
        <thead>
        <tr>
            <th colspan="5" class="text-center">

                @if(App::getLocale() == 'bn')
                    {{$economyCode->bangla_name}}
                @else
                    {{$economyCode->english_name}}
                @endif

                , @lang('accounts::budget.allocation'):
                {{\App\Utilities\EnToBnNumberConverter::en2bn($budgetCostCenter->budget_amount)}}/-
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
    </table><br><br>
@endforeach
