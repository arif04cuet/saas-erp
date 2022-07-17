@extends('accounts::layouts.master')
@section('title', trans('accounts::salary-rule.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"
                        id="basic-layout-form">@lang('accounts::salary-rule.title') @lang('labels.show')</h4>
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
                                <td>{{$salaryRule->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-rule.bangla_name')</th>
                                <td>{{$salaryRule->bangla_name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.code')</th>
                                <td>{{$salaryRule->code}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::payroll.salary_category')</th>
                                <td>{{$salaryRule->salaryCategory->name}}</td>
                            </tr>
                            <!-- debit account -->
                            <tr>
                                <th>@lang('accounts::journal.debit')</th>
                                <td>{{$salaryRule->debit_economy_code->code ?? ''}}</td>
                            </tr>
                            <!-- credit account -->
                            <tr>
                                <th>@lang('accounts::journal.credit')</th>
                                <td>{{$salaryRule->credit_economy_code->code ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-rule.contribution_register')</th>
                                <td>{{$salaryRule->contribution_register ?? ''}}</td>
                            </tr>

                            <tr>
                                <th>@lang('accounts::salary-rule.show_on_payslip')</th>
                                <td>{{($salaryRule->show_on_payslip)? __('labels.yes') : __('labels.no')}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h3 class="form-section">@lang('accounts::salary-rule.conditions')</h3>
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-rule.conditions_based_on')</th>
                                <td>{{$conditions[$salaryRule->condition_type]}}</td>
                            </tr>
                            @if($salaryRule->condition_type == 2)
                                <tr>
                                    <th>@lang('accounts::salary-rule.range_based_on')</th>
                                    <td>{{$salaryRule->conditionBasedRule->name}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('accounts::salary-rule.min_range')</th>
                                    <td>{{$salaryRule->min_range}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('accounts::salary-rule.max_range')</th>
                                    <td>{{$salaryRule->max_range}}</td>
                                </tr>
                            @elseif($salaryRule->condition_type == 3)
                                <tr>
                                    <th>@lang('accounts::salary-rule.expression')</th>
                                    <td>{{$salaryRule->condition_expression}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="2">
                                    <h3 class="form-section">@lang('accounts::salary-rule.computations')</h3>
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-rule.amount_type')</th>
                                <td>{{$amountTypes[$salaryRule->amount_type]}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::salary-rule.quantity')</th>
                                <td>{{$salaryRule->quantity}}</td>
                            </tr>
                            @if($salaryRule->amount_type == 1)
                                <tr>
                                    <th>@lang('accounts::salary-rule.fixed_amount')</th>
                                    <td>{{$salaryRule->fixed_amount}}</td>
                                </tr>
                            @elseif($salaryRule->amount_type == 2)
                                <tr>
                                    <th>@lang('accounts::salary-rule.percentage_based_on')</th>
                                    <td>{{$salaryRule->percentageBasedRule->name}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('accounts::salary-rule.percentage')</th>
                                    <td>{{$salaryRule->percentage}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('accounts::salary-rule.min_amount')</th>
                                    <td>{{$salaryRule->min_amount ?? "-"}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('accounts::salary-rule.max_amount')</th>
                                    <td>{{$salaryRule->max_amount ?? "-"}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <h3 class="form-section">@lang('accounts::salary-rule.child_rules')</h3><hr>
                            <table class="table">
                                <tbody>
                                @if(count($salaryRule->children))
                                    @foreach($salaryRule->children as $rule)
                                        @php $thisRule = $rule->salaryRule; @endphp
                                        <tr>
                                            <td>
                                                <a href="{{route('salary-rule.show', $thisRule->id)}}" target="_blank">
                                                    {{$thisRule->name}}
                                                </a>
                                            </td>
                                            <td>{{$thisRule->code}}</td>
                                            <td>{{$thisRule->salaryCategory->name}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>No Child Rules Found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="form-actions">
                            <a href="{{route('salary-rule.edit', $salaryRule->id)}}" class="btn btn-primary"><i
                                        class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
                            {{--<a href="{{URL::to( '/tms/trainee/show/'.$salaryRule->id)}}" class="btn btn-primary"><i class="ft-list"></i> {{trans('tms::training.trainee_card_title')}}</a>--}}
                            <a class="btn btn-warning mr-1" role="button" href="{{route('salary-rule.index')}}">
                                <i class="ft-x"></i> {{trans('labels.back_page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
