@extends('accounts::layouts.master')
@section('title', trans('accounts::gpf.yearly_statement')." ".trans('labels.show'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::gpf.yearly_statement') @lang('labels.show')</h4>
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
                                <th>@lang('accounts::employee-contract.employee_name')</th>
                                <td>{{$employee->getName()}}</td>
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
                                <th>@lang('accounts::gpf.interest_percentage')</th>
                                <td>{{$gpf->current_percentage}} %</td>
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
                            {!! Form::open(['route' => ['gpf.statement', $gpf->id], 'class' =>
                           'form', 'novalidate', 'method' => 'get']) !!}
                            @php
                                $yearsArr = range(1990, date('Y'));
                                $yearsRangeArr = [];
                                foreach ($yearsArr as $thisYear) {
                                $yearsRangeArr[] = $thisYear.' - '.($thisYear + 1);
                                }
                                $years = array_combine($yearsArr, $yearsRangeArr)
                            @endphp
                            <div class="row">
                                <div class="col-md-2">
                                    <strong style="margin-left: 8px;">
                                        @lang('accounts::gpf.year_statement')
                                    </strong>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::select('year', $years, $year?? date('Y'),
                                        ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="la la-filter"></i> @lang('accounts::gpf.filter')
                                    </button>
                                    <button type="submit" name="export" class="btn btn-info btn-sm">
                                        <i class="la la-file-word-o"></i>
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('labels.details')</th>
                                    <th>@lang('labels.amount')</th>
                                    <th>@lang('labels.remarks')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>@lang('accounts::gpf.stock_balance')</strong></td>
                                    <td>{{$statementData['stock_balance']}}</td>
                                    <td rowspan="6"></td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('accounts::gpf.monthly_amount')</strong></td>
                                    <td>{{$statementData['gpf_contribution']}}</td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('accounts::gpf.loan.advanced_return')</strong></td>
                                    <td>{{$statementData['gpf_advanced']}}</td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('accounts::gpf.interest')</strong></td>
                                    <td>{{$statementData['interest']}}</td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('accounts::gpf.loan.advanced_given')</strong></td>
                                    <td>{{$statementData['advance_given']}}</td>
                                </tr>
                                <tr>
                                    <td><strong>@lang('accounts::gpf.year_end_stock')</strong></td>
                                    <td>{{$statementData['year_end_stock']}}</td>
                                </tr>
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
