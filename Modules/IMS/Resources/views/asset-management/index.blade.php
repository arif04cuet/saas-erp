@extends('ims::layouts.master')
@section('title', trans('ims::asset.title'))
@push('page-css')
@endpush
@section('content')
    <section id="asset-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::asset.list_page_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <div class="heading-elements mt-2" style="margin-right: 10px;">
                            {{--                            <a href="{{ route('asset.add') }}" class="btn btn-primary btn-sm">--}}
                            {{--                                <i class="ft-plus white">@lang('ims::asset.create')</i>--}}
                            {{--                            </a>--}}
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.id')</th>
                                        <th>@lang('ims::asset.name')</th>
                                        <th>@lang('ims::inventory.item_category')</th>
                                        <th>@lang('ims::asset.price')</th>
                                        <th>@lang('ims::asset.purchase_date')</th>
                                        <th>@lang('labels.total') @lang('ims::asset.appreciation')</th>
                                        <th>@lang('labels.total') @lang('ims::asset.depreciation')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($assets as $key=>$asset)

                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{route('asset-managements.show', $asset->id)}}">
                                                    {{$asset->unique_id}}
                                                </a>
                                            </td>
                                            <td>{{$asset->title}}</td>
                                            <td>{{optional($asset->category)->name ?? __('labels.not_found')}}</td>
                                            <td>{{$asset->unit_price}}</td>
                                            <td>{{\Carbon\Carbon::parse($asset->craeted_at)->format('d F, Y')}}</td>
                                            <td>{{$asset->totalAppreciation()}}</td>
                                            <td>{{$asset->totalDepreciation()}}</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="imsProductList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="imsProductList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{route('asset-managements.show', $asset->id)}}"
                                                           class="dropdown-item">
                                                            <i class="ft-eye"></i>
                                                            @lang('labels.details')
                                                        </a>
                                                        @if($asset->status == 'active')
                                                            <a href="{{route('appreciation-depreciation-records.create', $asset->id)}}"
                                                               class="dropdown-item">
                                                            <i class="ft-edit-2"></i>
                                                            @lang('ims::appreciation-depreciation.record')
                                                        </a>
                                                        @endif
                                                        {{--                                                        <div class="dropdown-divider"></div>--}}

                                                        {{--                                                        {!!--}}

                                                        {{--                                                            Form::open([--}}
                                                        {{--                                                              'method'=>'DELETE',--}}
                                                        {{--                                                              'url' => [''],--}}
                                                        {{--                                                              'style' => 'display:inline'--}}
                                                        {{--                                                                ])--}}
                                                        {{--                                                         !!}--}}

                                                        {{--                                                        {!!--}}
                                                        {{--                                                           Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(--}}
                                                        {{--                                                           'type' => 'submit',--}}
                                                        {{--                                                           'class' => 'dropdown-item',--}}
                                                        {{--                                                           'title' => 'Delete the user',--}}
                                                        {{--                                                           'onclick'=>'return confirm("Confirm delete?")',--}}
                                                        {{--                                                                   ))--}}
                                                        {{--                                                                   !!}--}}
                                                        {{--                                                        {!! Form::close() !!}--}}
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

@push('page-js')

@endpush
