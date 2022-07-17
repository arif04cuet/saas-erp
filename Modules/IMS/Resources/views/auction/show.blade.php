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
                            <ul class="list-inline mb-1">
                                <li>
                                    <a href="{{ route('auctions.create') }}"
                                       class="btn btn-sm btn-primary"><i
                                                class="ft ft-plus"></i> @lang('ims::auction.create')</a>
                                </li>
                                @if($auction->status == "received")
                                    <li>
                                        <a href="{{ route('auctions.sales.create',$auction->id) }}"
                                           class="btn btn-sm btn-primary"><i
                                                    class="ft ft-plus"></i> @lang('ims::auction.auction_sales')</a>
                                    </li>
                                @endif
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('ims::auction.name')</th>
                                        <th>@lang('ims::auction.status')</th>
                                        <th>@lang('ims::fixed-asset-list-table.added')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$auction->title}}</td>
                                        <td>{{$auction->status}}</td>
                                        <td>{{$auction->date}}</td>
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
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>@lang('ims::auction.category')</th>
                                        <th>@lang('ims::auction.quantity')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($auction->details as $auctionDetail)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <!--Auction Detail have a relation with Scrap Product -->
                                            <td>{{$auctionDetail->inventoryItemCategory->name}}</td>
                                            <td>{{$auctionDetail->quantity}}</td>
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