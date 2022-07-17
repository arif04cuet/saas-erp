@extends('accounts::layouts.master')
@section('title', trans('accounts::gpf.loan.title')." ".trans('labels.show'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::gpf.loan.title') @lang('labels.show')</h4>
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
                                <th>@lang('labels.designation')</th>
                                <td>{{$employee->getDesignation()}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.id')</th>
                                <td>{{$employee->employee_id}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.loan.loan_summary')</th>
                                <td id="">
                                    <table class="table-striped table-borderless">
                                        <tr>
                                            <td>@lang('accounts::gpf.loan.total_loan'): </td>
                                            <td><span class="badge badge-warning" id="total_loan"></span></td>
                                        </tr>
                                        <tr>
                                            <td>@lang('accounts::gpf.loan.total_loan_paid'):</td>
                                            <td><span class="badge badge-success" id="total_paid"></span></td>
                                        </tr>
                                        <tr>
                                            <td>  @lang('accounts::gpf.loan.total_loan_remaining'): </td>
                                            <td><span class="badge badge-danger" id="total_remaining"></span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                                               href="#tab11" aria-expanded="true">@lang('accounts::gpf.loan.loans')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12"
                                               aria-expanded="false">@lang('accounts::gpf.loan.paid_history')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#tab13"
                                               aria-expanded="false">@lang('accounts::gpf.loan.loan_deposits')</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
                                            <h4 class="card-title">@lang('accounts::gpf.loan.loan_list')</h4>
                                            <div class="">
                                                <table class="table">
                                                    <tr>
                                                        <th>@lang('labels.serial')</th>
                                                        <th>@lang('accounts::gpf.loan.amount')</th>
                                                        <th>@lang('accounts::gpf.loan.no_of_installment')</th>
                                                        <th>@lang('accounts::gpf.loan.current_balance')</th>
                                                        <th>@lang('accounts::gpf.loan.sanction_date')</th>
                                                        <th>@lang('labels.action')</th>
                                                    </tr>
                                                    @php
                                                        $totalLoanAmount = 0;
                                                    @endphp
                                                    @foreach($loan->loans as $eachLoan)
                                                        @php
                                                            $totalLoanAmount += $eachLoan->amount;
                                                        @endphp
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$eachLoan->amount}}</td>
                                                            <td>{{$eachLoan->no_of_installment}}</td>
                                                            <td>{{$eachLoan->current_balance}}</td>
                                                            <td>{{date('d F, Y', strtotime($eachLoan->sanction_date))}}</td>
                                                            <td>
                                                                <a href="{{route('gpf-loan-deposits.create', $eachLoan->id)}}"
                                                                   class="btn btn-success btn-sm" >
                                                                    + @lang('accounts::gpf.loan.deposit')
                                                                </a>
                                                                <a href="{{route('gpf-loans.edit', $eachLoan->id)}}"
                                                                   class="btn btn-primary btn-sm" title="{{__('labels.edit')}}">
                                                                    <i class="ft ft-edit"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                                            <h4 class="card-title">@lang('accounts::gpf.loan.paid_history_title')</h4>

                                            <table class="table">
                                                <tr>
                                                    <th>@lang('accounts::employee-contract.month')</th>
                                                    <th>@lang('accounts::gpf.loan.return_list')</th>
                                                    <th>@lang('accounts::gpf.loan.deposit')</th>
                                                    <th>@lang('labels.total')</th>
                                                </tr>
                                                @php
                                                    $totalAdvanceReturn = 0;
                                                    $totalDeposit = 0;
                                                    $totalPaid = 0;
                                                @endphp
                                                @foreach($loanPayments as $key => $loanPayment)

                                                    <tr>
                                                        <td>
                                                            {{date('F, Y', strtotime($key.'-1'))}}
                                                        </td>
                                                        <td>{{$loanPayment['advance_return']?? "-"}}</td>
                                                        <td>{{$loanPayment['deposit']?? "-"}}</td>
                                                        <td>
                                                            {{$monthlyTotal = ($loanPayment['advance_return']!=''? $loanPayment['advance_return']: 0) +
                                                            ($loanPayment['deposit'] != ''? $loanPayment['deposit'] : 0)}}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $totalPaid += $monthlyTotal;
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td>@lang('labels.total')</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{$totalPaid}}</td>

                                                </tr>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
                                            <h4 class="card-title">@lang('accounts::gpf.loan.deposit_list')</h4>
                                            <table class="table">
                                                <tr>
                                                    <th>@lang('labels.serial')</th>
                                                    <th>@lang('accounts::gpf.loan.amount')</th>
                                                    <th>@lang('accounts::gpf.loan.deposit')</th>
                                                    <th>@lang('accounts::gpf.loan.balance_after_deposit')</th>
                                                    <th>@lang('accounts::gpf.loan.deposit_date')</th>
                                                    <th>@lang('labels.remarks')</th>
                                                </tr>
                                                @php $loopCount = 1; @endphp
                                                @foreach($loan->loans as $eachLoan)
                                                    @foreach($eachLoan->deposits as $deposit)
                                                        <tr>
                                                            <td>{{$loopCount++}}</td>
                                                            <td>{{$eachLoan->amount}}</td>
                                                            <td>{{$deposit->amount}}</td>
                                                            <td>{{$deposit->loan_balance}}</td>
                                                            <td>{{date('d F Y', strtotime($deposit->deposit_date))}}</td>
                                                            <td>{{$deposit->remarks?? "-"}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="form-actions">
{{--                            <a href="{{route('gpf-loans.edit', $loan->id)}}" class="btn btn-primary"><i--}}
{{--                                    class="ft-edit-2"></i> {{trans('labels.edit')}}</a>--}}
                            {{--<a href="{{URL::to( '/tms/trainee/show/'.$gpf->id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>--}}
                            <a class="btn btn-warning mr-1" role="button" href="{{route('gpf-loans.index')}}">
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
        $('#total_loan').html({{$totalLoanAmount}} + '/-');
        $('#total_paid').html({{$totalPaid}} + '/-');
        $('#total_remaining').html({{$totalLoanAmount - $totalPaid}} + '/-');
    </script>
@endpush
