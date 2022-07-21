<div id="crypto-stats-3" class="row" style="margin-top: 32px">
    @foreach ($modules as $module)
        {{-- @can(strtolower($module) . '-access') --}}
        @php
            switch ($module->short_code) {
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

        @php
            $name = 'name_'.$lang;
        @endphp
        <div class="col-xl-4 col-12 text-center">
            <a href="{{ url(config('app.admin_prefix').'/'.strtolower($module->slug)) . '/' }}" class="card crypto-card-3 pull-up">
                <div class="card-content">
                    <div class="card-body module-wrap pb-0 pt-0 d-flex dashboard-box">
                        <div class="icon" style="{{ $style }}">
                            {!! $fontLine !!}
                        </div>
                        <div class="info">
                            <h4>{{ $module->$name }}</h4>
                            <h6 class="text-muted">
                                {{ $module->$name }}
                            </h6>
                        </div>
                    </div>
                </div>
            </a>
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