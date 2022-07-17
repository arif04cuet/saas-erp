@extends('accounts::layouts.master')
@section('title', trans('accounts::gpf.personal_ledger')." ".trans('labels.show'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::gpf.personal_ledger') @lang('labels.show')</h4>
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
                            <tr>
                                <th width="40%">@lang('accounts::employee-contract.employee_name')</th>
                                <td>{{$employee->first_name." ".$employee->last_name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.id')</th>
                                <td>{{$employee->employee_id}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.fund_number')</th>
                                <td>{{$gpf->fund_number}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.percentage')</th>
                                <td>{{$gpf->current_percentage}} %</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.current_balance')</th>
                                <td>{{$gpf->current_balance}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.stock_balance')</th>
                                <td>{{$gpf->stock_balance}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::payscale.active_from')</th>
                                <td>{{date('d F, Y', strtotime($gpf->start_date))}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.status')</th>
                                <td>
                                    @if($gpf->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div style="overflow: auto">
                            {!! Form::open(['route' => ['gpf.personal-ledger', $employee->id], 'class' =>
                           'form', 'novalidate', 'method' => 'get']) !!}
                            @php
                                $yearsArr = range(1990, date('Y')+1);
                                $years = array_combine($yearsArr, $yearsArr)
                            @endphp
                            <div class="row">
                                <div class="col-md-2">
                                    <strong style="margin-left: 8px;">
                                        @lang('accounts::gpf.personal_ledger')
                                    </strong>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::select('from', $years, $yearFrom, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::select('to', $years, $yearTo, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-filter"></i> @lang('accounts::gpf.filter')
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: lightgrey;">
                                    <td><strong>@lang('accounts::gpf.month')</strong></td>
                                    <td><strong>@lang('accounts::gpf.voucher_no')</strong></td>
                                    <td><strong>@lang('accounts::gpf.stock_balance')</strong></td>
                                    <td><strong>@lang('accounts::gpf.monthly_amount')</strong></td>
                                    <td><strong>@lang('accounts::gpf.loan.advanced_return')</strong></td>
                                    <td><strong>@lang('accounts::gpf.interest')</strong></td>
                                    <td><strong>@lang('accounts::gpf.loan.advanced_given')</strong></td>
                                    <td><strong>@lang('accounts::gpf.year_end_stock')</strong></td>
                                    <td><strong>@lang('accounts::gpf.assistant_accountant_signature')</strong></td>
                                    <td><strong>@lang('accounts::gpf.accountant_signature')</strong></td>
                                    <td><strong>@lang('accounts::gpf.accounts_officer_signature')</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @php  $statusArr = ['badge-danger', 'badge-success']; @endphp
                                @foreach ($fiscalYearsLedger as $step => $months)
                                    @php
                                        $totalGpfAmount = 0;
                                        $totalGpfAdvancedInterest = 0;
                                        $totalInterest = 0;
                                        $lastStock = 0;
                                        $lastLoan = 0;
                                    @endphp
                                    @foreach($months as $month => $ledger)
                                        @php
                                            $dateStr =  strtotime($month.'-01');
                                            $monthValue = date('n', $dateStr);
                                            $monthName = date('F', $dateStr);
                                            $monthNameLocalized = __('labels.months_name.'.strtolower($monthName));
                                            $monthNameLocalized .= " ".__('labels.digits.'.substr($month, 0,2));
                                            $monthNameLocalized .= __('labels.digits.'.substr($month, 2,2));
                                            $totalGpfAmount += $ledger['gpf_amount']?? 0;
                                            $totalGpfAdvancedInterest += $ledger['gpf_advanced_amount']?? 0;
                                            $totalInterest += $ledger['interest']?? 0;
                                            $lastStock = $ledger['gpf_stock_amount']?? $lastStock;
                                            $lastLoan += ($monthValue == 6)?
                                            $ledger['loan_balance']?? 0 : 0;
                                        @endphp
                                        <tr>
                                            <td>{{$monthNameLocalized}}</td>
                                            <td></td>
                                            <td>
                                                @if($monthValue == 7)
                                                    {{$ledger['gpf_stock_amount']?? ""}}
                                                @endif
                                            </td>
                                            <td>{{$ledger['gpf_amount']?? ""}}</td>
                                            <td>{{$ledger['gpf_advanced_amount']?? ""}}</td>
                                            <td></td>
                                            <td>{{$loans[$month]?? ""}}</td>
                                            {{--<td>{{$ledger['gpf_balance']?? ""}}</td>--}}
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    <tr bgcolor="#d3d3d3">
                                        <td><strong>@lang('accounts::gpf.total')</strong></td>
                                        <td></td>
                                        <td>{{$lastStock?? $gpf->stock_balance}}</td>
                                        <td>{{$totalGpfAmount}}</td>
                                        <td>{{$totalGpfAdvancedInterest}}</td>
                                        <td>{{$totalInterest}}</td>
                                        <td>{{$lastLoan}}</td>
                                        <td>{{($lastStock + $totalGpfAmount + $totalGpfAdvancedInterest + $totalInterest)
                                         - $lastLoan}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-warning mr-1" role="button" href="{{route('gpf.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
