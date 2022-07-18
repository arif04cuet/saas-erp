@auth
    <ul class="master-aside-menus">
        <li class="master-aside-menu-item {{ isActive(['hrm-dashboard'],'route') }}">
            <a href="{{ route('hrm-dashboard') }}">
                <i class="la la-home"></i> @lang('labels.dashboard')
            </a>
        </li>
        <li class="master-aside-menu-item {{ isActive(['employee.index'],'route') }}">
            <a href="{{ route('employee.index') }}">
                <i class="la la-users"></i> @lang('hrm::employee.menu_name')
            </a>
        </li>
        <li class="master-aside-menu-item {{ isActive(['department.index'],'route') }}">
            <a href="{{ route('department.index') }}">
                <i class="la ft-file-text"></i> @lang('hrm::department.left_menu_title')
            </a>
        </li>
        <li class="master-aside-menu-item {{ isActive(['sections.index'],'route') }}">
            <a href="{{ route('sections.index') }}">
                <i class="la la-puzzle-piece"></i> @lang('hrm::section.left_menu_title')
            </a>
        </li>
        <li class="master-aside-menu-item {{ isActive(['designation.index'],'route') }}">
            <a href="{{ route('designation.index') }}">
                <i class="la la-users"></i> @lang('hrm::designation.left_menu_title')
            </a>
        </li>
        <li class="master-aside-menu-item {{ isActive(['employees.religions.index'],'route') }}">
            <a href="{{ route('employees.religions.index') }}">
                <i class="la la-list-alt"></i> @lang('hrm::employee.religion.title')
            </a>
        </li>

        <li class="master-aside-menu-item {{ isActive(['circular.index'],'route') }}">
            <a href="{{ route('circular.index') }}">
                <i class="la la-list-ol"></i> @lang('hrm::circular.title')
            </a>
        </li>
        
        <li class="master-aside-menu-item dropdown {{isActive(['leave-types.index','leaves.create', 'leaves.index','leave-balances.index'],'route')}}">
            <a href="#" >
                <i class="la la-edit"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    {{ trans('hrm::leave.leave') }}
                </span>
            </a>
    
            <ul>
                <li>
                    <a href="{{ route('leaves.create') }}" class="{{isActive(['leaves.create'],'route')}}">
                        <i class="la la-list"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">{{ trans('hrm::leave.leave_application') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('leaves.index') }}" class="{{isActive(['leaves.index'],'route')}}">
                        <i class="la la-user"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            {{ trans('hrm::leave.leave_list') }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('leave-balances.index') }}" class="{{isActive(['leave-balances.index'],'route')}}">
                        <i class="la la-user"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            {{ trans('hrm::leave.leave_balance') }}
                        </span>
                    </a>
                </li>
                @can('hrm-user-access')
                <li>
                    <a href="{{ route('leave-types.index') }}" class="{{isActive(['leave-types.index'],'route')}}">
                        <i class="la la-user"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            {{ trans('hrm::leave.leave_type') }}
                        </span>
                    </a>
                </li>
                @endcan
                
            </ul>
        </li>


        <li class="master-aside-menu-item dropdown {{isActive(['appraisals.settings.create','appraisals.settings.index'],'route')}}">
            <a href="#" >
                <i class="la la-edit"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('hrm::appraisal.title')
                </span>
            </a>
    
            <ul>
                <li>
                    <a href="{{ route('appraisals.settings.index') }}" class="{{isActive(['appraisals.settings.create','appraisal.create','appraisals.settings.index'],'route')}}">
                        <i class="la la-list"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::appraisal_setting.appraisal_setting')  - @lang('labels.list')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('appraisals.settings.create') }}" class="{{isActive(['appraisals.settings.create'],'route')}}">
                        <i class="la la-user"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('hrm::appraisal_setting.appraisal_setting')  - @lang('labels.create')
                        </span>
                    </a>
                </li>
                @if (get_user_designation()->rank_id <= 9)
                <li>
                    <a href="{{ route('appraisal.create',['class'=>'first']) }}" class="{{isActive(['appraisal.create'],'route')}}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('labels.form') - @lang('hrm::appraisal.first_class')
                        </span>
                    </a>
                </li>
                @endif
                
                <li>
                    <a href="{{ route('appraisal.create',['class'=>'second']) }}" class="{{isActive(['appraisal.create'],'route')}}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('labels.form') - @lang('hrm::appraisal.second_class')
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('appraisal.create',['class'=>'third']) }}" class="{{isActive(['appraisal.create'],'route')}}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('labels.form') - @lang('hrm::appraisal.third_class')
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('appraisal.create',['class'=>'fourth']) }}" class="{{isActive(['appraisal.create'],'route')}}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('labels.form') - @lang('hrm::appraisal.fourth_class')
                        </span>
                    </a>
                </li>



                <li>
                    <a href="{{ route('appraisals.index') }}" class="{{isActive(['appraisals.index'],'route')}}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            {{ trans('hrm::appraisal.appraisal_list') }}
                        </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('appraisal.invitation.index') }}" class="{{isActive(['appraisal.invitation.index'],'route')}}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            {{ trans('hrm::appraisal.invitation.title') }}
                        </span>
                    </a>
                </li>
                
                
            </ul>
        </li>


        <li class="master-aside-menu-item dropdown {{isActive(['complaints.invitations.index','complaint.create','complaint.index','complaints.invitations.create'],'route')}}">
            <a href="#" >
                <i class="la ft-users"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('hrm::complaint.title')
                </span>
            </a>
    
            <ul>
                <li>
                    <a href="{{ route('complaint.create') }}" class="{{isActive(['complaint.create'],'route')}}">
                        <i class="la la-list"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::complaint.title') @lang('labels.form')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('complaint.index') }}" class="{{isActive(['complaint.index'],'route')}}">
                        <i class="la la-user"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('hrm::complaint.title') @lang('labels.list')
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('complaints.invitations.create') }}" class="{{isActive(['complaints.invitations.create'],'route')}}">
                        <i class="la la-user"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('hrm::complaint.complaint_invitation_form')
                        </span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('complaints.invitations.index') }}" class="{{isActive(['complaints.invitations.index'],'route')}}">
                        <i class="la la-user"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('hrm::complaint.complaint_invitation_list')
                        </span>
                    </a>
                </li>
                
                
            </ul>
        </li>



        <!-- House Circular -->
        {{-- <li class="nav-item">
            <a href="#" class="">
                <i class="la la-file-o"></i>
                <span class="menu-title"
                    data-i18n="nav.templates.main">{{ trans('hrm::house-details.title') }}</span>
            </a>
            <ul class="menu-content">
                @can('hrm-user-access')
                    <li class="{{ (request()->is('house-categories')) ? 'active' : '' }}">
                        <a href="{{ route('house-categories.index') }}">
                            <i class="la la-arrow-circle-o-right"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">@lang('hrm::house-details.category.title')</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('house-details')) ? 'active' : '' }}">
                        <a href="{{ route('house-details.index') }}">
                            <i class="la la-arrow-circle-o-right"></i>
                            <span class="menu-title"
                                data-i18n="nav.dash.main">@lang('hrm::house-details.house_all')</span>
                        </a>
                    </li>
                @endcan
                <li class="{{ (request()->is('house-circulars')) ? 'active' : '' }}">
                    <a href="{{ route('house-circulars.index') }}">
                        <i class="la la-arrow-circle-o-right"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::house-circular.title')</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#" class=""><i class="la la-calendar"></i>
                <span class="menu-title"
                    data-i18n="nav.templates.main">{{ trans('hrm::employee.attendance') }}</span>
            </a>
            <ul class="menu-content">
                <li class="{{ (request()->is('hrm/attendance')) ? 'active' : '' }}">
                    <a href="{{ route('employee-attendance.index') }}">
                        <i class="la la-list-ol"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">{{ trans('hrm::employee.attendance_list') }}</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- Calender -->
        {{-- <li class="nav-item">
            <a href="javascript:;" class="">
                <i class="la la-calendar"></i>
                <span class="menu-title"
                    data-i18n="nav.templates.main">{{ trans('hrm::calendar.title') }}</span>
            </a>
            <ul class="menu-content">
                <li class="{{ (request()->routeIs('calendar')) ? 'active' : '' }}">
                    <a href="{{ route('calendar') }}">
                        <i class="la la-television"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('labels.show')</span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('calendar-event.index')) ? 'active' : '' }}">
                    <a href="{{ route('calendar-event.index') }}">
                        <i class="la la-calendar-plus-o"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('hrm::calendar.event')</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- // Calender -->

        <!-- Contact -->
        {{-- <li class="nav-item">
            <a href="#" class="">
                <i class="la la-mobile-phone"></i>
                <span class="menu-title"
                    data-i18n="nav.templates.main">{{ trans('hrm::contact.title') }}</span>
            </a>
            <ul class="menu-content">
                <li class="{{ (request()->is('cafeteria/units')) ? 'active' : '' }}">
                    <a href="{{ route('contact-types.index') }}">
                        <i class="la la-arrow-circle-o-right"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::contact.type.title')</span>
                    </a>
                </li>
                <li class="{{ (request()->is('contacts')) ? 'active' : '' }}">
                    <a href="{{ route('contacts.index') }}">
                        <i class="la la-arrow-circle-o-right"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::contact.contact_info')</span>
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- Employee Loan -->
        {{-- <li class="nav-item">
            <a href="#" class=""><i class="la ft-file-text"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('hrm::employee.loan.title')
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ (request()->routeIs('loan-circulars.index')) ? 'active' : '' }}">
                    <a href="{{ route('loan-circulars.index') }}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('hrm::employee.loan.circular.title')

                        </span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('employee-loans.create')) ? 'active' : '' }}">
                    <a href="{{ route('employee-loans.create') }}">
                        <i class="la ft-file-plus"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('hrm::employee.loan.apply')
                        </span>
                    </a>
                </li>
                <li
                    class="{{ (request()->routeIs('employee-loans.index')) ? 'active' : '' . (request()->routeIs('employee-loans.create')) . (request()->routeIs('employee-loans.loans')) }}">
                    <a href="{{ route('employee-loans.index') }}">
                        <i class="la ft-file"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('hrm::employee.loan.apply') @lang('labels.list')
                        </span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('employee-loans.loans')) ? 'active' : '' }}">
                    <a href="{{ route('employee-loans.loans') }}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('hrm::employee.loan.title')

                        </span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- / Employee Loan -->

        <!-- Note Options -->
        {{-- <li class="nav-item">
            <a href="#" class=""><i class="la ft-file-text"></i>
                <span class="menu-title" data-i18n="nav.templates.main">@lang('hrm::note.title')</span>
            </a>
            <ul class="menu-content">
                <li class="{{ (request()->routeIs('note.create')) ? 'active' : '' }}">
                    <a href="{{ route('note.create') }}">
                        <i class="la ft-file-plus"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('hrm::note.create')
                        </span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('note.index')) ? 'active' : '' }}">
                    <a href="{{ route('note.index') }}">
                        <i class="la ft-file"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">
                            @lang('hrm::note.my_note')
                        </span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- / Note Options -->

        <!-- Appraisal  Options -->
        {{-- <li class="nav-item">
            <a href="#" class=""><i class="la ft-users"></i>
                <span class="menu-title"
                    data-i18n="nav.templates.main">@lang('hrm::appraisal.title')</span></a>

            <ul class="menu-content">
                @include('hrm::appraisal.partials.menu.settings')
                <li class="nav-item">
                    <a href="#" class=""><i class="la ft-users"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">
                            @lang('hrm::appraisal.title') @lang('labels.form')
                        </span>
                    </a>

                    <ul class="menu-content">
                        @if (get_user_designation()->rank_id <= 9)
                            <li class="{{ (request()->is('hrm/appraisal/first/create')) ? 'active' : '' }}">
                                <a href="{{ route('appraisal.create', ['class' => 'first']) }}">
                                    <i class="la ft-file-text"></i>
                                    <span class="menu-title"
                                        data-i18n="nav.dash.main">@lang('hrm::appraisal.first_class')</span>
                                </a>
                            </li>
                        @endif
                        <li class="{{ (request()->is('hrm/appraisal/second/create')) ? 'active' : '' }}">
                            <a href="{{ route('appraisal.create', ['class' => 'second']) }}">
                                <i class="la ft-file-text"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">@lang('hrm::appraisal.second_class')</span>
                            </a>
                        </li>
                        <li class="{{ (request()->is('hrm/appraisal/third/create')) ? 'active' : '' }}">
                            <a href="{{ route('appraisal.create', ['class' => 'third']) }}">
                                <i class="la ft-file-text"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">@lang('hrm::appraisal.third_class')</span>
                            </a>
                        </li>
                        <li class="{{ (request()->is('hrm/appraisal/fourth/create')) ? 'active' : '' }}">
                            <a href="{{ route('appraisal.create', ['class' => 'fourth']) }}">
                                <i class="la ft-file-text"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">@lang('hrm::appraisal.fourth_class')</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (request()->is('appraisal/view')) ? 'active' : '' }}">
                    <a href="{{ url('hrm/appraisal/') }}">
                        <i class="la ft-grid"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">{{ trans('hrm::appraisal.appraisal_list') }}</span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('appraisal.invitation.index')) ? 'active' : '' }}">
                    <a href="{{ route('appraisal.invitation.index') }}">
                        <i class="la ft-grid"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">{{ trans('hrm::appraisal.invitation.title') }}</span>
                    </a>
                </li>
            </ul>

        </li> --}}
        <!-- / Appraisal Options -->

        <!-- / CV Evaluation Menu items -->
        {{-- <li class="nav-item">
            <a href="#" class=""><i class="la ft-briefcase"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    @lang('hrm::circular.job')
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ (request()->is('job-circular')) ? 'active' : '' }}">
                    <a href="{{ route('job-circular.index') }}">
                        <i class="la la-list-ol"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::circular.job_circular')</span>
                    </a>
                </li>
                <!-- This Should Only be visible to Employee -->
                <li class="{{ (request()->is('hrm/cv/list')) ? 'active' : '' }}">
                    <a href="{{ url('hrm/cv/list') }}">
                        <i class="la ft-grid"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::employee.cv_list')</span>
                    </a>
                </li>
                <li class="{{ (request()->is('recruitment-exams.index')) ? 'active' : '' }}">
                    <a href="{{ route('recruitment-exams.index') }}">
                        <i class="la ft-grid"></i>
                        @lang('hrm::job-circular.recruitment_exam.title')
                    </a>
                </li>
            </ul>
        </li> --}}

        <!-- Complaint  Options -->
        {{-- <li class="nav-item">
            <a href="#" class=""><i class="la ft-users"></i>
                <span class="menu-title"
                    data-i18n="nav.templates.main">@lang('hrm::complaint.title')</span></a>

            <ul class="menu-content">
                <li class="{{ (request()->is('complaint/create')) ? 'active' : '' }}">
                    <a href="{{ route('complaint.create') }}">
                        <i class="la ft-file-text"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('hrm::complaint.title')
                            @lang('labels.form')</span>
                    </a>
                </li>
                <li class="{{ (request()->is('complaint/list')) ? 'active' : '' }}">
                    <a href="{{ route('complaint.index') }}">
                        <i class="la la-list-alt"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">@lang('hrm::complaint.title')
                            @lang('labels.list')</span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('complaints.invitations.create')) ? 'active' : '' }}">
                    <a href="{{ route('complaints.invitations.create') }}">
                        <i class="la la-comments"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::complaint.complaint_invitation_form')</span>
                    </a>
                </li>
                <li class="{{ (request()->routeIs('complaints.invitations.index')) ? 'active' : '' }}">
                    <a href="{{ route('complaints.invitations.index') }}">
                        <i class="la la-list-alt"></i>
                        <span class="menu-title"
                            data-i18n="nav.dash.main">@lang('hrm::complaint.complaint_invitation_list')</span>
                    </a>
                </li> --}}
    </ul>
@endauth