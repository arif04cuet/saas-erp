@extends('accounts::layouts.master')
@section('title', trans('accounts::gpf.title')." ".trans('labels.show'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::gpf.title') @lang('labels.show')</h4>
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
                                    @if($gpf->status == config('constants.gpf_status')[0])
                                        <span class="badge badge-success">
                                    @elseif($gpf->status == config('constants.gpf_status')[2])
                                        <span class="badge badge-warning">
                                    @else
                                        <span class="badge badge-danger">
                                    @endif
                                         {{ucwords($gpf->status)}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong>@lang('accounts::gpf.gpf_history')</strong>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('accounts::salary-rule.percentage')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('accounts::payscale.active_from')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $statusArr = ['badge-danger', 'badge-success'];
                                        @endphp
                                        @foreach($gpfRecords as $gpfRecord)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$gpfRecord->percentage.' %'}}</td>
                                                <td><span class="badge {{$statusArr[$gpfRecord->status]}}"> {{$gpfRecord->status ? 'Active' : 'Inactive'}}</span></td>
                                                <td>{{date('d F, Y', strtotime($gpfRecord->created_at))}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="form-actions">
                            <a href="{{route('gpf.edit', $gpf->id)}}" class="btn btn-primary"><i
                                        class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                            <a href="{{route('gpf.statement', $gpf->id)}}" class="btn btn-info"><i
                                        class="la la-file-text"></i> {{trans('accounts::gpf.yearly_statement')}}</a>
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
