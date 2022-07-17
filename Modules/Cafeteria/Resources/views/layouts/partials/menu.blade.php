@auth
    <ul class="master-aside-menus">
        <li class="master-aside-menu-item {{ isActive(['cafeteria'],'route') }}">
            <a href="{{ route('cafeteria') }}">
                <i class="la la-home"></i> @lang('labels.dashboard')
            </a>
        </li>
        <!-- Inventory -->
        <li class="master-aside-menu-item dropdown {{isActive(['units.index','raw-material-categories.index','raw-materials.index','cafeteria-inventories.index'],'route')}}">
            <a href="#" >
                <i class="la la-list-alt"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('cafeteria::inventory.title')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['units.index'],'route')}}" href="{{ route('units.index') }}" data-i18n="nav.dash.main"><i class="la la-balance-scale"></i>{{ trans('cafeteria::unit.title') }}</a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['raw-material-categories.index'],'route')}}" href="{{ route('raw-material-categories.index') }}" data-i18n="nav.dash.main"><i class="la la-arrow-circle-o-right"></i>{{ trans('cafeteria::raw-material-category.title') }}</a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['raw-materials.index'],'route')}}" href="{{ route('raw-materials.index') }}" data-i18n="nav.dash.main"><i class="la la-arrow-circle-o-right"></i>{{ trans('cafeteria::raw-material.index') }}</a>
                    </li>
                {{-- @endcan --}}
                <!-- Cafeteria Inventories -->
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['cafeteria-inventories.index'],'route')}}" href="{{ route('cafeteria-inventories.index') }}" data-i18n="nav.dash.main"><i class="la la-arrow-circle-o-right"></i>{{ trans('cafeteria::inventory.index') }}</a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>

        <!-- Purchase List -->
        {{-- @can(['view_users','create_users']) --}}
        <li class="master-aside-menu-item {{isActive(['purchase-lists.index'],'route')}}">
            <a class="{{isActive(['purchase-lists.index'],'route')}}" href="{{ route('purchase-lists.index') }}" data-i18n="nav.dash.main">
                <i class="ft-shopping-cart"></i>
                {{ trans('cafeteria::purchase-list.title') }}
            </a>
        </li>
        <li class="master-aside-menu-item {{isActive(['deliver-materials.index'],'route')}}">
            <a class="{{isActive(['deliver-materials.index'],'route')}}" href="{{ route('deliver-materials.index') }}" data-i18n="nav.dash.main">
                <i class="la la-truck"></i>
                {{ trans('cafeteria::deliver-material.title') }}
            </a>
        </li>
        <!-- Venues -->
        <li class="master-aside-menu-item {{isActive(['venues.index'],'route')}}">
            <a class="{{isActive(['venues.index'],'route')}}" href="{{ route('venues.index') }}" data-i18n="nav.dash.main">
                <i class="la la-map-marker"></i>
                {{ trans('cafeteria::venue.title') }}
            </a>
        </li>
        <!-- Food Menu -->
        <li class="master-aside-menu-item {{isActive(['food-menus.index'],'route')}}">
            <a class="{{isActive(['food-menus.index'],'route')}}" href="{{ route('food-menus.index') }}" data-i18n="nav.dash.main">
                <i class="la la-list-alt"></i>
                {{ trans('cafeteria::food-menu.index') }}
            </a>
        </li>
        {{-- @endcan --}}

        <!-- Finish Food -->
        <li class="master-aside-menu-item dropdown {{isActive(['finish-foods.index','sales.index','venue-selections.index','unsold-foods.index'],'route')}}">
            <a href="#" >
                <i class="la la-list-alt"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('cafeteria::finish-food.title')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['finish-foods.index'],'route')}}" href="{{ route('finish-foods.index') }}" data-i18n="nav.dash.main">
                            <i class="la la-arrow-circle-o-right"></i>
                            {{ trans('cafeteria::finish-food.title') }}
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['sales.index'],'route')}}" href="{{ route('sales.index') }}" data-i18n="nav.dash.main">
                            <i class="ft-shopping-cart"></i>
                            {{ trans('cafeteria::sales.title') }}
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['venue-selections.index'],'route')}}" href="{{ route('venue-selections.index') }}" data-i18n="nav.dash.main">
                            <i class="la la-map-marker"></i>
                            {{ trans('cafeteria::venue-selection.title') }}
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['unsold-foods.index'],'route')}}" href="{{ route('unsold-foods.index') }}" data-i18n="nav.dash.main">
                            <i class="ft-trash-2"></i>
                            {{ trans('cafeteria::unsold-food.title') }}
                        </a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>
        <!-- Food Order -->
        {{-- @can(['view_users','create_users']) --}}
        <li class="master-aside-menu-item {{isActive(['food-orders.index'],'route')}}">
            <a class="{{isActive(['food-orders.index'],'route')}}" href="{{ route('food-orders.index') }}" data-i18n="nav.dash.main">
                <i class="la la-list-alt"></i>
                {{ trans('cafeteria::food-order.title') }}
            </a>
        </li>
        {{-- @endcan --}}


        <!-- Special Service -->
        <li class="master-aside-menu-item dropdown {{isActive(['special-groups.index','special-purchase-lists.index','special-group-bills.index'],'route')}}">
            <a href="#" >
                <i class="la la-list-alt"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('cafeteria::special-service.title')
                </span>
            </a>
            <ul>
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['special-groups.index'],'route')}}" href="{{ route('special-groups.index') }}" data-i18n="nav.dash.main">
                            <i class="ft-users"></i>
                            {{ trans('cafeteria::special-service.special_group.title') }}
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['special-purchase-lists.index'],'route')}}" href="{{ route('special-purchase-lists.index') }}" data-i18n="nav.dash.main">
                            <i class="ft-shopping-cart"></i>
                            {{ trans('cafeteria::cafeteria.purchase_list') }}
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['special-group-bills.index'],'route')}}" href="{{ route('special-group-bills.index') }}" data-i18n="nav.dash.main">
                            <i class="la la-money"></i>
                            {{ trans('cafeteria::special-service.bill.prepare_bill') }}
                        </a>
                    </li>
                {{-- @endcan --}}
                {{-- @can(['view_users','create_users']) --}}
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['unsold-foods.index'],'route')}}" href="{{ route('unsold-foods.index') }}" data-i18n="nav.dash.main">
                            <i class="ft-trash-2"></i>
                            {{ trans('cafeteria::unsold-food.title') }}
                        </a>
                    </li>
                {{-- @endcan --}}
            </ul>
        </li>

        {{-- @can(['view_users','create_users']) --}}
        <li class="master-aside-menu-item {{isActive(['income-expense-entries.index'],'route')}}">
            <a class="{{isActive(['income-expense-entries.index'],'route')}}" href="{{ route('income-expense-entries.index') }}" data-i18n="nav.dash.main">
                <i class="la la-money"></i>
                {{ trans('cafeteria::income-expense.title') }}
            </a>
        </li>
        {{-- @endcan --}}
    </ul>
@endauth
