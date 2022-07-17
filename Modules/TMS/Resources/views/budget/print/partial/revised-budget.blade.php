<div class="row">
    <div class="table-responsive col-sm-12">
        <table class="table table-bordered text-center">
            <thead>
            <tr>
                <th colspan="3"></th>
                <th colspan="2">@lang('tms::budget.title')</th>
                <th colspan="2">@lang('tms::budget.form_items.revised_budget')</th>
            </tr>
            <tr>
                <th width="25%">@lang('tms::budget.sector.title')</th>
                <th>@lang('tms::budget.form_items.days')</th>
                <td><strong>@lang('tms::budget.form_items.persons')</strong></td>
                <th>@lang('tms::budget.form_items.rate')</th>
                <th width="15%">@lang('labels.total')</th>
                <th><strong>@lang('tms::budget.form_items.persons')</strong></th>
                <th>@lang('tms::budget.form_items.rate')</th>
                <th width="15%">@lang('labels.total')</th>
            </tr>
            </thead>

            <tbody>

            <!-- Sectors and Sub Sectors -->
            @php
                $totalAmount = 0;
                $totalRevisedAmount = 0;
            @endphp
            @foreach($tmsBudget->budgetSectors as $budgetSector)
                <tr>
                    <td>{{optional($budgetSector->subSector)->getLocalizedTitle()}}</td>
                    <td>{{$budgetSector->no_of_days ?? ''}}</td>
                    <td>{{$budgetSector->no_of_person ?? ''}}</td>
                    <td>{{$budgetSector->rate ?? ''}}</td>
                    <td>{{$budgetSector->total ?? ''}}</td>
                    <td>{{$budgetSector->revised_no_of_person ?? ''}}</td>
                    <td>{{$budgetSector->revised_rate ?? ''}}</td>
                    <td>{{$budgetSector->revised_total ?? ''}}</td>
                    @php
                        $totalAmount += $budgetSector->total ?? 0;
                        $totalRevisedAmount += $budgetSector->revised_total ?? 0;
                    @endphp
                </tr>
            @endforeach

            </tbody>

            <tfoot>
            <tr>
                <td class="font-weight-bold">@lang('labels.total')</td>
                <td colspan="3"></td>
                <td>
                    <div class="font-weight-bold">{{$totalAmount}}</div>
                </td>
                <td></td>
                <td>
                    <div class="font-weight-bold">{{$totalRevisedAmount}}</div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
