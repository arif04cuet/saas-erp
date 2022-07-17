@extends('ims::layouts.master')
@section('title', trans('ims::inventory.departmental_item_category_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('ims::inventory.departmental_item_category_list')}}</h4>

                        <div class="heading-elements">
                            <a href="{{ route('inventory-item-category.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> {{trans('ims::inventory.create_new_category')}}
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.name')</th>
                                        {{--<th scope="col">@lang('ims::inventory.short_code')</th>--}}
                                        <th scope="col">@lang('ims::inventory.type')</th>
                                        <th scope="col">@lang('ims::inventory.unit')</th>
                                        <th scope="col">@lang('labels.status')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($departmentalCategories as $departmentalCategory)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{ route('inventory-item-category.show', $departmentalCategory->id) }}">{{ $departmentalCategory->name }}</a>
                                            </td>
                                            <td>
                                                @if($departmentalCategory->type == 'fixed asset')
                                                    <p>@lang('ims::inventory.fixed_asset')</p>
                                                @else
                                                    <p>@lang('ims::inventory.temporary_asset')</p>
                                                @endif
                                            </td>
                                            <td>{{ $departmentalCategory->unit }}</td>
                                            <td>
                                                @if($departmentalCategory->is_active == 0)
                                                    <p>@lang('labels.inactive')</p>
                                                @else
                                                    <p>@lang('labels.active')</p>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="imsProductList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="imsProductList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('inventory-item-category.show', $departmentalCategory->id) }}" class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                        <a href="{{ route('inventory-item-category.edit', $departmentalCategory->id) }}" class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
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
