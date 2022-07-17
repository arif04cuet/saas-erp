
{{-- <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        @auth
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="#"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main">{{trans('user-management.title')}}</span></a>
                    <ul class="menu-content">
                        @canany(['view_users','create_users','update_users','delete_users'])
                        <li class="{{ (request()->is('users*')) ? 'active' : '' }}">
                            <a class="menu-item" href="{{route('users.index')}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('labels.user')}}</a>
                        </li>
                        @endcanany

                        @canany(['view_roles','create_roles','update_roles','delete_roles'])
                        <li class="{{ (request()->is('roles*')) ? 'active' : '' }}">
                            <a class="menu-item" href="{{route('roles.index')}}" data-i18n="nav.users.user_cards"><i class="la la-pencil-square"></i>{{trans('user-management.list_page_title')}}</a>
                        </li>
                        @endcanany

                        @canany(['view_permissions','create_permissions','update_permissions','delete_permissions'])
                        <li class="{{ (request()->is('permissions*')) ? 'active' : '' }}">
                            <a class="menu-item" href="{{route('permissions.index')}}"><i class="la la-pencil-square"></i>{{trans('user-management.permission_list_title')}}</a>
                        </li>
                        @endcanany
                    </ul>
                </li>
                <!-- / -->
                <li class=" nav-item"><a href="#"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main">{{trans('labels.doptor_management')}}</span></a>
                    <ul class="menu-content">
                        <li class="{{ (request()->is('doptor/list')) ? 'active' : '' }}">
                            <a class="menu-item" href="{{'/doptor/list'}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('labels.doptor')}}</a>
                        </li>
                    </ul>
                </li>
                <!-- // -->
                <li class=" nav-item"><a href="#"><i class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main">{{trans('module.module_management')}}</span></a>
                    <ul class="menu-content">
                        <li class="{{ (request()->is('module')) ? 'active' : '' }}">
                            <a class="menu-item" href="{{route('module.index')}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('module.module')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endauth
    </div>
</div> --}}

@auth
    <ul class="master-aside-menus">
        <li class="master-aside-menu-item dropdown {{isActive(['users*','roles*','permissions*'])}}">
            <a href="#" >
                <i class="la la-user"></i>
                <span class="menu-title" data-i18n="nav.templates.main">
                    {{trans('user-management.title')}}
                </span>
            </a>
            <ul>
                @canany(['view_users','create_users','update_users','delete_users'])
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['users*'])}}" href="{{route('users.index')}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('labels.user')}}</a>
                    </li>
                @endcanany
                @canany(['view_roles','create_roles','update_roles','delete_roles'])
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['roles*'])}}" href="{{route('roles.index')}}" data-i18n="nav.users.user_cards"><i class="la la-pencil-square"></i>{{trans('user-management.list_page_title')}}</a>
                    </li>
                @endcanany
                @canany(['view_permissions','create_permissions','update_permissions','delete_permissions'])
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['permissions*'])}}" href="{{route('permissions.index')}}" data-i18n="nav.users.user_profile"><i class="la la-pencil-square"></i>{{trans('user-management.permission_list_title')}}</a>
                    </li>
                @endcanany
            </ul>
        </li>
        <!-------- Doptor Item --------->
        <li class="master-aside-menu-item dropdown {{isActive(['doptor*'],'route')}}">
            <a href="#" >
                <i class="la la-user"></i>
                <span class="menu-title" data-i18n="nav.users.main">
                    {{trans('labels.doptor_management')}}
                </span>
            </a>
            <ul>
                @canany(['view_users','create_users','update_users','delete_users'])
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['doptors.index'],'route')}}" href="{{route('doptors.index')}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('labels.doptor')}}</a>
                    </li>
                @endcanany
            </ul>
        </li>
        <!-------- Module Item --------->
        <li class="master-aside-menu-item dropdown {{isActive(['module*'],'route')}}">
            <a href="#" >
                <i class="la la-user"></i>
                <span class="menu-title" data-i18n="nav.users.main">
                    {{trans('module.module_management')}}
                </span>
            </a>
            <ul>
                @canany(['view_users','create_users','update_users','delete_users'])
                    <li class="master-aside-menu-item">
                        <a class="{{isActive(['module*'],'route')}}" href="{{route('module.index')}}" data-i18n="nav.users.user_profile"><i class="la la-users"></i>{{trans('module.module')}}</a>
                    </li>
                @endcanany
            </ul>
        </li>
    </ul>
@endauth
