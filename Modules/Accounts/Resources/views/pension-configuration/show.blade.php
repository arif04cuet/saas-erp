@extends('accounts::layouts.master')
@section('title', trans('accounts::pension.configuration.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">@lang('accounts::pension.configuration.title')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.percentage')</th>
                                <td>{{$pensionConfiguration->percentage ?? 0}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.lump_sum_number')</th>
                                <td>{{$pensionConfiguration->lump_sum_number ?? 0}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.lump_sum_percentage')</th>
                                <td>{{$pensionConfiguration->lump_sum_percentage ?? 0}}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.monthly_pension_percentage')</th>
                                <td>{{$pensionConfiguration->monthly_pension_percentage ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.minimum_pension_amount')</th>
                                <td>{{$pensionConfiguration->minimum_pension_amount ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.medical_allowance_increment_age')</th>
                                <td>{{$pensionConfiguration->medical_allowance_increment_age ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.initial_medical_allowance')</th>
                                <td>{{$pensionConfiguration->initial_medical_allowance ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>@lang('accounts::pension.configuration.form_elements.medical_allowance_after_increment')</th>
                                <td>{{$pensionConfiguration->medical_allowance_after_increment ?? 0 }}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.status')</th>
                                @if($pensionConfiguration->status == \Modules\Accounts\Entities\PensionConfiguration::status[0])
                                    <td>
                                       <span
                                           class="badge badge-success">@lang('accounts::pension.configuration.form_elements.status.active')</span>
                                    </td>
                                @else
                                    <td>
                                    <span
                                        class="badge badge-danger">@lang('accounts::pension.configuration.form_elements.status.inactive')</span>
                                    </td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                        <h4 class="card-title" id="basic-layout-form">@lang('accounts::pension.rule.title')</h4>

                        <table class="table table-striped table-bordered alt-pagination"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('accounts::pension.rule.form_elements.name')</th>
                                <th>@lang('accounts::pension.rule.form_elements.type')</th>
                                <th>@lang('accounts::pension.rule.form_elements.condition')</th>
                                <th>@lang('accounts::pension.rule.form_elements.amount_type')</th>
                                <th>@lang('accounts::pension.rule.form_elements.percentage_amount')</th>
                                <th>@lang('accounts::pension.rule.form_elements.fixed_amount')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pensionConfiguration->rules  as $pensionRule)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        {{$pensionRule->name ?? ''}}
                                    </td>
                                    <td>
                                        {{\Illuminate\Support\Facades\Config::get('constants.pension.rule.type.'.$pensionRule->type) ?? ''}}
                                    </td>
                                    <td>
                                        {{\Illuminate\Support\Facades\Config::get('constants.pension.rule.condition.'.$pensionRule->condition) ?? ''}}
                                    </td>
                                    <td>
                                        {{\Illuminate\Support\Facades\Config::get('constants.pension.rule.amount_type.'.$pensionRule->amount_type) ?? ''}}
                                    </td>
                                    <td>
                                        {{$pensionRule->percentage_amount ?? ''}}
                                    </td>
                                    <td>
                                        {{$pensionRule->fixed_amount ?? ''}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <a href="{{route('pension-configuration.edit', $pensionConfiguration->id)}}"
                       class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>

                    <a class="btn btn-warning mr-1" role="button" href="{{route('pension-configuration.index')}}">
                        <i class="ft-x"></i> {{trans('labels.back_page')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
