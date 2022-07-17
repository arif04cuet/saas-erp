<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="{{ (request()->routeIs('inventory')) ? 'active' : '' }}">
                <a href="{{ route('inventory') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.dashboard')</span></a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="la la-folder-o"></i>
                    <span class="menu-title"
                          data-i18n="nav.templates.main">@lang('ims::inventory.item.menu_title')</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->is('ims/inventory-request/requisition/create/initial')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-request.create.initial', 'requisition') }}">
                            <i class="la la-plus-circle"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('ims::inventory.inventory_request_types.requisition')
                                @lang('ims::inventory.inventory_request_types.request')
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('ims/inventory-request/transfer/create/initial')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-request.create.initial', 'transfer') }}">
                            <i class="la la-plus-circle"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('ims::inventory.inventory_request_types.transfer')
                                @lang('ims::inventory.inventory_request_types.request')
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('ims/inventory-request/scrap/create/initial')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-request.create.initial', 'scrap') }}">
                            <i class="la la-plus-circle"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('ims::inventory.inventory_request_types.scrap')
                                @lang('ims::inventory.inventory_request_types.request')
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('ims/inventory-request/abandon/create/initial')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-request.create.initial', 'abandon') }}">
                            <i class="la la-plus-circle"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('ims::inventory.inventory_request_types.abandon')
                                @lang('ims::inventory.inventory_request_types.request')
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->routeIs('inventory-request.index')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-request.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('ims::inventory.inventory_request_types.request') @lang('labels.list')
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Inventory -->
            <li class="{{ (request()->routeIs('inventory.index')) ? 'active' : '' }}">
                <a href="{{ route('inventory.index') }}">
                    <i class="la la-list-alt"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">@lang('ims::inventory.title')</span>
                </a>
            </li>
            <!-- //Inventory -->

            <!-- Inventory Item Request -->
            <li class="nav-item">
                <a href="#">
                    <i class="la la-building"></i>
                    <span class="menu-title"
                          data-i18n="nav.templates.main">@lang('ims::inventory.item.item_request.menu_title')</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->routeIs('inventory-item-request.index')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-item-request.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('ims::inventory.item.item_request.menu_index')</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- // Inventory Item Request -->

            <!-- Report -->
            <li class="nav-item">
                <a href="#">
                    <i class="la la-building"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">@lang('ims::report.title')</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->routeIs('inventory.report.users')) ? 'active' : '' }}">
                        <a href="{{ route('inventory.report.users') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('ims::report.users')</span>
                        </a>
                    </li>
                    <li class="{{ (request()->routeIs('inventory.report.category-items')) ? 'active' : '' }}">
                        <a href="{{ route('inventory.report.category-items') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('ims::report.category_items')</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- //Report -->

            <!-- Inventory Item Category -->
            <li class="nav-item">
                <a href="#">
                    <i class="la la-shopping-cart"></i>
                    <span class="menu-title"
                          data-i18n="nav.templates.main">@lang('ims::inventory.item_category')</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->routeIs('inventory-item-category.index').
(request()->routeIs('inventory-item-category.departmental-item-categories')) ? 'active' : '') }}">
                        <a href="{{ route('inventory-item-category.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('ims::inventory.all_list')</span>
                        </a>
                    </li>
                    <li class="{{ (request()->routeIs('inventory-category-group.index')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-category-group.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('ims::group.group_list')</span>
                        </a>
                    </li>
                    <li class="{{ (request()->routeIs('inventory-items.index')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-items.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('ims::inventory.item.menu_title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ (request()->routeIs('departmental-item-categories')) ? 'active' : '' }}">
                        <a href="{{ route('inventory-item-category.departmental-item-categories') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('ims::inventory.departmental_list')</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- //Inventory Item Category -->

            <!-- Asset Management -->
            <li class="nav-item">
                <a href="#">
                    <i class="ft ft-box"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">@lang('ims::asset.title')</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->routeIs('asset-managements.index')) ? 'active' : '' }}">
                        <a href="{{ route('asset-managements.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('ims::asset.list_menu_title')</span>
                        </a>
                    </li>
                    <li class="{{ (request()->routeIs('appreciation-depreciation-records.index')) ? 'active' : '' }}">
                        <a href="{{ route('appreciation-depreciation-records.create') }}">
                            <i class="la la-compress"></i>
                            @lang('ims::appreciation-depreciation.title')
                        </a>
                    </li>
                </ul>
            </li>
            <!-- //Asset Management -->

            <!-- Procurement and Billing -->
            <li class="nav-item">
                <a href="#">
                    <i class="la la-building"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">
                        @lang('ims::procurement.menu_title')
                    </span>
                </a>
                <ul class="menu-content">
                    <!-- Procurement -->
                    <li class="{{ (request()->routeIs('procurement-billings.index')) ? 'active' : '' }}">
                        <a href="{{ route('procurement-billings.index') }}">
                            <i class="la la-list-alt"></i>

                            @lang('ims::procurement.index')
                        </a>
                    </li>
                    <li class="{{ (request()->routeIs('procurement-bill-settings.index')) ? 'active' : '' }}">
                        <a href="{{ route('procurement-bill-settings.index') }}">
                            <i class="la la-cog"></i>
                            @lang('ims::procurement.settings.menu_title')
                        </a>
                    </li>
                </ul>
            </li>
            <!-- //Procurement and Billing -->

            <!-- Inventory Location -->
            <li class="nav-item">
                <a href="{{ route('inventory-locations.index') }}">
                    <i class="la la-building"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">@lang('ims::location.location')</span>
                </a>
            </li>
            <!-- //Location -->

            <!-- Vendor -->
            <li class="nav-item">
                <a href="{{ route('vendor.index') }}">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">@lang('ims::vendor.vendor')</span>
                </a>
            </li>
            <!-- //Vendor -->
        @if(auth()->user()->hasAnyRole('ROLE_INVENTORY_USER'))
            <!-- Auction -->
                <li class="nav-item">
                    <a href="#">
                        <i class="la la-building"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">@lang('ims::auction.title')</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ (request()->routeIs('auctions.create')) ? 'active' : '' }}">
                            <a href="{{ route('auctions.create') }}">
                                <i class="la la-plus-circle"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('ims::auction.add_menu_title')</span>
                            </a>
                        </li>
                        <li class="{{ (request()->routeIs('auctions.index')) ? 'active' : '' }}">
                            <a href="{{ route('auctions.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('ims::auction.list_menu_title')</span>
                            </a>
                        </li>
                        <li class="{{ (request()->routeIs('auctions.sales.index')) ? 'active' : '' }}">
                            <a href="{{ route('auctions.sales.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('ims::auction.auction_sales_list')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- // Auction -->
            @endif
        </ul>
    </div>
</div>
