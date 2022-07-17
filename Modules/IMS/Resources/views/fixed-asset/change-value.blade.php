@extends('ims::layouts.master')
@section('title', 'Note')
@push('page-css')
@endpush
@section('content')

    {{-- use the {{type}} to find out appreciate or depreciate--}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
{{--                        <h4 class="card-title">@lang('ims::fixed-asset.add_menu_title')</h4>--}}
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf
                                <h4 class="form-section"><i
                                            class="la la-puzzle-piece"></i> @if($type=='appreciation')@lang('ims::fixed-asset.add_appreciation') @else  @lang('ims::fixed-asset.add_depreciation') @endif
                                </h4>

                                <div class="row">

                                    <!-- Reasons -->
                                    <div class="col">


                                                    <label for="app_dep_reasons">@lang('ims::appreciation-depreciation.reason')</label>
                                                    <input type="text" class="form-control" id="app_dep_reasons"
                                                           name="app_dep_reasons"
                                                           placeholder="@lang('ims::appreciation-depreciation.reason')"
                                                           required>


                                    </div>

                                    <div class="col">
                                        <!-- appre/depre value -->
                                        <div class="col">
                                            <label for="app_dep_value">@lang('ims::appreciation-depreciation.value')</label>
                                            <input type="number" min="0" id="app_dep_value" name="app_dep_value"
                                                   class="form-control"
                                                   placeholder="@lang('ims::appreciation-depreciation.value')" required>
                                        </div>
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