@auth
    <ul class="master-aside-menus">
        <li class="master-aside-menu-item {{ isActive(['inventory'],'route') }}">
            <a href="{{ route('inventory') }}">
                <i class="la la-home"></i> @lang('labels.dashboard')
            </a>
        </li>

        <li class="master-aside-menu-item dropdown {{isActive(['inventory-request.create.initial'],'route')}}">
            <a href="#" >
                <i class="la la-folder-o"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('ims::inventory.item.menu_title')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['inventory-request.create.initial'],'route')}}" href="{{ route('inventory-request.create.initial', 'requisition') }}" data-i18n="nav.dash.main">
                            <i class="la la-plus-circle"></i>
                            @lang('ims::inventory.inventory_request_types.requisition')
                            @lang('ims::inventory.inventory_request_types.request')
                        </a>
                    </li>
                    <li class="master-aside-menu-item">
                        <a class="{{isActive('ims/inventory-request/transfer/create/initial')}}" href="{{ route('inventory-request.create.initial', 'transfer') }}" data-i18n="nav.dash.main">
                            <i class="la la-plus-circle"></i>
                            @lang('ims::inventory.inventory_request_types.transfer')
                            @lang('ims::inventory.inventory_request_types.request')
                        </a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>
        <!-- Hostel Budgets -->
        <li class="master-aside-menu-item dropdown {{isActive(['hostel-budgets.index','hostel-budget-section.index'],'route')}}">
            <a href="#" >
                <i class="la la-balance-scale"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    {{ trans('hm::hostel_budget.menu_title') }}
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['hostel-budgets.index'],'route')}}" href="{{ route('hostel-budgets.index') }}" data-i18n="nav.dash.main"><i class="la la-hotel"></i>{{ trans('hm::hostel_budget.sub_menu_budget') }}</a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['hostel-budget-section.index'],'route')}}" href="{{ route('hostel-budget-section.index') }}" data-i18n="nav.dash.main"><i class="la la-list-alt"></i>{{ trans('hm::hostel_budget.sub_menu_section') }}</a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>
        <!-- HM Accounts Report -->
        <li class="master-aside-menu-item dropdown {{isActive(['hm.accounts.report.annual-budgets.index'],'route')}}">
            <a href="#" >
                <i class="la la-balance-scale"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('tms::budget.report.title')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['hm.accounts.report.annual-budgets.index'],'route')}}" href="{{ route('hm.accounts.report.annual-budgets.index') }}" data-i18n="nav.dash.main"><i class="la la-hotel"></i>
                            @lang('hm::report.budget.annual.menu_title')
                        </a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>

        <!-- Hm Code Setting -->
        {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
        <li class="master-aside-menu-item {{isActive(['hm.accounts.code-setting.index'],'route')}}">
            <a class="{{isActive(['hm.accounts.code-setting.index'],'route')}}" href="{{ route('hm.accounts.code-setting.index') }}" data-i18n="nav.dash.main"><i class="la la-hotel"></i>
                @lang('accounts::economy-code.settings.title')
            </a>
        </li>
        {{-- @endcan --}}

        <!-- HM Setup -->
        <li class="master-aside-menu-item dropdown {{isActive(['hostels.index','room-types.index'],'route')}}">
            <a href="#" >
                <i class="la la-building"></i>
                <span class="menu-title" data-i18n="nav.dash.main">
                    @lang('labels.setup')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['hostels.index'],'route')}}" href="{{ route('hostels.index') }}" data-i18n="nav.dash.main"><i class="la la-building"></i>
                            @lang('hm::hostel.menu_title')
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['room-types.index'],'route')}}" href="{{ route('room-types.index') }}" data-i18n="nav.dash.main"><i class="la la-hotel"></i>
                            @lang('hm::roomtype.menu_title')
                        </a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>
        <!-- HM Inventory -->
        <li class="master-aside-menu-item dropdown {{isActive(['hm-inventory-request.index','hm-inventory-locations.index'],'route')}}">
            <a href="#">
                <i class="la la-shopping-cart"></i>
                <span class="menu-title" data-i18n="nav.dash.main">
                    @lang('hm::hm_inventory.title')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['hm-inventory-request.index'],'route')}}" href="{{ route('hm-inventory-request.index') }}" data-i18n="nav.dash.main"><i class="la la-list"></i>
                            @lang('hm::hm_inventory.inventory_request')
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['hm-inventory-locations.index'],'route')}}" href="{{ route('hm-inventory-locations.index') }}" data-i18n="nav.dash.main"><i class="la la-bank"></i>
                            @lang('hm::hm_inventory.inventory_location')
                        </a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>
        <!-- HM Manager Section -->
        <li class="master-aside-menu-item dropdown {{isActive(['hostels.collection-report'],'route')}}">
            <a href="#">
                <i class="la la-dollar"></i>
                <span class="menu-title" data-i18n="nav.dash.main">
                    @lang('hm::report.report')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users','update_users','delete_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['hostels.collection-report'],'route')}}" href="{{ route('hostels.collection-report') }}" data-i18n="nav.dash.main"><i class="la la-building"></i>
                            @lang('hm::report.collection')
                        </a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>
    </ul>
@endauth
