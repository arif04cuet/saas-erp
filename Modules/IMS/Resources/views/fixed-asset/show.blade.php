@extends('ims::layouts.master')
@section('title', 'Note')
@push('page-css')
@endpush
@section('content')

    <!-- Appreciation/ Depreciation ADD button -->
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12">

        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-info round"
                       href="{{ route('fixed-asset.add_appreciation_depreciation', 'appreciation') }}">
                        <i class="ft-book"></i> @lang('ims::fixed-asset.add_appreciation')
                    </a>
                    <a class="btn btn-outline-warning round"
                       href="{{  route('fixed-asset.add_appreciation_depreciation', 'depreciation') }}">
                        <i class="ft-bookmark"></i> @lang('ims::fixed-asset.add_depreciation')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- Detail View -->
    <section id="asset-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::fixed-asset.detail') </h4>
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
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('ims::fixed-asset-list-table.name')</th>
                                        <th>@lang('ims::fixed-asset-list-table.price')</th>
                                        <th>@lang('ims::fixed-asset-list-table.added')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Chair</td>
                                        <td>100</td>
                                        <td>Today 8.10 AM</td>
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

    <!-- appreciation_depreciation_datatable -->
    <section id="asset-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::fixed-asset-list-table.appre_depre_list')</h4>
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
                                        <th>@lang('ims::appreciation-depreciation.value')</th>
                                        <th>@lang('ims::appreciation-depreciation.type')</th>
                                        <th>@lang('ims::appreciation-depreciation.reason')</th>
                                        <th>@lang('ims::appreciation-depreciation.added_by')</th>
                                        <th>@lang('ims::appreciation-depreciation.date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for( $i=1; $i<=2 ; $i++)
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td>5000</td>
                                            <td>Depreciation</td>
                                            <td>Broken</td>
                                            <td>Mohammad Imran Hossain</td>
                                            <td>30-04-2019</td>
                                        </tr>
                                    @endfor
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