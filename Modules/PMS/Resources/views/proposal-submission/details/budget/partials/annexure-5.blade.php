<table class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th>@lang('draft-proposal-budget.economy_code')</th>
        <th>@lang('draft-proposal-budget.economy_sub_code')</th>
        <th>@lang('draft-proposal-budget.economy_code') @lang('labels.details')</th>
        <th>@lang('labels.unit')</th>
        <th>@lang('labels.unit_rate')</th>
        <th>@lang('labels.quantity')</th>
        <th>@lang('draft-proposal-budget.gov') (@lang('draft-proposal-budget.foreign_currency'))</th>
        <th>@lang('draft-proposal-budget.own_financing') (@lang('draft-proposal-budget.foreign_currency'))</th>
        <th>@lang('draft-proposal-budget.other')</th>
        <th>@lang('labels.total')</th>
        <th>@lang('draft-proposal-budget.total_estimated_expenditure_percentage')</th>
    </tr>
    </thead>
    <tbody>
    @php
        $grandTotalWeight = $totalGovSource = $totalOwnFinancingSource = $totalOtherSource = 0;
    @endphp
    <tr>
        <th colspan="4">(ক) @lang('draft-proposal-budget.revenue') : </th>
        @for($l = 1; $l <= 7; $l++)
            <td></td>
        @endfor
    </tr>

    @php
        $economyHeadCode = 0; $changeStage = 0;
    @endphp

    @foreach($projectDetailProposal->budgets as $budget)
        @if($budget->section_type === 'revenue')

            @if($changeStage == 0)
                @php
                    $changeStage = 1;
                    $economyHeadCode = intval($budget->economyCode->economyHead->code);
                @endphp
            @endif

            @if($economyHeadCode != $budget->economyCode->economyHead->code)

                <tr>
                    <th colspan="3">@lang('draft-proposal-budget.economy_code') @lang('labels.wise') @lang('labels.sub_total') : </th>
                    @for($l = 1; $l <= 8; $l++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    @php
                        $revenueHead = $data->economyHeadWiseRevenueData[$economyHeadCode];
                    @endphp
                    <th colspan="3">{{ $economyHeadCode }}</th>
                    <td></td>
                    <td>{{ $revenueHead->unitRate }}</td>
                    <td>{{ $revenueHead->quantity }}</td>
                    <td>{{ $revenueHead->govSource }}</td>
                    <td>{{ $revenueHead->ownFinancingSource }}</td>
                    <td>{{ $revenueHead->otherSource }}</td>
                    <td>{{ $revenueHead->totalExpense }}</td>
                    <td>{{ number_format( (float) $revenueHead->totalExpense / $data->grandTotalExpense, 3, '.', '') }}</td>
                </tr>
            @endif

            @php
                $economyHeadCode = $budget->economyCode->economyHead->code;
                $grandTotalWeight += $weight = $budget->total_expense / $data->grandTotalExpense;
                $totalGovSource += $budget->gov_source;
                $totalOwnFinancingSource += $budget->own_financing_source;
                $totalOtherSource += $budget->other_source;
            @endphp
            <tr>
                <td>{{ $budget->economyCode->economyHead->code }}</td>
                <td>{{ $budget->economyCode->code }}</td>
                <td>{{ $budget->economyCode->bangla_name }}</td>
                <td>{{ $budget->unit }}</td>
                <td>{{ $budget->unit_rate }}</td>
                <td>{{ $budget->quantity }}</td>
                <td>{{ $budget->gov_source }}</td>
                <td>{{ $budget->own_financing_source }}</td>
                <td>{{ $budget->other_source }}</td>
                <td>{{ $budget->total_expense }}</td>
                <td>{{ number_format( (float) $weight, 3, '.', '') }}</td>
            </tr>

        @endif
    @endforeach

    @if( $economyHeadCode !== 0 )
        <tr>
            <th colspan="3">@lang('draft-proposal-budget.economy_code') @lang('labels.wise') @lang('labels.sub_total') : </th>
            @for($l = 1; $l <= 8; $l++)
                <td></td>
            @endfor
        </tr>
        <tr>
            @php
                $revenueHead = $data->economyHeadWiseRevenueData[$economyHeadCode];
            @endphp
            <th colspan="3">{{ $economyHeadCode }}</th>
            <td></td>
            <td>{{ $revenueHead->unitRate }}</td>
            <td>{{ $revenueHead->quantity }}</td>
            <td>{{ $revenueHead->govSource }}</td>
            <td>{{ $revenueHead->ownFinancingSource }}</td>
            <td>{{ $revenueHead->otherSource }}</td>
            <td>{{ $revenueHead->totalExpense }}</td>
            <td>{{ number_format( (float) $revenueHead->totalExpense / $data->grandTotalExpense, 3, '.', '') }}</td>
        </tr>
    @endif

    <tr>
        <th colspan="3">@lang('labels.sub_total') (@lang('draft-proposal-budget.capital')) : </th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $data->revenueExpense }}</td>
        <td></td>
    </tr>
    <tr>
        <th colspan="4">(খ) @lang('draft-proposal-budget.capital') : </th>
        @for($l = 1; $l <= 7; $l++)
            <td></td>
        @endfor
    </tr>

    @php
        $economyHeadCode = 0; $changeStage = 0;
    @endphp

    @foreach($projectDetailProposal->budgets as $budget)
        @if($budget->section_type === 'capital')
            @if($changeStage == 0)
                @php
                    $changeStage = 1;
                    $economyHeadCode = intval($budget->economyCode->economyHead->code);
                @endphp
            @endif

            @if($economyHeadCode != $budget->economyCode->economyHead->code)

                <tr>
                    <th colspan="3">@lang('draft-proposal-budget.economy_code') @lang('labels.wise') @lang('labels.sub_total') : </th>
                    @for($l = 1; $l <= 8; $l++)
                        <td></td>
                    @endfor
                </tr>
                <tr>
                    @php
                        $revenueHead = $data->economyHeadWiseCapitalData[$economyHeadCode];
                    @endphp
                    <th colspan="3">{{ $economyHeadCode }}</th>
                    <td></td>
                    <td>{{ $revenueHead->unitRate }}</td>
                    <td>{{ $revenueHead->quantity }}</td>
                    <td>{{ $revenueHead->govSource }}</td>
                    <td>{{ $revenueHead->ownFinancingSource }}</td>
                    <td>{{ $revenueHead->otherSource }}</td>
                    <td>{{ $revenueHead->totalExpense }}</td>
                    <td>{{ number_format( (float) $revenueHead->totalExpense / $data->grandTotalExpense, 3, '.', '') }}</td>
                </tr>
            @endif

            @php
                $economyHeadCode = $budget->economyCode->economyHead->code;
                $grandTotalWeight += $weight = $budget->total_expense / $data->grandTotalExpense;
                $totalGovSource += $budget->gov_source;
                $totalOwnFinancingSource += $budget->own_financing_source;
                $totalOtherSource += $budget->other_source;
            @endphp
            <tr>
                <td>{{ $budget->economyCode->economyHead->code }}</td>
                <td>{{ $budget->economyCode->code }}</td>
                <td>{{ $budget->economyCode->bangla_name }}</td>
                <td>{{ $budget->unit }}</td>
                <td>{{ $budget->unit_rate }}</td>
                <td>{{ $budget->quantity }}</td>
                <td>{{ $budget->gov_source }}</td>
                <td>{{ $budget->own_financing_source }}</td>
                <td>{{ $budget->other_source }}</td>
                <td>{{ $budget->total_expense }}</td>
                <td>{{ number_format( (float) $weight, 3, '.', '') }}</td>
            </tr>
        @endif
    @endforeach

    @if( $economyHeadCode !== 0 )
        <tr>
            <th colspan="3">@lang('draft-proposal-budget.economy_code') @lang('labels.wise') @lang('labels.sub_total') : </th>
            @for($l = 1; $l <= 8; $l++)
                <td></td>
            @endfor
        </tr>
        <tr>
            @php
                $revenueHead = $data->economyHeadWiseCapitalData[$economyHeadCode];
            @endphp
            <th colspan="3">{{ $economyHeadCode }}</th>
            <td></td>
            <td>{{ $revenueHead->unitRate }}</td>
            <td>{{ $revenueHead->quantity }}</td>
            <td>{{ $revenueHead->govSource }}</td>
            <td>{{ $revenueHead->ownFinancingSource }}</td>
            <td>{{ $revenueHead->otherSource }}</td>
            <td>{{ $revenueHead->totalExpense }}</td>
            <td>{{ number_format( (float) $revenueHead->totalExpense / $data->grandTotalExpense, 3, '.', '') }}</td>
        </tr>
    @endif

    <tr>
        <th colspan="3">@lang('labels.sub_total') (@lang('draft-proposal-budget.capital')) : </th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $data->capitalExpense }}</td>
        <td></td>
    </tr>
    <tr>
        <th colspan="4">(গ) @lang('draft-proposal-budget.physical_contingency') : </th>
        @for($l = 1; $l <= 7; $l++)
            <td></td>
        @endfor
    </tr>
    @foreach($projectDetailProposal->budgets as $budget)
        @if($budget->section_type === 'physical_contingency')
            @php
                $grandTotalWeight += $weight = $data->physicalContingencyExpense / $data->grandTotalExpense;
                $totalGovSource += $budget->gov_source;
                $totalOwnFinancingSource += $budget->own_financing_source;
                $totalOtherSource += $budget->other_source;
            @endphp
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $budget->gov_source }}</td>
                <td>{{ $budget->own_financing_source }}</td>
                <td>{{ $budget->other_source }}</td>
                <td>{{ $data->physicalContingencyExpense }}</td>
                <td>{{ number_format( (float) $weight, 3, '.', '') }}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <th colspan="4">(ঘ) @lang('draft-proposal-budget.price_contingency') : </th>
        @for($l = 1; $l <= 7; $l++)
            <td></td>
        @endfor
    </tr>
    @foreach($projectDetailProposal->budgets as $budget)
        @if($budget->section_type === 'price_contingency')
            @php
                $grandTotalWeight += $weight = $data->priceContingencyExpense / $data->grandTotalExpense;
                $totalGovSource += $budget->gov_source;
                $totalOwnFinancingSource += $budget->own_financing_source;
                $totalOtherSource += $budget->other_source;
            @endphp
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $budget->gov_source }}</td>
                <td>{{ $budget->own_financing_source }}</td>
                <td>{{ $budget->other_source }}</td>
                <td>{{ $data->priceContingencyExpense }}</td>
                <td>{{ number_format( (float) $weight, 3, '.', '') }}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <th colspan="3">@lang('labels.grand_total') (ক+খ+গ+ঘ) : </th>
        <td></td>
        <td></td>
        <td></td>
        <td>{{ $totalGovSource }}</td>
        <td>{{ $totalOwnFinancingSource }}</td>
        <td>{{ $totalOtherSource }}</td>
        <td>{{ $data->grandTotalExpense }}</td>
        <td>{{ $grandTotalWeight }}</td>
    </tr>
    </tbody>
</table>