<table>
    <tr>
        <td>@lang('labels.bard_title')</td>
    </tr>
    <tr>
        <td> @lang('labels.bard_address.kotbari') - @lang('labels.bard_address.address')</td>
    </tr>
    <tr>
        <td>
            @lang('accounts::payroll.payslip_report.sector_report.title.0')
            {{ \App\Utilities\MonthNameConverter::en2bn($modelPayslip->period_from->format('F'))}},
            {{ \App\Utilities\EnToBnNumberConverter::en2bn($modelPayslip->period_from->format('Y'),false)}}
            @lang('accounts::payroll.payslip_report.sector_report.title.1')
        </td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>@lang('labels.serial')</th>
        <th>{{trans('accounts::payroll.payslip_report.bank_report.name')}}</th>
        <th>{{trans('accounts::payroll.payslip_report.bank_report.designation')}}</th>
        @foreach($sectors as $sector)
            @if(app()->isLocale('bn'))
                <th>{{$sector->bangla_name}}</th>
            @else
                <th>{{$sector->name}}</th>
            @endif
        @endforeach
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
                <p>{{ $payslip->employee_name }}</p>
            </td>
            <td>
                <p>{{ $payslip->employee->getDesignation()}}</p>
            </td>
            @foreach($sectors as $sector)
                @php
                    if(!isset($totalAmount[$sector->id]))
                    {
                        $totalAmount[$sector->id] = 0;
                    }
                @endphp
                @foreach($payslip->payslipDetails as $detail)
                    @if($detail->salaryRule->id == $sector->id)
                        <th>{{\App\Utilities\EnToBnNumberConverter::en2bn($detail->amount)}}</th>
                        @php
                            $totalAmount[$sector->id] += $detail->amount;
                        @endphp
                    @endif
                @endforeach
            @endforeach
        </tr>
        {{--        @php $totalAmount+= $payslip->total_amount @endphp--}}
    @endforeach

    <tr>
        <td colspan="3">@lang('labels.grand_total')</td>
        @foreach($sectors as $sector)
            <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($totalAmount[$sector->id])}}</td>
        @endforeach
    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th colspan="2">
            {{trans('accounts::payroll.payslip_report.bank_report.assistant_accountant')}}
        </th>
        <th>
            {{trans('accounts::payroll.payslip_report.bank_report.section_officer')}}
        </th>
        <th colspan="2">
            {{trans('accounts::payroll.payslip_report.bank_report.accountant_officer')}}
        </th>
    </tr>
    </thead>
</table>
