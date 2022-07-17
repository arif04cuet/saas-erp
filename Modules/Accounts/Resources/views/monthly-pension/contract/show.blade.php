@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.contract.title')." ".trans('labels.show'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::pension.contract.title') @lang('labels.show')</h4>
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
                        <table class="table">
                            <tbody>
                            @php
                                $employee = $pensionContract->employee?? null;
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
                                <th>@lang('accounts::pension.contract.ppo_no')</th>
                                <td><?php echo $pensionContract->ppo_number ?></td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.contract.receiver')</th>
                                <td><?php echo $pensionContract->getReceiverInfo() ?></td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.contract.initial_basic')</th>
                                <td>{{$pensionContract->initial_basic}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.contract.current_basic')</th>
                                <td>{{$pensionContract->current_basic}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::employee-contract.increment')</th>
                                <td>{{$pensionContract->increment}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.contract.disburse_type')</th>
                                <td>
                                    <strong>{{ucwords($pensionContract->disbursement_type)}}</strong>
                                    @if($pensionContract->disbursement_type == "bank")
                                        : {{$pensionContract->bank_account_information}}
                                    @endif
                                </td>
                            </tr>

                            {{--<tr>--}}
                            {{--<th>@lang('accounts::payscale.active_from')</th>--}}
                            {{--<td>{{date('d F, Y', strtotime($pensionContract->start_date))}}</td>--}}
                            {{--</tr>--}}
                            <tr>
                                <th>@lang('labels.status')</th>
                                <td>
                                    @if($pensionContract->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.monthly.monthly_pension_record')</th>
                                <td>
                                    @lang('labels.showing') <i class="la la-angle-down"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div style="overflow: auto">

                            {{--{!! Form::open(['route' => ['gpf.personal-ledger', $employee->id], 'class' =>--}}
                            {{--'form', 'novalidate', 'method' => 'get']) !!}--}}
                            {{--@php--}}
                            {{--$yearsArr = range(1990, date('Y')+1);--}}
                            {{--$years = array_combine($yearsArr, $yearsArr);--}}
                            {{--$yearFrom = date('Y');--}}
                            {{--$yearTo = date('Y') + 1;--}}
                            {{--@endphp--}}
                            {{--<div class="row">--}}
                            {{--<div class="col-md-2">--}}
                            {{--<strong style="margin-left: 8px;">--}}
                            {{--@lang('accounts::gpf.personal_ledger')--}}
                            {{--</strong>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                            {{--<div class="form-group">--}}
                            {{--{!! Form::select('from', $years, $yearFrom, ['class' => 'form-control']) !!}--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                            {{--<div class="form-group">--}}
                            {{--{!! Form::select('to', $years, $yearTo, ['class' => 'form-control']) !!}--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                            {{--<i class="la la-filter"></i> @lang('accounts::gpf.filter')--}}
                            {{--</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--{!! Form::close() !!}--}}
                            <table class="table table-bordered" id="pension_record">
                                <thead>
                                <tr style="background-color: lightgrey;">
                                    <td>#</td>
                                    <td><strong>@lang('accounts::gpf.month')</strong></td>
                                    <td><strong>@lang('accounts::pension.contract.receiver')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.basic')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.medical')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.bonus')</strong></td>
                                    <td><strong>@lang('labels.total')</strong></td>
                                    <td><strong>@lang('labels.status')</strong></td>
                                    <td><strong>@lang('accounts::pension.monthly.disburse_date')</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $statusArr = ['draft' => 'badge-warning', 'disbursed' => 'badge-success'];
                                    $monthlyPensions = $pensionContract->monthlyPensions;
                                @endphp
                                @foreach ($monthlyPensions as $key => $pension)
                                    @php
                                        $month = $pension->month;
                                        $monthName = date('F', strtotime($month));
                                        $monthNameLocalized = __('labels.months_name.'.strtolower($monthName));
                                        $monthNameLocalized .= " ".__('labels.digits.'.substr($month, 0,2));
                                        $monthNameLocalized .= __('labels.digits.'.substr($month, 2,2));
                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$monthNameLocalized}}</td>
                                        <td><?php echo $pension->receiver?? "" ?></td>
                                        <td>{{$pension->basic_pay?? ""}}</td>
                                        <td>{{$pension->medical_allowance?? ""}}</td>
                                        <td><?php echo $pension->bonus_name ?></td>
                                        <td>{{$pension->total?? ""}}</td>
                                        <td>
                                            <span class="badge {{$statusArr[$pension->status]}}">
                                                {{ucwords($pension->status?? "")}}
                                            </span>
                                        </td>

                                        <td>{{$pension->disburse_date?? "N/A"}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-warning mr-1" role="button"
                               href="{{route('monthly-pension-contracts.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        $('#pension_record').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy', className: 'copyButton',
                    title: "{{"Pension Records for Employee: ".$employee->getName()}}",
                    messageTop: "{{'Employee ID: '. $employee->employee_id.', Designation: '. $employee->designation->name}}",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'excel', className: 'excel',
                    title: "{{"Pension Records for Employee: ".$employee->getName()}}",
                    messageTop: "{{'Employee ID: '. $employee->employee_id.', Designation: '. $employee->designation->name}}",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'pdf', className: 'pdf',
                    title: "{{"Pension Records for Employee: ".$employee->getName()}}",
                    messageTop: "{{'Employee ID: '. $employee->employee_id.', Designation: '. $employee->designation->name}}",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
                {
                    extend: 'print', className: 'print',
                    title: "{{"Pension Records for Employee: ".$employee->getName()}}",
                    messageTop: "{{'Employee ID: '. $employee->employee_id.', Designation: '. $employee->designation->name}}",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                    }
                },
            ],
            paging: true,
            pageLength: 100,
            searching: true,
            "bDestroy": true,
        });
    </script>
@endpush
