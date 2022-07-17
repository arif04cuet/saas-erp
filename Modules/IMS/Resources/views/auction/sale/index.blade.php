@extends('ims::layouts.master')
@section('title', trans('ims::auction.auction_sales_list'))

@section('content')
    <section id="asset-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> @lang('ims::auction.auction_sales_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li>
                                    <a href="{{ route('auctions.index') }}" class="btn btn-primary btn-sm">
                                        <i class="ft-list white"> @lang('ims::auction.list_menu_title')</i>
                                    </a>
                                </li>
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
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('ims::auction.order_no')</th>
                                        <th>@lang('ims::auction.auction')</th>
                                        <th>@lang('ims::auction.vendor')</th>
                                        <th>@lang('labels.date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($auctionSales as $auctionSale)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{ route('auctions.sale.show',[ $auctionSale->auction->id, $auctionSale->id] )}}">{{ $auctionSale->order_no }}</a>
                                            </td>
                                            <td>{{ $auctionSale->auction->title }}</td>
                                            <td>{{ $auctionSale->vendor->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($auctionSale->date)->format('d/m/Y') }}</td>
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
