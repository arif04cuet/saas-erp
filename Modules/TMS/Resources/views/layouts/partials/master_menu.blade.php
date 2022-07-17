@auth
<ul class="master-aside-menus">
    <!-- // -->

    <li class="master-aside-menu-item {{ request()->is('/') ? 'active' : '' }}">
        <a href="{{ url('admin/') }}">
            <i class="la la-home"></i>
            <span class="menu-title">@lang('labels.dashboard')</span>
        </a>
    </li>

    @can('view_tms_calendar')
        <li class="master-aside-menu-item {{ request()->routeIs('tms.dashboard') ? 'active' : '' }}">
            <a href="{{ route('tms.dashboard') }}">
                <i class="las la-school"></i>
                <span class="menu-title">@lang('tms::training.calendar')</span>
            </a>
        </li>
    @endcan

    <li class="master-aside-menu-item dropdown {{isActive(['training.index', 'training.create'],'route')}}">
        <a href="#" >
            <i class="la la-edit"></i>
            <span class="menu-title" data-i18n="nav.templates.main">
                {{ trans('tms::training.training') }}
            </span>
        </a>

        <ul>
            <li>
                <a href="{{ route('training.index') }}" class="{{isActive(['training.index'],'route')}}">
                    <i class="la la-list"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('tms::training.training_list') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('training.create') }}" class="{{isActive(['training.create'],'route')}}">
                    <i class="la la-user"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">
                        {{ trans('tms::training.training_add') }}
                    </span>
                </a>
            </li>
        </ul>
    </li>

    {{-- <li class="master-aside-menu-item dropdown {{isActive(['offline.courses','online.courses'],'route')}}">
        <a href="#" >
            <i class="la la-edit"></i>
            <span class="menu-title" data-i18n="nav.templates.main">
                {{ trans('tms::course.course_management') }}
            </span>
        </a>
        
        <ul>
            <li>
                <a href="{{ route('offline.courses') }}" class="{{isActive(['offline.courses'],'route')}}">
                    <i class="la la-list"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('tms::training.through.offline') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('online.courses') }}" class="{{isActive(['online.courses'],'route')}}">
                    <i class="la la-list"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">
                        {{ trans('tms::training.through.online') }}
                    </span>
                </a>
            </li>
        </ul>
    </li> --}}
    <li class="master-aside-menu-item {{isActive(['trainee.index'],'route')}}">
        <a href="{{ route('trainee.index') }}" class="{{isActive(['trainee.index'],'route')}}">
            <i class="la la-users"></i>
            <span class="menu-title"
                data-i18n="nav.dash.main">{{ trans('tms::training.trainee') }}</span>
        </a>
    </li>
    <li class="master-aside-menu-item {{isActive(['online.enroll.trainee.list'],'route')}}">
        <a href="{{ route('online.enroll.trainee.list') }}" class="{{isActive(['online.enroll.trainee.list'],'route')}}">
            <i class="lar la-check-square"></i>
            <span class="menu-title"
                data-i18n="nav.dash.main">{{ trans('labels.trainee_approve') }}</span>
        </a>
    </li>
    {{-- <li class="master-aside-menu-item {{ isActive(['annual-training-notification.index'],'route') }}">
        <a href="{{ route('annual-training-notification.index') }}">
            <i class="la la-credit-card"></i>
            <span class="menu-title" data-i18n="nav.dash.main">
                @lang('tms::annual_training.menu_title')
            </span>
        </a>
    </li> --}}
    <li class="master-aside-menu-item dropdown {{ isActive(['training.category.index','training-head.index','trainee-type.index','tms-budgets.index','training-year.index','venue.index','expense-type.index'],'route') }}">
        <a href="#" class="">
            <i class="la la-list-alt"></i>
            <span class="menu-title" data-i18n="nav.templates.main">
                @lang('tms::system_setting.system_setting')
            </span>
        </a>
        <ul>
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
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['training.category.index'],'route') }}" href="{{ route('training.category.index') }}">
                    <i class="la la-list"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('tms::system_setting.setup.training_type')</span>
                </a>
            </li>
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['training-head.index'],'route') }}" href="{{ route('training-head.index') }}">
                    <i class="la la-list-alt"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('tms::training_head.menu_title') }}</span>
                </a>
            </li>
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['trainee-type.index'],'route') }}" href="{{ route('trainee-type.index') }}">
                    <i class="la la-building"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('tms::training.participant') }}</span>
                </a>
            </li>
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['tms-budgets.index'],'route') }}" href="{{ route('tms-budgets.index') }}">
                    <i class="la la-building"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('tms::budget.budget') }}</span>
                </a>
            </li>
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['expense-type.index'],'route') }}" href="{{ route('expense-type.index') }}">
                    <i class="la la-building"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('tms::expense_type.manue_title') }}</span>
                </a>
            </li>
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['training-year.index'],'route') }}" href="{{ route('training-year.index') }}">
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
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['venue.index'],'route') }}" href="{{ route('venue.index') }}">
                    <i class="la la-building"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('tms::venue.manue_title') }}</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- @can('tms-menu-access')
    <li class="master-aside-menu-item dropdown {{ isActive(['training.course.evaluate.index','trainings.courses.modules.sessions.course_evaluations'],'route') }}">
        <a href="#" class="">
            <i class="la la-list-alt"></i>
            <span class="menu-title" data-i18n="nav.templates.main">
                @lang('tms::training.course_evaluation')
            </span>
        </a>
        <ul>
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['training.course.evaluate.index'],'route') }}" href="{{ route('training.course.evaluate.index') }}">
                    <i class="la la-list"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.list')</span>
                </a>
            </li>
            @can('tms-department-course-administration-menu-access')
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['trainings.courses.modules.sessions.course_evaluations'],'route') }}" href="{{ route('trainings.courses.modules.sessions.course_evaluations') }}">
                    <i class="la la-list-alt"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        @lang('tms::trainee.did_not_evaluated')
                    </span>
                </a>
            </li>
            @endcan
        </ul>
    </li>
    @endcan --}}
    {{-- <li class="master-aside-menu-item dropdown {{ isActive(['training.evaluate.index','trainings.courses.modules.sessions.evaluations'],'route') }}">
        <a href="#" class="">
            <i class="la la-list-alt"></i>
            <span class="menu-title" data-i18n="nav.templates.main">
                @lang('tms::training.speaker_evaluation')
            </span>
        </a>
        <ul>
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['training.evaluate.index'],'route') }}" href="{{ route('training.evaluate.index') }}">
                    <i class="la la-list"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.list')</span>
                </a>
            </li>
            @can('tms-department-course-administration-menu-access')
            <li class="master-aside-menu-item">
                <a class="{{ isActive(['trainings.courses.modules.sessions.evaluations'],'route') }}" href="{{ route('trainings.courses.modules.sessions.evaluations') }}">
                    <i class="la la-list-alt"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        @lang('tms::trainee.did_not_evaluated')
                    </span>
                </a>
            </li>
            @endcan
        </ul>
    </li> --}}
    {{-- @can('tms-menu-access')
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
    @endcan --}}

    {{-- @can('tms-menu-access')
    <li class="master-aside-menu-item {{ isActive(['trainings.courses.modules.sessions.schedules.index'],'route') }}">
        <a class="{{ isActive(['trainings.courses.modules.sessions.schedules.index'],'route') }}" href="{{ route('trainings.courses.modules.sessions.schedules.index') }}">
            <i class="la la-building"></i>
            <span class="menu-title"
                data-i18n="nav.dash.main">{{ trans('tms::schedule.session.title') }}</span>
        </a>
    </li>
    @endcan --}}

    <!-- Accounts  -->
    {{-- <li class="master-aside-menu-item dropdown {{ isActive(['tms.journal-entries.index','tms.journal-entries.index','tms-sectors.index','tms.advance-payments.index','tms.code-setting.index','tms-accounts-reports.index'],'route') }}">
        <a href="#" class=""><i class="la la-balance-scale"></i>
            <span class="menu-title" data-i18n="nav.templates.main">@lang('accounts::accounts.title')</span></a>
        <ul> --}}
            <!-- Journal Entry  -->
            {{-- <li class="master-aside-menu-item">
                <a class="{{ isActive(['tms.journal-entries.index'],'route') }}" href="{{ route('tms.journal-entries.index') }}">
                    <i class="la la-arrow-circle-o-right"></i>
                    <span class="menu-title"
                        data-i18n="nav.dash.main">{{ trans('accounts::journal.index') }}</span>
                </a>
            </li> --}}
            <!-- TMS Budget -->
            {{-- <li class="nav-item">
                <a href="#" class=""><i class="la la-money"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">
                        @lang('tms::budget.menu_title')
                    </span>
                </a>
                <ul> --}}
                <!-- Budget -->
                {{-- <li class="master-aside-menu-item">
                    <a class="{{ isActive(['tms-budgets.index'],'route') }}" href="{{ route('tms-budgets.index') }}">
                        <i class="la la-balance-scale"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('tms::budget.title')</span>
                    </a>
                </li> --}}
                <!-- Sector and Sub-sector -->
                {{-- <li class="master-aside-menu-item">
                    <a class="{{ isActive(['tms-sectors.index'],'route') }}" href="{{ route('tms-sectors.index') }}">
                        <i class="la la-tags"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('tms::budget.sector.title')
                        </span>
                    </a>
                </li> --}}
                {{-- </ul>
            </li> --}}
            <!-- Employee Advance Payment List -->
            {{-- <li class="master-aside-menu-item">
                <a class="{{ isActive(['tms.advance-payments.index'],'route') }}" href="{{ route('tms.advance-payments.index') }}">
                    <i class="la la-arrow-circle-o-right"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">
                        {{ trans('accounts::journal.entry.advance_payment.index') }}</span>
                </a>
            </li> --}}

            <!-- Tms Code Setting -->
            {{-- <li class="master-aside-menu-item">
                <a class="{{ isActive(['tms.code-setting.index'],'route') }}" href="{{ route('tms.code-setting.index') }}">
                    <i class="la la-cog"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">@lang('accounts::economy-code.settings.title')
                    </span>
                </a>
            </li> --}}

            <!-- TMS Accounts Report -->
            {{-- <li class="nav-item">
                <a href="#" class=""><i class="la la-file-pdf-o "></i>
                    <span class="menu-title" data-i18n="nav.templates.main">
                        @lang('tms::budget.report.title')
                    </span>
                </a> --}}
                {{-- <ul class="menu-content"> --}}
                    <!-- Budget Report -->
                    {{-- <li class="{{ is_active_match(route('tms-budgets.index')) }}"> --}}
                    {{-- <a href="{{ route('tms-budgets.index') }}"> --}}
                    {{-- <i class="la la-balance-scale"></i> --}}
                    {{-- <span class="menu-title" --}}
                    {{-- data-i18n="nav.dash.main">@lang('tms::budget.title')</span> --}}
                    {{-- </a> --}}
                    {{-- </li> --}}
                    <!-- Expenditure Report -->
                    {{-- <li class="master-aside-menu-item">
                        <a class="{{ isActive(['tms-accounts-reports.index'],'route') }}" href="{{ route('tms-accounts-reports.index') }}">
                            <i class="la la-list"></i>
                            <span class="menu-title" data-i18n="nav.dash.main">
                                @lang('tms::budget.report.expenditure')
                            </span>
                        </a>
                    </li> --}}
                {{-- </ul>
            </li> --}}
        {{-- </ul>
    </li> --}}
    <!-----end Accounts ---->
    <!----- User Management Start Here -------->
    {{-- <li class="master-aside-menu-item dropdown {{(request()->is('users*') || request()->is('roles*') || request()->is('permissions*')) ? 'active' : ''}}">
        <a href="#"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main">{{trans('user-management.title')}}</span></a>
        <ul>
            @canany(['view_users','create_users','update_users','delete_users'])
            <li>
                <a class="{{ (request()->is('users*')) ? 'active' : '' }}" href="{{route('users.index')}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('labels.user')}}</a>
            </li>
            @endcanany

            @canany(['view_roles','create_roles','update_roles','delete_roles'])
            <li>
                <a class="{{ (request()->is('roles*')) ? 'active' : '' }}" href="{{route('roles.index')}}" data-i18n="nav.users.user_cards"><i class="la la-pencil-square"></i>{{trans('user-management.list_page_title')}}</a>
            </li>
            @endcanany

            @canany(['view_permissions','create_permissions','update_permissions','delete_permissions'])
            <li>
                <a class="{{ (request()->is('permissions*')) ? 'active' : '' }}" href="{{route('permissions.index')}}"><i class="la la-pencil-square"></i>{{trans('user-management.permission_list_title')}}</a>
            </li>
            @endcanany
        </ul>
    </li> --}}
    <!-- // -->
    <li class="master-aside-menu-item {{ isActive('[users.index]','route') }}">
        <a href="{{route('users.index')}}">
            <i class="la la-users"></i> {{trans('user-management.title')}}
        </a>
    </li>
    {{--
    <li class="master-aside-menu-item">
        <a href="{{ route('cafeteria') }}">
            <i class="la la-list"></i> @lang('cafeteria::cafeteria.title')
        </a>
    </li> --}}
    <!-- TMS Inventory -->
    {{-- <li class="{{ request()->routeIs('inventory') ? 'active' : '' }}">
        <a href="{{ route('inventory') }}">
            <i class="la la-shopping-cart"></i>
            <span class="menu-title" data-i18n="nav.dash.main">@lang('ims::inventory.title')</span>
        </a>
    </li> --}}
    <!-- TMS HRM -->
    <li class="master-aside-menu-item">
        <a href="{{ route('hrm-dashboard') }}">
            <i class="la la-users"></i> @lang('hrm::employee.menu_name')
        </a>
    </li>
    <li class="master-aside-menu-item">
        <a href="{{ route('hm') }}">
            <i class="la la-building"></i> @lang('hm::hostel.title')
        </a>
    </li>
    <!-- // -->
    {{-- <li class="master-aside-menu-item {{ (request()->is('module')) ? 'active' : '' }}">
        <a href="{{route('module.index')}}">
            <i class="la la-users"></i> {{trans('module.module')}}
        </a>
    </li> --}}

</ul>
@endauth