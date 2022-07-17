@extends('ims::layouts.master')

@section('title', __('ims::auction.workflow.form_title'))

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
                        <h4 class="form-section">
                            <i class="la  la-building-o"></i>
                            @lang('ims::auction.workflow.form_title')
                        </h4>
                        <hr>

                        {{ Form::open(['route' => 'auction.workflow.update', 'method' => 'PUT', 'class' => 'form', 'novalidate']) }}
                        {{ Form::hidden('auction_id', $auction->id) }}
                        <div class="row">
                            <div class="col-6">
                                <table class="table">
                                    <tr>
                                        <th>@lang('ims::inventory.inventory_request_title')</th>
                                        <td>{{ $auction->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.requester')</th>
                                        <td>{{ $auction->requester ? $auction->requester->name : '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.receiver')</th>
                                        <td>{{ $auction->receiver ? $auction->receiver->name : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th>@lang('labels.status')</th>
                                        <td>{{ trans('labels.' . $auction->status) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                @if(count($auctionDetails))
                                    <table class="table">
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('ims::auction.category')</th>

                                            @if(in_array('approve', $possibleTransitions) && $auction->status = 'shared')
                                                @if($fromLocation != null)
                                                    <th>
                                                        {{ trans('ims::workflow.request.details.table.columns.available') }}
                                                    </th>
                                                @endif
                                            @endif
                                            <th>@lang('ims::auction.workflow.requested')</th>
                                            @if($isQuantityAvailable)
                                                <th>@lang('ims::auction.workflow.given')</th>
                                            @endif
                                            @if($isQuantityAvailable || $itemViewOption)
                                                <th>@lang('labels.action')</th>
                                            @endif
                                        </tr>
                                        @foreach($auctionDetails as $item)
                                            @php
                                                static $totalFixedAssetRequests = 0;
                                                $category = $item->inventoryItemCategory;
                                                $categoryId = $category->id;
                                                $isFixedAsset = $category->type == config('constants.inventory_asset_types.fixed asset');
                                                if ($isFixedAsset) {
                                                    $totalFixedAssetRequests += $item->quantity;
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name ?? '' }}</td>
                                                @if(in_array('approve', $possibleTransitions) && $auction->status = 'shared')
                                                    @if($fromLocation != null)
                                                        <td>{{ get_inventory_quantity($auction->id, $item->inventoryItemCategory->id, $fromLocation->id, \Modules\IMS\Entities\Auction::class) }}</td>
                                                    @endif
                                                @endif
                                                <td>{{ $item->quantity }}</td>
                                                @if($isQuantityAvailable)

                                                    <td id="selected-for-category-{{$categoryId}}">-</td>
                                                    <td>
                                                        @include('ims::auction.workflow.modal.select-item')
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                title="{{__('ims::inventory.item.select_item')}}"
                                                                data-backdrop="false"
                                                                data-target="#item-modal-{{$categoryId}}">
                                                            <i class="ft ft-edit"></i>
                                                        </button>
                                                    </td>
                                                @endif
                                                @if($itemViewOption)
                                                    <td>
                                                        @include('ims::auction.workflow.modal.view-item')
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                title="{{__('ims::inventory.item.view_item')}}"
                                                                data-backdrop="false"
                                                                data-target="#item-modal-{{$categoryId}}">
                                                            <i class="ft ft-eye"></i>
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif

                            <!-- Show Hint If Items Are Available -->
                                @if(in_array('approve', $possibleTransitions))
                                    @if(!$isQuantityAvailable)
                                        <h4 class="danger">* @lang('ims::workflow.validations.not_available')</h4>
                                    @else
                                        <h4 class="success">* @lang('ims::workflow.validations.available')</h4>
                                    @endif
                                    @if($errors->has('inventory_item_ids'))
                                        <h5 class="danger">* @lang('ims::auction.workflow.select_error_message')</h5>
                                    @endif
                                @endif

                            <!-- Update detail -->
                                @if(!in_array($auction->status, ['approved', 'received', 'rejected']))
                                    <h3>
                                        <a href="{{ route('auctions.edit', [$auction->id]) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="ft-upload"></i> @lang('labels.details') @lang('labels.update')
                                        </a>
                                    </h3>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @if(count($auction->stateDetails)>0)
                                    <div class="col-md-12">
                                        <label class="black">@lang('labels.remarks'): </label>
                                        <div class="media">
                                            <div class="media-body">

                                                @foreach($auction->stateDetails as $detail)
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
                                        @if($transition == 'receive')
                                            <button class="btn btn-success" name="transition"
                                                    value="{{ $transition }}">
                                                {{ trans('ims::workflow.transitions.release.title') }}
                                            </button>
                                        @elseif($transition == 'approve' && !$isQuantityAvailable)
                                        <!-- hide approve button -->
                                        @else
                                            <button class="btn btn-{{$transition != 'reject' ? 'success' : 'danger'}}"
                                                    name="transition" value="{{ $transition }}">
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
                alert("{{__('ims::auction.workflow.select_error_message')}}");
            }
            return valid;
        });
    </script>
@endpush
