@extends('accounts::layouts.master')
@section('title',trans('accounts::payroll.payslip.title'))
@section('content')
    <section id="payslip-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::prl.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="payslip_table"
                                   class="table table-striped table-bordered alt-pagination text-center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('accounts::prl.form_elements.employee')</th>
                                    <th>@lang('accounts::prl.form_elements.start_date')</th>
                                    <th>@lang('accounts::prl.form_elements.end_date')</th>
                                    <th>@lang('accounts::prl.form_elements.eligible_month')
                                    <th>@lang('accounts::prl.form_elements.total_amount')</th>
                                    <th>@lang('accounts::pension.lump_sum.form_elements.status')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{route('employee.show',$employee->employee->id)}}">
                                                {{ $employee->employee->getName() ?? trans('accounts::payroll.payslip.not_found') }}
                                            </a>
                                        </td>
                                        <td>{{ $employee->start_date->format('d Y,M') ?? trans('accounts::payroll.payslip.not_found')}}</td>
                                        <td>{{ $employee->end_date->format('d Y,M') ?? trans('accounts::payroll.payslip.not_found')}}</td>
                                        <td>{{ $employee->eligible_month ?? '0' }}</td>
                                        <td>{{ $employee->total_amount ?? '0' }}</td>
                                        <td>
                                            @if($employee->status == \Modules\Accounts\Entities\PostRetirementLeaveEmployee::status[0])
                                                <span
                                                    class="badge badge-warning">@lang('accounts::pension.lump_sum.status.draft')
                                                </span>
                                            @else
                                                <span
                                                    class="badge badge-success">@lang('accounts::pension.lump_sum.status.disbursed')
                                                </span>
                                            @endif
                                        </td>
                                        <td width="10%">
                                            <span class="dropdown">
                                                <button id="imsProductList" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                @if($employee->status == \Modules\Accounts\Entities\PostRetirementLeaveEmployee::status[0])
                                                    <span aria-labelledby="imsProductList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                           href="{{route('prl.status', $employee->id)}}">
                                                            <i class="la la-eye"></i>@lang('accounts::pension.lump_sum.mark_as_disbursed')
                                                        </a>
                                                </span>
                                                @endif

                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

