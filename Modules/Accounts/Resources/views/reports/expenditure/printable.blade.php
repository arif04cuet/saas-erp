<style>
    .report {
        border-collapse: collapse;
        width: 96%;
        text-align: center;
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
        {{$budget->title}}
    </div>
    <strong style="font-size: 12px; float: right; margin-right: 20px;">{{$monthName.' '.$year}}</strong>
</center>
<br>
<!-- Budget Sectors -->
<table class="report">
    <thead>
    <tr>
        <th>@lang('accounts::economy-code.title')</th>
        <th>@lang('accounts::economy-code.recurring_expenditure')</th>
        <th>@lang('accounts::budget.sector_details')</th>
        <th>@lang('accounts::budget.revised_budget_split')</th>
        <th>@lang('accounts::accounts.report.monthly_expense')</th>
        <th>@lang('accounts::accounts.report.total_expense')</th>
        <th>@lang('accounts::accounts.report.percentage')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenditures as $key => $expenditure)
        @php
            $head = explode('-', $key);
            $sectorCount = count($expenditure);
            $totalBudget = 0;
            $totalMonthlyExpense = 0;
            $totalExpense = 0;
        @endphp
        <tr>
            <td rowspan="{{$sectorCount + 2}}">
                {{\App\Utilities\EnToBnNumberConverter::en2bn($head[0], false)}}
            </td>
            <td rowspan="{{$sectorCount + 2}}">{{$head[1]}}</td>
        </tr>
        @foreach($expenditure as $code => $datum)
            @php
                $totalBudget += $datum['budget_amount'];
                $totalMonthlyExpense += $datum['monthly_expense'];
                $totalExpense += $datum['total_expense'];
            @endphp
            <tr>
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($code, false)
.' - '.$datum['name']}}</td>
                <td>
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['budget_amount'])}}
                </td>
                <td>
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['monthly_expense'])}}
                </td>
                <td>
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['total_expense'])}}
                </td>
                <td>
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['percentage_of_expense'], false, 2)}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="text-right">
                {{__('accounts::budget.subtotal').'-'.$head[1]}}
            </td>
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalBudget)}}</td>
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalMonthlyExpense)}}</td>
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalExpense)}}</td>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn(
($totalExpense? (($totalExpense * 100) / $totalBudget) : 0), false, 2)}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table><br>
<div style="page-break-after: always"></div>
<!-- Budget Cost Centers -->
@foreach($budget->budgetCostCenters as $budgetCostCenter)
    @php
        $costCenterSectors = $costCenterData[$budgetCostCenter->economy_code];
        $economyCode = $budgetCostCenter->economyCode;
    @endphp
    <table class="report">
        <thead>
        <tr>
            <th colspan="6" class="text-center">

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
            <th>@lang('accounts::accounts.report.percentage')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($costCenterSectors as $costCenterSector)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$costCenterSector['title']}}</td>
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector['budget'])}}</td>
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector['monthly_expense'])}}</td>
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector['total_expense'])}}</td>
                <td>
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector['total_expense']?
(($costCenterSector['total_expense'] * 100) / $costCenterSector['budget']) : 0, false, 2)}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table><br><br>
@endforeach
