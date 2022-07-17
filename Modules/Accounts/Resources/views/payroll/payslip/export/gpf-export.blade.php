<table>
    <tr>
        <td>
            @lang('labels.bard_title'),@lang('labels.bard_address.kotbari')
            , @lang('labels.bard_address.cumilla')
        </td>
    </tr>

    <tr>
        <td>
            {{ \App\Utilities\MonthNameConverter::en2bn($modelPayslip->period_from->format('F')) }},
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($modelPayslip->period_from->format('Y'),false) }}
            - @lang('accounts::payroll.payslip_report.gpf_report.title.0')
        </td>
    </tr>

    <tr>
        <td>
            @lang('accounts::payroll.payslip_report.gpf_report.title.1')
            {{ \App\Utilities\MonthNameConverter::en2bn($modelPayslip->period_from->addMonths(1)->format('F')) }},
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($modelPayslip->period_from->addMonths(1)->format('Y'),false) }}
            - @lang('accounts::payroll.payslip_report.gpf_report.title.2')
        </td>
    </tr>

</table>

<table>
    <thead>
    <tr>
        <th>@lang('labels.serial')</th>
        <th>{{trans('accounts::payroll.payslip_report.gpf_report.name')}}</th>
        <th>{{trans('accounts::payroll.payslip_report.gpf_report.designation')}}</th>
        <th>{{trans('accounts::payroll.payslip_report.gpf_report.fund_number')}}</th>
        <th>{{trans('accounts::payroll.payslip_report.gpf_report.gpf_contribution')}}</th>
        <th>{{trans('accounts::payroll.payslip_report.gpf_report.gpf_advanced')}}</th>
    </tr>
    </thead>
    <tbody>
    <!-- Other Details -->
    @php
        $totalAmount = [];
    @endphp
    @foreach($payslips as $payslip)
        <tr>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration,false)}}
            </td>
            <td>
                <p>{{ $payslip->employee_name ?? '' }}</p>
            </td>
            <td><p>{{ $payslip->employee->getDesignation() ?? '' }}</p></td>
            <td>
                <p>
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn($payslip->employee->gpfRecord->fund_number ?? '',false) }}
                </p>
            </td>

            @foreach($sectors as $sector)
                @php
                    if(!isset($totalAmount[$sector]))
                    {
                        $totalAmount[$sector] = 0;
                    }
                @endphp
                @foreach($payslip->payslipDetails as $detail)
                    @if($detail->salaryRule->code == $sector)
                        <th>{{\App\Utilities\EnToBnNumberConverter::en2bn($detail->amount)}}</th>
                        @php
                            $totalAmount[$sector] += $detail->amount;
                        @endphp
                    @endif
                @endforeach
            @endforeach
        </tr>
    @endforeach

    <tr>
        <td colspan="4">@lang('labels.grand_total')</td>
        <td>
            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalAmount[\Modules\Accounts\Entities\SalaryRule::GPF_CODE] ?? 0)}}
        </td>
        <td>
            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalAmount[\Modules\Accounts\Entities\SalaryRule::GPF_ALLOWANCE] ?? 0)}}
        </td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td colspan="2">
            {{trans('accounts::payroll.payslip_report.bank_report.assistant_accountant')}}
        </td>
        <td colspan="2">
            {{trans('accounts::payroll.payslip_report.bank_report.section_officer')}}
        </td>
        <td colspan="2">
            {{trans('accounts::payroll.payslip_report.bank_report.accountant_officer')}}
        </td>
    </tr>
    </tbody>
</table>

