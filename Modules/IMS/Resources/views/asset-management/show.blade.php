@extends('ims::layouts.master')
@section('title', __('ims::asset.title').' '.__('labels.show'))

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
                            <div class="col-md-6">
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
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table">
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

                            <!-- Item Appreciation and Depreciation -->
                            <div class="col-md-12">
                                <div class="card-header">

                                    <h4 class="form-section">@lang('ims::appreciation-depreciation.list')</h4>
                                </div>

                                <table class="table alt-pagination table-bordered">
                                    <thead>
                                    <tr class="text-center">
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('ims::appreciation-depreciation.reason')</th>
                                        <th>@lang('ims::appreciation-depreciation.date')</th>
                                        <th>@lang('ims::appreciation-depreciation.added_by')</th>
                                        <th>@lang('ims::appreciation-depreciation.evaluation_type')</th>
                                        <th>@lang('ims::appreciation-depreciation.value')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($item->appreciationDepreciationRecords as $record)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$record->reason}}</td>
                                            <td>{{\Carbon\Carbon::parse($record->evaulation_date)->format('d F, Y')}}</td>
                                            <td>{{optional($record->creator)->name ?? __('labels.not_found')}}</td>
                                            <td>
                                                @lang('ims::appreciation-depreciation.evaluation_types.' . $record->type)
                                            </td>
                                            <td class="text-right">
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($record->value)}}/-
                                            </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="form-actions center">

                        <a href="{{route('appreciation-depreciation-records.create', $item->id)}}"
                           class="btn btn-success">
                            <i class="la la-edit"></i>
                            @lang('ims::appreciation-depreciation.record')
                        </a>

                        <a href="{{route('asset-managements.index')}}" class="btn btn-warning">
                            <i class="la la-backward"></i> @lang('labels.back_page')
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

