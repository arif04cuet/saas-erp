@extends('vms::layouts.master')
@section('title', trans('vms::fuelLogBook.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('vms::fuelLogBook.title') @lang('labels.details')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h4 class="form-section"><i class="la la-tag"></i> @lang('labels.details')</h4>
                        <table class="table">
                            <tr>
                                <th>@lang('vms::fuelLogBook.form_elements.vehicle')</th>
                                <td>{{ $fuelLog->vehicle->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::fuelLogBook.form_elements.type')</th>
                                <td>{{$fuelLog->vehicleType->getTitle() ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::fuelLogBook.form_elements.fuel_type')</th>
                                <td>{{ trans("vms::fuelLogBook.fuel_type.".$fuelLog->fuel_type) }}</td>
                            </tr>

                            <tr>
                                <th>@lang('vms::fuelLogBook.form_elements.fuel_quantity')</th>
                                <td>{{ $fuelLog->fuel_quantity ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::fuelLogBook.form_elements.filling_station')</th>
                                <td>{{ $fuelLog->fillingStation->name ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::fuelLogBook.form_elements.amount')</th>
                                <td>{{ $fuelLog->amount ?? trans('labels.not_found') }}</td>
                            </tr>

                            <tr>
                                <th>@lang('vms::fuelLogBook.form_elements.voucher_number')</th>
                                <td>{{ $fuelLog->voucher_number }}</td>
                            </tr>

                            <tr>
                                <th>@lang('labels.date')</th>
                                <td>{{ date('d-m-Y', strtotime($fuelLog->date)) }}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-md-5">
                        <h4 class="form-section"><i class="la la-tag"></i> @lang('vms::fuelLogBook.voucher_attachment')
                        </h4>
                        <br>
                        @if(!empty($fuelLog->acknowledgement_slip))
                            <img src="{{ '/file/get?filePath='.$fuelLog->acknowledgement_slip }}"
                                 style="width: 100%; max-height: 500px; border: 1px #EEE solid; padding: 8px;"
                                 id="prescription_img">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-12">
                <a href="{{route('vms.fuel.log.index')}}" class="btn btn-danger">
                    <i class="la la-backward"></i> @lang('labels.back_page')
                </a>
            </div>
        </div>
    </div>
    </div>

@endsection


@push('page-js')
@endpush
