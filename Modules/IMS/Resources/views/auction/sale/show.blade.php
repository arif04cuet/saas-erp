@extends('ims::layouts.master')
@section('title', 'Note')

@push('page-css')
@endpush

@section('content')
    <!-- Detail View -->
    <section id="asset-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::auction.detail') </h4>
                        <div class="heading-elements" style="top: 5px;">

                        </div>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('ims::auction.name')</th>
                                        <th>@lang('ims::auction.vendor')</th>
                                        <th>@lang('ims::auction.order_no')</th>
                                        <th>@lang('ims::fixed-asset-list-table.added')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$auctionSale->auction->title ?? 'NULL'}}</td>
                                        <td>{{$auctionSale->vendor->name ?? 'NULL' }}</td>
                                        <td>{{$auctionSale->order_no ?? 'NULL'}}</td>
                                        <td>{{$auctionSale->created_at ?? 'NULL' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- scrap_product_datatable -->
    <section id="asset-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::auction.scrap_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('ims::auction.category')</th>
                                        <th>@lang('ims::auction.quantity')</th>
                                        <th>@lang('ims::auction.unit_price')</th>
                                        <th>@lang('ims::auction.tax')</th>
                                        <th>@lang('ims::auction.vat')</th>
                                        <th>@lang('ims::fixed-asset-list-table.added')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($auctionSale->details as $auctionSaleDetail)
                                        <tr>
                                            <!--Auction Detail have a relation with Scrap Product -->
                                            <td>{{ $auctionSaleDetail->inventoryItemCategory->name }}</td>
                                            <td>{{ $auctionSaleDetail->quantity }}</td>
                                            <td>{{ $auctionSaleDetail->unit_price ?? 0 }}</td>
                                            <td>{{ $auctionSaleDetail->tax ?? 0 }}</td>
                                            <td>{{ $auctionSaleDetail->vat ?? 0 }}</td>
                                            <td>{{ $auctionSaleDetail->created_at ?? 0 }}</td>
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

@endsection

@push('page-js')


@endpush