<nav role="navigation" class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light ">

    <div class="navbar-wrapper">
        <button class="navbar-toggler" type="button" id="menuButton">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="brand-logo" alt="bard erp logo" src="{{ asset('images/logo.png') }}">
                        <h3 class="brand-text">
                            @php
                                $lang = App::getLocale();
                                if ($lang == 'bn') {
                                    echo 'পল্লী উন্নয়ন ও সমবায় বিভাগ';
                                } else {
                                    echo 'Rural Development and Cooperative Division';
                                }
                            @endphp
                        </h3>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-container content" style="margin-left: 260px;">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                {{-- <ul class="nav navbar-nav mr-auto float-left">

                   </ul> --}}
                <ul class="nav navbar-nav ml-auto">
                    <!-- Course Evaluation form -->
                    <li class="nav-item nav-link">
                        <br>
                        <a href="{{ route('courses.public.index') }}" class="btn btn-sm btn-round btn-outline-info">
                            @lang('tms::course.evaluation.title')</a>
                    </li>
                    <!-- Training Evaluation form -->
                    <li class="nav-item nav-link">
                        <br>
                        <a href="{{ route('trainings.public.index') }}" class="btn btn-sm btn-round btn-outline-info">
                            @lang('tms::training.evaluation.title')</a>
                    </li>

                    <!--  Physical Facility Request Link  -->
                    {{-- <li class="nav-item nav-link">
                        <br>
                        <a href="{{ route('physical-facility-requests.create') }}"
                           class="btn btn-sm btn-round btn-outline-info">
                            @lang('hm::booking-request.facility.title')</a>
                    </li> --}}

                    <li class="nav-item nav-link dropdown">
                        <br>
                        <a id="navbarDropdown" class="dropdown-toggle btn btn-sm btn-round btn-outline-info"
                            href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" v-pre>
                            @lang('hm::booking-request.booking_request') <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a href="{{ route('public-booking-requests.create') }}"
                                class="btn btn-sm btn-round btn-outline-info dropdown-item">
                                @lang('hm::booking-request.create_booking_request')
                            </a>
                            <a href="{{ route('booking-requests.check') }}"
                                class="btn btn-sm btn-round btn-outline-info dropdown-item">
                                @lang('hm::booking-request.cancel_booking_request')
                            </a>

                        </div>
                    </li>


                    <!-- Training Link -->
                    <li class="nav-item nav-link">
                        <br>
                        <a href="{{ route('training-registration.index') }}"
                            class="btn btn-sm btn-round btn-outline-info">
                            @lang('tms::training.registration_for_training')</a>

                    </li>

                    <!-- Training Link -->
                    {{-- <li class="nav-item nav-link">
                        <br>
                        <a href="{{route('public.circular')}}" class="btn btn-sm btn-round btn-outline-info">
                            @lang('hrm::circular.title')</a>

                    </li>
                    <li class="nav-item nav-link">
                        <br>
                        <a href="{{route('job-circulars.list')}}" class="btn btn-sm btn-round btn-outline-info">
                            @lang('hrm::circular.job_circular')</a>

                    </li> --}}
                    <?php
                    $curr = App::getLocale();
                    if (Session::has('locale')) {
                        $curr = Session::get('locale');
                    }
                    $key = $curr == 'bn' ? 'en' : 'bn';
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/lang/' . $key) }}" title="Switch language">
                            <strong>
                                <?php
                                if ($key == 'en') {
                                    echo 'English';
                                } else {
                                    echo 'বাংলা ';
                                }
                                ?>

                            </strong>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@push('page-js')
    <script>
        $("#menuButton").click(function() {
            $("#navbar-mobile").toggleClass("show");
        });
        $(document).mouseup(function(e) {
            var container = $("#navbar-mobile ul, #menuButton ");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $("#navbar-mobile").removeClass("show");
            }
        });
    </script>
@endpush
