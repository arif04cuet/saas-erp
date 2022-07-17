@extends('accounts::layouts.master')
@section('title',trans('accounts::payroll.payslip.title'))
@section('content')
    <section id="room-type-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::payroll.payslip_batch.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('payslip-batches.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i>@lang('accounts::payroll.payslip_batch.create')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table id="room-type" class="table table-striped table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('labels.serial')</th>
                                    <th width="25%">@lang('labels.name')</th>
                                    <th>@lang('accounts::payroll.payslip.create_form_elements.period_from')</th>
                                    <th>@lang('accounts::payroll.payslip.create_form_elements.period_to')</th>
                                    {{--<th>@lang('labels.status')</th>--}}
                                    <th width="15%">@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payslipBatches as $batch)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a href="{{route('payslip-batches.show', $batch->id)}}">{{$batch->name}}</a>
                                        </td>
                                        <td>{{date('d F, Y', strtotime($batch['period_from']))}}</td>
                                        <td>{{date('d F, Y', strtotime($batch['period_to']))}}</td>
                                        {{--<td>{{$batch['status']}}</td>--}}
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                               href="{{route('payslip-batches.show', $batch->id)}}">
                                                <i class="la la-eye"></i>
                                            </a>
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

