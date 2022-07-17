@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.lump_sum.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">@lang('accounts::pension.lump_sum.title')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>@lang('accounts::pension.lump_sum.form_elements.employee')</th>
                                <td>{{ optional($employeeLumpSum->employee)->getName() ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.lump_sum.form_elements.basic_salary')</th>
                                <td>{{ \App\Utilities\EnToBnNumberConverter::en2bn($employeeLumpSum->basic_salary ?? 0)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.lump_sum.form_elements.eligible_pension')</th>
                                <td>{{ \App\Utilities\EnToBnNumberConverter::en2bn($employeeLumpSum->eligible_pension ?? 0)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.lump_sum.form_elements.monthly_pension')</th>
                                <td>{{ \App\Utilities\EnToBnNumberConverter::en2bn($employeeLumpSum->monthly_pension ?? 0)}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.lump_sum.form_elements.lump_sum')</th>
                                <td>{{ \App\Utilities\EnToBnNumberConverter::en2bn($employeeLumpSum->lump_sum_amount ?? 0)}}</td>
                            </tr>

                            <tr>
                                <th>@lang('accounts::pension.lump_sum.form_elements.receiver')</th>
                                <td>
                                    {{__('accounts::pension.nominee.' . $employeeLumpSum->receiver)}}
                                    @if($employeeLumpSum->receiver == array_keys(config('constants.pension.contract.receiver_type'))[1])
                                        <?php echo ': ' . $employeeLumpSum->nominee->getNomineeInfo() ?>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('labels.status')</th>
                                @if($employeeLumpSum->status == \Modules\Accounts\Entities\EmployeeLumpSum::status[0])
                                    <td>
                                       <span
                                           class="badge badge-warning">@lang('accounts::pension.lump_sum.status.draft')
                                       </span>
                                    </td>
                                @else
                                    <td>
                                    <span
                                        class="badge badge-success">@lang('accounts::pension.lump_sum.status.disbursed')</span>
                                    </td>
                                @endif
                            </tr>
                            </tbody>
                        </table>

                        <h4 class="card-title"
                            id="basic-layout-form">@lang('accounts::pension.lump_sum.deduction.title')
                        </h4>

                        <table class="table table-striped table-bordered alt-pagination"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('accounts::pension.lump_sum.deduction.form_elements.title')</th>
                                <th>@lang('accounts::pension.lump_sum.deduction.form_elements.amount')</th>
                                <th>@lang('accounts::pension.lump_sum.deduction.form_elements.remark')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employeeLumpSum->deductions  as $deduction)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        {{$deduction->pensionDeduction->name
                                                    . " - " . $deduction->pensionDeduction->bangla_name?? ''}}
                                    </td>
                                    <td>
                                        {{ \App\Utilities\EnToBnNumberConverter::en2bn($deduction->amount ?? 0)}}
                                    </td>
                                    <td>
                                        {{$deduction->remark ?? ''}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-actions text-center">

                        <a href="{{route('lump-sum.edit', $employeeLumpSum->id)}}"
                           class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>

                        <a href="{{route('lump-sum.bill', $employeeLumpSum->id)}}"
                           class="btn btn-info"><i class="ft-download"></i> {{trans('accounts::pension.lump_sum.bill')}}
                        </a>

                        <a class="btn btn-warning mr-1" role="button" href="{{route('lump-sum.index')}}">
                            <i class="ft-x"></i> {{trans('labels.back_page')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
