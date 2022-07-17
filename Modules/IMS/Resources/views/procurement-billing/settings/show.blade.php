@extends('ims::layouts.master')

@section('title', trans('ims::procurement.settings.title') . ' ' . trans('labels.show'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('ims::procurement.settings.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements" style="top: 5px;">
                        <ul class="list-inline mb-1">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="col-md-12">
                            <h4 class="form-section">@lang('ims::procurement.settings.title') @lang('labels.details')</h4>
                            <table class="table">
                                <tr>
                                    <th width="20%">@lang('labels.title')</th>
                                    <td>{{ $setting->title }}</td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <th>@lang('ims::procurement.settings.vat_rate')</th>--}}
{{--                                    <td>--}}
{{--                                        {{ \App\Utilities\EnToBnNumberConverter::en2bn($setting->vat_percentage)}} %--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                                <tr>
                                    <th>@lang('ims::procurement.settings.vat_economy_code')</th>
                                    <td>
                                        {{ optional($setting->vatEconomyCode)->getNameWithCode() ?? __('labels.not_found') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('ims::procurement.settings.it_economy_code')</th>
                                    <td>
                                        {{ optional($setting->itEconomyCode)->getNameWithCode() ?? __('labels.not_found') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('ims::procurement.settings.items_economy_code')</th>
                                    <td>
                                        {{ optional($setting->itemsEconomyCode)->getNameWithCode() ?? __('labels.not_found') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('ims::procurement.settings.journal')</th>
                                    <td>
                                        {{ optional($setting->journal)->name ?? __('labels.not_found') }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>@lang('ims::procurement.settings.bill_type')</th>
                                    <td>{{__('ims::procurement.bill_types')[$setting->bill_type]}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('ims::procurement.settings.default')?</th>
                                    <td>{{$setting->is_default ? __('labels.yes') : __('labels.no')}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.remarks')</th>
                                    <td>{{$setting->remark ?? ""}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('procurement-bill-settings.edit', $setting->id) }}"
                       class="btn btn-success">
                        <i class="ft-edit white"> @lang('labels.edit')</i>
                    </a>
                    <a href="{{ route('procurement-bill-settings.index') }}" class="btn btn-warning">
                        <i class="ft-x white"></i>
                        @lang('labels.cancel')
                    </a>
                </div>

            </div>
        </div>
    </div>

@stop


