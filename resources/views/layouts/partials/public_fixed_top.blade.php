<nav role="navigation" class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light ">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="brand-logo" alt="bard erp logo" src="{{ asset('images/logo.png') }}">
                        {{-- @php 
                            $lang = App::getLocale();
                        @endphp
                        @if ($lang == 'bn')
                        <div class="brand-text">
                            <span class="rdcd">পল্লী উন্নয়ন ও সমবায় বিভাগ</span>
                            <span class="isdp">ইন্টিগ্রেটেড সার্ভিস ডেলিভারি প্ল্যাটফর্ম</span>
                        </div>
                        @else
                        <div class="brand-text">
                            <span class="rdcd">Rural Development and Cooperative Division</span>
                            <span class="isdp">Integrated service delivery platform</span>
                        </div>
                        @endif --}}
                    </a>
                </li>
            </ul>
        </div>
        @auth
            {{auth()->user()->id}}
        @endauth
        {{-- <div class="navbar-container content"> --}}
        <button class="navbar-toggler" type="button" id="menuButton">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav lang ml-auto">
                <li class="nav-item nav-link">
                    <a href="#">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="background: transparent;padding:7px 12px;">Sign Up</button>
                    </a>
                </li>
                <li class="nav-item nav-link">
                    {{-- <br> --}}
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-info loginbtn d-flex">
                        <span class="loginicon"><i class="la la-user rounded-left"></i></span>
                        <span class="logintext rounded-right">{{ trans('labels.login') }}</span>
                    </a>
                </li>
                <?php
                $curr = App::getLocale();
                if (Session::has('locale')) {
                    $curr = Session::get('locale');
                }
                $key = $curr == 'bn' ? 'en' : 'bn';
                ?>
                <li class="nav-item nav-link">
                    <div class="d-lg-block dropdown">
                        <a class="nav-link dropdown-toggle drop-lang" href="#" id="navbarDropdownMenuLink78"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="la la-language"></i></span>
                            <?php
                            if ($key == 'en') {
                                echo 'বাংলা';
                            } else {
                                echo 'English';
                            }
                            ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink78">
                            @if ($key == 'en')
                                <a class="dropdown-item" href="{{ url('/lang/' . 'en') }}"
                                    title="Switch language"><span class="flag-icon flag-icon-us"></span>
                                    <?php
                                    echo 'English';
                                    ?>
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ url('/lang/' . 'bn') }}"
                                    title="Switch language"><span class="flag-icon flag-icon-us"></span>
                                    <?php
                                    echo 'বাংলা';
                                    ?>
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        {{-- </div> --}}
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
