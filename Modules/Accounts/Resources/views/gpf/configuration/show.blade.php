@extends('accounts::layouts.master')
@section('title', trans('accounts::gpf.configuration.title')." ".trans('labels.show'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::gpf.configuration.title') @lang('labels.show')</h4>
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
                                <th>@lang('accounts::gpf.configuration.gpf_interest_percentage')</th>
                                <td>{{$configuration->gpf_interest_percentage}} %</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.configuration.gpf_loan_interest_percentage')</th>
                                <td>{{$configuration->gpf_loan_interest_percentage}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.configuration.min_gpf_percentage')</th>
                                <td>{{$configuration->min_gpf_percentage}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.configuration.max_gpf_percentage')</th>
                                <td>{{$configuration->max_gpf_percentage}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::gpf.configuration.max_loan_installment')</th>
                                <td>{{$configuration->max_loan_installment}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.remarks')</th>
                                <td>{{$configuration->remark}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.status')</th>
                                <td>
                                    @if($configuration->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        {{--<div class="card-content">--}}
                        {{--<div class="card-body">--}}
                        {{--<ul class="nav nav-tabs nav-top-border no-hover-bg">--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11"--}}
                        {{--href="#tab11" aria-expanded="true">@lang('accounts::gpf.personal_ledger')</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12"--}}
                        {{--aria-expanded="false">@lang('accounts::employee-contract.gpf_record')</a>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--<div class="tab-content px-1 pt-1">--}}
                        {{--<div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">--}}
                        {{--<h4 class="card-title">@lang('accounts::employee-contract.contract_terms')</h4>--}}
                        {{--<div class="">--}}
                        {{--<table class="table">--}}
                        {{--<tr>--}}
                        {{--<th width="30%"> {!! Form::label('start_date', __('labels.start'), ['class' => 'form-label required']) !!}</th>--}}
                        {{--<td><div class="col-md-12">{!! Form::label('start_date', '-') !!}</div></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                        {{--<th>{!! Form::label('end_date', __('labels.end'), ['class' => 'form-label label-sm']) !!}</th>--}}
                        {{--<td><div class="col-md-12">{!! Form::label('end_date', '-') !!}</div></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                        {{--<th>{!! Form::label('probation_end', __('accounts::employee-contract.probation_end'), ['class' => 'form-label']) !!}</th>--}}
                        {{--<td><div class="col-md-12">{!! Form::label('probation_end', '-') !!}</div></td>--}}
                        {{--</tr>--}}
                        {{--</table>--}}
                        {{--</div>--}}

                        {{--</div>--}}

                        {{--<div class="tab-pane" id="tab12" aria-labelledby="base-tab12">--}}
                        {{--<table class="table">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                        {{--<th>@lang('labels.serial')</th>--}}
                        {{--<th>@lang('accounts::salary-rule.percentage')</th>--}}
                        {{--<th>@lang('labels.status')</th>--}}
                        {{--<th>@lang('accounts::payscale.active_from')</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@php--}}
                        {{--$statusArr = ['badge-danger', 'badge-success'];--}}
                        {{--@endphp--}}
                        {{--@foreach($gpfRecords as $gpfRecord)--}}
                        {{--<tr>--}}
                        {{--<td>{{$loop->iteration}}</td>--}}
                        {{--<td>{{$gpfRecord->percentage.' %'}}</td>--}}
                        {{--<td><span class="badge {{$statusArr[$gpfRecord->status]}}"> {{$gpfRecord->status ? 'Active' : 'Inactive'}}</span></td>--}}
                        {{--<td>{{date('d F, Y', strtotime($gpfRecord->created_at))}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                        {{--</table>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-actions">
                            <a href="{{route('gpf-configurations.edit', $configuration->id)}}" class="btn btn-primary"><i
                                    class="ft-edit-2"></i> {{trans('labels.edit')}}</a>

                            <a href="{{route('gpf-configurations.toggle-activation', $configuration->id)}}"
                               class="btn btn-info">
                                @if($configuration->status)
                                    <i class="la la-times-circle"></i> {{trans('labels.inactive')}}
                                @else
                                    <i class="la la-check-circle"></i> {{trans('labels.active')}}
                                @endif
                            </a>
                            <a class="btn btn-warning mr-1" role="button" href="{{route('gpf-configurations.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
