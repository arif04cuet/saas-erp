<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow side-bar-print" data-scroll-to-active="true">
    <div class="main-menu-content">
        @auth
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                {{-- @can('view_tms_calendar') --}}
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">
                        <i class="la la-home"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.dashboard')</span>
                    </a>
                </li>
                {{-- @endcan --}}
                @can('view_tms_calendar')
                    <li class="{{ request()->routeIs('tms.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('tms.dashboard') }}">
                            <i class="las la-school"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">@lang('tms::training.calendar')</span>
                        </a>
                    </li>
                @endcan
                @can('tms-department-course-administration-menu-access')
                    {{-- <li class="{{ request()->routeIs('training.index') ? 'active' : '' }}">
                        <a href="{{ url('tms/training') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">{{ trans('tms::training.training_list') }}</span>
                        </a>
                    </li> --}}
                    {{-- <li class="{{ activeMenu('training') }}">
                        <a href="{{ url('tms/training') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">{{ trans('tms::training.training_list') }}</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="la la-edit"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                                {{ trans('tms::training.training') }}
                            </span>
                        </a>
                        <ul class="menu-content">
                            {{-- @can('view_trainings') --}}
                            <li class="{{ request()->routeIs('training.index') ? 'active' : '' }}">
                                <a href="{{ route('training.index') }}">
                                    <i class="la la-list"></i>
                                    <span class="menu-title"
                                        data-i18n="nav.dash.main">{{ trans('tms::training.training_list') }}</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            <li class="{{ request()->routeIs('training.create') ? 'active' : '' }}">
                                <a href="{{ url('tms/training/create') }}" class="">
                                    <i class="la la-user"></i>
                                    <span class="menu-title" data-i18n="nav.templates.main">
                                        {{ trans('tms::training.training_add') }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="la la-edit"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                                {{ trans('tms::course.course_management') }}
                            </span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('offline.courses') ? 'active' : '' }}">
                                <a href="{{ url('tms/training/course/offline') }}">
                                    <i class="la la-list"></i>
                                    <span class="menu-title"
                                        data-i18n="nav.dash.main">{{ trans('tms::training.through.offline') }}</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('online.courses') ? 'active' : '' }}">
                                <a href="{{ url('tms/training/course/online') }}" class="">
                                    <i class="la la-user"></i>
                                    <span class="menu-title" data-i18n="nav.templates.main">
                                        {{ trans('tms::training.through.online') }}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- 
                    <li class="{{ (request()->is('tms/training')) ? 'active' : '' }}">
                        <a href="{{ url('tms/training') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">{{trans('tms::training.training_list')}}</span>
                        </a>
                    </li> 
                    --}}

                    <li class="{{ request()->is('tms/trainee') ? 'active' : '' }}">
                        <a href="{{ url('tms/trainee') }}">
                            <i class="la la-users"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">{{ trans('tms::training.trainee') }}</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('tms/trainee/approve') ? 'active' : '' }}">
                        <a href="{{ url('tms/trainee/approve') }}">
                            <i class="lar la-check-square"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">{{ trans('labels.trainee_approve') }}</span>
                        </a>
                    </li>
                @endcan

                {{-- @can('tms-access-medical')
                    <li class="{{ (request()->is('/tms/medical/trainee')) ? 'active' : '' }}">
                        <a href="{{ url('/tms/medical/trainee') }}">
                            <i class="la la-users"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">{{trans('tms::training.trainee')}}</span>
                        </a>
                    </li>
                @endcan --}}

                <!-- Training Invitation -->
                @can('tms-menu-access')
                    <li class="{{ request()->routeIs('annual-training-notification.index') ? 'active' : '' }}">
                        <a href="{{ route('annual-training-notification.index') }}">
                            <i class="la la-credit-card"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('tms::annual_training.menu_title')
                            </span>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="">
                        <i class="la la-list-alt"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('tms::system_setting.system_setting')
                        </span>
                    </a>
                    <ul class="menu-content">
                        {{-- <li class="{{ (request()->is('hrm/employee')) ? 'active' : '' }}">
                            <a href="{{ url('hrm/employee') }}">
                                <i class="la la-list"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('hrm::employee.menu_name')</span>
                            </a>
                        </li> --}}
                        {{-- <li class="{{ (request()->routeIs('training-type.index')) ? 'active' : '' }}">
                            <a href="{{ route('training-type.index') }}">
                                <i class="la la-list"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('tms::system_setting.setup.training_type')</span>
                            </a>
                        </li> --}}
                        <li class="{{ request()->routeIs('training.category.index') ? 'active' : '' }}">
                            <a href="{{ route('training.category.index') }}">
                                <i class="la la-list"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">@lang('tms::system_setting.setup.training_type')</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('training-head.index') ? 'active' : '' }}">
                            <a href="{{ route('training-head.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('tms::training_head.menu_title') }}</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('trainee-type.index') ? 'active' : '' }}">
                            <a href="{{ route('trainee-type.index') }}">
                                <i class="la la-building"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('tms::training.participant') }}</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('tms-budgets.index') ? 'active' : '' }}">
                            <a href="{{ route('tms-budgets.index') }}">
                                <i class="la la-building"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('tms::budget.budget') }}</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('training-year.index') ? 'active' : '' }}">
                            <a href="{{ route('training-year.index') }}">
                                <i class="la la-building"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('tms::training.training_year') }}</span>
                            </a>
                        </li>
                        {{-- <li class="{{ (request()->routeIs('organization.index')) ? 'active' : '' }}">
                            <a href="{{ route('organization.index') }}">
                                <i class="la la-building"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">{{trans('tms::organization.Office_Doptor')}}</span>
                            </a>
                        </li> --}}
                        <li class="{{ request()->routeIs('venue.index') ? 'active' : '' }}">
                            <a href="{{ route('venue.index') }}">
                                <i class="la la-building"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('tms::venue.manue_title') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @can('tms-menu-access')
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                                @lang('tms::training.course_evaluation')
                            </span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('training.course.evaluate.index') ? 'active' : '' }}">
                                <a href="{{ route('training.course.evaluate.index') }}">
                                    <i class="la la-list"></i>
                                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.list')</span>
                                </a>
                            </li>
                            @can('tms-department-course-administration-menu-access')
                                <li class="nav-item">
                                    <a href="" class="">
                                        <i class="la la-user"></i>
                                        <span class="menu-title" data-i18n="nav.templates.main">
                                            @lang('tms::trainee.title')
                                        </span>
                                    </a>
                                    <ul class="menu-content">
                                        <li
                                            class="{{ request()->routeIs('trainings.courses.modules.sessions.course_evaluations') ? 'active' : '' }}">
                                            <a href="{{ route('trainings.courses.modules.sessions.course_evaluations') }}">
                                                <i class="la la-list-alt"></i>
                                                <span class="menu-title" data-i18n="nav.dash.main">
                                                    @lang('tms::trainee.did_not_evaluated')
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="">
                        <i class="la la-list-alt"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('tms::training.speaker_evaluation')
                        </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('training.evaluate.index') ? 'active' : '' }}">
                            <a href="{{ route('training.evaluate.index') }}">
                                <i class="la la-list"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.list')</span>
                            </a>
                        </li>
                        @can('tms-department-course-administration-menu-access')
                            <li class="nav-item">
                                <a href="" class="">
                                    <i class="la la-user"></i>
                                    <span class="menu-title" data-i18n="nav.templates.main">
                                        @lang('tms::trainee.title')
                                    </span>
                                </a>
                                <ul class="menu-content">
                                    <li
                                        class="{{ request()->routeIs('trainings.courses.modules.sessions.evaluations') ? 'active' : '' }}">
                                        <a href="{{ route('trainings.courses.modules.sessions.evaluations') }}">
                                            <i class="la la-list-alt"></i>
                                            <span class="menu-title" data-i18n="nav.dash.main">
                                                @lang('tms::trainee.did_not_evaluated')
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('tms-menu-access')
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                                @lang('tms::certificate.title')
                            </span>
                        </a>
                        <ul class="menu-content">
                            <li class="">
                                <a href="#">
                                    <i class="la la-list"></i>
                                    <span class="menu-title" data-i18n="nav.dash.main">@lang('tms::certificate.list')</span>
                                </a>
                            </li>
                            @can('tms-department-course-administration-menu-access')
                                <li class="nav-item">
                                    <a href="" class="">
                                        <i class="la la-user"></i>
                                        <span class="menu-title" data-i18n="nav.templates.main">
                                            @lang('tms::certificate.new_add')
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('tms-department-menu-access')
                    {{-- <li class="nav-item">
                        <a href="#" class=""><i class="la la-hotel"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('hm::hostel.title')
                        </span>
                        </a> --}}
                    <!-- Hostel Calender -->
                    {{-- <ul class="menu-content">
                            <li class="{{ (request()->routeIs('trainings.hostels.calendars.show')) ? 'active' : '' }}">
                                <a href="{{ route('trainings.hostels.calendars.show') }}">
                                    <i class="la la-calendar"></i>
                                    <span class="menu-title"
                                          data-i18n="nav.dash.main">@lang('hm::hostel.title') @lang('hrm::calendar.title')</span>
                                </a>
                            </li>
                        </ul> --}}
                    {{-- <ul class="menu-content"> --}}
                    <li class="{{ request()->routeIs('hm') ? 'active' : '' }}">
                        <a href="{{ route('hm') }}">
                            <i class="la la-building"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">@lang('hm::hostel.title')</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('cafeteria') ? 'active' : '' }}">
                        <a href="{{ route('cafeteria') }}">
                            <i class="la la-building"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">@lang('cafeteria::cafeteria.title')</span>
                        </a>
                    </li>
                    <!-- TMS Inventory -->
                    <li class="{{ request()->routeIs('inventory') ? 'active' : '' }}">
                        <a href="{{ route('inventory') }}">
                            <i class="la la-shopping-cart"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">@lang('ims::inventory.title')</span>
                        </a>
                    </li>
                    <!-- TMS HRM -->
                    <li class="{{ request()->routeIs('hrm-dashboard') ? 'active' : '' }}">
                        <a href="{{ route('hrm-dashboard') }}">
                            <i class="la la-users"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">@lang('hrm::employee.menu_name')</span>
                        </a>
                    </li>
                    {{-- </ul> --}}
                    <!-- Hostel Booking-Request -->
                    {{-- <ul class="menu-content">
                            <li class="{{ (request()->routeIs('tms.hostel-booking-requests.create')) ? 'active' : '' }}">
                                <a href="{{ route('tms.hostel-booking-requests.create') }}">
                                    <i class="la la-building"></i>
                                    <span class="menu-title"
                                          data-i18n="nav.dash.main">@lang('tms::hostel_booking_request.menu_title')</span>
                                </a>
                            </li>
                        </ul> --}}

                    {{-- </li> --}}
                    <!-- cafeteria menu -->

                    {{-- <li class="nav-item"> --}}
                    {{-- <a href="#" class=""><i class="la la-hotel"></i> --}}
                    {{-- <span class="menu-title" data-i18n="nav.templates.main"> --}}
                    {{-- @lang('tms::training_cafeteria.title') --}}
                    {{-- </span> --}}
                    {{-- </a> --}}
                    {{-- <ul class="menu-content"> --}}
                    {{-- <li class="{{ is_active_route('trainings.cafeterias.calendars.show') }}"> --}}
                    {{-- <a href="{{ route('trainings.cafeterias.calendars.show') }}"> --}}
                    {{-- <i class="la la-calendar"></i> --}}
                    {{-- <span class="menu-title" --}}
                    {{-- data-i18n="nav.dash.main">@lang('tms::training_cafeteria.title') @lang('hrm::calendar.title')</span> --}}
                    {{-- </a> --}}
                    {{-- </li> --}}
                    {{-- </ul> --}}
                    {{-- </li> --}}

                    <!-- TMS Inventory -->
                    {{-- <li class="nav-item">
                        <a href="#" class=""><i class="la la-shopping-cart"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('tms::inventory.title')
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ (request()->routeIs('tms-inventory-request.index')) ? 'active' : '' }}">
                                <a href="{{ route('tms-inventory-request.index') }}">
                                    <i class="la la-list"></i>
                                    <span class="menu-title" data-i18n="nav.dash.main">
                                        @lang('tms::inventory.inventory_request')
                                    </span>
                                </a>
                            </li>
                            <li class="{{ (request()->routeIs('tms-inventory-locations.index')) ? 'active' : '' }}">
                                <a href="{{ route('tms-inventory-locations.index') }}">
                                    <i class="la la-bank"></i>
                                    <span class="menu-title"
                                          data-i18n="nav.dash.main">
                                        @lang('tms::inventory.inventory_location')
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#">
                                    <i class="la la-building"></i>
                                    <span class="menu-title"
                                          data-i18n="nav.templates.main">@lang('ims::inventory.item.item_request.menu_title')</span>
                                </a>
                                <ul class="menu-content">
                                    <li class="{{ (request()->routeIs('inventory-item-request.index')) ? 'active' : '' }}">
                                        <a href="{{ route('tms-inventory-item-request.index') }}">
                                            <i class="la la-list-alt"></i>
                                            <span class="menu-title"
                                                  data-i18n="nav.dash.main">@lang('ims::inventory.item.item_request.menu_index')</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- // Inventory Item Request -->

                        </ul>
                    </li> --}}
                @endcan
                @can('tms-menu-access')
                    <li
                        class="{{ request()->routeIs('trainings.courses.modules.sessions.schedules.index') ? 'active' : '' }}">
                        <a href="{{ route('trainings.courses.modules.sessions.schedules.index') }}">
                            <i class="la la-building"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">{{ trans('tms::schedule.session.title') }}</span>
                        </a>
                    </li>
                @endcan

                <!-- Accounts  -->
                <li class="nav-item">
                    <a href="#" class=""><i class="la la-balance-scale"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">@lang('accounts::accounts.title')</span></a>
                    <ul class="menu-content">
                        <!-- Journal Entry  -->
                        <li>
                            <a href="#" class=""><i class="ft ft-file-plus"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">
                                    @lang('accounts::journal.entry.title')
                                </span>
                            </a>
                            <ul class="menu-content">
                                <!-- Journal List -->
                                <li class="{{ request()->routeIs('tms.journal-entries.index') ? 'active' : '' }}">
                                    <a href="{{ route('tms.journal-entries.index') }}">
                                        <i class="la la-arrow-circle-o-right"></i>
                                        <span class="menu-title"
                                            data-i18n="nav.dash.main">{{ trans('accounts::journal.index') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- TMS Budget -->
                        <li class="nav-item">
                            <a href="#" class=""><i class="la la-money"></i>
                                <span class="menu-title" data-i18n="nav.templates.main">
                                    @lang('tms::budget.menu_title')
                                </span>
                            </a>
                            <ul class="menu-content">
                                <!-- Budget -->
                                <li class="{{ request()->routeIs('tms-budgets.index') ? 'active' : '' }}">
                                    <a href="{{ route('tms-budgets.index') }}">
                                        <i class="la la-balance-scale"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">@lang('tms::budget.title')</span>
                                    </a>
                                </li>
                                <!-- Sector and Sub-sector -->
                                <li class="{{ request()->routeIs('tms-sectors.index') ? 'active' : '' }}">
                                    <a href="{{ route('tms-sectors.index') }}">
                                        <i class="la la-tags"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">
                                            @lang('tms::budget.sector.title')
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <!-- Employee Advance Payment List -->
                        <li class="{{ request()->routeIs('tms.advance-payments.index') ? 'active' : '' }}">
                            <a href="{{ route('tms.advance-payments.index') }}">
                                <i class="la la-arrow-circle-o-right"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">
                                    {{ trans('accounts::journal.entry.advance_payment.index') }}</span>
                            </a>
                        </li>

                        <!-- Tms Code Setting -->
                        <li class="{{ request()->routeIs('tms.code-setting.index') ? 'active' : '' }}">
                            <a href="{{ route('tms.code-setting.index') }}">
                                <i class="la la-cog"></i>
                                <span class="menu-title" data-i18n="nav.dash.main">@lang('accounts::economy-code.settings.title')
                                </span>
                            </a>
                        </li>

                        <!-- TMS Accounts Report -->
                        <li class="nav-item">
                            <a href="#" class=""><i class="la la-file-pdf-o "></i>
                                <span class="menu-title" data-i18n="nav.templates.main">
                                    @lang('tms::budget.report.title')
                                </span>
                            </a>
                            <ul class="menu-content">
                                <!-- Budget Report -->
                                {{-- <li class="{{ is_active_match(route('tms-budgets.index')) }}"> --}}
                                {{-- <a href="{{ route('tms-budgets.index') }}"> --}}
                                {{-- <i class="la la-balance-scale"></i> --}}
                                {{-- <span class="menu-title" --}}
                                {{-- data-i18n="nav.dash.main">@lang('tms::budget.title')</span> --}}
                                {{-- </a> --}}
                                {{-- </li> --}}
                                <!-- Expenditure Report -->
                                <li class="{{ request()->routeIs('tms-accounts-reports.index') ? 'active' : '' }}">
                                    <a href="{{ route('tms-accounts-reports.index') }}">
                                        <i class="la la-list"></i>
                                        <span class="menu-title" data-i18n="nav.dash.main">
                                            @lang('tms::budget.report.expenditure')
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                @endauth
    </div>
</div>
