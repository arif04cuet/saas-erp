@extends('vms::layouts.master')
@section('title',trans('vms::trip.title'))

@section('content')

    <section id="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('vms::trip.setting.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('vms.trip.setting.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('vms::trip.setting.create') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('vms::trip.setting.form_elements.per_km_taka')</th>
                                        <th>@lang('vms::trip.setting.form_elements.per_hour_taka')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($regularTripCalculationSettings as $tripCalculationSetting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$tripCalculationSetting->title ?? trans('labels.not_found')}}</td>
                                            <td>{{$tripCalculationSetting->per_km_taka ?? trans('labels.not_found')}}</td>
                                            <td>{{$tripCalculationSetting->per_hour_taka ?? trans('labels.not_found')}}</td>
                                            <td>
                                                <p class="btn btn-{{$statusCssArray[$tripCalculationSetting->status]}} btn-sm">
                                                    {{trans('labels.'.$tripCalculationSetting->status)}}
                                                </p>
                                            </td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href=" {{ route('vms.trip.setting.edit',  $tripCalculationSetting->id )}}"
                                                           class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
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
            </div>
        </div>
        <!-- Exceed Speed limit Index -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('vms::trip.setting.exceed_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('vms::trip.setting.form_elements.per_km_taka')</th>
                                        <th>@lang('vms::trip.setting.form_elements.per_hour_taka')</th>
                                        <th>@lang('vms::trip.setting.form_elements.oil_price')</th>
                                        <th>@lang('vms::trip.setting.form_elements.gas_price')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exceedTripCalculationSettings as $tripCalculationSetting)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$tripCalculationSetting->title ?? trans('labels.not_found')}}</td>
                                            <td>{{$tripCalculationSetting->per_km_taka ?? trans('labels.not_found')}}</td>
                                            <td>{{$tripCalculationSetting->per_hour_taka ?? trans('labels.not_found')}}</td>
                                            <td>{{$tripCalculationSetting->oil_price ?? trans('labels.not_found')}}</td>
                                            <td>{{$tripCalculationSetting->gas_price ?? trans('labels.not_found')}}</td>
                                            <td>
                                                <p class="btn btn-{{$statusCssArray[$tripCalculationSetting->status]}} btn-sm">
                                                    {{trans('labels.'.$tripCalculationSetting->status)}}
                                                </p>
                                            </td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href=" {{ route('vms.trip.setting.edit',  $tripCalculationSetting->id )}}"
                                                           class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
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
            </div>
        </div>

    </section>
@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

@endpush
