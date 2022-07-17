@php
    $appraisalSettingRoutes = 'appraisals.settings';
@endphp

<li class="nav-item">
    <a href="#" class=""><i class="la ft-settings"></i>
        <span class="menu-title" data-i18n="nav.templates.main">
            @lang('hrm::appraisal_setting.appraisal_setting')
        </span>
    </a>

    <ul class="menu-content">
        <li class="{{ (request()->routeIs($appraisalSettingRoutes .'.index')) ? 'active' : '' }}">
            <a href="{{ route($appraisalSettingRoutes .'.index') }}">
                <i class="la ft-list"></i>
                <span class="menu-title"
                      data-i18n="nav.dash.main">@lang('labels.list')
                </span>
            </a>
        </li>
        <li class="{{ (request()->routeIs($appraisalSettingRoutes .'.create')) ? 'active' : '' }}">
            <a href="{{ route($appraisalSettingRoutes . '.create') }}">
                <i class="la ft-file-plus"></i>
                <span class="menu-title"
                      data-i18n="nav.dash.main">@lang('labels.create')
                </span>
            </a>
        </li>
    </ul>
</li>