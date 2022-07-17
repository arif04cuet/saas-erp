<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="{{ (request()->routeIs('mms')) ? 'active' : '' }}">
                <a href="{{ route('mms') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.dashboard')</span></a>
            </li>

            @if (Auth::user()->hasRole(['ROLE_DOCTOR']))
                @include('mms::layouts.partials.doector_access')
            @else
                @include('mms::layouts.partials.phamacist_access')
            @endif
        </ul>
    </div>
</div>
