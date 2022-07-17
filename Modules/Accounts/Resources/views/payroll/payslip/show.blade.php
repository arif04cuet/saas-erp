@extends('accounts::layouts.master')
@section('title', trans('accounts::payroll.payslip.title'))
@section('content')
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Payslip Heading -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-md-6 col-sm-12 text-center text-md-left">
                                <div class="media">
                                    <img src="{{asset('images/logo.png')}}" alt="company logo" class=""/>
                                    <div class="media-body">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">@lang('labels.BARD ERP')</li>
                                            <li>{{trans('labels.bard_address.kotbari')}}</li>
                                            <li>{{trans('labels.bard_address.address')}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-right">
                                <h2>{{trans('accounts::payroll.payslip.title')}}</h2>
                                <p class="pb-3"> {{$payslip->reference}} </p>
                            </div>
                        </div>
                        <!-- / Payslip Heading -->

                        <h4 class="card-title"
                            id="basic-layout-form"></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    </div>

                    <div class="card-content collapse show">
                        <h3 class="form-section text-center">{{$payslip->payslip_name}}
                            <a class="btn btn-sm btn-outline-info mr-1" role="button"
                               href="{{url(route('payslips.export',$payslip->id))}}">
                                <i class="ft ft-download"></i> Export
                            </a>
                        </h3>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <table class="table ">
                                        <!-- Employee Name -->
                                        <tr>
                                            <th>@lang('labels.name')</th>
                                            <td>{{ $payslip->employee->getName() }}</td>
                                        </tr>

                                        <!-- Employee Designation -->
                                        <tr>
                                            <th>{{trans('hrm::designation.designation')}}</th>
                                            <td>{{ $payslip->employee->getDesignation() }}</td>
                                        </tr>

                                        <!-- Employee Salary Range -->
                                        <tr>
                                            <th>{{trans('accounts::payroll.payslip_report.form_elements.salary_range')}}</th>
                                            <td>{{$minSalary}} --- {{$maxSalary}}</td>
                                        </tr>

                                        <!-- Period From -->
                                        <tr>
                                            <th>{{trans('accounts::payroll.payslip.create_form_elements.period_from')}}
                                                -
                                                {{trans('accounts::payroll.payslip.create_form_elements.period_to')}}</th>
                                            <td>{{ $payslip->period_from->format('M d, Y') }}
                                                - {{ $payslip->period_to->format('M d, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="table-responsive">
                                            <table id="payslip_table" class="table table-striped table-bordered "
                                                   style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th>{{trans('accounts::chart-of-accounts.code')}}</th>
                                                    <th>{{trans('accounts::salary-rule.title')}}</th>
                                                    <th class="text-right">{{trans('accounts::payroll.payslip.amount')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- Other Details -->
                                                @php
                                                    $otherTotalAmount = 0;
                                                @endphp
                                                @foreach($otherDetails as $otherDetail)
                                                    <tr>
                                                        <td>
                                                            @if(isset($otherDetail->salaryRule->debit_account))
                                                                {{ \App\Utilities\EnToBnNumberConverter::en2bn(
                                                                    $otherDetail->salaryRule->debit_economy_code->code ?? 0,false)
                                                                }}
                                                            @elseif(isset($otherDetail->salaryRule->credit_account))
                                                                {{ \App\Utilities\EnToBnNumberConverter::en2bn(
                                                                   $otherDetail->salaryRule->credit_economy_code->code ?? 0,false)
                                                                }}
                                                            @else
                                                                {{ trans('accounts::payroll.payslip.not_found') }}
                                                            @endif
                                                        </td>
                                                        <td>

                                                        @if( app()->isLocale('en'))
                                                            {{
                                                                isset($otherDetail->salaryRule->name) ?  $otherDetail->salaryRule->name  : "Not Found"
                                                            }}
                                                        @else
                                                            {{
                                                                        isset($otherDetail->salaryRule->bangla_name) ?  $otherDetail->salaryRule->bangla_name : "Not Found"
                                                               }}
                                                        @endif
                                                        <!-- if outstanding found, print  -->
                                                            @if(in_array($otherDetail->salaryRule->id,$outstandings))
                                                                @lang('accounts::payroll.payslip.outstanding')
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{$otherDetail->amount ?? trans('accounts::payroll.payslip.not_found')}}</td>
                                                        @php $otherDetail->amount ? $otherTotalAmount+= $otherDetail->amount : $otherTotalAmount+= 0 @endphp

                                                    </tr>
                                                @endforeach
                                                <!-- otherDetails Total -->
                                                <tr>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        <h4>{{trans('accounts::payroll.payslip.total')}}</h4>
                                                    </td>
                                                    <td class="text-right">
                                                        <h4 class="font-weight-bold">{{ $otherTotalAmount ?? trans('accounts::payroll.payslip.not_found')}}</h4>
                                                    </td>
                                                </tr>
                                                <!-- Deduction Details -->
                                                <tr>
                                                    <td>
                                                        <h4>{{trans('accounts::payroll.payslip.deduction')}}</h4></td>
                                                    <td></td>

                                                    <td></td>
                                                </tr>
                                                @php
                                                    $deductionTotalAmount = 0;
                                                @endphp
                                                @foreach($deductionDetails as $deductionDetail)
                                                    <tr>
                                                        <td>
                                                            @if(isset($deductionDetail->salaryRule->debit_account))
                                                                {{ \App\Utilities\EnToBnNumberConverter::en2bn(
                                                                    $deductionDetail->salaryRule->debit_economy_code->code ?? 0,false)
                                                                }}

                                                            @elseif(isset($deductionDetail->salaryRule->credit_account))
                                                                {{ \App\Utilities\EnToBnNumberConverter::en2bn(
                                                                    $deductionDetail->salaryRule->credit_economy_code->code ?? 0,false)
                                                                }}
                                                            @else
                                                                {{ trans('accounts::payroll.payslip.not_found') }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                        @if( app()->isLocale('en'))
                                                            {{
                                                                    isset($deductionDetail->salaryRule->name) ?  $deductionDetail->salaryRule->name : trans('accounts::payroll.payslip.not_found')
                                                           }}
                                                        @else
                                                            {{
                                                                        isset($deductionDetail->salaryRule->bangla_name) ?  $deductionDetail->salaryRule->bangla_name : trans('accounts::payroll.payslip.not_found')
                                                               }}
                                                        @endif

                                                        <!-- if outstanding found, print  -->
                                                        @if(in_array($otherDetail->salaryRule->id,$outstandings))
                                                            @lang('accounts::payroll.payslip.outstanding')
                                                        @endif

                                                        <td class="text-right">{{$deductionDetail->amount ?? trans('accounts::payroll.payslip.not_found')}}</td>
                                                        @php $deductionDetail->amount ? $deductionTotalAmount+= $deductionDetail->amount : $deductionTotalAmount+= 0 @endphp
                                                    </tr>
                                                @endforeach
                                                <!-- Deduction Details Total-->
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <h4>{{trans('accounts::payroll.payslip.total')}}</h4>
                                                    </td>
                                                    <td class="text-right">
                                                        <h4 class="font-weight-bold">{{$deductionTotalAmount ?? trans('accounts::payroll.payslip.not_found') }}</h4>
                                                    </td>
                                                </tr>
                                                <!-- Total with minus -->
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <h4>{{trans('accounts::payroll.payslip.total')}}
                                                            - {{trans('accounts::payroll.payslip.deduction')}}</h4>
                                                    </td>
                                                    <td class="text-right">
                                                        <h4 class="font-weight-bold"> {{$otherTotalAmount}}
                                                            - {{$deductionTotalAmount}}</h4>
                                                    </td>
                                                </tr>
                                                <!-- Total  -->
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <h3>{{trans('accounts::payroll.payslip.net')}}</h3>
                                                    </td>

                                                    <td class="text-right">
                                                        <h3 class="font-weight-bold">{{$otherTotalAmount - $deductionTotalAmount ?? trans('accounts::payroll.payslip.not_found') }}</h3>
                                                    </td>

                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <a class="btn btn-warning mr-1" role="button" href="{{url(route('payslips.index'))}}">
                                    <i class="ft-skip-back"></i> @lang('labels.back_page')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')





@endpush
