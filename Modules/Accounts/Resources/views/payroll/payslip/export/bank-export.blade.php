<table>
    <tr>
        <td>@lang('labels.bard_title')</td>
    </tr>
    <tr>
        <td> @lang('labels.bard_address.kotbari'),@lang('labels.bard_address.cumilla')</td>
    </tr>
    <tr>
        <td>
            @lang('accounts::payroll.payslip_report.bank_report.title.0')
            {{ \App\Utilities\MonthNameConverter::en2bn($modelPayslip->period_from->format('F'))}},
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($modelPayslip->period_from->format('Y'),false)}}
            @lang('accounts::payroll.payslip_report.bank_report.title.1')
        </td>
    </tr>
    <tr>
        <td>@lang('accounts::payroll.payslip_report.bank_report.title.2')</td>
    </tr>
</table>


<table>
    <thead>
    <tr>
        <th>@lang('labels.serial')</th>
        <th>{{trans('accounts::payroll.payslip_report.bank_report.name')}}</th>
        <th>{{trans('accounts::payroll.payslip_report.bank_report.designation')}}</th>
        <th>{{trans('accounts::payroll.payslip_report.bank_report.account_number')}}</th>
        <th>{{trans('accounts::payroll.payslip.amount')}}</th>
    </tr>
    </thead>
    <tbody>
    <!-- Other Details -->
    @php
        $totalAmount = 0;
    @endphp
    @foreach($payslips as $payslip)
        <tr>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration)}}
            </td>
            <td>
                <p>{{ $payslip->employee_name }}</p>
            </td>
            <td>
                <p>{{ $payslip->employee->getDesignation()}}</p>
            </td>
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn($payslip->employee->employeeContract->bank_account_no,false) }}
            </td>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($payslip->total_amount)}}
            </td>
        </tr>
        @php $totalAmount+= $payslip->total_amount @endphp
    @endforeach

    <!-- Total  column -->
    <tr>
        @for($i=1;$i<=3;$i++)
            <td></td>
        @endfor
        <td>{{trans('accounts::payroll.payslip.net')}}</td>
        <td>
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($totalAmount) }}
        </td>
    </tr>
    <tr>
    </tr>
    <!-- signature column -->
    <tr>
        <td colspan="2">{{trans('accounts::payroll.payslip_report.bank_report.director')}}</td>
        <td>{{trans('accounts::payroll.payslip_report.bank_report.section_officer')}}</td>
        <td>{{trans('accounts::payroll.payslip_report.bank_report.accountant_officer')}}</td>
        <td>{{trans('accounts::payroll.payslip_report.bank_report.assistant_accountant')}}</td>
    </tr>
    </tbody>
</table>
