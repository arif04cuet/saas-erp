<table class="table ">
    <!-- Employee Name -->

    <tr>
        <td></td>
        <td>@lang('labels.bard_title')</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td> @lang('labels.bard_address.kotbari') - @lang('labels.bard_address.address')</td>
        <td></td>
    </tr>
    <tr></tr>
    <tr></tr>

    <tr>
        <th>@lang('labels.name')</th>
        <td>{{ $payslip->employee->getName() }}</td>
    </tr>

    <!-- Employee Designation -->
    <tr>
        <th>{{trans('hrm::designation.designation')}}</th>
        <td>{{ $payslip->employee->getDesignation() }}</td>
    </tr>

    <!-- Employee Salary Range -->
    <tr>
        <th>{{trans('accounts::payroll.payslip_report.form_elements.salary_range')}}</th>
        <td>{{$minSalary}} --- {{$maxSalary}}</td>
    </tr>

    <!-- Period From -->
    <tr>
        <th>{{trans('accounts::payroll.payslip.create_form_elements.period_from')}}
            -
            {{trans('accounts::payroll.payslip.create_form_elements.period_to')}}</th>
        <td>{{ $payslip->period_from->format('M d, Y') }}
            - {{ $payslip->period_to->format('M d, Y') }}</td>
    </tr>
    <tr></tr>
</table>


<table id="payslip_table" class="table table-striped table-bordered "
       style="width: 100%">
    <thead>
    <tr>
        <th>{{trans('accounts::chart-of-accounts.code')}}</th>
        <th>{{trans('accounts::salary-rule.title')}}</th>
        <th class="text-right">{{trans('accounts::payroll.payslip.amount')}}</th>
    </tr>
    </thead>
    <tbody>
    <!-- Other Details -->
    @php
        $otherTotalAmount = 0;
    @endphp
    @foreach($otherDetails as $otherDetail)
        <tr>
            <td>
                @if(isset($otherDetail->salaryRule->debit_account))
                    {{ $otherDetail->salaryRule->debit_economy_code->code }}
                @elseif(isset($otherDetail->salaryRule->credit_account))
                    {{$otherDetail->salaryRule->credit_economy_code->code}}
                @else
                    {{ trans('accounts::payroll.payslip.not_found') }}
                @endif
            </td>
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
            </td>
            <td class="text-right">{{$otherDetail->amount ?? trans('accounts::payroll.payslip.not_found')}}</td>
            @php $otherDetail->amount ? $otherTotalAmount+= $otherDetail->amount : $otherTotalAmount+= 0 @endphp

        </tr>
    @endforeach
    <!-- otherDetails Total -->
    <tr>
        <td>

        </td>
        <td>
            <h4>{{trans('accounts::payroll.payslip.total')}}</h4>
        </td>
        <td class="text-right">
            <h4 class="font-weight-bold">{{ $otherTotalAmount ?? trans('accounts::payroll.payslip.not_found')}}</h4>
        </td>
    </tr>
    <!-- Deduction Details -->
    <tr>
        <td>
            <h3>{{trans('accounts::payroll.payslip.deduction')}}</h3></td>
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
                    {{ $deductionDetail->salaryRule->debit_economy_code->code }}
                @elseif(isset($deductionDetail->salaryRule->credit_account))
                    {{$deductionDetail->salaryRule->credit_economy_code->code}}
                @else
                    {{ trans('accounts::payroll.payslip.not_found') }}
                @endif
            </td>
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
            </td>
            <td class="text-right">{{$deductionDetail->amount ?? trans('accounts::payroll.payslip.not_found')}}</td>
            @php $deductionDetail->amount ? $deductionTotalAmount+= $deductionDetail->amount : $deductionTotalAmount+= 0 @endphp
        </tr>
    @endforeach
    <!-- Deduction Details Total-->
    <tr>
        <td></td>
        <td>
            <h4>{{trans('accounts::payroll.payslip.total')}}</h4>
        </td>
        <td class="text-right">
            <h4 class="font-weight-bold">{{$deductionTotalAmount ?? trans('accounts::payroll.payslip.not_found') }}</h4>
        </td>
    </tr>
    <!-- Total with minus -->
    <tr>
        <td></td>
        <td>
            <h4>{{trans('accounts::payroll.payslip.total')}}
                - {{trans('accounts::payroll.payslip.deduction')}}</h4>
        </td>
        <td class="text-right">
            <h4 class="font-weight-bold"> {{$otherTotalAmount}}
                -{{$deductionTotalAmount}}</h4>
        </td>
    </tr>
    <!-- Total  -->
    <tr>
        <td></td>
        <td>
            <h3>{{trans('accounts::payroll.payslip.net')}}</h3>
        </td>

        <td class="text-right">
            <h3 class="font-weight-bold">{{$otherTotalAmount - $deductionTotalAmount ?? trans('accounts::payroll.payslip.not_found') }}</h3>
        </td>

    </tr>

    </tbody>
</table>
