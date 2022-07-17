@extends('ims::layouts.master')
@section('title', trans('ims::asset.create'))
@push('page-css')
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('ims::asset.add_menu_title')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="heading-elements mt-2" style="margin-right: 10px;">
                <a href="{{ route('asset.list') }}" class="btn btn-primary btn-sm">
                    <i class="ft-list white">@lang('ims::asset.list_page_title')</i>
                </a>
            </div>
        </div>
        <form action="{{ route('asset.add') }}" method="POST">
            <div class="card-content collapse show">
                <div class="card-body">
                    @csrf
                    <h4 class="form-section"><i class="la la-puzzle-piece"></i> @lang('ims::asset.title')</h4>
                    <div class="row">
                        <!-- Asset Name -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fixed_asset_name"> @lang('ims::asset.name')</label>
                                <input id="fixed_asset_name" name="fixed_asset_name" type="text" class="form-control" placeholder="@lang('ims::asset.name')" required>
                            </div>
                        </div>
                        <!-- Asset Price -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fixed_asset_price">@lang('ims::asset.price')</label>
                                <input type="number" min="0" id="fixed_asset_price" class="form-control" placeholder="@lang('ims::asset.price')" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="appreciation">@lang('ims::asset.appreciation')</label>
                                <input type="text" min="0" id="appreciation" class="form-control" name="appreciation" placeholder="@lang('ims::asset.price')" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="depreciation">@lang('ims::asset.depreciation')</label>
                                <input type="text" min="0" id="depreciation" name="depreciation" class="form-control" placeholder="@lang('ims::asset.price')" required>
                            </div>
                        </div>
                    </div>
                    <!-- Labels -->
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="ft-check"></i> {{trans('labels.save')}}
                    </button>
                    <a class="btn btn-warning" role="button"
                       href="{{ route('asset.list') }}">
                        <i class="ft-x"></i> {{trans('labels.cancel')}}
                    </a>
                </div>
            </div>
        </form>

    </div>

@endsection

@push('page-js')


@endpush