@extends('ims::layouts.master')

@section('title', trans('ims::procurement.title') . ' ' . trans('labels.show'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('ims::procurement.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{ route('procurement-billings.create') }}"
                           class="btn btn-primary btn-sm">
                            <i class="ft-plus white"> @lang('ims::procurement.add_button')</i>
                        </a>
                        <a href="{{ route('procurement-billings.index') }}" class="btn btn-info btn-sm">
                            <i class="ft-list white"> @lang('ims::procurement.index')</i>
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body">
                        <h4 class="form-section">
                            <i class="la la-tag"></i>
                            @lang('ims::procurement.title') @lang('labels.details')
                        </h4>

                        <!-- Procurement Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tr>
                                        <th>@lang('labels.title')</th>
                                        <td>{{ $procurement->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::procurement.order_no')</th>
                                        <td>{{ $procurement->order_no}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::vendor.vendor')</th>
                                        <td>
                                            {{optional($procurement->vendor)->name ?? __('labels.not_found') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('ims::procurement.settings.menu_title')</th>
                                        <td>
                                            @if($billSetting = $procurement->billSetting)
                                                <a href="{{route('procurement-bill-settings.show', $billSetting->id)}}">
                                                    {{$billSetting->title}}
                                                </a>
                                            @else
                                                @lang('labels.not_found')
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tr>
                                        <th>@lang('ims::inventory.inventory_location')</th>
                                        <td>
                                            {{ optional($procurement->location)->getName() ?? __('labels.not_found') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.date')</th>
                                        <td>
                                            {{ \Carbon\Carbon::parse($procurement->bill_date)->format('d F, Y')  }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('labels.status')</th>
                                        <td>
                                            <span
                                                class="badge badge-{{ in_array($procurement->status, array_keys(config('constants.status_classes'))) ?
config('constants.status_classes')[$procurement->status] : 'info' }}">
                                               {{ucwords($procurement->status)}}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Procurement Items Information -->
                    <div class="card-body">
                        <div class="form-body">

                            <h4 class="form-section">
                                <i class="la la-tag"></i>
                                @lang('ims::procurement.item_details')
                                <hr>
                            </h4>
                            <table class="table table-bordered table-striped" id="Example1">
                                <thead class="text-center">
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('labels.code')</th>
                                    <th width="20%">@lang('ims::inventory.item_category')</th>
                                    <th width="10%">@lang('ims::inventory.item.title') @lang('labels.name')</th>
                                    <th>@lang('ims::inventory.quantity')</th>
                                    <th>@lang('ims::inventory.item.unit_price')</th>
                                    <th>@lang('ims::procurement.vat')</th>
                                    <th>@lang('ims::procurement.it')</th>
                                    <th>@lang('labels.total')</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($procurement->items as $item)
                                    @php
                                        static $total = 0;
                                        static $totalVat = 0;
                                        static $totalIt = 0;
                                        $thisTotal = ($item->quantity ?? 0) * ($item->unit_price ?? 0);
                                        $total += $thisTotal;
                                        $totalVat += $item->vat ?? 0;
                                        $totalIt += $item->it ?? 0;
                                        $category = $item->itemCategory;
                                    @endphp
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>
                                            @if($category)
                                                <a href="{{route('inventory-item-category.show', $category->id)}}"
                                                   target="_blank">
                                                    {{$category->name}}
                                                </a>
                                            @else
                                                @lang('labels.not_found')
                                            @endif
                                        </td>
                                        <td>{{$item->item_name ?? " - "}}</td>
                                        <td class="text-right">
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($item->quantity) ?? ""}}
                                        </td>
                                        <td class="text-right">
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($item->unit_price) ?? ""}}
                                            /-
                                        </td>
                                        <td class="text-right">
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($item->vat) ?? ""}}
                                            /-
                                        </td>
                                        <td class="text-right">
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($item->it) ?? ""}}
                                            /-
                                        </td>
                                        <td class="text-right">
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($thisTotal)}}
                                            /-
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @if(isset($total))
                                    <tfoot>
                                    <tr class="text-right">
                                        <th colspan="6">@lang('labels.grand_total')</th>
                                        <th>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalVat)}}
                                            /-
                                        </th>
                                        <th>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalIt)}}
                                            /-
                                        </th>
                                        <th>
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($total)}}
                                            /-
                                        </th>
                                    </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
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

