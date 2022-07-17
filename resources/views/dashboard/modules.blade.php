<div id="crypto-stats-3" class="row" style="margin-top: 32px">
    @foreach ($modules as $module)
        {{-- @can(strtolower($module) . '-access') --}}
        @php
            switch ($module) {
                case 'TMS':
                    $style = 'background-color:#3cb371';
                    $fontLine = '<h1><i class="las la-school font-large-2" title="BTC"></i></h1>';
                    break;
                case 'HRM':
                    $style = 'background-color:#C0C0C0';
                    $fontLine = '<h1><i class="las la-id-card font-large-2" title="BTC"></i></h1>';
                    break;
                case 'Cafeteria':
                    $style = 'background-color:#008080';
                    $fontLine = '<h1><i class="las la-hamburger font-large-2" title="BTC"></i></h1>';
                    break;
                case 'HM':
                    $style = 'background-color:#20b2aa';
                    $fontLine = '<h1><i class="las la-hotel font-large-2" title="BTC"></i></h1>';
                    break;
                case 'IMS':
                    $style = 'background-color:#556B2F';
                    $fontLine = '<h1><i class="las la-desktop font-large-2" title="BTC"></i></h1>';
                    break;
                default:
                    $style = 'background-color:#000';
                    $fontLine = '<h1><i class="las la-school font-large-2" title="BTC"></i></h1>';
            }
        @endphp
        <div class="col-xl-3 col-12 text-center">
            <div class="card crypto-card-3 pull-up">
                <div class="card-content" style="{{ $style }}">
                    <div class="card-body module-wrap pb-0 pt-0">
                        {{-- <div class="row"> --}}
                        {{-- <div class="col-2"> --}}
                        {{-- <i class="las la-school"></i> --}}
                        {{-- <h1><i class="ft-grid warning font-large-2" title="BTC"></i></h1> --}}
                        {{-- <h1><i class="las la-school font-large-2" title="BTC"></i></h1> --}}
                        {!! $fontLine !!}
                        {{-- </div> --}}
                        {{-- <div class="col-8 pl-2"> --}}
                        <h4>{{ trans('labels.' . $module) }}</h4>
                        <h6 class="text-muted"><a
                                href="{{ url(config('app.admin_prefix').'/'.strtolower($module)) . '/' }}">{{ trans('labels.' . $module) }}
                                <i class="las la-angle-double-right" style="color:#ffffff !important"></i></a>
                        </h6>
                        {{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- @endcan --}}
    @endforeach
    <div class="col-xl-4 col-12" style="display: none;">
        <div class="card crypto-card-3 pull-up">
            <div class="card-content">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-2">
                            <h1><i class="ft-stop-circle warning font-large-2" title="BTC"></i></h1>
                        </div>
                        <div class="col-5 pl-2">
                            <h4>{{ trans('labels.Admin') }}</h4>
                            <h6 class="text-muted"><a
                                    href="{{ url('system/user') }}">{{ trans('labels.Administration') }}</a>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>