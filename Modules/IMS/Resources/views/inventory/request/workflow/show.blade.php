@extends('ims::layouts.master')

@section('title', trans('ims::inventory.inventory_request_review_form'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">

                        {{ Form::open(['route' => 'inventory-request.workflow.update', 'method' => 'PUT', 'class' => 'form', 'novalidate']) }}
                        {{ Form::hidden('inventory_request_id', $inventoryRequest->id) }}
                        @php
                            $totalFixedAssetRequests = 0;
                        @endphp
                        <h4 class="form-section"><i
                                class="la  la-building-o"></i> @lang('ims::inventory.inventory_request_review_form')
                        </h4>

                        <div class="row">
                            <div class="col-5">
                                <h4 class="head-title">
                                    @lang('ims::inventory.inventory_request_info')
                                </h4>
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
                                    <tr>
                                        <th>@lang('ims::inventory.inventory_request_purpose')</th>
                                        <td>{{ __('ims::inventory.inventory_request_purposes.' . $inventoryRequest->purpose) }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Requested Existing Inventory Categories -->
                            <div class="col-md-7">
                                @if(count($requestDetailsActive))
                                    <h4 class="head-title"><i
                                            class="la la-tag"></i>@lang('ims::inventory.inventory_request')</h4>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>@lang('ims::product.title')</th>
                                            <th>@lang('ims::inventory.type')</th>
                                            <th>@lang('ims::inventory.unit')</th>
                                            @if(in_array('approve', $possibleTransitions) && $inventoryRequest->status = 'shared')
                                                @if($fromLocation != null)
                                                    <th>{{ trans('ims::workflow.request.details.table.columns.available') }}</th>
                                                @endif
                                            @endif
                                            <th>@lang('ims::inventory.item.requested')</th>
                                            @if($isQuantityAvailable)
                                                <th>@lang('ims::inventory.item.given')</th>
                                            @endif
                                            @if($isQuantityAvailable || $itemViewOption)
                                                <th>@lang('labels.action')</th>
                                            @endif
                                        </tr>
                                        @foreach($requestDetailsActive as $item)
                                            @php
                                                $category = $item->category;
                                                $categoryId = $item->category_id;
                                                $isFixedAsset = $category->type == config('constants.inventory_asset_types.fixed asset');
                                                if ($isFixedAsset) {
                                                    $totalFixedAssetRequests += $item->quantity;
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $category->name ?? __('labels.not_found')}}</td>
                                                <td>@lang('ims::inventory.' . preg_replace('/\s+/', '_', $category->type))</td>
                                                <td>{{ $category->unit }}</td>
                                                @if(in_array('approve', $possibleTransitions) && $inventoryRequest->status = 'shared')
                                                    @if($fromLocation != null)
                                                        <td>{{ get_inventory_quantity($inventoryRequest->id, $categoryId, $fromLocation->id) }}</td>
                                                    @endif
                                                @endif
                                                <td>{{ $item->quantity }}</td>
                                                @if($isQuantityAvailable)
                                                    <td id="selected-for-category-{{$categoryId}}">-</td>
                                                    <td>
                                                        @if($isFixedAsset)
                                                            @include('ims::inventory.request.workflow.modal.select-item')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    title="{{__('ims::inventory.item.select_item')}}"
                                                                    data-backdrop="false"
                                                                    data-target="#item-category-modal-{{$categoryId}}">
                                                                <i class="ft ft-edit"></i>
                                                            </button>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($itemViewOption)
                                                    <td>
                                                        @if($isFixedAsset)
                                                            @include('ims::inventory.request.workflow.modal.view-item')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    title="{{__('ims::inventory.item.view_item')}}"
                                                                    data-backdrop="false"
                                                                    data-target="#item-category-modal-{{$categoryId}}">
                                                                <i class="ft ft-eye"></i>
                                                            </button>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif

                            <!-- Requested New Inventory Categories -->
                                @if(count($requestDetailsNew))
                                    <h4 class="head-title"><i
                                            class="la la-tag"></i> @lang('labels.new') @lang('ims::inventory.inventory_request')
                                    </h4>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>@lang('ims::product.title')</th>
                                            <th>@lang('ims::inventory.type')</th>
                                            <th>@lang('ims::inventory.unit')</th>
                                            <th>@lang('ims::inventory.item.requested')</th>
                                            @if($isQuantityAvailable)
                                                <th>@lang('ims::inventory.item.given')</th>
                                            @endif
                                            @if($isQuantityAvailable || $itemViewOption)
                                                <th>@lang('labels.action')</th>
                                            @endif
                                        </tr>
                                        @foreach($requestDetailsNew as $item)
                                            @php
                                                $category = $item->category;
                                                $categoryId = $item->category_id;
                                                $isFixedAsset = $category->type == config('constants.inventory_asset_types.fixed asset');
                                                if ($isFixedAsset) {
                                                    $totalFixedAssetRequests += $item->quantity;
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $category->name ?? __('labels.not_found') }}</td>
                                                <td>@lang('ims::inventory.' . preg_replace('/\s+/', '_', $category->type))</td>
                                                <td>{{ $category->unit }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                @if($isQuantityAvailable)
                                                    <td id="selected-for-category-{{$categoryId}}"></td>
                                                    <td>
                                                        @if($isFixedAsset)
                                                            @include('ims::inventory.request.workflow.modal.select-item')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    title="{{__('ims::inventory.item.select_item')}}"
                                                                    data-backdrop="false"
                                                                    data-target="#item-category-modal-{{$categoryId}}">
                                                                <i class="ft ft-edit"></i>
                                                            </button>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                @endif
                                                @if($itemViewOption)
                                                    <td>
                                                        @if($isFixedAsset)
                                                            @include('ims::inventory.request.workflow.modal.view-item')
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    title="{{__('ims::inventory.item.view_item')}}"
                                                                    data-backdrop="false"
                                                                    data-target="#item-category-modal-{{$categoryId}}">
                                                                <i class="ft ft-eye"></i>
                                                            </button>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                                @if(in_array('approve', $possibleTransitions))
                                    @if(!$isQuantityAvailable)
                                        <h4 class="danger">* @lang('ims::workflow.validations.not_available')</h4>
                                    @else
                                        <h4 class="success">* @lang('ims::workflow.validations.available')</h4>
                                    @endif
                                @endif
                                @if($errors->has('inventory_item_ids'))
                                    <h4 class="danger">* @lang('ims::inventory.item.select_error_message')</h4>
                                @endif

                                @if(!in_array($inventoryRequest->status, ['approved', 'received', 'rejected']))
                                    <h3>
                                        <a href="{{ route('inventory-request.edit.detail', [$inventoryRequest->type, $inventoryRequest->id]) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="ft-upload"></i> @lang('labels.details') @lang('labels.update')
                                        </a>
                                    </h3>
                                @endif
                            </div>
                            <div class="col-md-7">
                                @if(count($inventoryRequest->stateDetails)>0)
                                    <div class="col-md-12">
                                        <label class="black">@lang('labels.remarks'): </label>
                                        <div class="media">
                                            <div class="media-body">

                                                @foreach($inventoryRequest->stateDetails as $detail)
                                                    <p class="text-bold-600 mb-0">
                                                        {{ state_actor($detail->stateHistory->actor_id)->name }}
                                                    </p>
                                                    <p class="small m-0 comment-time">{{ date("j F, Y, g:i a",strtotime($detail->created_at)) }}</p>
                                                    <p class="m-0 comment-text">{{ $detail->remark }}</p>
                                                    <hr/>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>

                        @if(in_array('share', $possibleTransitions))
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""
                                                   class="form-label required">{{ __('ims::inventory.send_to') }}</label>
                                            {{ Form::select('recipients[]', $users, null, [
                                                'class' => 'form-control select2' . ($errors->has('recipients') || $errors->has('recipients.*') ? ' is-invalid' : ''),
                                                'placeholder' => trans('labels.select')
                                            ]) }}
                                            <div class="help-block"></div>
                                            @if($errors->has('recipients'))
                                                <span class="invalid-feedback"
                                                      role="alert">{{ $errors->first('recipients') }}</span>
                                            @endif
                                            @if($errors->has('recipients.*'))
                                                @foreach($errors->all() as $key => $error)
                                                    @if($errors->has('recipients.' . $key ))
                                                        <span class="invalid-feedback"
                                                              role="alert">{{ $errors->first('recipients.' . $key) }}</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""
                                               class="form-label required">{{ __('ims::inventory.remark.title') }}</label>
                                        {{ Form::textarea('remark', null, [
                                            'class' => 'form-control' . ($errors->has('remark') ? ' is-invalid' : ''),
                                            'placeholder' => __('ims::inventory.remark.placeholder'),
                                            'rows' => 4, 'required', 'data-validation-required-message' =>
                                            __('labels.This field is required')
                                        ]) }}
                                        <div class="help-block"></div>
                                        @if($errors->has('remark'))
                                            <span class="invalid-feedback"
                                                  role="alert">{{ $errors->first('remark') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(in_array('share', $possibleTransitions))
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""
                                                   class="form-label">{{ __('ims::inventory.message.title') }}</label>
                                            {{ Form::textarea('message', null, [
                                                'class' => 'form-control',
                                                'placeholder' => __('ims::inventory.message.placeholder'),
                                                'rows' => 4
                                            ]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-left">
                                    @foreach($possibleTransitions as $transition)
                                        @if(in_array($inventoryRequest->type, ['scrap', 'abandon']) && $transition == 'receive')
                                            <button class="btn btn-success" name="transition" type="submit"
                                                    value="{{ $transition }}">
                                                {{ trans('ims::workflow.transitions.release.title') }}
                                            </button>
                                        @elseif($transition == 'approve' && !$isQuantityAvailable)
                                        <!-- hide approve button if quantity is not available -->
                                        @else
                                            <button type="submit"
                                                    class="btn {{$transition == 'reject' ? 'btn-danger' : 'btn-success'}}"
                                                    name="transition"
                                                    value="{{ $transition }}">
                                                {{ trans('ims::workflow.transitions.' . $transition . '.title') }}
                                            </button>
                                        @endif
                                    @endforeach
                                    <a class="btn btn-warning" style="color: #fff;" href="{{ route('inventory') }}">
                                        <i class="ft ft-x"></i>
                                        @lang('labels.cancel')
                                    </a>
                                </div>
                            </div>
                        </div>
                        {!! Form::hidden('requested_fixed_asset', $totalFixedAssetRequests ?? 0) !!}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-js')
    <script>
        // Configuring selector (select2) on page loading/re-loading
        $(".item-selector").each(function () {
            $(this).select2({
                placeholder: "{{__('labels.select')}}",
                maximumSelectionLength: $(this).attr('limit')
            });
            $('#selected-for-category-' + $(this).attr('category')).html($(this).select2('data').length);
            $(this).change(function () {
                $('#selected-for-category-' + $(this).attr('category')).html($(this).select2('data').length);
            });
        });

        // Checking validation on form submit
        $('.form').submit(function () {
            let valid = true;
            let action = $(this).find("button[name=transition]:focus").val();
            if (action == 'approve') {
                $(".item-selector").each(function () {
                    if ($(this).attr('limit') != $(this).select2('data').length) {
                        valid = false;
                    }
                });
            }
            if (!valid) {
                alert("{{__('ims::inventory.item.select_error_message')}}");
            }
            return valid;
        });
    </script>
@endpush
