@extends('tms::layouts.master')

@section('title', trans('ims::inventory.item.item_request.index'))

@section('content')
    <section id="product-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::inventory.item.item_request.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('inventory-item-request.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('ims::inventory.item.item_request.create') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="inventory-request-table table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('ims::inventory.item.item_request.title')</th>
                                        <th>@lang('hrm::photocopy_management.requester')</th>
                                        <th>@lang('ims::inventory.item.item_request.form_elements.purpose')</th>
                                        <th>@lang('tms::training.title')</th>
                                        <th>@lang('ims::location.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inventoryItemRequests as $inventoryItemRequest)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="#">
                                                    {{ $inventoryItemRequest->title ?? trans('labels.not_found') }}
                                                </a>
                                            </td>
                                            <td>
                                                {{  optional($inventoryItemRequest->requester)->name ?? trans('labels.not_found')  }}
                                            </td>
                                            <td>{{ trans('ims::inventory.item.item_request.purpose.'. $inventoryItemRequest->purpose)  ?? trans('labels.not_found') }}</td>
                                            <td>{{ $inventoryItemRequest->referenceEntity->getTitle()  ?? trans('labels.not_found') }}</td>
                                            <td>
                                                <p class="btn btn-{{$statusCssArray[$inventoryItemRequest->status]}} btn-sm">
                                                    {{trans('ims::inventory.item.item_request.status.'.$inventoryItemRequest->status)}}
                                                </p>
                                            </td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="imsRequestList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="#"
                                                           class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                        <div class="dropdown-divider"></div>
                                                        @if(!in_array($inventoryItemRequest->status, ['approved', 'received', 'rejected']))
                                                            <a href="{{ route('inventory-item-request.edit', $inventoryItemRequest) }}"
                                                               class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
                                                        @endif
                                                         <div class="dropdown-divider"></div>
                                                        @if(in_array($inventoryItemRequest->status, ['new']))
                                                            <a href="{{ route('inventory-item-request.workflow.start', $inventoryItemRequest) }}"
                                                               class="dropdown-item"><i class="ft-edit-2"></i> @lang('ims::inventory.item.item_request.labels.send_to_workflow')</a>
                                                        @endif
                                                    </span>
                                                </span>
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
    </section>
@stop

@push('page-js')



@endpush
