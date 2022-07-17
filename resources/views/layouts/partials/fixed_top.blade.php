<nav role="navigation"
     class="header-navbar navbar-expand-sm navbar navbar-with-menu fixed-top navbar-light navbar-shadow navbar-border not-print">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                        class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="brand-logo" alt="bard erp logo" src="{{ asset('images/logo.png') }}">
                        {{-- <h3 class="brand-text">{{ $doptorName }}</h3> --}}
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    {{-- <li class="nav-item d-none d-md-block">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a>
                    </li> --}}
                </ul>
                <ul class="nav navbar-nav float-right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('labels.login') }}</a>
                        </li>
                    @else
                        @include('layouts.partials.notification')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                   href="{{route('change.password')}}">{{ trans('labels.change_password') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ trans('labels.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <?php
                    $curr = App::getLocale();
                    if (Session::has('locale')) {
                        $curr = Session::get('locale');
                    }
                    $key = $curr == 'bn' ? 'en' : 'bn';
                    ?>
                    <li class="nav-item"><a class="nav-link" href="{{url('/lang/'.$key)}}"
                                title="Switch language"><strong>
                                <?php
                                if ($key == 'en') {
                                    echo 'English';
                                } else {
                                    echo 'বাংলা ';
                                }
                                ?>

                            </strong></a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a><app-switcher></app-switcher></a>
                        </li>

                        @impersonating($guard = null)
                        <li class="nav-item bg-danger">
                            <a class=" nav-link" href="{{ route('impersonate.leave') }}">Leave impersonation</a>
                        </li>
                            
                        @endImpersonating
                       
                </ul>
            </div>
        </div>
    </div>
</nav>
