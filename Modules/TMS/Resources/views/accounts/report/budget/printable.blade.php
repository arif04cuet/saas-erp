<style>
    .report {
        border-collapse: collapse;
        width: 96%;
        text-align: right;
        margin-left: 10px;
        font-size: 9px;
    }
    .report td, th {
        border: 1px solid gray;
    }

    .top-zero {
        border-top: 0;
    }

    .meta-info {
        width: 80%;
        text-align: left;
        margin-left: 10px;
        font-size: 12px;
    }
    .meta-info th, td{
        border: none;
    }

</style>
<center>
    <strong style="font-size: 16px;">{{__('labels.bard_title')}}</strong><br>
    <strong style="font-size: 12px;">@lang('labels.bard_address.kotbari'), @lang('labels.bard_address.address')</strong><br>
    <strong style="font-size: 12px">@lang('tms::budget.title')</strong>
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
<table class="report">
    <thead>
    <tr style="text-align: center">
        <td><strong>@lang('labels.serial')</strong></td>
        <td><strong>@lang('tms::budget.report.expense_sector')</strong></td>
        <td><strong>@lang('tms::budget.report.budget')</strong></td>
        <td><strong>@lang('tms::budget.form_items.revised_budget')</strong></td>
    </tr>
    </thead>
    <tbody data-repeater-list="category">
    @php
        $totalBudget = 0;
        $totalRevisedBudget = 0;
    @endphp
    @foreach($expenditures as $sector => $expenditure)
        @php
            $count = 0;
        @endphp
        <tr>
            <td style="text-align: center"><strong>{{__('tms::budget.report.sector_serials')[$loop->iteration]}}</strong></td>
            <td colspan="3" style="text-align: left"><strong>{{$sector}}</strong></td>
        </tr>
        @foreach($expenditure as $subSector => $budgetEntries)
            @php
                $count++;
                $totalSectorBudget = 0;
                $totalRevisedSectorBudget = 0;
            @endphp
            <tr>
                <td style="text-align: center">{{$count}}</td>
                <td style="text-align: left">{{$subSector}}
                    @foreach($budgetEntries as $budgetEntry)
                        @php
                            $totalSectorBudget += $budgetEntry['total'];
                            $totalRevisedSectorBudget += $budgetEntry['revised_total'];
                        @endphp
                        <ul class="">
                            @if($budgetEntry['days'] || $budgetEntry['persons'])
                                <li class="">

                                    (
                                    {{$budgetEntry['days'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['days']) . ' X ' : ''}}
                                    {{$budgetEntry['persons'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['persons']) . ' X ' : ''}}
                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['rate'])}}
                                    ) = {{\App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['total'])}}
                                </li>
                            @endif
                        </ul>
                    @endforeach
                </td>
                <td class="text-right">
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($totalSectorBudget)}}
                </td>
                <td class="text-right">
                    {{\App\Utilities\EnToBnNumberConverter::en2bn($totalRevisedSectorBudget)}}
                </td>
                @php
                    $totalBudget += $totalSectorBudget;
                    $totalRevisedBudget += $totalRevisedSectorBudget;
                @endphp
            </tr>
        @endforeach
        <tr style="text-align: right; font-weight: bold">
            <td colspan="2">@lang('tms::budget.report.sub_total')</td>
            <td>@enToBnNumber($totalSectorBudget)</td>
            <td>@enToBnNumber($totalRevisedSectorBudget)</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr class="text-bold-700">
        <td></td>
        <td class="text-right">@lang('labels.total')</td>
        <td class="text-right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalBudget)}}</td>
        <td class="text-right">
            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalRevisedBudget)}}
        </td>
    </tr>
    </tfoot>
</table>

