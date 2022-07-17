<style>
    .report {
        border-collapse: collapse;
        width: 96%;
        text-align: center;
        margin-left: 10px;
        font-size: 11px;
    }

    .report td, th {
        border: 1px solid gray;
    }
</style>
<center>
    <strong style="font-size: 20px;">{{__('labels.bard_title')}}</strong><br>
    @lang('labels.bard_address.kotbari'), @lang('labels.bard_address.address')<br>
    @php
        $monthArr = explode( ' ', $month);
        $yearLocale = \App\Utilities\EnToBnNumberConverter::en2bn($monthArr[1], false);
        $monthNameLocale = __('labels.months_name.'.strtolower($monthArr[0]));
    @endphp
    <br>
    {{trans('accounts::pension.report.report_headline', ['month' => $monthNameLocale.', '.$yearLocale])}}
</center>
<br>

<!-- Pension Employee List with Bank account information -->
<table class="report">
    <thead>
    <tr>
        <th>@lang('labels.serial')</th>
        <th>@lang('labels.name')</th>
        <th>@lang('accounts::pension.contract.ppo_no')</th>
        <th>@lang('accounts::pension.report.sonali_bank_acc_no')</th>
        <th>@lang('accounts::pension.report.tk')</th>
    </tr>
    </thead>
    <tbody>
    @php
        $totalAmount = 0;
        @endphp
    @foreach($reportData as $datum)
        @php $totalAmount += $datum['total_amount'] @endphp
        <tr>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration, false)}}
            </td>
            <td>{{$datum['name']}}</td>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['ppo_number'], false)}}
            </td>
            <td>
                {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['bank_account'], false)}}
            </td>
            <td style="text-align: right">
                {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['total_amount'])}}
            </td>
        </tr>
    @endforeach
    <tr>
        <td style="text-align: right" colspan="4"><strong>@lang('labels.total')</strong>&nbsp;</td>
        <td style="text-align: right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalAmount)}}</td>

    </tr>
    </tbody>
</table>
<br>

