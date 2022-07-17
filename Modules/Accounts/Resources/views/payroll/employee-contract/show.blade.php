@extends('accounts::layouts.master')
@section('title', trans('accounts::employee-contract.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::employee-contract.title') @lang('labels.show')</h4>
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
                                <th>
                                    @lang('accounts::salary-structure.reference')
                                </th>
                                <td>{{$contract->reference}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.name')</th>
                                <td>{{$contract->employee->first_name.' '.$contract->employee->last_name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-structure.title')</th>
                                <td>{{$contract->salaryStructure->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::employee-contract.salary_grade')</th>
                                <td>{{'Grade '.$contract->salary_grade}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::employee-contract.increment')</th>
                                <td>{{$contract->increment}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab11" data-toggle="tab"
                                               aria-controls="tab11" href="#tab11" aria-expanded="true">
                                                @lang('accounts::employee-contract.contract_details')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12"
                                               href="#tab12" aria-expanded="false">
                                                @lang('accounts::employee-contract.salary_information')
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13"
                                               href="#tab13"
                                               aria-expanded="false">@lang('accounts::employee-contract.deductions')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab14" data-toggle="tab" aria-controls="tab14"
                                               href="#tab14"
                                               aria-expanded="false">@lang('accounts::employee-contract.gpf_record')</a>
                                        </li>
                                        <!-- salary-outstanding data -->
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab15" data-toggle="tab" aria-controls="tab15"
                                               href="#tab15" aria-expanded="false">
                                                @lang('accounts::employee-contract.outstanding.title')
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                                             aria-labelledby="base-tab11">
                                            <h4 class="card-title">@lang('accounts::employee-contract.contract_terms')</h4>
                                            <div class="">
                                                <table class="table">
                                                    <tr>
                                                        <th width="30%"> {!! Form::label('start_date', __('labels.start'), ['class' => 'form-label required']) !!}</th>
                                                        <td>
                                                            <div
                                                                class="col-md-12">{!! Form::label('start_date', $contract->start_date) !!}</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{!! Form::label('end_date', __('labels.end'), ['class' => 'form-label label-sm']) !!}</th>
                                                        <td>
                                                            <div
                                                                class="col-md-12">{!! Form::label('end_date', $contract->end_date) !!}</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{!! Form::label('probation_end', __('accounts::employee-contract.probation_end'), ['class' => 'form-label']) !!}</th>
                                                        <td>
                                                            <div
                                                                class="col-md-12">{!! Form::label('probation_end', $contract->probation_end?? "-") !!}</div>
                                                        </td>
                                                    </tr>
                                                    {{--<tr>--}}
                                                    {{--<td>{!! Form::label('working_schedule', __('accounts::employee-contract.working_schedule'), ['class' => 'form-label']) !!}</td>--}}
                                                    {{--<td><div class="col-md-12">{!! Form::select('working_schedule', ['1' => 'Standard 40 Hours/Week'], null, ['class' => 'col-md-10 form-control input-sm']) !!}</div></td>--}}
                                                    {{--</tr>--}}
                                                    <tr>
                                                        <th>{!! Form::label('hr_responsible', __('accounts::employee-contract.hr_responsible'), ['class' => 'form-label']) !!}</th>
                                                        @php
                                                            $hrResponsible = ($contract->hrResponsible)? $contract->hrResponsible : null;
                                                        @endphp
                                                        <td>
                                                            <div
                                                                class="col-md-12">{!! Form::label('hr_responsible',(!is_null($hrResponsible))? $hrResponsible->first_name.' '.$hrResponsible->last_name : '-') !!}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>{!! Form::label('bank_account_no', __('accounts::employee-contract.bank_account')." (".Config::get('constants.bank_name').")", ['class' => 'form-label']) !!}</th>
                                                        <td>
                                                            <div
                                                                class="col-md-12">{!! Form::label('bank_account_no', $contract->bank_account_no?? "-") !!}</div>
                                                        </td>
                                                    </tr>

                                                    {{--<tr>--}}
                                                    {{--<td>{!! Form::label('new_contract_template', __('accounts::employee-contract.new_contract_template'), ['class' => 'form-label']) !!}</td>--}}
                                                    {{--<td><div class="col-md-12">{!! Form::select('new_contract_template',[''] , null, ['class' => 'col-md-10 input-sm form-control']) !!}</div></td>--}}
                                                    {{--</tr>--}}
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                                            <h4 class="card-title">@lang('accounts::employee-contract.monthly_advantages')</h4>

                                            <table class="table">
                                                <tr>
                                                    <th width="30%">{!! Form::label('wage', __('accounts::employee-contract.wage'), ['class' => 'label-control required']) !!}</th>
                                                    <td>{!! Form::label('wage', $basicSalary) !!}</td>
                                                </tr>
                                                {{--<tr>--}}
                                                {{--<td>{!! Form::label('fuel_card', __('accounts::employee-contract.fuel_card'), ['class' => 'label-control']) !!}</td>--}}
                                                {{--<td>{!! Form::text('fuel_card', null, ['class' => 'form-control input-sm col-md-10']) !!}</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                {{--<td>{!! Form::label('meal_voucher', __('accounts::employee-contract.meal_vouchers'), ['class' => 'label-control']) !!}</td>--}}
                                                {{--<td>{!! Form::text('meal_voucher', null, ['class' => 'form-control input-sm col-md-10']) !!}</td>--}}
                                                {{--</tr>--}}
                                                {{--<tr>--}}
                                                {{--<td>{!! Form::label('commission_on_target', __('accounts::employee-contract.commission_on_target'), ['class' => 'label-control']) !!}</td>--}}
                                                {{--<td>{!! Form::text('commission_on_target', null, ['class' => 'form-control input-sm col-md-10']) !!}</td>--}}
                                                {{--</tr>--}}
                                            </table>
                                            <h4 class="card-title">@lang('accounts::employee-contract.monthly_benefit_in_kind')</h4>
                                            <table class="table">
                                                <tr>
                                                    <th width="30%">{!! Form::label('house_allotment', __('accounts::employee-contract.house_allotment'), ['class' => 'label-control required']) !!}</th>
                                                    <td>{!! Form::label('house_allotment', ($contract->house_allotment) ? 'Yes': 'No') !!}</td>
                                                    <td></td>
                                                </tr>
                                                @foreach($assignedRules as $assignedRule)
                                                    @if($assignedRule['amount_type'] == 3 and $assignedRule['category'] != 'Deduction')
                                                        <tr>
                                                            <th width="30%">{!! Form::label($assignedRule['name'], $assignedRule['name'],
                                                         ['class' => 'label-control']) !!}</th>
                                                            <td>
                                                                <label>{{$assignedRule['amount']}}</label>
                                                            </td>
                                                            <td>{!! Form::label('remark' ,($assignedRule['remark'])?? " ", ['class' => 'form-label']) !!}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
                                            <h4 class="card-title">@lang('accounts::payroll.deduction_payment')</h4>
                                            <table class="table">
                                                <tr>
                                                    <th>
                                                       {{App::getLocale() == 'bn'? $gpfRule->bangla_name : $gpfRule->name}}
                                                    </th>
                                                    <td>{{$assignedRules[$gpfRule->id]['amount']}}</td>
                                                    <td>{{$gpfPercentage}} %</td>
                                                </tr>
                                                @foreach($assignedRules as $assignedRule)
                                                    @if($assignedRule['salary_rule_code'] == 'GPFC')
                                                        @continue;
                                                    @endif
                                                    @if($assignedRule['amount_type'] == 3 and $assignedRule['category'] == 'Deduction')
                                                        <tr>
                                                            <th width="30%">{!! Form::label($assignedRule['name'],  $assignedRule['name'],
                                                         ['class' => 'label-control']) !!}</th>
                                                            <td>
                                                                <label>{{$assignedRule['amount']}}</label>
                                                            </td>
                                                            <td>{!! Form::label('remark' ,($assignedRule['remark'])?? " ", ['class' => 'form-label']) !!}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab14" aria-labelledby="base-tab14">
                                            <table class="table">
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
                                                        <td><span
                                                                class="badge {{$statusArr[$gpfRecord->status]}}"> {{$gpfRecord->status ? 'Active' : 'Inactive'}}</span>
                                                        </td>
                                                        <td>{{date('d F, Y', strtotime($gpfRecord->created_at))}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- salary-outstanding data -->
                                        <div class="tab-pane" id="tab15" aria-labelledby="base-tab15">
                                            <table class="table table-striped table-bordered alt-pagination"
                                                   style="overflow: auto">
                                                <thead>
                                                <tr>
                                                    <th>@lang('labels.serial')</th>
                                                    <th>@lang('accounts::employee-contract.outstanding.form_elements.salary_rule')</th>
                                                    <th>@lang('accounts::employee-contract.outstanding.form_elements.month')</th>
                                                    <th>@lang('accounts::employee-contract.outstanding.form_elements.amount')</th>
                                                    <th>@lang('accounts::employee-contract.outstanding.form_elements.remark')</th>
                                                    <th>@lang('labels.status')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $statusArr = ['inactive'=>'badge-danger', 'active'=>'badge-success'];
                                                @endphp
                                                @foreach($outstandings as $outstanding)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$outstanding->salaryRule->name ?? ''}}</td>
                                                        <td>{{$outstanding->month ?? ''}}</td>
                                                        <td>{{$outstanding->amount ?? ''}}</td>
                                                        <td>{{$outstanding->remark ?? ''}}</td>
                                                        <td>
                                                            <span class="badge {{$statusArr[$outstanding->status]}}">
                                                                {{$outstanding->status}}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <a href="{{route('employee-contracts.edit', $contract->id)}}" class="btn btn-primary"><i
                                        class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                                {{--<a href="{{URL::to( '/tms/trainee/show/'.$employeeContract->id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>--}}
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{route('employee-contracts.index')}}">
                                    <i class="ft-x"></i> {{trans('labels.back_page')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
