@extends('ims::layouts.master')

@section('title', trans('ims::inventory.item.item_request.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    @if($inventoryItemRequest->status == 'rejected')
                        <li><span class="badge badge-danger"
                                  style="padding: 8px;">{{ trans('hm::booking-request.rejected') }}</span>
                        </li>
                    @elseif($inventoryItemRequest->status == 'approved')
                        <li><span class="badge badge-success"
                                  style="padding: 8px;">{{ trans('hm::booking-request.approved') }}
                            </span>
                        </li>
                    @else

                        <li><span class="badge badge-warning"
                                  style="padding: 8px;">{{ trans('hm::booking-request.pending') }}</span>
                        </li>
                    @endif

                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="card-title">
                <h4 class="form-section"><i
                        class=""></i> @lang('ims::inventory.item.item_request.details')
                </h4>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <h4 class="form-section"><i
                        class="la  la-building-o"></i> @lang('labels.details')
                </h4>
                <div class="row">
                    <!-- request details -->
                    <div class="col-5">

                        <table class="table">
                            <tr>
                                <th>@lang('ims::inventory.inventory_request_title')</th>
                                <td>{{ $inventoryItemRequest->title }}</td>
                            </tr>
                            <tr>
                                <th>@lang('labels.requester')</th>
                                <td>{{ $inventoryItemRequest->requester ? $inventoryItemRequest->requester->name : '' }}</td>
                            </tr>
                            <tr>
                                <th>@lang('ims::inventory.item.item_request.form_elements.purpose')</th>
                                <td>{{  trans('ims::inventory.item.item_request.purpose.'.$inventoryItemRequest->purpose) }}</td>
                            </tr>
                            <tr>
                                <th>@lang('ims::inventory.item.item_request.form_elements.reason')</th>
                                <td>{{ $inventoryItemRequest->reason ?? trans('labels.not_found') }}</td>
                            </tr>

                            <tr>
                                <th>@lang('labels.status')</th>
                                <td>{{ trans('labels.' . $inventoryItemRequest->status) }}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- Requested Existing Inventory Categories -->
                    <div class="col-md-7">
                        <h4 class="head-title"><i
                                class="la la-tag"></i>@lang('ims::inventory.item.item_request.title')</h4>
                        <table class="table table-striped">
                            <tr>
                                <th>@lang('ims::product.title')</th>
                                <th>@lang('labels.quantity')</th>
                            </tr>
                            @foreach($inventoryItemRequest->details as $detail)
                                <tr>
                                    <td>{{ optional($detail->inventoryItemCategory)->name ?? trans('labels.not_found')}}</td>
                                    <td> @enToBnNumber($detail->quantity ?? 0 )</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
