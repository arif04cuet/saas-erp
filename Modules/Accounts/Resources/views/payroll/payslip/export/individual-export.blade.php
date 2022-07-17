<table>
    <tr>
        <td>@lang('labels.bard_title')</td>
    </tr>
    <tr>
        <td> @lang('labels.bard_address.kotbari') - @lang('labels.bard_address.address')</td>
    </tr>
</table>

<table>

    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.t_r_form_no')
        </td>
        @for($i=1;$i<=7;$i++)
            <td></td>
        @endfor
        <td>
            @lang('accounts::payroll-report.officer_report.sector_subsector_no')
        </td>
    </tr>
    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.s_r_no')
        </td>
        @for($i=1;$i<=7;$i++)
            <td></td>
        @endfor
        <td>
            @lang('accounts::payroll-report.officer_report.voucher_number')
        </td>
        @for($i=1;$i<=7;$i++)
            <td></td>
        @endfor
        <td>
            @lang('accounts::payroll-report.officer_report.month')
            {{ \App\Utilities\MonthNameConverter::en2bn($payslip->period_from->format('F'))}},
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($payslip->period_from->format('Y'),false)}}
        </td>
        @for($i=1;$i<=5;$i++)
            <td></td>
        @endfor
    </tr>
    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.code_no')
            {{\App\Utilities\EnToBnNumberConverter::en2bn(($employeeContract->code_number ?? 338053213),false)}}
        </td>
    </tr>
    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.e_tin_no')
            {{\App\Utilities\EnToBnNumberConverter::en2bn(($employeeContract->e_tin_number ?? 161122788796),false)}}
        </td>
    </tr>

    <tr>
        <td>
            @lang('labels.name') : {{ $payslip->employee->getName() }}
        </td>
        @for($i=1;$i<=7;$i++)
            <td></td>
        @endfor
        <td> {{trans('accounts::payroll-report.officer_report.designation')}}
            : {{ $payslip->employee->getDesignation() }}</td>
    </tr>
    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.future_fund_number')
            {{\App\Utilities\EnToBnNumberConverter::en2bn(($employeeContract->employee->gpfRecord->fund_number ?? 0),false)}}
        </td>
        @for($i=1;$i<=7;$i++)
            <td></td>
        @endfor
        <td>@lang('accounts::payroll-report.officer_report.tin_number')</td>
        <td></td>
    </tr>
    <!-- Employee Salary Range -->
    <tr>
        <td>
            {{trans('accounts::payroll.payslip_report.form_elements.salary_range')}} :
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($employeeContract->getMinSalary()) }}
            ---
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($employeeContract->getMaxSalary()) }}
        </td>
    </tr>
    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.comment')
        </td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>{{trans('accounts::chart-of-accounts.code')}}</th>
        @for($i=1;$i<=3;$i++)
            <th></th>
        @endfor
        <th>{{trans('accounts::salary-rule.title')}}</th>
        @for($i=1;$i<=5;$i++)
            <th></th>
        @endfor
        <th>{{trans('accounts::payroll-report.officer_report.rate')}}</th>
    </tr>
    <tr>
        @for($i=1;$i<=10;$i++)
            <th></th>
        @endfor
        <th>{{trans('accounts::payroll-report.officer_report.taka')}}</th>
        @for($i=1;$i<=2;$i++)
            <th></th>
        @endfor
        <th>{{trans('accounts::payroll-report.officer_report.coin')}}</th>
        <th></th>
        <th>{{trans('accounts::payroll-report.officer_report.taka')}}</th>
        @for($i=1;$i<=2;$i++)
            <th></th>
        @endfor
        <th>{{trans('accounts::payroll-report.officer_report.coin')}}</th>
    </tr>
    </thead>
    <tbody>
    <!-- Other Details -->
    @php
        $otherTotalAmount = 0;
    @endphp
    @foreach($otherDetails as $otherDetail)
        <tr>
            <!-- code number -->
            <td>
                @if(isset($otherDetail->salaryRule->debit_account))
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherDetail->salaryRule->debit_account,false) }}
                @elseif(isset($otherDetail->salaryRule->credit_account))
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherDetail->salaryRule->credit_account,false) }}
                @else
                    {{ trans('accounts::payroll.payslip.not_found') }}
                @endif
            </td>
            @for($i=1;$i<=3;$i++)
                <td></td>
            @endfor
        <!-- code name -->
            <td>
            @if( app()->isLocale('en'))
                {{
                        isset($otherDetail->salaryRule->name) ?  $otherDetail->salaryRule->name : "Not Found"
               }}
            @else
                {{
                            isset($otherDetail->salaryRule->bangla_name) ?  $otherDetail->salaryRule->bangla_name : "Not Found"
                   }}
            @endif
            <!-- if outstanding found, print  -->
                @if(in_array($otherDetail->salaryRule->id,$outstandings))
                    @lang('accounts::payroll.payslip.outstanding')
                @endif
            </td>
            @for($i=1;$i<=10;$i++)
                <td></td>
            @endfor
        <!-- salary amount -->
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherDetail->amount ) }}
            </td>
            @php $otherDetail->amount ? $otherTotalAmount+= $otherDetail->amount : $otherTotalAmount+= 0 @endphp
        </tr>
    @endforeach
    <!-- otherDetails Total -->
    <tr>
        @for($i=1;$i<=4;$i++)
            <td></td>
        @endfor
        <td>
            {{trans('accounts::payroll.payslip.total')}}
        </td>
        @for($i=1;$i<=10;$i++)
            <td></td>
        @endfor
        <td>
            {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherTotalAmount ) }}
        </td>
    </tr>
    <!-- Deduction Details -->
    <tr>
        <td>
            {{trans('accounts::payroll.payslip.deduction')}}</td>
        <td></td>

        <td></td>
    </tr>
    @php
        $deductionTotalAmount = 0;
    @endphp
    @foreach($deductionDetails as $deductionDetail)
        <tr>
            <td>
                @if(isset($deductionDetail->salaryRule->debit_account))
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn( $deductionDetail->salaryRule->debit_account,false) }}
                @elseif(isset($deductionDetail->salaryRule->credit_account))
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn( $deductionDetail->salaryRule->credit_account,false) }}
                @else
                    {{ trans('accounts::payroll.payslip.not_found') }}
                @endif
            </td>
            @for($i=1;$i<=3;$i++)
                <td></td>
            @endfor
            <td>
            @if( app()->isLocale('en'))
                {{
                        isset($deductionDetail->salaryRule->name) ?  $deductionDetail->salaryRule->name : trans('accounts::payroll.payslip.not_found')
               }}
            @else
                {{
                            isset($deductionDetail->salaryRule->bangla_name) ?  $deductionDetail->salaryRule->bangla_name : trans('accounts::payroll.payslip.not_found')
                   }}
            @endif
            <!-- if outstanding found, print  -->
                @if(in_array($deductionDetail->salaryRule->id,$outstandings))
                    @lang('accounts::payroll.payslip.outstanding')
                @endif
            </td>
            @for($i=1;$i<=10;$i++)
                <td></td>
            @endfor
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn( $deductionDetail->amount) }}
            </td>
            @php $deductionDetail->amount ? $deductionTotalAmount+= $deductionDetail->amount : $deductionTotalAmount+= 0 @endphp
        </tr>
    @endforeach
    <!-- Deduction Details Total-->
    <tr>
        @for($i=1;$i<=4;$i++)
            <td></td>
        @endfor
        <td>
            {{trans('accounts::payroll.payslip.total')}}
        </td>
        @for($i=1;$i<=10;$i++)
            <td></td>
        @endfor
        <td>
            {{ \App\Utilities\EnToBnNumberConverter::en2bn( $deductionTotalAmount ) }}
        </td>
    </tr>
    <!-- Total with minus -->
    <tr>
        @for($i=1;$i<=4;$i++)
            <td></td>
        @endfor
        <td>
            {{trans('accounts::payroll.payslip.total')}} - {{trans('accounts::payroll.payslip.deduction')}}
        </td>
        @for($i=1;$i<=10;$i++)
            <td></td>
        @endfor
        <td>
            {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherTotalAmount - $deductionTotalAmount) }}
        </td>
    </tr>
    <!-- Total  -->
    <tr>
        @for($i=1;$i<=4;$i++)
            <td></td>
        @endfor
        <td>
            {{trans('accounts::payroll.payslip.net')}}
        </td>
        @for($i=1;$i<=10;$i++)
            <td></td>
        @endfor
        <td>
            {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherTotalAmount - $deductionTotalAmount) }}
        </td>
    </tr>
    </tbody>
</table>


<!-- back side -->
<table>

    @for($i=1;$i<=10;$i++)
        <tr></tr>
    @endfor
<!-- net taka -->
    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.back_side.net_taka') =
            {{\App\Utilities\EnToBnNumberConverter::convertToWords($otherTotalAmount - $deductionTotalAmount)}}
        </td>
    </tr>
    @for($i=1;$i<=3;$i++)
        <tr></tr>
    @endfor
    <tr>
        <td>@lang('accounts::payroll-report.officer_report.back_side.pay_to') </td>
    </tr>
    @for($i=1;$i<=3;$i++)
        <tr></tr>
    @endfor
<!-- employee name and signature -->
    <tr>
        <td> @lang('accounts::payroll-report.officer_report.back_side.employee_name')
            {{ $payslip->employee->getName() }}
        </td>
        @for($i=1;$i<=14;$i++)
            <td></td>
        @endfor
        <td>@lang('accounts::payroll-report.officer_report.back_side.signature')</td>
    </tr>
    @for($i=1;$i<=1;$i++)
        <tr></tr>
    @endfor
<!-- date -->
    <tr>
        @for($i=1;$i<=15;$i++)
            <td></td>
        @endfor
        <td>@lang('accounts::payroll-report.officer_report.back_side.date')</td>
    </tr>

    @for($i=1;$i<=4;$i++)
        <tr></tr>
    @endfor
    <tr>
        @for($i=1;$i<=16;$i++)
            <td>----------</td>
        @endfor
    </tr>
    <!-- account information -->
    <tr>
        <td>@lang('accounts::payroll-report.officer_report.back_side.account_department_info')</td>
    </tr>
    @for($i=1;$i<=3;$i++)
        <tr></tr>
    @endfor
<!-- taka and pay -->
    <tr>
        <td>
            @lang('accounts::payroll-report.officer_report.back_side.taka') =
            {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherTotalAmount - $deductionTotalAmount) }} (
            {{\App\Utilities\EnToBnNumberConverter::convertToWords($otherTotalAmount - $deductionTotalAmount)}}
            @lang('accounts::payroll-report.officer_report.back_side.only')
            )
            @lang('accounts::payroll-report.officer_report.back_side.pay')
        </td>
    </tr>
    @for($i=1;$i<=3;$i++)
        <tr></tr>
    @endfor
    <tr>
        <td>@lang('accounts::payroll-report.officer_report.back_side.section_officer')</td>
        @for($i=1;$i<=7;$i++)
            <td></td>
        @endfor
        <td>@lang('accounts::payroll-report.officer_report.back_side.account_officer')</td>
        @for($i=1;$i<=7;$i++)
            <td></td>
        @endfor
        <td>@lang('accounts::payroll-report.officer_report.back_side.director')</td>
    </tr>
    @for($i=1;$i<=3;$i++)
        <tr></tr>
    @endfor
    <tr>
        @for($i=1;$i<=15;$i++)
            <td>-------------------</td>
    @endfor
    <tr>
        <td>@lang('accounts::payroll-report.officer_report.back_side.note.0')</td>
    </tr>
    <tr>
        <td>@lang('accounts::payroll-report.officer_report.back_side.note.1')</td>
    </tr>
</table>
