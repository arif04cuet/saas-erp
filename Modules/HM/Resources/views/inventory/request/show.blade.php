@extends('hm::layouts.master')

@section('title', trans('hm::hm_inventory.inventory_request'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('hm::hm_inventory.inventory_request') @lang('labels.show')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="heading-elements mt-2" style="margin-right: 10px;">
                <a href="{{ route('hm-inventory-request.index') }}" class="btn btn-primary btn-sm">
                    <i class="ft-list white"> @lang('ims::inventory.inventory_request') @lang('labels.list')</i>
                </a>
                @if(!in_array($inventoryRequest->status, ['approved', 'received', 'rejected']))

                    @if($inventoryRequest->status == 'new')
                        <a href="{{ route('inventory-request.create.detail', [$inventoryRequest->type, $inventoryRequest->id]) }}"
                           class="btn btn-success btn-sm" target="_blank">
                            <i class="ft-upload"></i> @lang('labels.details') @lang('labels.update')
                        </a>
                    @elseif($inventoryRequest->isRecipient())
                        <a href="{{ route('inventory-request.create.detail', [$inventoryRequest->type, $inventoryRequest->id]) }}"
                           class="btn btn-success btn-sm" target="_blank">
                            <i class="ft-upload"></i> @lang('labels.details') @lang('labels.update')
                        </a>
                    @endif

                @endif
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                <h4 class="form-section"><i
                        class="la la-tag"></i>@lang('ims::inventory.inventory_request') @lang('labels.details')</h4>
                <div class="row">
                    <div class="col-5">
                        <table class="table">
                            <tr>
                                <th>@lang('ims::inventory.inventory_request_title')</th>
                                <td>{{ $inventoryRequest->title }}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.requester')</th>
                                <td>{{ $inventoryRequest->requester ? $inventoryRequest->requester->name : '' }}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.receiver')</th>
                                <td>{{ $inventoryRequest->receiver ? $inventoryRequest->receiver->name : '' }}</td>
                            </tr>
                            <tr>
                                <th>@lang('ims::inventory.inventory_request_type')</th>
                                <td>{{ trans('ims::inventory.inventory_request_types.' . $inventoryRequest->type) }}</td>
                            </tr>
                            <tr>
                                <th>@lang('ims::location.from_location')</th>
                                <td>{{ $inventoryRequest->fromLocation ? $inventoryRequest->fromLocation->name : '' }}</td>
                            </tr>
                            <tr>
                                <th>@lang('ims::location.to_location')</th>
                                <td>{{ $inventoryRequest->toLocation ? $inventoryRequest->toLocation->name : '' }}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.status')</th>
                                <td>{{ trans('labels.' . $inventoryRequest->status) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-7">
                        <table class="table">
                            <tr>
                                <th>@lang('ims::product.title')</th>
                                <th>@lang('ims::inventory.type')</th>
                                <th>@lang('ims::inventory.unit')</th>
                                <th>@lang('labels.quantity')</th>
                            </tr>
                            @foreach($inventoryRequest->details as $item)
                                {{--                                {{ dd($item->category) }}--}}
                                <tr>
                                    <td>{{ $item->category->name }}</td>
                                    <td>
                                        @if($item->category->type)
                                            @lang('ims::inventory.' . preg_replace('/\s+/', '_', $item->category->type))
                                        @endif
                                    </td>
                                    <td>{{ $item->category->unit }}</td>
                                    <td>{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
