@extends('ims::layouts.master')
@section('title', 'Note')
@push('page-css')
@endpush
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::fixed-asset.add_menu_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="heading-elements mt-2" style="margin-right: 10px;">
                            <a href="{{ route('fixed-asset.list') }}" class="btn btn-primary btn-sm">
                                <i class="ft-list white">@lang('ims::fixed-asset.list_page_title')</i>
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="{{ route('fixed-asset.add') }}" method="POST">
                                @csrf
                                <h4 class="form-section"><i
                                            class="la la-puzzle-piece"></i> @lang('ims::fixed-asset.title')</h4>
                                <div class="row">
                                    <!-- Asset Name -->
                                    <div class="col-6">
                                        <label for="fixed_asset_name"> @lang('ims::fixed-asset.name')</label>
                                        <input id="fixed_asset_name" name="fixed_asset_name" type="text"
                                               class="form-control" placeholder="@lang('ims::fixed-asset.name')"
                                               required>
                                    </div>
                                    <!-- Asset Price -->
                                    <div class="col-6">

                                        <label for="fixed_asset_price">@lang('ims::fixed-asset.price')</label>
                                        <input type="number" min="0" id="fixed_asset_price" class="form-control"
                                               placeholder="@lang('ims::fixed-asset.price')" required>
                                    </div>

                                </div>


                                <!-- Labels -->
                                <div class="form-actions mb-lg-3">
                                    <a class="btn btn-warning pull-right" role="button"
                                       href="{{ route('fixed-asset.list') }}" style="margin-left: 2px;">
                                        <i class="ft-x"></i> {{trans('labels.cancel')}}
                                    </a>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-js')


@endpush