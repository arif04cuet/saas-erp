<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ (request()->routeIs('publication')) ? 'active' : '' }}">
                <a href="{{ route('publication') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.dashboard')</span></a>
            </li>

            @can('publication-menu-access')

                <li class="{{ (request()->routeIs('publication-types.index')) ? 'active' : '' }}">
                    <a href="{{ route('publication-types.index') }}">
                        <i class="la la-tags"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('publication::type.title')</span></a>
                </li>

                <li class="{{ (request()->routeIs('publication-presses.index')) ? 'active' : '' }}">
                    <a href="{{ route('publication-presses.index') }}">
                        <i class="la la-newspaper-o"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('publication::press.title')</span></a>
                </li>


                <li class="{{ (request()->routeIs('publication-organizations.index')) ? 'active' : '' }}">
                    <a href="{{ route('publication-organizations.index') }}">
                        <i class="la la-university"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('publication::organization.title')</span></a>
                </li>

                <li class="nav-item">
                    <a href="#" class=""><i class="la la-list-alt"></i>
                        <span class="menu-title"
                            data-i18n="nav.templates.main">{{ trans('publication::inventory.inventory') }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ (request()->routeIs('publication-inventories.create')) ? 'active' : '' }}">
                            <a href="{{ route('publication-inventories.create') }}">
                                <i class="la la-arrow-circle-o-right"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('publication::inventory.add') }}</span></a>
                        </li>


                        <li class="{{ (request()->routeIs('publication-inventories.index')) ? 'active' : '' }}">
                            <a href="{{ route('publication-inventories.index') }}">
                                <i class="la la-arrow-circle-o-right"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('publication::inventory.index') }}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan

            <!-- Publish Request -->
            <li class="nav-item">
                <a href="#" class=""><i class="la la-list-alt"></i>
                    <span class="menu-title"
                        data-i18n="nav.templates.main">{{ trans('publication::publication-request.request') }}</span></a>
                <ul class="menu-content">
                    @can('publication-menu-access')
                        <!-- Publication Request -->
                        <li class="{{ (request()->is('publication/publication-requests')) ? 'active' : '' }}">
                            <a href="{{ route('publication.publication-requests') }}">
                                <i class="la la-arrow-circle-o-right"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('publication::publication-request.title') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    <!-- Press Researches -->
                    <li class="{{ (request()->is('publication/published-research-papers')) ? 'active' : '' }}">
                        <a href="{{ route('publication.published-research-papers.index') }}">
                            <i class="la la-arrow-circle-o-right"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">{{ trans('publication::press-research.title') }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>


            <!-- Free Paper Distribution -->
            <li class="nav-item">
                <a href="#" class=""><i class="la la-list-alt"></i>
                    <span class="menu-title"
                        data-i18n="nav.templates.main">{{ trans('publication::research-paper-free-request.title') }}</span></a>
                <ul class="menu-content">

                    <!-- Employee Request -->
                    <li class="{{ (request()->routeIs('employee-paper-requests.index')) ? 'active' : '' }}">
                        <a href="{{ route('employee-paper-requests.index') }}">
                            <i class="la la-send-o"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">{{ trans('publication::research-paper-free-request.emp_paper_request') }}</span></a>
                    </li>
                    @can('publication-menu-access')
                        <!-- Manual Distribution -->
                        <li class="{{ (request()->routeIs('research-paper-free-requests.index')) ? 'active' : '' }}">
                            <a href="{{ route('research-paper-free-requests.index') }}">
                                <i class="la la-gift"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('publication::research-paper-free-request.title') }}</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            @can('publication-menu-access')
                <!-- Income Expense Entry -->
                <li class="{{ (request()->routeIs('publication-income-expense-entries')) ? 'active' : '' }}">
                    <a href="{{ route('publication-income-expense-entries.index') }}">
                        <i class="la la-money"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">{{ trans('publication::income-expense.title') }}
                        </span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
