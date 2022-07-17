@extends('mms::layouts.master')
@section('title', trans('mms::medicine_inventory.site_titel'))
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> @lang('mms::medicine.medicine_info')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="heading-elements mt-2" style="margin-right: 10px;">
                <a href="{{ route('inventories.medicines.index') }}" class="btn btn-primary btn-sm">
                    <i class="ft-list white"> @lang('mms::medicine_inventory.list')</i>
                </a>
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">

                <div class="row">
                    <div class="col-12 col-md-5">
                        <h4 class="form-section"><i
                                class="la la-tag"></i> @lang('mms::medicine_inventory.inventory_medicine_details')</h4>
                        <table class="table">

                            <tr>
                                <th>@lang('mms::medicine.name')</th>
                                <td>{{$medicineInfo->medicine->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine.generic_name')</th>
                                <td>{{$medicineInfo->medicine->generic_name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine.group')</th>
                                <td>{{$medicineInfo->medicine->group->name}}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine_inventory.piece')</th>
                                <td>{{$medicineInfo->quantity}}</td>
                            </tr>
                            <tr>
                                <th>@lang('mms::medicine_inventory.last_update_date')</th>
                                <td>{{ date('d-m-Y', strtotime($medicineInfo->updated_at)) }}</td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4 class="form-section"><i
                                class="la la-tag"></i> @lang('mms::medicine_inventory.previous_history')</h4>

                        <table class="table">
                            <tr>
                                <th>@lang('mms::medicine_inventory.date')</th>
                                <th>@lang('mms::medicine_inventory.piece')</th>
                                <th>@lang('mms::medicine_inventory.flow_type')</th>
                                <th>@lang('mms::medicine_inventory.previous_quantity')</th>
                            </tr>
                            @php $total=0; @endphp
                            @foreach($inventoryHistory as $history)
                                @php  $total+=$history->quantity  @endphp
                                <tr>
                                    <td>{{ date('d-m-Y', strtotime($history->created_at)) }}</td>
                                    <td>{{$history->quantity}}</td>
                                    <td>{{$history->flow_type}}</td>
                                    <td>{{$history->previous_quantity}}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-js')
@endpush
