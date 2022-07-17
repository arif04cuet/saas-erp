<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow side-bar-print" data-scroll-to-active="true">
    <div class="main-menu-content">
        @auth
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ is_active_route('tms.dashboard') }}">
                    <a href="{{ route('tms.dashboard') }}">
                        <i class="la la-home"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.dashboard')</span>
                    </a>
                </li>
                @can('tms-department-course-administration-menu-access')
                    <li class="{{ is_active_route('training-head.index') }}">
                        <a href="{{ route('training-head.index') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">{{trans('tms::training_head.menu_title')}}</span>
                        </a>
                    </li>
                    <li class="{{ is_active_url('tms/training') }}">
                        <a href="{{ url('tms/training') }}">
                            <i class="la la-list-alt"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">{{trans('tms::training.menu_title')}}</span>
                        </a>
                    </li>
                    <li class="{{ is_active_match('tms/trainee')}}">
                        <a href="{{ url('tms/trainee') }}">
                            <i class="la la-users"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">{{trans('tms::training.trainee')}}</span>
                        </a>
                    </li>
                @endcan

                @can('tms-department-menu-access')
                    <li class="{{ is_active_route('organization.index') }}">
                        <a href="{{ route('organization.index') }}">
                            <i class="la la-building"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">{{trans('tms::organization.title')}}</span>
                        </a>
                    </li>
                    <li class="{{ is_active_route('venue.index') }}">
                        <a href="{{ route('venue.index') }}">
                            <i class="la la-building"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">{{trans('tms::venue.manue_title')}}</span>
                        </a>
                    </li>
                    <li class="{{ is_active_route('participant.index') }}">
                        <a href="{{ route('participant.index') }}">
                            <i class="la la-building"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">{{trans('tms::training.participant')}}</span>
                        </a>
                    </li>
                @endcan

                @can('tms-access-medical')
                    <li class="{{ is_active_match('/tms/medical/trainee')}}">
                        <a href="{{ url('/tms/medical/trainee') }}">
                            <i class="la la-users"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">{{trans('tms::training.trainee')}}</span>
                        </a>
                    </li>
                @endcan

            <!-- Training Invitation -->
                @can('tms-menu-access')
                    <li class="{{ is_active_match(route('annual-training-notification.index'))}}">
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
                            @lang('tms::training.speaker_evaluation')
                        </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ is_active_route('training.evaluate.index') }}">
                            <a href="{{ route('training.evaluate.index') }}">
                                <i class="la la-list"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('labels.list')</span>
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
                                    <li class="{{ is_active_route('trainings.courses.modules.sessions.evaluations') }}">
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
                            @lang('tms::training.course_evaluation')
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ is_active_route('training.course.evaluate.index') }}">
                                <a href="{{ route('training.course.evaluate.index') }}">
                                    <i class="la la-list"></i>
                                    <span class="menu-title"
                                          data-i18n="nav.dash.main">@lang('labels.list')</span>
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
                                        <li class="{{ is_active_route('trainings.courses.modules.sessions.course_evaluations') }}">
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

                @can('tms-department-menu-access')
                    <li class="nav-item">
                        <a href="#" class=""><i class="la la-hotel"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('hm::hostel.title')
                        </span>
                        </a>
                        <!-- Hostel Calender -->
                        <ul class="menu-content">
                            <li class="{{ is_active_route('trainings.hostels.calendars.show') }}">
                                <a href="{{ route('trainings.hostels.calendars.show') }}">
                                    <i class="la la-calendar"></i>
                                    <span class="menu-title"
                                          data-i18n="nav.dash.main">@lang('hm::hostel.title') @lang('hrm::calendar.title')</span>
                                </a>
                            </li>
                        </ul>
                        <!-- Hostel Booking-Request -->
                        <ul class="menu-content">
                            <li class="{{ is_active_route('tms.hostel-booking-requests.create') }}">
                                <a href="{{ route('tms.hostel-booking-requests.create') }}">
                                    <i class="la la-building"></i>
                                    <span class="menu-title"
                                          data-i18n="nav.dash.main">@lang('tms::hostel_booking_request.menu_title')</span>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <!-- cafeteria menu -->

                    {{--                    <li class="nav-item">--}}
                    {{--                        <a href="#" class=""><i class="la la-hotel"></i>--}}
                    {{--                            <span class="menu-title" data-i18n="nav.templates.main">--}}
                    {{--                            @lang('tms::training_cafeteria.title')--}}
                    {{--                        </span>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="menu-content">--}}
                    {{--                            <li class="{{ is_active_route('trainings.cafeterias.calendars.show') }}">--}}
                    {{--                                <a href="{{ route('trainings.cafeterias.calendars.show') }}">--}}
                    {{--                                    <i class="la la-calendar"></i>--}}
                    {{--                                    <span class="menu-title"--}}
                    {{--                                          data-i18n="nav.dash.main">@lang('tms::training_cafeteria.title') @lang('hrm::calendar.title')</span>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                <!-- TMS Inventory -->
                    <li class="nav-item">
                        <a href="#" class=""><i class="la la-shopping-cart"></i>
                            <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('tms::inventory.title')
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ is_active_match(route('tms-inventory-request.index')) }}">
                                <a href="{{ route('tms-inventory-request.index') }}">
                                    <i class="la la-list"></i>
                                    <span class="menu-title" data-i18n="nav.dash.main">
                                        @lang('tms::inventory.inventory_request')
                                    </span>
                                </a>
                            </li>
                            <li class="{{ is_active_match(route('tms-inventory-locations.index')) }}">
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
                                    <li class="{{ is_active_route('inventory-item-request.index') }}">
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
                    </li>
                @endcan
                @can('tms-menu-access')
                    <li class="{{ is_active_route('trainings.courses.modules.sessions.schedules.index') }}">
                        <a href="{{ route('trainings.courses.modules.sessions.schedules.index') }}">
                            <i class="la la-building"></i>
                            <span class="menu-title"
                                  data-i18n="nav.dash.main">{{trans('tms::schedule.session.title')}}</span>
                        </a>
                    </li>
            @endcan

            <!-- Accounts  -->
                <li class="nav-item">
                    <a href="#" class=""><i class="la la-balance-scale"></i>
                        <span class="menu-title"
                              data-i18n="nav.templates.main">@lang('accounts::accounts.title')</span></a>
                    <ul class="menu-content">
                        <!-- Journal Entry  -->
                        <li>
                            <a href="#" class=""><i class="ft ft-file-plus"></i>
                                <span class="menu-title"
                                      data-i18n="nav.templates.main">
                                    @lang('accounts::journal.entry.title')
                                </span>
                            </a>
                            <ul class="menu-content">
                                <!-- Journal List -->
                                <li class="{{is_active_match(route('tms.journal-entries.index'))}}">
                                    <a href="{{route('tms.journal-entries.index')}}">
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
                                <li class="{{ is_active_match(route('tms-budgets.index')) }}">
                                    <a href="{{ route('tms-budgets.index') }}">
                                        <i class="la la-balance-scale"></i>
                                        <span class="menu-title"
                                              data-i18n="nav.dash.main">@lang('tms::budget.title')</span>
                                    </a>
                                </li>
                                <!-- Sector and Sub-sector -->
                                <li class="{{ is_active_match(route('tms-sectors.index')) }}">
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
                        <li class="{{is_active_match(route('tms.advance-payments.index'))}}">
                            <a href="{{route('tms.advance-payments.index')}}">
                                <i class="la la-arrow-circle-o-right"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">
                                            {{ trans('accounts::journal.entry.advance_payment.index') }}</span>
                            </a>
                        </li>

                        <!-- Tms Code Setting -->
                        <li class="{{ is_active_route('tms.code-setting.index') }}">
                            <a href="{{ route('tms.code-setting.index') }}">
                                <i class="la la-cog"></i>
                                <span class="menu-title"
                                      data-i18n="nav.dash.main">@lang('accounts::economy-code.settings.title')
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
                            {{--                                <li class="{{ is_active_match(route('tms-budgets.index')) }}">--}}
                            {{--                                    <a href="{{ route('tms-budgets.index') }}">--}}
                            {{--                                        <i class="la la-balance-scale"></i>--}}
                            {{--                                        <span class="menu-title"--}}
                            {{--                                              data-i18n="nav.dash.main">@lang('tms::budget.title')</span>--}}
                            {{--                                    </a>--}}
                            {{--                                </li>--}}
                            <!-- Expenditure Report -->
                                <li class="{{ is_active_match(route('tms-accounts-reports.index')) }}">
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
