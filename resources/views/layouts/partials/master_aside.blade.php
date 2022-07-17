@auth
<ul class="master-aside-menus">
    <li class="master-aside-menu-item dropdown {{(request()->is('users*') || request()->is('roles*') || request()->is('permissions*')) ? 'active' : ''}}">
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
    </li>
    <!-- // -->
    <li class="master-aside-menu-item {{ (request()->is('doptor/list')) ? 'active' : '' }}">
        <a href="{{'/doptor/list'}}">
            <i class="la la-users"></i> {{trans('labels.doptor')}}
        </a>
    </li>
    <!-- // -->
    <li class="master-aside-menu-item {{ (request()->is('module')) ? 'active' : '' }}">
        <a href="{{route('module.index')}}">
            <i class="la la-users"></i> {{trans('module.module')}}
        </a>
    </li>

</ul>
@endauth