@extends('accounts::layouts.master')
@section('title',trans('accounts::payroll.master_roll.title'))
@section('content')
    <section id="payslip-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::payroll.master_roll.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('master-roll.salary.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('accounts::payroll.master_roll.create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="payslip_table" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('accounts::payroll.payslip.create_form_elements.employee')</th>
                                    <th>@lang('accounts::payroll.payslip.create_form_elements.period_from')
                                        - @lang('accounts::payroll.payslip.create_form_elements.period_to')</th>
                                    <th>@lang('accounts::payroll.master_roll.form_elements.payment_per_day')</th>
                                    <th>@lang('accounts::payroll.payslip.total')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($masterRollSalaries as $masterRollSalary)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            {{ $masterRollSalary->employee->getName() ?? trans('labels.not_found') }}
                                        </td>
                                        <td>{{ $masterRollSalary->period_from->format('M d, Y') }}
                                            - {{ $masterRollSalary->period_to->format('M d, Y')  }}</td>
                                        <td>{{ $masterRollSalary->payment_per_day ?? '0'}}</td>
                                        <td>{{ $masterRollSalary->total_amount ?? '0' }}</td>
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

