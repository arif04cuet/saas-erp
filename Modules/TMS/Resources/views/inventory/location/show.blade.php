@extends('tms::layouts.master')

@section('title', trans('tms::inventory.tms_inventory_location') . ' ' . trans('labels.details'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('tms::inventory.inventory_location') @lang('labels.details')</h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class=k"ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>@lang('labels.name')</th>
                                        <td>{{ $location->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::location.department')</th>
                                        <td>{{ $location->department->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::location.type')</th>
                                        <td>@lang('ims::location.' . $location->type)</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::location.description')</th>
                                        <td>{{ $location->description }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">

                        <a href="{{ route('inventory-locations.edit', $location->id) }}"
                           class="btn btn-success btn-sm" target="_blank">
                            <i class="ft-edit white">@lang('ims::location.location_edit')</i>
                        </a>
                        <a href="{{ route('tms-inventory-locations.index') }}" class="btn btn-primary btn-sm">
                            <i class="ft-list white">
                                @lang('tms::inventory.inventory_location') @lang('labels.list')
                            </i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('ims::inventory.item_category_list')}}</h4>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('ims::location.location')</th>
                                        <th scope="col">@lang('ims::inventory.category')</th>
                                        <th scope="col">@lang('ims::location.quantity')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($itemLists as $itemList)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                {{$itemList->inventoryLocation->name}}
                                            </td>
                                            <td>{{$itemList->inventoryItemCategory->name}}</td>
                                            <td>
                                                {{$itemList->quantity ?? 0 }}
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

    </div>
@stop


