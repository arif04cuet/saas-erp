@php
    $sumArray = [];
@endphp
<table>
    <tr>
        <td>
            @lang('labels.bard_title')
        </td>
    </tr>
    <tr>
        <td>
            @lang('labels.bard_address.kotbari') - @lang('labels.bard_address.address')
        </td>
    </tr>
    <tr>
        <td>
            {{trans($modelPayslip->employee->employeeContract->salaryStructure->getName() ?? '') }}
        </td>
    </tr>
</table>


<table>
    @php
        use Modules\Accounts\Entities\SalaryCategory;
        $payslipDetails = $modelPayslip->payslipDetails;
        $deductionDetails = $payslipDetails->filter(function ($detail)  {
            return $detail->salaryRule->salaryCategory->name == SalaryCategory::SALARY_CATEGORY_DEDUCTION;
        })->sortBy(function ($u) {
            return (int)$u->salaryRule->sequence;
        })->values();

        $otherDetails = $payslipDetails->filter(function ($detail) use(&$sumArray)  {
            $sumArray[$detail->salary_rule_id] = 0;
            return $detail->salaryRule->salaryCategory->name != SalaryCategory::SALARY_CATEGORY_DEDUCTION;
        })->sortBy(function ($u) {
            return (int)$u->salaryRule->sequence;
        })->values();
        $sumArray['allowance'] = 0;
        $sumArray['deduction'] = 0;
        $sumArray['total'] = 0;
    @endphp

    <thead>
    <tr>
        <th>@lang('labels.serial')</th>
        <th>@lang('labels.name')</th>
        <!-- Print all the Other details -->
        @foreach($otherDetails as $otherDetail)
            <th>
                @if( app()->isLocale('bn') )
                    {{ $otherDetail->salaryRule->bangla_name }}
                @else
                    {{ $otherDetail->salaryRule->name }}
                @endif
            </th>
        @endforeach

        <th>{{trans('accounts::payroll.payslip.total')}}</th>

        <!-- Print all the deduction details -->
        @foreach($deductionDetails as $deductionDetail)
            <th>
                @if( app()->isLocale('bn') )
                    {{ $deductionDetail->salaryRule->bangla_name }}
                @else
                    {{ $deductionDetail->salaryRule->name }}
                @endif
            </th>
    @endforeach
    <!-- Total deduction -->
        <th>{{trans('accounts::payroll.payslip.deduction')}}</th>
        <!--  Net Amount-->
        <th> {{trans('accounts::payroll.payslip.total')}}</th>
        <!-- Signature -->
        <th>@lang('accounts::payroll.payslip.signature')</th>

    </tr>
    </thead>


    <tbody>
    @foreach($payslips as $payslip)

        @php
            $otherTotalAmount = 0;
            $deductionTotalAmount = 0;
        @endphp
        <tr>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration)}}
            </td>
            <td>
                <p>{{ $payslip->employee->getName() }}</p>
                <p>{{ $payslip->employee->getDesignation() }}</p>
                <p>(

                    {{ \App\Utilities\EnToBnNumberConverter::en2bn( $payslip->employee->employeeContract->getMinSalary() ) }}
                    -
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn( $payslip->employee->employeeContract->getMaxSalary() ) }}
                    )
                </p>
            </td>
            @php
                $payslipDetails = $payslip->payslipDetails;
                $deductionDetails = $payslipDetails->filter(function ($detail) {
                    return $detail->salaryRule->salaryCategory->name == SalaryCategory::SALARY_CATEGORY_DEDUCTION;
                })->sortBy(function ($u) {
                    return (int)$u->salaryRule->sequence;
                })->values();

                $otherDetails = $payslipDetails->filter(function ($detail) {
                    return $detail->salaryRule->salaryCategory->name != SalaryCategory::SALARY_CATEGORY_DEDUCTION;
                })->sortBy(function ($u) {
                    return (int)$u->salaryRule->sequence;
                })->values();
            @endphp


            @foreach($otherDetails as $otherDetail)
                <td>
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn($otherDetail->amount) }}
                </td>
                @php
                    $otherDetail->amount ? $otherTotalAmount+= $otherDetail->amount : $otherTotalAmount+= 0;
                    isset($sumArray[$otherDetail->salary_rule_id])
                            ? $sumArray[$otherDetail->salary_rule_id] += $otherDetail->amount
                            : $sumArray[$otherDetail->salary_rule_id] = 0;
                @endphp
            @endforeach
        <!--  Total Allowance -->
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn($otherTotalAmount) }}
                @php $sumArray['allowance'] += $otherTotalAmount; @endphp
            </td>
            @foreach($deductionDetails as $deductionDetail)
                <td>
                    {{ \App\Utilities\EnToBnNumberConverter::en2bn($deductionDetail->amount) }}
                </td>
            @php
                $deductionDetail->amount ? $deductionTotalAmount+= $deductionDetail->amount : $deductionTotalAmount+= 0;
                 isset($sumArray[$deductionDetail->salary_rule_id])
                            ? $sumArray[$deductionDetail->salary_rule_id] += $deductionDetail->amount
                            : $sumArray[$deductionDetail->salary_rule_id] = 0;
            @endphp
        @endforeach
        <!--  Total deduction  -->
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn( $deductionTotalAmount ) }}
                @php $sumArray['deduction'] += $deductionTotalAmount; @endphp
            </td>
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn( $otherTotalAmount - $deductionTotalAmount ) }}
                @php $sumArray['total'] += ($otherTotalAmount - $deductionTotalAmount); @endphp
            </td>
            <td></td>
        </tr>
    @endforeach


    <!-- print total -->
    <tr>
        <td colspan="2">@lang('labels.total')</td>

        @foreach($otherDetails as $otherDetail)
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn($sumArray[$otherDetail->salary_rule_id])}}
            </td>
        @endforeach
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn( $sumArray['allowance'])}}</td>
        <!-- Print all the deduction details -->
        @foreach($deductionDetails as $deductionDetail)
            <td>
                {{ \App\Utilities\EnToBnNumberConverter::en2bn($sumArray[$deductionDetail->salary_rule_id])}}
            </td>
        @endforeach
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn( $sumArray['deduction'])}}</td>
        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn( $sumArray['total'])}}</td>
    </tr>
    </tbody>
</table>
@php
    unset($sumArray);
@endphp

