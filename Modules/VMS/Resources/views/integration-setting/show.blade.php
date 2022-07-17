@extends('vms::layouts.master')

@section('title', trans('vms::trip.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1>@lang('vms::integration.title')</h1>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <!-- Integration Codes -->
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::integration.title')
                </h4>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::integration.form_elements.salary_rule_id')</th>
                                <td>{{$vmsIntegrationSetting->salaryRule->getName() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::integration.form_elements.tms_sub_sector_id')</th>
                                <td>{{$vmsIntegrationSetting->tmsSubSector->getTitle() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::integration.form_elements.fuel_bill_economy_code')</th>
                                <td>{{$vmsIntegrationSetting->fuelBill->getName() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::integration.form_elements.vehicle_maintenance_economy_code')</th>
                                <td>{{$vmsIntegrationSetting->vehicleMaintenance->getName() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::integration.form_elements.project_economy_code')</th>
                                <td>{{$vmsIntegrationSetting->project->getName() ?? trans('labels.not_found')}}</td>
                            </tr>
                        </table>
                    </div>

                </div>
                <!-- Bank/Cash Codes  -->
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::integration.bank_cash_title')
                </h4>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::integration.form_elements.accounts_bank_cash_economy_code')</th>
                                <td>{{$vmsIntegrationSetting->accountsBankCash->getName() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::integration.form_elements.tms_bank_cash_economy_code')</th>
                                <td>{{$vmsIntegrationSetting->tmsBankCash->getTitle() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::integration.form_elements.pms_bank_cash_economy_code')</th>
                                <td>{{$vmsIntegrationSetting->pmsBankCash->getName() ?? trans('labels.not_found')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Save & Cancel Button -->
                <div class="form-actions text-center">

                    @if(is_null($vmsIntegrationSetting))
                        <a role="button" href="{{route('vms.integration.setting.create')}}"
                           class="btn btn-outline-primary">
                            <i class="la la-check-square"></i>@lang('labels.create')
                        </a>
                    @else
                        <a role="button" href="{{route('vms.integration.setting.edit',$vmsIntegrationSetting)}}"
                           class="btn btn-outline-primary">
                            <i class="la la-check-square"></i>@lang('labels.edit')
                        </a>
                        <a class="btn btn-outline-warning mr-1" role="button"
                           href="{{route('vms.integration.setting.show',$vmsIntegrationSetting)}}">
                            <i class="ft-x"></i> @lang('labels.cancel')
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
