@extends('ims::layouts.master')
@section('title', trans('ims::auction.auction'))

@section('content')
    <section id="asset-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::auction.list_page_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="heading-elements mt-2" style="margin-right: 10px;">
                            <a href="{{ route('auctions.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white">@lang('ims::auction.create')</i>
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>@lang('ims::auction.name')</th>
                                        <th>@lang('ims::auction.status')</th>
                                        <th>@lang('ims::auction.description')</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($auctions as $auction)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration}}</th>
                                            <td>
                                                <a href="{{route('auctions.show',$auction->id)}}">{{ $auction->title}}</a>
                                            </td>
                                            <td>{{$auction->status}}</td>
                                            <td>{{$auction->date}}</td>
                                            <td>
                                            <span class="dropdown">
                                                <button id="imsProductList" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="imsProductList"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <a href="{{route('auctions.show', $auction->id)}}"
                                                       class="dropdown-item"><i
                                                                class="ft-eye"></i> @lang('labels.details')</a>
{{--                                                    <a href="{{route('auctions.edit',$auction->id)}}"--}}
{{--                                                       class="dropdown-item"><i--}}
{{--                                                                class="ft-edit-2"></i> @lang('labels.edit')</a>--}}
{{--                                                --}}
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
@endsection
