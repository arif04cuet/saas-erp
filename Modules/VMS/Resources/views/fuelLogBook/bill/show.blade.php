@extends('vms::layouts.master')
@section('title', trans('vms::fuelBillSubmit.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('vms::fuelBillSubmit.title') @lang('labels.details')</h4>
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
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="fuel-bill-list-table table table-bordered">
                                <tbody>
                                <tr>
                                    <th>@lang('vms::fuelBillSubmit.form_elements.filling_station')</th>
                                    <td>{{$fuelBill->fillingStation->name  ?? trans('labels.not_found')}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.date')</th>
                                    <td>{{  date('d M Y', strtotime($fuelBill->date)) }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('vms::fuelBillSubmit.form_elements.amount')</th>
                                    <td>{{$fuelBill->amount ?? trans('labels.not_found')}}</td>
                                </tr>
                                </tbody>

                            </table>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="fuel-bill-list-table table table-bordered">
                                <tbody>
                                <tr>
                                    <th>@lang('vms::fuelBillSubmit.form_elements.attachment')</th>
                                    @if(empty($fuelBill->acknowledgement_one))
                                        <td>
                                            {{trans('labels.not_found')}}
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('file.getfile',['filePath'=>$fuelBill->acknowledgement_one]) }}"
                                               target="_blank" class="btn btn-info btn-sm">
                                                View
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th>@lang('vms::fuelBillSubmit.form_elements.attachment')</th>
                                    @if(!empty($fuelBill->acknowledgement_two))
                                        <td>
                                            <a href="{{ route('file.getfile',['filePath'=>$fuelBill->acknowledgement_two]) }}"
                                               target="_blank" class="btn btn-info btn-sm">
                                                View
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            {{trans('labels.not_found')}}
                                        </td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="col-md-12">
                        @if($shouldShowApproveRejectButton)
                            <div class="form-actions text-center">
                                <a class="btn btn-outline-success mr-1" role="button"
                                   href="{{route('vms.fuel.bill.change-status',[$fuelBill->id,Modules\VMS\Entities\VehicleFuelBillSubmit::getStatuses()['approved']])}}">
                                    <i class="la la-check-square"></i> @lang('labels.approve')
                                </a>
                                <a class="btn btn-outline-danger mr-1" role="button"
                                   href="{{route('vms.fuel.bill.change-status',[$fuelBill->id,Modules\VMS\Entities\VehicleFuelBillSubmit::getStatuses()['rejected']])}}">
                                    <i class="ft-x la la-check-square"></i> @lang('labels.reject')
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@push('page-js')
@endpush
