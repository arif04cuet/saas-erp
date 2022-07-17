@extends('hrm::layouts.master')
@section('title', trans('labels.details'))


@section('content')
    {{-- {{ dd($employee) }} --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">
                @lang('hrm::leave.leave_balance') @lang('labels.details')
            </h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                </ul>
                @can('hrm-user-access')
                    <a class="btn btn-primary btn-sm mt-2" href="{{ route('leaves.edit_employee_leave', $employee->id) }}"
                        class="dropdown-item">
                        <i class="ft-edit"></i>
                        @lang('hrm::leave.update_leave')
                    </a>
                @endcan
            </div>

        </div>
        <br>

        <div class="card-content collapse show mt-2" style="">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">@lang('labels.name')</th>
                                    <td>{{ $employee->getName() }}</td>
                                </tr>
                                <tr>
                                    <th class="">@lang('labels.designation')</th>
                                    <td>{{ optional($employee->designation)->getName() ?? __('labels.not_found') }}</td>
                                </tr>
                                <tr>
                                    <th class="">@lang('hrm::personal_info.joining_date')</th>
                                    <td>
                                        {{ \Carbon\Carbon::parse($employee->employeePersonalInfo->job_joining_date ?? null)->format('d F, Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h4 class="form-section">@lang('hrm::leave.leave_balance')</h4>

                        <table class="table table-bordered table-striped">
                            <tr class="text-center">
                                <th>@lang('labels.serial')</th>
                                <th>@lang('hrm::leave.leave_type')</th>
                                <th>@lang('hrm::leave.spent_leave_count')</th>
                                <th>@lang('hrm::leave.available_leave_days')</th>

                                @foreach ($leaveBalances as $leaveBalance)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>
                                    {{ __('hrm::leave.' . $leaveBalance['leave_type_name']) }}
                                </th>
                                <th>{{ $leaveBalance['balance'][0] }}</th>
                                <th>
                                    {{ !empty($leaveBalance['amount']) && $leaveBalance['balance'][1] > $leaveBalance['amount'] ? $leaveBalance['amount'] - $leaveBalance['balance'][0] + $leaveBalance['extra_leave'] : $leaveBalance['balance'][1] + $leaveBalance['extra_leave'] }}
                                </th>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <a type="button" class="btn btn-warning" href="{{ route('leave-balances.index') }}">
                    <i class="ft ft-x"></i>
                    @lang('labels.back_page')
                </a>
            </div>
        </div>
    </div>

@endsection
