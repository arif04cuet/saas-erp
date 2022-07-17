<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        @auth
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ (request()->routeIs('pms')) ? 'active' : '' }} nav-item">
                    <a href="{{ url('pms') }}"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="nav.dash.main">@lang('labels.dashboard')</span></a>
                </li>
                <li class="{{ (request()->routeIs('project.index')) ? 'active' : '' }} nav-item">
                    <a href="{{ route('project.index') }}"><i class="la la-briefcase"></i><span class="menu-title"
                            data-i18n="nav.dash.main">@lang('pms::project_proposal.projects')</span></a>
                </li>

                <li class="nav-item">
                    <a href="#"><i class="la la-list"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ trans('pms::project_proposal.project_invitation_brief') }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ (request()->routeIs('project-request.index')) ? 'active' : '' }}">
                            <a href="{{ route('project-request.index') }}">
                                <i class="la la-list"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('pms::project_proposal.invitation') }}</span>
                            </a>
                        </li>
                        <li class="{{ (request()->routeIs('project-proposal-submission.index')) ? 'active' : '' }}">
                            <a href="{{ route('project-proposal-submission.index') }}">
                                <i class="la la-list"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('pms::project_proposal.submitted_proposal') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#"><i class="la la-list"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ trans('pms::project_proposal.project_invitation_details') }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ (request()->routeIs('project-request-details.index')) ? 'active' : '' }}">
                            <a href="{{ route('project-request-details.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('pms::project_proposal.invitation') }}</span>
                            </a>
                        </li>
                        <li class="{{ (request()->routeIs('project-details-proposal-submission.index')) ? 'active' : '' }}">
                            <a href="{{ route('project-details-proposal-submission.index') }}">
                                <i class="la la-list-alt"></i>
                                <span class="menu-title"
                                    data-i18n="nav.dash.main">{{ trans('pms::project_proposal.submitted_proposal') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="{{is_active_route('project-request.index')}}"> --}}
                {{-- <a href="{{route('project-request.index')}}"> --}}
                {{-- <i class="la la-list"></i> --}}
                {{-- <span class="menu-title" data-i18n="nav.dash.main">{{trans('pms::project_proposal.invitation')}}</span> --}}
                {{-- </a> --}}
                {{-- </li> --}}
                {{-- <li class="{{is_active_route('project-proposal-submission.index')}}"> --}}
                {{-- <a href="{{route('project-proposal-submission.index')}}"> --}}
                {{-- <i class="la la-list"></i> --}}
                {{-- <span class="menu-title" data-i18n="nav.dash.main">{{trans('pms::project_proposal.submitted_proposal')}}</span> --}}
                {{-- </a> --}}
                {{-- </li> --}}
            </ul>
        @endauth
    </div>
</div>
