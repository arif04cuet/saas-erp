@extends('ims::layouts.master')
@section('title', __('ims::inventory.item.title').' '.__('labels.show'))

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/pages/timeline.css') }}">
@endpush

@section('content')

    <!-- Inventory Item Information Card -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('ims::inventory.item.title') @lang('labels.show')</h4>
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
                        <div class="row">
                            <!-- Item Information -->
                            <div class="col-md-7">
                                <table class="table">
                                    <tr>
                                        <th>@lang('ims::inventory.inventory_item_category')</th>
                                        <td>{{$item->category->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.title')</th>
                                        <td>{{$item->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::inventory.item.unique_id')</th>
                                        <td>{{$item->unique_id}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::inventory.item.model')</th>
                                        <td>{{$item->model}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::inventory.item.unit_price')</th>
                                        <td>{{$item->unit_price}}/-</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::inventory.item.invoice_no')</th>
                                        <td>{{$item->invoice_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::inventory.location')</th>
                                        <td>{{optional($item->location)->getName() ?? __('ims::inventory.item.no_location')}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.details')</th>
                                        <td>{{$item->remark}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.status')</th>
                                        <td>
                                        <span class="badge badge-{{$item->status == 'active' ? "success": "danger"}}">
                                            {{ucwords($item->status)}}
                                        </span>
                                        </td>
                                    </tr>

                                </table>
                            </div>

                            <div style="margin-left: 20px"></div>

                            <!-- Item Life Cycle Timeline -->
                            <div class="col-md-4" style="max-height: 500px; overflow: auto">
                                <section id="timeline" class="timeline-left timeline-wrapper">
                                    <h3 class="page-title text-center text-lg-left">
                                        @lang('ims::inventory.item.timeline.title')
                                    </h3>
                                    <ul class="timeline">
                                        <li class="timeline-line"></li>
                                    @php
                                        $bgClasses = [
                                            'requisition' => 'bg-info',
                                             'transfer' => 'bg-primary',
                                              'scrap' => 'bg-warning',
                                               'abandon' => 'bg-danger'
                                               ];
                                        $faClasses = [
                                            'requisition' => 'la-check-circle',
                                             'transfer' => 'la-exchange ',
                                              'scrap' => 'la-recycle',
                                               'abandon' => 'la-trash'
                                               ];
                                    @endphp

                                    <!-- Timeline Event: Item's travel through various inventory requests -->
                                        @foreach($item->requests->reverse() as $request)
                                            @php
                                                $inventoryRequest = $request->request;
                                            @endphp
                                            <li class="timeline-item" style="margin-bottom: -70px">
                                                <div class="timeline-badge">
                                                <span class="{{$bgClasses[$inventoryRequest->type ?? 'bg-warning']}} bg-lighten-1" data-toggle="tooltip"
                                                      data-placement="right"
                                                      title="{{__('ims::inventory.inventory_request_types.' . $inventoryRequest->type)}}">
                                                    <i class="la {{$faClasses[$inventoryRequest->type ?? 'la-question']}}"></i>
                                                </span>
                                                </div>
                                                <div class="timeline-card card border-grey border-lighten-2">
                                                    <div class="card-header">
                                                        <h4 class="card-title">
                                                            <a target="_blank"
                                                               href="{{route('inventory-request.show', $inventoryRequest->id)}}">
                                                                @lang('ims::inventory.inventory_request_types.' .
$inventoryRequest->type)
                                                            </a>
                                                        </h4>
                                                        <p class="card-subtitle text-muted pt-1">
                                                        <span class="font-small-3">
                                                            {{__('ims::inventory.item.timeline.date', [
    'date' => \App\Utilities\MonthNameConverter::convertMonthToBn($inventoryRequest->updated_at, false, true),
    'user' => optional($inventoryRequest->requester)->name ?? ""
    ]
    )}}
                                                        </span>
                                                        </p>
                                                        <p class="card-subtitle text-muted pt-1">
                                                        <span class="font-small-3">
                                                            @if(!empty($inventoryRequest->fromLocation))
                                                                {{__('ims::inventory.item.timeline.from_to', [
        'from' => optional($inventoryRequest->fromLocation)->getName() ?? __('labels.not_found'),
        'to' => optional($inventoryRequest->toLocation)->getName() ?? __('labels.not_found')
        ]
        )}}
                                                            @else
                                                                {{__('ims::inventory.item.timeline.to', [
    'to' => optional($inventoryRequest->toLocation)->getName() ?? __('labels.not_found')
    ]
    )}}
                                                            @endif
                                                        </span>
                                                        </p>
                                                        <a class="heading-elements-toggle"><i
                                                                class="la la-ellipsis-h font-medium-3"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                    @endforeach

                                    <!-- Timeline event: Item Created -->
                                        <li class="timeline-item" style="margin-bottom: -70px">
                                            <div class="timeline-badge">
                                                <span class="bg-success bg-lighten-1" data-toggle="tooltip"
                                                      data-placement="right"
                                                      title="{{__('ims::inventory.item.timeline.created')}}">
                                                    <i class="la la-save"></i>
                                                </span>
                                            </div>
                                            <div class="timeline-card card border-grey border-lighten-2">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        <a href="#">
                                                            @lang('ims::inventory.item.timeline.created')
                                                        </a>
                                                    </h4>
                                                    <p class="card-subtitle text-muted pt-1">
                                                        <span class="font-small-3">
                                                            {{__('ims::inventory.item.timeline.date', [
    'date' => \App\Utilities\MonthNameConverter::convertMonthToBn($item->created_at, false, true),
    'user' => optional($item->creator)->name ?? ""
    ]
    )}}
                                                        </span>
                                                    </p>
                                                    <a class="heading-elements-toggle"><i
                                                            class="la la-ellipsis-h font-medium-3"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- 2014 -->
                                    <ul class="timeline">

                                        <li class="timeline-group">
                                            <span class="bg bg-primary white" style="padding: 8px 8px 8px 8px">
                                                <i class="ft-calendar"></i>
                                                @lang('ims::inventory.item.timeline.end')
                                            </span>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="col-md-12">
                        @if($item->status == 'inactive')
                            <a href="{{route('inventory-items.edit', $item->id)}}" class="btn btn-success">
                                <i class="la la-edit"></i> @lang('labels.edit')
                            </a>
                        @endif
                        <a href="{{route('inventory-items.index')}}" class="btn btn-warning">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
