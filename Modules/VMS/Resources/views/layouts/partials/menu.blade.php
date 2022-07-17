<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="{{ (request()->routeIs('vms')) ? 'active' : '' }}">
                <a href="{{ route('vms') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.dashboard')</span></a>
            </li>
        @can('admin-vms-trip-approve')
            <!-- Vehicles -->
                <li class="nav-item">
                    <a href="#">
                        <i class="la la-car"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">@lang('vms::vehicle.menu_title')</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ (request()->routeIs('vms.vehicles.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.vehicles.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">@lang('vms::vehicle.index')</span>
                            </a>
                        </li>
                        <li class="{{ (request()->routeIs('vms.vehicles.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.vehicle-types.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::vehicle.type.index')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Vehicles -->

                <!-- Driver Create -->
                <li class="nav-item">
                    <a href="#">
                        <i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">@lang('vms::driver.menu_title')</span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ (request()->routeIs('vms.drivers.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.drivers.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">@lang('vms::driver.index')</span>
                            </a>
                        </li>
                    </ul>
                </li>
        @endcan

        <!-- Trip -->
            <li class="nav-item">
                <a href="#">
                    <i class="la la-taxi"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">@lang('vms::trip.menu_title')</span>
                </a>
                <ul class="menu-content">
                    <!-- apply for a trip -->
                    <li class="{{ (request()->routeIs('vms.trip.create')) ? 'active' : '' }}">
                        <a href="{{ route('vms.trip.create') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('vms::trip.apply.menu_title')</span>
                        </a>
                    </li>
                    <!-- Trip List -->
                    <li class="{{ (request()->is('vms.trip.index')) ? 'active' : '' }}">
                        <a href="{{ route('vms.trip.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">@lang('vms::trip.index')</span>
                        </a>
                    </li>
                @can('admin-vms-trip-approve')
                    <!-- Trip Setting -->
                        <li class="{{ (request()->routeIs('vms.trip.setting.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.trip.setting.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::trip.setting.menu_title')</span>
                            </a>
                        </li>
                        <!-- Trip Limit  -->
                        <li class="{{ (request()->routeIs('vms.trip.limit.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.trip.limit.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::trip.limit.index')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>


            <!-- Trip Bill -->
            <li class="nav-item">
                <a href="#">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">@lang('vms::trip.bill.menu_title')</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (request()->routeIs('vms.trip.bill.index')) ? 'active' : '' }}">
                        <a href="{{ route('vms.trip.bill.index') }}">
                            <i class="la la-money"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                    @lang('hm::hm_code_setting.menu_index')
                            </span>
                        </a>
                    </li>
                    @can('admin-vms-trip-approve')
                        <li class="{{ (request()->routeIs('vms.monthly-bill.create')) ? 'active' : '' }}">
                            <a href="{{ route('vms.monthly-bill.create') }}">
                                <i class="la la-money"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">
                                    @lang('vms::trip.bill.monthly_bill')
                            </span>
                            </a>
                        </li>

                        <li class="{{ (request()->routeIs('vms.bill-sector.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.bill-sector.index') }}">
                                <i class="la la-money"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">
                                    @lang('vms::bill-sector.index')
                            </span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

        @can('admin-vms-trip-approve')
            <!-- Filling Station  -->
                <li class="nav-item">
                    <a href="#">
                        <i class="la la-battery-half"></i>
                        <span class="menu-title"
                              data-i18n="nav.templates.main">@lang('vms::fillingStation.menu_title')</span>
                    </a>
                    <ul class="menu-content">
                        <!-- apply for a trip -->
                        <li class="{{ (request()->routeIs('vms.fillingStation.create')) ? 'active' : '' }}">
                            <a href="{{ route('vms.fillingStation.create') }}">
                                <i class="la la-plus"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::fillingStation.create')</span>
                            </a>
                        </li>
                        <!-- Trip List -->
                        <li class="{{ (request()->routeIs('vms.fillingStation.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.fillingStation.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::fillingStation.index')</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <!-- Fuel Log Book -->
                <li class="nav-item">
                    <a href="#">
                        <i class="la la-book"></i>
                        <span class="menu-title"
                              data-i18n="nav.templates.main">@lang('vms::fuelLogBook.menu_title')</span>
                    </a>
                    <ul class="menu-content">
                        <!-- create fuel  -->
                        <li class="{{ (request()->routeIs('vms.fuel.log.create')) ? 'active' : '' }}">
                            <a href="{{ route('vms.fuel.log.create') }}">
                                <i class="la la-plus"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::fuelLogBook.create')</span>
                            </a>
                        </li>
                        <!-- Fuel List -->
                        <li class="{{ (request()->routeIs('vms.fuel.log.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.fuel.log.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::fuelLogBook.index')</span>
                            </a>
                        </li>
                        <!-- Fuel report -->
                        <li class="{{ (request()->routeIs('vms.fuel.log.report')) ? 'active' : '' }}">
                            <a href="{{ route('vms.fuel.log.report') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::fuelLogBook.report')</span>
                            </a>
                        </li>

                        <!-- Fuel Bill Submit -->
                        <li class="{{ (request()->routeIs('vms.fuel.bill.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.fuel.bill.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::fuelBillSubmit.menu_title')</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <!-- Maintenance-->
                <li class="nav-item">
                    <a href="#">
                        <i class="la la-book"></i>
                        <span class="menu-title"
                              data-i18n="nav.templates.main">@lang('vms::maintenanceItem.menu.root_menu')</span>
                    </a>
                    <ul class="menu-content">
                        <!-- create fuel  -->
                        <li class="{{ (request()->routeIs('vms.maintenance.item.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.maintenance.item.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::maintenanceItem.items.list')</span>
                            </a>
                        </li>
                        <!-- Fuel List -->
                        <li class="{{ (request()->routeIs('vms.requisition.index')) ? 'active' : '' }}">
                            <a href="{{ route('vms.requisition.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('vms::requisition.index')</span>

                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Integration Setting -->
                <li class="{{ (request()->is('vms.integration.setting.index')) ? 'active' : '' }}">
                    <a href="{{ route('vms.integration.setting.create') }}">
                        <i class="la la-wrench"></i>
                        <span class="menu-title"
                              data-i18n="nav.dash.main">@lang('vms::integration.menu_title')</span></a>
                </li>
            @endcan
        </ul>
    </div>
</div>
