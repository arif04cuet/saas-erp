{!! Form::open(['route' =>  'inventory-items.store', 'class' => 'form tms-budget-form', 'novalidate']) !!}

{!! Form::hidden('inventory_item_category_id', $inventoryItemCategory->id) !!}
<div class="form-body">
    <h4 class="form-section">
        <i class="la la-tag"></i>@lang('ims::inventory.item_category') @lang('labels.info')
    </h4>

    <!-- Inventory Item Category Information -->

    <div class="row">
        <div class="col-12">
            <table class="table table-borderless table-striped">
                <tr>
                    <th>@lang('labels.name')</th>
                    <td>{{ $inventoryItemCategory->name}}</td>
                </tr>
                <tr>
                    <th>@lang('labels.id')</th>
                    <td>{{ $inventoryItemCategory->unique_id}}</td>
                </tr>
                <tr>
                    <th>@lang('ims::inventory.type')</th>
                    <td>@lang('ims::inventory.' . preg_replace('/\s+/', '_', $inventoryItemCategory->type))</td>
                </tr>
                <tr>
                    <th>@lang('ims::inventory.unit')</th>
                    <td>{{ $inventoryItemCategory->unit}}</td>
                </tr>
            </table>
        </div>

    </div>

    <!-- Inventory Items -->
    <h4 class="form-section">
        <i class="la la-tag"></i>@lang('ims::inventory.item.title') @lang('labels.info')
    </h4>
    <div class="card-body">
        <ul class="nav nav-tabs nav-top-border no-hover-bg">
            <li class="nav-item">
                <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                   href="#tab11"
                   aria-expanded="true">@lang('ims::inventory.item.new_item')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12"
                   aria-expanded="false">@lang('ims::inventory.item.existing_item')</a>
            </li>
        </ul>
        <div class="tab-content px-1 pt-1">
            <!-- Tab 1: New Item Entry -->
            <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                 aria-labelledby="base-tab11">

                <table class="table table-bordered repeater-inventory-items">
                    <thead class="text-center">
                    <tr>
                        <th width="25%">@lang('labels.title') <span class="red">*</span></th>
                        <th width="15%">@lang('ims::inventory.item.model')</th>
                        <th width="15%">@lang('ims::inventory.item.unit_price') <span class="red">*</span></th>
                        <th width="15%">@lang('ims::inventory.item.invoice_no')</th>
                        {{--                        <th>@lang('ims::inventory.inventory_location') <span class="red">*</span></th>--}}
                        <th>@lang('labels.details')</th>
                        <th width="1%">
                            <i data-repeater-create class="la la-plus-circle text-info" style="cursor: pointer"
                               id="repeater_create"></i>
                        </th>
                    </tr>
                    </thead>

                    <tbody data-repeater-list="inventory_item_entries">

                    <tr data-repeater-item>
                        <!-- Sectors and Sub Sectors -->
                        <td>
                            {!! Form::hidden('id', null) !!}
                            <div class="form-group">
                                {!! Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 250,
                                 'data-validation-required-message' => __('labels.This field is required') ])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::text('model', null, ['class' => 'form-control', 'maxlength' => 100])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::text('unit_price', null, ['class' => 'form-control', 'step' => '0.01',
                                    'required', 'maxlength' => 10,
                                    'data-validation-required-message' => __('labels.required_short_message'),
                                    'data-validation-min-min' => 1,
                                    'data-validation-min-message' => __('validation.min.numeric',
                                    ['attribute' => __('ims::inventory.item.unit_price'), 'min' => __('labels.digits.1')]),
                                    'data-validation-number-message' => __('validation.numeric', ['attribute' => __('ims::inventory.item.unit_price')]),
                                    ])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                {!! Form::text('invoice_no', null, ['class' => 'form-control', 'maxlength' => 50 ])!!}
                                <div class="help-block"></div>
                            </div>
                        </td>
                        {{--                        <td>--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                {!! Form::select('inventory_location_id', $inventoryLocations, null, ['required',--}}
                        {{--                                    'class' => 'form-control', 'data-validation-required-message' =>--}}
                        {{--                                    __('labels.required_short_message')])!!}--}}
                        {{--                                <div class="help-block"></div>--}}
                        {{--                            </div>--}}
                        {{--                        </td>--}}
                        <td>
                            {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 2])!!}
                        </td>

                        <td><i data-repeater-delete class="la la-trash-o text-danger"
                               style="cursor: pointer"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-primary" style="cursor: pointer" type="button"
                        onclick="$('#repeater_create').trigger('click');">
                    <i class="ft ft-plus"></i>@lang('labels.add')
                </button>


            </div>

            <!-- Tab 2: Existing Items -->
            <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                <table class="table table-bordered table-striped alt-pagination">
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
                            <td>{{$item->title}}</td>
                            <td>{{$item->unique_id}}</td>
                            <td>{{$item->model ?? ""}}</td>
                            <td class="text-right">{{$item->unit_price ?? "0.00"}}/-</td>
                            <td>{{$item->invoice_no ?? ""}}</td>
                            <td>{{optional($item->location)->name ?? __('ims::inventory.item.no_location')}}</td>
                            <td>{{$item->remark ?? ""}}</td>
                            <td>
                                <span class="badge badge-{{$item->status == 'active' ? "success": "danger"}}">
                                    {{ucwords($item->status)}}
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

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="ft-check-square"></i>
        @lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('inventory-item-category.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}

