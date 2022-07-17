@extends('accounts::layouts.master')
@section('title',trans('accounts::payroll.payslip.title'))
@section('content')
    <section id="payslip-list">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::pension.lump_sum.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('lump-sum.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('accounts::pension.lump_sum.create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content show">
                        <div class="card-body">
                            <table id="payslip_table"
                                   class="table table-striped table-bordered alt-pagination text-center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('accounts::pension.lump_sum.form_elements.employee')</th>
                                    <th>@lang('accounts::pension.lump_sum.form_elements.lump_sum')</th>
                                    <th>@lang('accounts::pension.lump_sum.form_elements.receiver')</th>
                                    <th>@lang('accounts::pension.lump_sum.form_elements.status')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td width="10%">{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{route('lump-sum.show',$employee->id)}}">
                                                {{ $employee->employee->getName() ?? trans('accounts::payroll.payslip.not_found') }}
                                            </a>
                                        </td>
                                        <td>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($employee->lump_sum_amount )}}
                                        </td>
                                        <td>
                                            {{__('accounts::pension.nominee.' . $employee->receiver)}}
                                            @if($employee->receiver == array_keys(config('constants.pension.contract.receiver_type'))[1])
                                                <?php echo ': ' . $employee->nominee->getNomineeInfo() ?>
                                            @endif
                                        </td>

                                        <td>
                                            @if($employee->status == \Modules\Accounts\Entities\EmployeeLumpSum::status[0])
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
                                                   <span aria-labelledby="imsProductList"
                                                         class="dropdown-menu mt-1 dropdown-menu-right">
                                                        @if($employee->status == \Modules\Accounts\Entities\EmployeeLumpSum::status[0])
                                                           <a class="dropdown-item"
                                                              href="{{route('lump-sum.status', $employee->id)}}">
                                                                        <i class="la la-money"></i>@lang('accounts::pension.lump_sum.mark_as_disbursed')
                                                                    </a>
                                                       @endif
                                                         <a class="dropdown-item"
                                                            href="{{route('lump-sum.edit', $employee->id)}}">
                                                            <i class="la la-pencil"></i>@lang('labels.edit')
                                                        </a>
                                                            <div class="dropdown-divider"></div>
                                                       <a class="dropdown-item"
                                                          href="{{route('lump-sum.bill', $employee->id)}}">
                                                           <i class="la la-download"></i>
                                                           @lang('accounts::pension.lump_sum.bill')
                                                       </a>
                                                   </span>

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

