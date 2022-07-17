{{--        <!-- Prescription --}}
<li class="nav-item">
    <a href="#">
        <i class="la la-list"></i>
        <span class="menu-title" data-i18n="nav.templates.main">@lang('mms::prescription.title')</span>
    </a>
    <ul class="menu-content">
        @if (Auth::user()->hasRole(['ROLE_DOCTOR']))
            <li class="{{ (request()->routeIs('prescriptions.create')) ? 'active' : '' }}">
                <a href="{{ route('prescriptions.create') }}">
                    <i class="la la-list-alt"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.create') </span>
                </a>
            </li>
        @endif
        <li class="{{ (request()->routeIs('prescriptions.create')) ? 'active' : '' }}{{ (request()->routeIs('prescriptions.show')) ? 'active' : '' }}{{ (request()->routeIs('prescriptions.edit')) ? 'active' : '' }}{{ (request()->routeIs('prescriptions.list_by_user')) ? 'active' : '' }}">
            <a href="{{ route('prescriptions.index') }}">
                <i class="la la-list-alt"></i>
                <span class="menu-title" data-i18n="nav.dash.main">@lang('mms::prescription.list') </span>
            </a>
        </li>
    </ul>
</li>
{{--             // Prescription -->--}}
