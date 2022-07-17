@extends('accounts::layouts.master')
@section('title', trans('accounts::gpf.settlement'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::gpf.settlement') @lang('labels.form')</h4>
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
                                    @if($gpf->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($gpf->status == 'settled')
                                        <span class="badge badge-warning">Settled</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div  class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>@lang('accounts::gpf.current_fiscal_year_adjustment')</h5>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td><strong>@lang('accounts::gpf.month')</strong></td>
                                            <td><strong>@lang('accounts::gpf.monthly_amount')</strong></td>
                                            <td><strong>@lang('accounts::gpf.loan.advanced_return')</strong></td>
                                            <td><strong>@lang('accounts::gpf.interest')</strong></td>
                                        </tr>
                                        </thead>
                                        @php
                                            $totalInstallment = 0;
                                            $totalAdvancedInstallment = 0;
                                            $totalInterest = 0;
                                            $lastMonth = null;
                                        @endphp
                                        @if(count($records))
                                            <tbody>
                                            @foreach($records as $month => $record)
                                                @php
                                                    $totalInstallment += $record->gpf_amount;
                                                    $totalAdvancedInstallment += $record->gpf_advanced_amount;
                                                    $totalInterest += $record->interest;
                                                @endphp
                                                <tr>
                                                    <td>{{$lastMonth = date('M Y', strtotime($month.'-01'))}}</td>
                                                    <td>{{$record->gpf_amount}}</td>
                                                    <td>{{$record->gpf_advanced_amount}}</td>
                                                    <td>{{$record->interest}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr bgcolor="#d3d3d3">
                                                <td>@lang('labels.total')</td>
                                                <td>{{$totalInstallment}}</td>
                                                <td>{{$totalAdvancedInstallment}}</td>
                                                <td>{{$totalInterest}}</td>
                                            </tr>
                                            </tfoot>
                                        @endif
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h5>@lang('accounts::gpf.loan_adjustment')</h5>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td><strong>@lang('accounts::gpf.loan.sanction_date')</strong></td>
                                            <td><strong>@lang('accounts::gpf.loan.amount')</strong></td>
                                            <td><strong>@lang('accounts::gpf.loan.loan_balance')</strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $totalLoan = 0;
                                            $totalLoanAmount = 0;
                                        @endphp
                                        @if(count($loans))
                                            @foreach($loans as $loan)
                                                @php
                                                    $totalLoan += $loan->current_balance;
                                                    $totalLoanAmount += $loan->amount;
                                                @endphp
                                                <tr>
                                                    <td>{{$loan->sanction_date}}</td>
                                                    <td>{{$loan->amount}}</td>
                                                    <td>{{$loan->current_balance}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3"> @lang('labels.not_found')</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr bgcolor="#d3d3d3">
                                            <td>@lang('labels.total')</td>
                                            <td>{{$totalLoanAmount}}</td>
                                            <td>{{$totalLoan}}</td>
                                        </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                        </div>

                        {!! Form::open(['route' => ['gpf.store-settlement', $gpf->id], 'class' => 'form']) !!}
                        {!! Form::token() !!}
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                        $finalStock = $gpf->stock_balance + $totalInstallment +
                                        $totalAdvancedInstallment - $totalLoan;
                                        if (is_null($settlementDate)) {
                                           $settlementDate = $lastMonth? date('Y-m-d', strtotime('01-'.$lastMonth)) :
                                            date('Y-m-d');
                                        }
                                        if (date('n', strtotime('01-'.$lastMonth)) == 6) {
                                            $finalStock += $totalInterest;
                                            $remarkStr = "(".__('accounts::gpf.stock_balance')." + ".
                                            __('accounts::gpf.current_year_installment')." + ".
                                            __('accounts::gpf.loan.advanced_return')." + ".
                                            __('accounts::gpf.interest')." - ".
                                            __('accounts::gpf.loan.loan_balance').")";
                                        } else {
                                         $remarkStr = "(".__('accounts::gpf.stock_balance')." + ".
                                            __('accounts::gpf.current_year_installment')." + ".
                                            __('accounts::gpf.loan.advanced_return')." - ".
                                            __('accounts::gpf.loan.loan_balance').")";
                                    }
                                    @endphp
                                    <h5><strong>@lang('accounts::gpf.final_adjustment') <small>{{$remarkStr}}</small></strong></h5>
                                    <input type="text" name="stock_balance" required readonly class="form-control"
                                           value="{{$finalStock}}">
                                </div>
                                <div class="col-md-6">
                                    <h5><strong>@lang('accounts::gpf.settlement') @lang('labels.date') </strong></h5>
                                    <input type="text" name="settlement_date" required id="settlement_date"
                                           class="form-control required"
                                           onchange="dateChange()"
                                           value="{{date('d F Y', strtotime($settlementDate))}}">
                                </div>
                            </div>
                        </div><br>

                        <div class="card-footer">
                            @if($gpf->status == 'active')
                                <button type="submit" class="btn btn-success mr-1" role="button">
                                    <i class="ft ft-check-circle"></i> @lang('accounts::gpf.confirm_settlement')
                                </button>
                            @endif
                            <a class="btn btn-warning mr-1" role="button" href="{{route('gpf.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">

@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('input[name=settlement_date]').pickadate({
                format: 'dd mmmm yyyy',
            });
        });

        function dateChange()
        {
            window.location = "{{route('gpf.settlement', $gpf->id)}}/" + $("#settlement_date").val();
        }
    </script>
@endpush
