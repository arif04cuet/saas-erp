<div class="master-nav p-0">
   <div class="master-nav position-absolute">
      <div class="master-company">
         <div class="d-flex justtify-content-center align-items-center">
         <a href="{{route('dashboard')}}" class="brand">
            <img src="{{asset('images/logo_.png')}}" alt="" />
         </a>
         <div class="ml-1 text-info">{{ $doptorName}}</div>
         </div>
      </div>
      <!-- // -->
      <div class="master-quick-actions">
         <div>
         <span class="aside-toggle"><i class="las la-bars"></i></span>
         </div>
         <ul>
            <!-- // -->
            @guest
               <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('labels.login') }}</a>
               </li>
            @else

            @include('layouts.partials.master_notification')

            <!-- // -->
            <li>
               <div class="dropdown" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false" >
                  <img src="{{asset('images/default-profile-picture.png')}}"  alt="">
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" >

                     <a class="dropdown-item" href="{{$myProfileUrl}}">
                        <i class="las la-user-circle black"></i> {{ Auth::user()->name }}
                     </a>

                     <hr class="m-0 p-0">

                     <a href="{{route('change.password')}}" class="dropdown-item" onclick="window.location.href=`{{route('change.password')}}`" style="margin-top: 6px;"> 
                        <i class="las la-key"></i> {{ trans('labels.change_password') }}
                     </a>
                     
                     <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                        <i class="las la-sign-out-alt"></i> {{ trans('labels.logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                     </form>
                  </div>
               </div>
            </li>

            @endguest
            <li>
               @php $curr = App::getLocale(); if(Session::has('locale')) $curr = Session::get('locale'); $key = $curr == 'bn' ? 'en' : 'bn'; @endphp
               <a href="{{url('/lang/'.$key)}}" title="{{($key == 'en' ? 'English' : 'বাংলা')}}">
                  <img class="rounded-circle" src="{{asset($key == 'en' ? 'images/en.webp' : 'images/bn.webp')}}"  alt="">
               </a>
            </li>

            <!-- // -->
            @auth
            
            <li><app-switcher></app-switcher></li>
            @endauth
         </ul>
      </div>
   </div>
</div>