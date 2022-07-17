<style>
    .report {
        border-collapse: collapse;
        width: 96%;
        text-align: right;
        margin-left: 10px;
        margin-right: 5px;
        font-size: 9px;
    }

    .report td, th {
        border: 1px solid gray;
    }

    table.print-friendly tr td, table.print-friendly tr th {
        page-break-inside: avoid !important;
    }

    .meta-info {
        width: 80%;
        text-align: left;
        margin-left: 10px;
        font-size: 12px;
    }

    .meta-info th, td {
        border: none;
    }

</style>
<center>
    <strong style="font-size: 16px;">{{__('labels.bard_title')}}</strong><br>
    <strong style="font-size: 12px;">@lang('labels.bard_address.kotbari'), @lang('labels.bard_address.address')</strong><br>
    <strong style="font-size: 12px">@lang('tms::budget.report.expenditure')</strong>
</center>
<br>
<!-- Training Information -->
<table class="meta-info">
    <tr>
        <th>@lang('tms::budget.for_training')</th>
        <td>{{$training->title}}</td>
    </tr>
    <tr>
        <th>@lang('tms::budget.report.participant_no')</th>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($training->no_of_trainee, false)}}</td>
    </tr>
    <tr>
        <th>@lang('tms::budget.report.duration')</th>
        <td>
            {{\App\Utilities\EnToBnNumberConverter::en2bn(date('d', strtotime($training->start_date))) .
 ' ' . \App\Utilities\MonthNameConverter::convertMonthToBn($training->start_date). ' - ' . \App\Utilities\EnToBnNumberConverter::en2bn(date( 'd', strtotime($training->end_date))) . ' ' . \App\Utilities\MonthNameConverter::convertMonthToBn($training->end_date) . ' (' .
 \App\Utilities\EnToBnNumberConverter::en2bn(\Carbon\Carbon::parse($training->start_date)->diffInDays($training->end_date))
 . __('tms::budget.report.day') . ')'}}
        </td>
    </tr>
    <tr>
        <th>@lang('tms::budget.report.organization')</th>
        <td>
            @foreach($training->trainingSponsors as $key => $sponsor)
                @if($key)
                    ,
                @endif
                {{optional($sponsor->organization)->name}}
            @endforeach
        </td>
    </tr>
    <tr>
        <th>@lang('tms::budget.report.organizer')</th>
        <td>@lang('labels.bard_title')</td>
    </tr>
</table><br>
<!-- Budget Sectors -->
<table class="report print-friendly">
    <thead>
    <tr class="text-center">
        <td>
            <strong>@lang('labels.serial')</strong>
        </td>
        <td>
            <strong>@lang('tms::budget.report.expense_sector')</strong>
        </td>
        <td>
            <strong>@lang('tms::budget.report.budget')</strong>
        </td>
        <td>
            <strong>@lang('tms::budget.report.bill_no')</strong>
        </td>
        <td>
            <strong>@lang('tms::budget.report.payment')</strong>
        </td>
        <td>
            <strong>@lang('tms::budget.report.vat')</strong>
        </td>
        <td>
            <strong>@lang('tms::budget.report.tax')</strong>
        </td>
        <td>
            <strong>@lang('tms::budget.report.total_bill')</strong>
        </td>
    </tr>
    </thead>
    <tbody>
    @php
        $count = 0;
        $totalBudget = 0;
        $totalMonthlyExpense = 0;
        $totalExpense = 0;
        $totalVat = 0;
        $totalTax = 0;
        $expenditures = $data[0];
        $expenses = $data[1];
        $vatAndTaxArray = $data[2];
    @endphp
    @foreach($expenses as $sector => $subSectors)
        @php
            $count = 0;
            $sectorBudgetSubTotal = 0;
            $sectorExpenseSubTotal = 0;
        @endphp
        <tr>
            <td style="text-align: center">
                <strong>
                    {{__('tms::budget.report.sector_serials')[$loop->iteration] ?? '*'}}
                </strong>
            </td>
            <td colspan="7" style="text-align: left"><strong>{{$sector}}</strong></td>
        </tr>

        @foreach($subSectors as $subSector => $bills)
            @php
                $sectorCount = 0;
                $totalSectorExpense = 0;
                $hasExpense = false;
                $count++;
                $sectorTotalBudget = 0;
                $totalSectorVatExpense = 0;
                $totalSectorTaxExpense = 0;
                $sectorVatExpense = 0;
                $sectorTaxExpense = 0;
                $subSectorBudgets = $expenditures[$sector][$subSector];
                $vatAndTaxValue = $vatAndTaxArray[$sector][$subSector];
            @endphp
            @foreach($bills as $billTitle => $bill)
                @php
                    $totalSectorExpense += $bill;
                    $totalExpense += $bill;
                    $sectorCount++;
                    $hasExpense = true;
                    $sectorVatExpense = isset($vatAndTaxValue[$billTitle]['vat']) ? $vatAndTaxValue[$billTitle]['vat'] : 0;
                    $sectorTaxExpense = isset($vatAndTaxValue[$billTitle]['tax']) ? $vatAndTaxValue[$billTitle]['tax']:0;
                    $totalVat += $sectorVatExpense;
                    $totalTax += $sectorTaxExpense;
                    $totalSectorVatExpense += $sectorVatExpense;
                    $totalSectorTaxExpense += $sectorTaxExpense;
                    $rowspan = count($bills) + 1;
                @endphp
                <tr>
                    @if($sectorCount === 1)
                        <td rowspan="{{$rowspan}}" style="text-align: center">{{$count}}</td>
                        <td rowspan="{{$rowspan}}" style="text-align: left">
                            {{$subSector}}
                            <ul class="">
                                @foreach($subSectorBudgets as $budgetEntry)
                                    @if($budgetEntry['days'] || $budgetEntry['persons'])
                                        <li class="">
                                            (
                                            {{$budgetEntry['days'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['days']) . ' X ' : ''}}
                                            {{$budgetEntry['persons'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['persons']) . ' X ' : ''}}
                                            @enToBnNumber($budgetEntry['rate'])
                                            ) = @enToBnNumber($budgetEntry['total'])
                                        </li>
                                    @endif
                                    @php
                                        $sectorTotalBudget += $budgetEntry['total'];
                                    @endphp
                                @endforeach
                            </ul>

                        </td>
                        <td class="text-right" rowspan="{{$rowspan}}">
                            {{\App\Utilities\EnToBnNumberConverter::en2bn($sectorTotalBudget)}}
                        </td>
                        {{--                    @else--}}
                        {{--                        <td class="border-top-0"></td>--}}
                        {{--                        <td class="border-top-0"></td>--}}
                        {{--                        <td class="border-top-0"></td>--}}
                    @endif
                    <td>{{$billTitle}}</td>
                    <td class="text-right">
                        {{\App\Utilities\EnToBnNumberConverter::en2bn($bill)}}
                    </td>
                    <td class="text-right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalSectorVatExpense) ?? 0}} </td>
                    <td class="text-right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalSectorTaxExpense) ?? 0}}</td>
                    <td>
                        {{\App\Utilities\EnToBnNumberConverter::en2bn($bill)}}
                    </td>
                </tr>
            @endforeach

            <!-- Generating row while no expense logged for a specific sub sector -->
            @if(!$hasExpense)
                <tr>
                    <td rowspan="2" style="text-align: center">{{$count}}</td>
                    <td rowspan="2" style="text-align: left">
                        {{$subSector}}
                        <ul class="">
                            @foreach($subSectorBudgets as $budgetEntry)
                                @if($budgetEntry['days'] || $budgetEntry['persons'])
                                    <li class="">
                                        (
                                        {{$budgetEntry['days'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['days']) . ' X ' : ''}}
                                        {{$budgetEntry['persons'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['persons']) . ' X ' : ''}}
                                        @enToBnNumber($budgetEntry['rate'])
                                        ) = @enToBnNumber($budgetEntry['total'])
                                    </li>
                                @endif
                                @php
                                    $sectorTotalBudget += $budgetEntry['total'];
                                @endphp
                            @endforeach
                        </ul>
                    </td>
                    <td rowspan="2">
                        {{\App\Utilities\EnToBnNumberConverter::en2bn($sectorTotalBudget)}}
                    </td>

                    <td>-</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                    <td class="text-right">0</td>
                </tr>
            @endif

            <tr>
                <td>@lang('tms::budget.report.sub_total')</td>
                <td class="text-right">
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($totalSectorExpense)}}
                </td>
                <td class="text-right">0</td>
                <td class="text-right">0</td>
                <td class="text-right">
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($totalSectorExpense)}}
                </td>
            </tr>
            @php
                $sectorBudgetSubTotal += $sectorTotalBudget;
                $sectorExpenseSubTotal += $totalSectorExpense;
                $totalBudget += $sectorTotalBudget?? 0;
            @endphp
        @endforeach
        <!-- Sector Subtotal Calculation  -->
        <tr style="text-align: right; font-weight: bold">
            <td colspan="2">@lang('tms::budget.report.sub_total')</td>
            <td>@enToBnNumber($sectorBudgetSubTotal)</td>
            <td></td>
            <td>@enToBnNumber($sectorExpenseSubTotal)</td>
            <td>@enToBnNumber($totalVat)</td>
            <td>@enToBnNumber($totalTax)</td>
            <td>@enToBnNumber($sectorExpenseSubTotal)</td>
        </tr>
    @endforeach
    </tbody>
    <tr style="font-weight: bold">
        <td colspan="2">@lang('labels.total')</td>
        <td class="text-right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalBudget)}}</td>
        <td>@lang('labels.total')</td>
        <td class="text-right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalExpense)}}</td>
        <td>@enToBnNumber($totalVat)</td>
        <td>@enToBnNumber($totalTax)</td>
        <td class="text-right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalExpense)}}</td>
    </tr>
</table>
