@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.monthly.title')." ".trans('labels.show'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::pension.monthly.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                        </ul>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                    @php
                                        $employee = $monthlyPension->employee?? null;
                                    @endphp
                                    <tr>
                                        <th width="40%">@lang('accounts::employee-contract.employee_name')</th>
                                        <td>{{$employee? $employee->getName() : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.id')</th>
                                        <td>{{$employee->employee_id?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('accounts::pension.contract.receiver')</th>
                                        <td><?php echo $monthlyPension->receiver ?></td>
                                    </tr>
                                    <tr>
                                        <th>@lang('accounts::gpf.month')</th>
                                        <td>
                                            {{\App\Utilities\MonthNameConverter::convertMonthToBn($latestMonthData->month)}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>@lang('accounts::pension.monthly.medical')</th>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($latestMonthData->medical_allowance)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('accounts::pension.monthly.bonus')</th>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($latestMonthData->bonus)}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.total')</th>
                                        <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($latestMonthData->total)}}</td>
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<th>@lang('accounts::payscale.active_from')</th>--}}
                                    {{--<td>{{date('d F, Y', strtotime($monthlyPension->start_date))}}</td>--}}
                                    {{--</tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div style="overflow: auto">
                            <h5>@lang('accounts::pension.monthly.monthly_pension_records')</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: lightgrey;">
                                    <td><strong>@lang('accounts::gpf.month')</strong></td>
                                    <td><strong>@lang('accounts::pension.contract.receiver')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.basic')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.medical')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.bonus')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.adjustment')</strong></td>
                                    <td><strong>@lang('labels.total')</strong></td>
                                    <td><strong>@lang('labels.status')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.disburse_date')</strong></td>
                                    <td><strong>@lang('labels.action')</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $statusArr = ['draft' => 'badge-warning', 'disbursed' => 'badge-success'];
                                @endphp
                                @foreach ($pensions as $key => $pension)
                                    @php
                                        $month = $pension->month;
                                        $monthName = date('F', strtotime($month));
                                        $monthNameLocalized = __('labels.months_name.'.strtolower($monthName));
                                        $monthNameLocalized .= " ".__('labels.digits.'.substr($month, 0,2));
                                        $monthNameLocalized .= __('labels.digits.'.substr($month, 2,2));
                                    @endphp
                                    <tr>
                                        <td>{{$monthNameLocalized}}</td>
                                        <td>
                                            {{$pension->receiver ?? ""}}
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($pension->basic_pay?? "0")}}
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($pension->medical_allowance?? "0")}}
                                        </td>
                                        <td>
                                            {!! $pension->bonus_name ?? '' !!}
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($pension->deduction?? "0")}}
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($pension->total?? "0")}}
                                        </td>
                                        <td>
                                            <span class="badge {{$statusArr[$pension->status]}}">
                                                @if($pension->status == 'draft')
                                                    @lang('accounts::pension.lump_sum.status.draft')
                                                @else
                                                    @lang('accounts::pension.lump_sum.status.disbursed')
                                                @endif
                                            </span>
                                        </td>

                                        <td>{{$pension->disburse_date?? "N/A"}}</td>
                                        <td>
                                            @if ($pension->status == 'disbursed')
                                                <button type="button" class="btn btn-sm btn-outline-success">
                                                    <i class="la la-check-circle"></i>
                                                </button>
                                            @else
                                                <a class="btn btn-sm btn-success"
                                                   title="{{__('accounts::pension.monthly.disburse')}}"
                                                   href="{{route('monthly-pensions.disburse', $pension->id)}}">
                                                    <i class="la la-check-circle"></i>
                                                </a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('monthly-pensions.bill', $employee->id)}}"
                               class="btn btn-info" title="{{__('accounts::pension.monthly.download_bill')}}">
                                <i class="ft ft-download"></i>
                                @lang('accounts::pension.monthly.download_bill')
                            </a>
                            <a class="btn btn-warning mr-1" role="button"
                               href="{{route('monthly-pensions.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
