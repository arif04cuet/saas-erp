<table class="table table-borderless text-center">
    <tr class>
        <td>
            {{trans('labels.bard_title')}}
        </td>
    </tr>
    <tr>
        <td>{{trans('labels.bard_address.kotbari')}}
            , {{trans('labels.bard_address.cumilla')}}</td>
    </tr>
    <tr>
        <td>
            {{trans('hm::report.budget.annual.report_title',['year'=>$annualBudgetReportData['fiscal_year']])}}
        </td>
    </tr>
</table>

<table class="table table-bordered border-2 text-center">
    <thead>
    <tr>
        <td>
            {{trans('labels.serial')}}
        </td>
        <td>
            {{trans('hm::report.budget.annual.table.sector_sub_sector')}}
        </td>
        <td>
            {{trans('hm::report.budget.annual.table.previous_fiscal_year_income',['year'=>$annualBudgetReportData['previous_fiscal_year']])}}
        </td>
        <td>
            {{trans('hm::report.budget.annual.table.fiscal_year_income_budget',['year'=>$annualBudgetReportData['fiscal_year']])}}
        </td>
        <td>
            {{trans('labels.serial')}}
        </td>
        <td>
            {{trans('hm::report.budget.annual.table.sector_sub_sector')}}
        </td>
        <td>
            {{trans('hm::report.budget.annual.table.previous_fiscal_year_expense',['year'=>$annualBudgetReportData['previous_fiscal_year']])}}
        </td>
        <td>
            {{trans('hm::report.budget.annual.table.fiscal_year_expense_budget',['year'=>$annualBudgetReportData['fiscal_year']])}}
        </td>
    </tr>
    </thead>
    <tbody>
    @for($i=0;$i<$viewFormationData['maxLoopNumber'];$i++)
        @php
            $incomeSectionId = null;
            $expenseSectionId = null ;
           if($i < $viewFormationData['maxIncomeNumber'])
                           $incomeSectionId = $viewFormationData['income'][$i];
           if($i < $viewFormationData['maxExpenseNumber'])
                           $expenseSectionId = $viewFormationData['expense'][$i];
        @endphp
        <tr>
            <td>
                @if($i < $viewFormationData['maxIncomeNumber'])
                    @enToBnNumber($i+1,false)
                @endif
            </td>
            <td>
                <!-- Income Section Name -->
                @if(!is_null($incomeSectionId))
                    {{$annualBudgetReportData['section'][$incomeSectionId]->name ?? 0}}
                @endif
            </td>
            <td>
                <!-- Last Year Actual Income -->
                @if(!is_null($incomeSectionId))
                    @enToBnNumber($annualBudgetReportData['income'][$incomeSectionId] ??0)
                @endif
            </td>
            <td>
                <!-- Income Budget -->
                @if(!is_null($incomeSectionId))
                    @enToBnNumber($annualBudgetReportData['budget'][$incomeSectionId]??0 )
                @endif
            </td>
            <td>
                <!-- Expense Serial -->
                @if($i < $viewFormationData['maxExpenseNumber'])
                    @enToBnNumber($i+1,false)
                @endif
            </td>
            <td>
                <!-- Expense Section Name -->
                @if(!is_null($expenseSectionId))
                    @if($expenseSectionId == 'difference')
                        {{trans('hm::report.budget.annual.table.difference')}}
                    @else
                        {{$annualBudgetReportData['section'][$expenseSectionId]->name ?? 0}}
                    @endif
                @endif
            </td>
            <td>
                <!-- Last Year Actual Expense  -->
                @if(!is_null($expenseSectionId))
                    @enToBnNumber($annualBudgetReportData['expense'][$expenseSectionId] ?? 0)
                @endif
            </td>
            <td>
                <!-- Expense Budget -->
                @if($expenseSectionId == 'difference')
                    @enToBnNumber($viewFormationData['difference'] ?? 0 )
                @else
                    @enToBnNumber($annualBudgetReportData['budget'][$expenseSectionId] ?? 0 )
                @endif
            </td>
        </tr>
    @endfor
    <!-- total row -->
    <tr>
        <td>

        </td>
        <td>
            @lang('labels.total')
        </td>
        <td>
            <!-- Total: Last Year Actual Income -->
        {{$viewFormationData['incomeSum'] ?? 0}}

        <td>
            <!-- Total: Income Budget -->
            {{$viewFormationData['budgetIncomeSum'] ?? 0}}
        </td>
        <td>
            <!-- Expense Serial -->
        </td>
        <td>


        </td>
        <td>
            <!-- Total: Expense Section Name -->
        {{$viewFormationData['expenseSum'] ?? 0}}
        <td>
            <!-- Total: Last Year Actual Expense  -->
            {{ ( $viewFormationData['budgetExpenseSum']) ?? 0 }}
        </td>
    </tr>

    </tbody>
</table>



