
<li class="{{ (request()->routeIs('patients')) ? 'active' : '' }}">
    <a href="{{ route('patients.index') }}">
        <i class="la la-group"></i>
        <span class="menu-title" data-i18n="nav.dash.main">@lang('mms::patient.title')</span></a>
</li>
{{-- Prescription --}}
<li class="nav-item">
    <a href="#">
        <i class="la la-list"></i>
        <span class="menu-title" data-i18n="nav.templates.main">@lang('mms::prescription.title')</span>
    </a>
    <ul class="menu-content">
        <li class="{{ (request()->routeIs('prescriptions.index')) ? 'active' : '' }}{{ (request()->routeIs('prescriptions.show')) ? 'active' : '' }}{{ (request()->routeIs('prescriptions.edit')) ? 'active' : '' }}{{ (request()->routeIs('prescriptions.list_by_user')) ? 'active' : '' }}">
            <a href="{{ route('prescriptions.index') }}">
                <i class="la la-list-alt"></i>
                <span class="menu-title" data-i18n="nav.dash.main">@lang('mms::prescription.list') </span>
            </a>
        </li>
    </ul>
</li>
{{--   // Prescription -->--}}


{{--            <li class="{{ is_active_route('company') }}">--}}
{{--                <a href="{{ route('company.index') }}">--}}
{{--                    <i class="la la-folder-open"></i>--}}
{{--                    <span class="menu-title" data-i18n="nav.dash.main">@lang('mms::company.title')</span></a>--}}
{{--            </li>--}}

<li class="{{ (request()->routeIs('medicine')) ? 'active' : '' }}">
    <a href="{{ route('medicine.index') }}">
        <i class="la la-medkit"></i>
        <span class="menu-title" data-i18n="nav.dash.main"> @lang('mms::medicine.title') </span></a>

</li>


{{--{{Inventories}}--}}
<li class="nav-item">
    <a href="#">
        <i class="la la-cubes"></i>
        <span class="menu-title"
              data-i18n="nav.templates.main"> @lang('mms::medicine_inventory.inventory_menu_name')</span>
    </a>
    <ul class="menu-content">
        <li class="nav-item">
            <a href="#">
                <i class="la la-medkit"></i>
                <span class="menu-title" data-i18n="nav.templates.main"> @lang('mms::medicine_inventory.title')</span>
            </a>
            <ul class="menu-content">
                <li class="{{ (request()->routeIs('inventories.medicines.create')) ? 'active' : '' }}">
                    <a href="{{ route('inventories.medicines.create') }}">
                        <i class="la la-plus"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{{ trans('mms::medicine.create') }}</span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('inventories.medicines.index')) ? 'active' : '' }}">
                    <a href="{{ route('inventories.medicines.index') }}">
                        <i class="la la-list-alt"></i>
                        <span class="menu-title" data-i18n="nav.dash.main"> @lang('mms::medicine_inventory.list')</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ (request()->routeIs('ims/inventory-request/requisition/create/initial')) ? 'active' : '' }}">
            <a href="{{ route('inventory-request.create.initial', 'requisition') }}">
                <i class="la la-newspaper-o"></i>
                <span class="menu-title" data-i18n="nav.dash.main">
                    @lang('ims::inventory.inventory_request_types.requisition')
                    @lang('ims::inventory.inventory_request_types.request')
                </span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#">
        <i class="la la-hourglass-2"></i>
        <span class="menu-title" data-i18n="nav.templates.main">@lang('mms::medicine_distribution.root_menu')</span>
    </a>
    <ul class="menu-content">

        <li class="{{ (request()->routeIs('inventories.prescribed.create')) ? 'active' : '' }}">
            <a href="{{ route('inventories.prescribed.create') }}">
                <i class="la la-plus"></i>
                <span class="menu-title" data-i18n="nav.dash.main">@lang('mms::medicine_distribution.create')</span>
            </a>
        </li>

        <li class="{{ (request()->routeIs('inventories.prescribed.index')) ? 'active' : '' }}{{ (request()->routeIs('inventories.prescribed.show')) ? 'active' : '' }}">
            <a href="{{ route('inventories.prescribed.index') }}">
                <i class="la la-list-alt"></i>
                <span class="menu-title"
                      data-i18n="nav.dash.main">@lang('mms::medicine_distribution.distribution_list')</span>
            </a>
        </li>
    </ul>
</li>

{{-- <li class="nav-item">
    <a href="#">
        <i class="la la-newspaper-o"></i>
        <span class="menu-title" data-i18n="nav.templates.main">@lang('mms::requisition.root_menu')</span>
    </a>
    <ul class="menu-content">
        <li class="{{ is_active_route('requisition.create') }}">
            <a href="{{ route('requisition.create') }}">
                <i class="la la-plus"></i>
                <span class="menu-title" data-i18n="nav.dash.main">@lang('mms::requisition.create')</span>
            </a>
        </li>
        <li class="{{ is_active_route('requisition.index') }} {{ is_active_route('requisition.show') }}">
            <a href="{{ route('requisition.index') }}">
                <i class="la la-list-alt"></i>
                <span class="menu-title" data-i18n="nav.dash.main">@lang('mms::requisition.requisition_list')</span>
            </a>
        </li>
    </ul>
</li> --}}
