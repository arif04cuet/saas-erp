@extends('vms::layouts.master')
@section('title', trans('vms::maintenanceItem.table.details'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('vms::maintenanceItem.title') @lang('labels.details')</h4>
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
                <h4 class="form-section"><i class="la la-tag"></i> @lang('labels.details')</h4>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::maintenanceItem.table.item_name_en')</th>
                                <td>{{ $item->item_name_en }}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::maintenanceItem.table.item_name_bn')</th>
                                <td>{{ $item->item_name_bn }}</td>
                            </tr>

                            <tr>
                                <th>@lang('vms::maintenanceItem.table.item_short_name')</th>
                                <td>{{ $item->short_name }}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12">
                    <a href="{{route('vms.maintenance.item.index')}}" class="btn btn-danger">
                        <i class="la la-backward"></i> @lang('labels.back_page')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('page-js')
@endpush
