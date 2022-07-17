@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.payslip_batch.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::payroll.payslip_batch.title') @lang('labels.show')</h4>
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
                                <th width="40%">@lang('labels.name')</th>
                                <td>{{$payslipBatch->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::payroll.payslip_batch.create_form_elements.period_from')</th>
                                <td>{{date('d F, Y', strtotime($payslipBatch->period_from))}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::payroll.payslip_batch.create_form_elements.period_to')</th>
                                <td>{{date('d F, Y', strtotime($payslipBatch->period_to))}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <h4 >@lang('accounts::payroll.payslip_list')</h4>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('labels.name')</th>
                                <th>@lang('accounts::payroll.payslip_batch.create_form_elements.reference')</th>
                                <th>@lang('labels.status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($payslipBatch->payslips))
                                @foreach($payslipBatch->payslips as $payslip)
                                    @php //$thisRule = $payslip->salaryRule; @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <a target=_blank href="{{route('payslips.show', $payslip->id)}}">
                                                {{$payslip->payslip_name}}
                                            </a>
                                        </td>
                                        <td>{{$payslip->reference}}</td>
                                        <td>{{ucwords($payslip->status)}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No Payslip Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>


                        <div class="form-actions">
                            {{--<a href="{{route('salary-rule.edit', $payslipBatch->id)}}" class="btn btn-primary"><i--}}
                            {{--class="ft-edit-2"></i> {{trans('labels.edit')}}</a>--}}
                            {{--<a href="{{URL::to( '/tms/trainee/show/'.$payslipBatch->id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>--}}
                            <a class="btn btn-warning mr-1" role="button" href="{{route('payslip-batches.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
