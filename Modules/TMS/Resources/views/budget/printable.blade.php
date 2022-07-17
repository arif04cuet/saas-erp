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
    <strong style="font-size: 16px;">{{__('labels.bard_title')}}</strong><br>
    <strong style="font-size: 12px;">@lang('labels.bard_address.kotbari'), @lang('labels.bard_address.address')</strong><br>
    <div style="font-size: 11px;">
        {{$budget->title}}
    </div>
</center>

<!-- Budget Sectors -->
<table class="report">
    <thead>
    <tr>
        <th>@lang('accounts::economy-code.title')</th>
        <th>@lang('accounts::economy-code.recurring_expenditure')</th>
        <th>@lang('accounts::budget.sector_details')</th>
        <th>@lang('accounts::budget.revised_budget_split')</th>
        <th>@lang('accounts::budget.gob')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reportData as $key => $data)
        @php
            $head = explode('-', $key);
            $sectorCount = count($data);
            $subtotal = 0;
            $subtotalGob = 0;
        @endphp
        <tr>
            <td rowspan="{{$sectorCount + 2}}">{{\App\Utilities\EnToBnNumberConverter::en2bn($head[0])}}</td>
            <td rowspan="{{$sectorCount + 2}}">{{$head[1]}}</td>
        </tr>
        @foreach($data as $datum)
            @php
                $economyCode = $datum['economy_code'];
                $sector = $datum['sector'];
                $subtotal += $sector->revised_revenue_amount + $sector->revised_local_amount;
                $subtotalGob += $sector->revised_revenue_amount;
            @endphp
            <tr>
                <td>
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($economyCode->code, false)}}-
                    @if(App::getLocale() == 'bn')
                        {{$economyCode->bangla_name}}
                    @else
                        {{$economyCode->english_name}}
                    @endif
                </td>
                <td>
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($sector->local_amount + $sector->revenue_amount)}}
                </td>
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($sector->revised_revenue_amount)}}</td>
            </tr>
        @endforeach
        <tr>
            <td style="text-align: right">
                {{__('accounts::budget.subtotal').'-'.$head[1]}}
            </td>
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($subtotal)}}</td>
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($subtotalGob)}}</td>
        </tr>
    @endforeach
    </tbody>
</table><br>

<div style="page-break-after: always"></div>
<!-- Budget Cost Centers -->
{{--<h4>@lang('accounts::budget.cost_center.index')</h4>--}}
@foreach($budget->budgetCostCenters as $budgetCostCenter)
    @php
        $costCenterSectors = $budgetCostCenter->sectors;
        $economyCode = $budgetCostCenter->economyCode;
    @endphp
    <table class="report">
        <thead>
        <tr>
            <th colspan="4" class="text-center">
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
            <th>@lang('labels.code')</th>
            <th>@lang('accounts::budget.cost_center.amount_bdt')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($costCenterSectors as $costCenterSector)
            @php
                $economySector = $costCenterSector->economySector;
            @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>     {{(
    App::getLocale() == 'bn')? $economySector->title_bangla : $economySector->title}}</td>
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector->economy_sector_code, false)}}</td>
                <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($costCenterSector->budget_amount)}}</td>
            </tr>
        @endforeach
        </tbody>
    </table><br>
@endforeach
