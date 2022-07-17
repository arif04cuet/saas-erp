@extends('ims::layouts.master')

@section('title', trans('ims::inventory.item_category_details'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('ims::inventory.item_category')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        @if($inventoryItemCategory->type == config('constants.inventory_asset_types.fixed asset'))
                            <a href="{{ route('inventory-items.create', $inventoryItemCategory->id) }}"
                               class="btn btn-sm btn-info"><i class="ft-plus"></i>
                                @lang('ims::inventory.item.title') @lang('labels.add')
                            </a>
                        @endif
                        <a href="{{ route('inventory-item-category.edit', $inventoryItemCategory->id) }}"
                           class="btn btn-success btn-sm">
                            <i class="ft-edit white"> @lang('ims::inventory.item_category_edit')</i>
                        </a>
                        <a href="{{ route('inventory-item-category.index') }}" class="btn btn-warning btn-sm">
                            <i class="ft-x white"> @lang('ims::inventory.item_category_list')</i>
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        <h4 class="form-section">
                            <i class="la la-tag"></i>
                            @lang('ims::inventory.item_category_details')
                        </h4>

                        <!-- Inventory Category Information -->
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-striped">
                                    <tr>
                                        <th>@lang('labels.name')</th>
                                        <td>{{ $inventoryItemCategory->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.id')</th>
                                        <td>{{ $inventoryItemCategory->unique_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::inventory.short_code')</th>
                                        <td>{{ $inventoryItemCategory->short_code }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-striped">
                                    <tr>
                                        <th>@lang('ims::inventory.type')</th>
                                        <td>@lang('ims::inventory.' . preg_replace('/\s+/', '_', $inventoryItemCategory->type))</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::inventory.unit')</th>
                                        <td>{{ $inventoryItemCategory->unit}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.status')</th>
                                        <td>
                                            <span
                                                class="{{ $inventoryItemCategory->is_active ? 'text-success' : 'text-danger' }}">
                                                @lang('labels.' . ($inventoryItemCategory->is_active ? 'active' : 'inactive'))
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Inventory Items Information -->
                    @if($inventoryItemCategory->type ==  config('constants.inventory_asset_types.fixed asset'))
                        <div class="card-body">
                            <div class="form-body">

                                <h4 class="form-section">
                                    <i class="la la-tag"></i>
                                    @lang('ims::inventory.item.title')
                                    <hr>
                                </h4>
                                <table class="table table-bordered table-striped" id="Example1">
                                    <thead class="text-center">
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.title')</th>
                                        <th>@lang('ims::inventory.item.unique_id')</th>
                                        <th>@lang('ims::inventory.item.model')</th>
                                        <th>@lang('ims::inventory.item.unit_price')</th>
                                        <th>@lang('ims::inventory.item.invoice_no')</th>
                                        <th>@lang('ims::inventory.inventory_location')</th>
                                        <th>@lang('labels.details')</th>
                                        <th>@lang('labels.status')</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($inventoryItemCategory->items as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <a href="{{route('inventory-items.show', $item->id)}}" target="_blank">
                                                    {{$item->title}}
                                                </a>
                                            </td>
                                            <td>{{$item->unique_id}}</td>
                                            <td>{{$item->model ?? ""}}</td>
                                            <td class="text-right">{{$item->unit_price ?? ""}}/-</td>
                                            <td>{{$item->invoice_no ?? ""}}</td>
                                            <td>
                                                {{optional($item->location)->name ?? __('ims::inventory.item.no_location')}}
                                            </td>
                                            <td>{{$item->remark ?? ""}}</td>
                                            <td>
                                            <span
                                                class="badge badge-{{$item->status == 'active' ? "success": "danger"}}">
                                                {{ucwords($item->status)}}
                                            </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-js')
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'print'],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });
    </script>
@endpush

