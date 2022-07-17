@extends('hrm::layouts.master')
@section('title', trans('labels.details'))

@section('content')
    {{--{{ dd($employee) }}--}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">
                @lang('hrm::employee.loan.title') @lang('labels.details')
            </h4>
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
        <div class="card-content collapse show" style="">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tbody>

                            <tr>
                                <th style="width: 30%">
                                    @lang('hrm::employee.loan.circular.title')
                                    @lang('hrm::employee.loan.circular.reference_no')
                                </th>
                                <td>
                                    <strong>
                                        {{ optional($loan->circular)->reference_no ?? __('labels.not_found')}}
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::employee.menu_name') @lang('labels.name')</th>
                                <td>{{ optional($loan->employee)->getName() ?? __('labels.not_found')}}</td>
                            </tr>
                            <tr>

                                <th class="">@lang('labels.designation')</th>
                                <td>
                                    {{ optional($loan->employee->designation)->getName() ?? __('labels.not_found') }}
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <h4 class="form-section">
                            @lang('hrm::employee.loan.info')
                        </h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('hrm::employee.loan.amount')</th>
                                <th>@lang('hrm::employee.loan.installment')</th>
                                <th>@lang('hrm::employee.loan.type')</th>
                                <th>@lang('hrm::employee.loan.reason')</th>
                                <th>@lang('labels.attachments')</th>
                                <th>@lang('labels.status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($loan->loans as $eachLoan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $eachLoan->amount }}</td>
                                    <td>{{ $eachLoan->installment }}</td>
                                    <td>{{ __('hrm::employee.loan.types.' . $eachLoan->type) }}</td>
                                    <td>{{ $eachLoan->reason }}</td>
                                    <td>
                                        @if(!empty($eachLoan->attachment))
                                            <a href="{{route('employee-loans.attachment', $eachLoan->id)}}"
                                               class="btn btn-info btn-sm btn-round">
                                                <i class="ft ft-download"></i> @lang('labels.download')
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ ucwords($eachLoan->status) }}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                <a class="btn btn-warning" href="{{ route('employee-loans.index') }}">
                    <i class="ft-x"></i> @lang('labels.back_page')
                </a>
            </div>
        </div>
    </div>

@endsection
