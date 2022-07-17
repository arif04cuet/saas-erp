<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@lang('labels.bard_hostel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/animate.css') }}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/icomoon.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/bootstrap.css') }}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/magnific-popup.css') }}">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/flexslider.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/owl.theme.default.min.css') }}">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/bootstrap-datepicker.css') }}">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/fonts/flaticon/font/flaticon.css') }}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('hostel-resources/css/style.css') }}">

    <!-- Modernizr JS -->
    <script src="{{ asset('hostel-resources/js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{ asset('hostel-resources/js/respond.min.js')  }}"></script>
    <![endif]-->

    <style type="text/css">
        a.booking-request-btn {
            position: relative;
            display: inline-block;
            padding: 1.2em 2em;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            color: white;
            font-size: 18px;
        }
        a.booking-request-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border-radius: 4px;
            transition: box-shadow 0.5s ease, -webkit-transform 0.2s ease;
            transition: box-shadow 0.5s ease, transform 0.2s ease;
            transition: box-shadow 0.5s ease, transform 0.2s ease, -webkit-transform 0.2s ease;
            will-change: transform;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        a.booking-request-btn:hover::before {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        a.booking-request-btn::after {
            position: relative;
            display: inline-block;
            content: attr(data-title);
            transition: -webkit-transform 0.2s ease;
            transition: transform 0.2s ease;
            transition: transform 0.2s ease, -webkit-transform 0.2s ease;
            font-weight: bold;
            letter-spacing: 0.01em;
            will-change: transform;
        }
    </style>
</head>
<body>

<div class="colorlib-loader"></div>

<div id="page">
    {{--<nav class="colorlib-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="colorlib-logo"><a href="index.html">Luxehotel</a></div>
                    </div>
                </div>
            </div>
        </div>
    </nav>--}}
    <aside id="colorlib-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url({{ asset('hostel-resources/images/DSC_0092.JPG') }});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                                <div class="slider-text-inner text-center">
                                    <p><a class="booking-request-btn" href="{{ route('public-booking-requests.create') }}" data-title="{{ __('hm::booking-request.create_booking_request') }}"></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ url('hostel-resources/images/DSC_0098.JPG') }});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                                <div class="slider-text-inner text-center">
                                    <p><a class="booking-request-btn" href="{{ route('public-booking-requests.create') }}" data-title="{{ __('hm::booking-request.create_booking_request') }}"></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ url('hostel-resources/images/DSC_0113.JPG') }});">
                    <div class="overlay"></div>
                    <div class="container-fluids">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                                <div class="slider-text-inner text-center">
                                    <p><a class="booking-request-btn" href="{{ route('public-booking-requests.create') }}" data-title="{{ __('hm::booking-request.create_booking_request') }}"></a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ url('hostel-resources/images/DSC_0109.JPG') }});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                                <div class="slider-text-inner text-center">
                                    <p><a class="booking-request-btn" href="{{ route('public-booking-requests.create') }}" data-title="{{ __('hm::booking-request.create_booking_request') }}"></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

    <div id="colorlib-testimony" class="colorlib-light-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
                    <span><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i></span>
                    <h2>মহাপরিচালকের বার্তা</h2>
                    <p style="font-size: 17px;">বাংলাদেশ পল্লী উন্নয়ন একাডেমী (বার্ড) পল্লী উন্নয়নের ক্ষেত্রে অনবদ্য অবদানের জন্য আর্ন্তজাতিকভাবে প্রশংসিত। বার্ড উদ্ভাবিত পল্লী উন্নয়নে কুমিল্লা পদ্ধতি সমন্বিত উন্নয়নের একটি প্যাকেজ কর্মসূচি যা পল্লী এলাকা এবং পল্লীর দরিদ্র জনগণের জীবনমান উন্নয়নে ব্যাপক অবদান রেখেছে। ২৭ মে ২০০৯ তারিখে বার্ড তার সুবর্ণ জয়ন্তী উদযাপন করে। প্রশিক্ষণ, গবেষণা এবং প্রায়োগিক গবেষণায় বার্ডের সুদীর্ঘ ৫৭ বছরের অভিজ্ঞতা পল্লী উন্নয়নে সম্পৃক্ত ও আগ্রহী সকল প্রতিষ্ঠান, দেশ  ও মানুষের  কাছে পৌঁছিয়ে দেয়ার জন্য তথ্য প্রযুক্তির বিকল্প নেই। ওয়েবসাইটটি বার্ডের অভিজ্ঞতা ও চলমান কার্যক্রমের তথ্যাদি তাৎক্ষণিকভাবে বিশ্ব সম্প্রদায়ের কাছে পৌঁছানের কাজটি সহজতর করবে বলে আমরা বিশ্বাস করি। এই ওয়েবসাইটে আপনাদের স্বাগত জানাই এবং এটিকে আরও সমৃদ্ধ করা এবং সবসময় হালনাগাদ রাখার জন্য আমরা প্রতিশ্রুতিবদ্ধ। কোন বিষয় সম্পর্কে আরও বিস্তারিত জানার জন্য আমাদের সাথে দয়া করে যোগাযোগ করুন।</p>
                </div>
            </div>
        </div>
    </div>

    <div id="colorlib-rooms" class="colorlib-light-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
                    <span><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i></span>
                    <h2>রুম বিস্তারিত</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 animate-box">
                    <div class="owl-carousel owl-carousel2">
                        <div class="item">
                            <div class="desc text-center">
                                <h3>এসি অভিজাত</h3><br>
                                <ul>
                                    <li><i class="icon-check"></i> সাধারণ হার 546.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> সরকারের হার 507.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বার্ড কর্মী হার 453.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বিশেষ হার 412.00 টাকা প্রতি রাতে</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item">
                            <div class="desc text-center">
                                <h3>এসি শোভন</h3><br>
                                <ul>
                                    <li><i class="icon-check"></i> সাধারণ হার 1183.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> সরকারের হার 867.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বার্ড কর্মী হার 728.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বিশেষ হার 205.00 টাকা প্রতি রাতে</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item">
                            <div class="desc text-center">
                                <h3>শোভন</h3><br>
                                <ul>
                                    <li><i class="icon-check"></i> সাধারণ হার 676.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> সরকারের হার 607.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বার্ড কর্মী হার 731.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বিশেষ হার 138.00 টাকা প্রতি রাতে</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item">
                            <div class="desc text-center">
                                <h3>সাধারণ</h3><br>
                                <ul>
                                    <li><i class="icon-check"></i> সাধারণ হার 703.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> সরকারের হার 536.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বার্ড কর্মী হার 422.00 টাকা প্রতি রাতে</li>
                                    <li><i class="icon-check"></i> বিশেষ হার 704.00 টাকা প্রতি রাতে</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="colorlib-dining-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
                    <span><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i><i class="icon-star-full"></i></span>
                    <h2>Terms &amp; Conditions</h2>
                </div>
            </div>
            <div class="row">
                <ol>
                    <li>Only members of BCS (Administration) Cadre who are posted outside Dhaka Metropolitan area and their spouse, father, mother, daughter, son, father-in-law and mother-in-law can stay in BARD hostel for certain period. Others will have to take prior permission from BARD.</li>
                    <li>An entitled officer can stay in BARD hostel up to 10 (ten) days within consecutive two months period at regular room rent. If needed, a boarder can stay for another 07 (seven) days within these two months period and in this case, rent will be double if the reason for staying is personal. In case of official reason, the rent will remain regular and hence, the memo number of concerned office order (along with its date) is to be submitted.</li>
                    <li>The booking money has to be deposited through online payment gateway while booking online which is non-refundable if it is cancelled by the applicant.</li>
                    <li>Any eligible member can book seats maximum 7 days before the expected date of arrival and for maximum two rooms at a time.</li>
                    <li>Check-in time is from 12 noon and check-out time is by 12 noon. In case of not checking-in on the booked date, that allocation will be considered as cancelled and that seat will become vacant for new booking from the next day.</li>
                    <li>VIP rooms will be kept reserved for the Deputy Commissioners and above ranking Officers. Priority will be determined on the basis of seniority. Others will have to take prior permission from BARD.</li>
                    <li>Boarders of opposite genders are not permitted to enter each other’s room. If urgently needed, they may meet in the waiting lounge at the reception or canteen instead.</li>
                    <li>Cooking is strictly prohibited inside any rented room. Boarders can purchase meal from BARD canteen. Order for food / meal can be placed both online and at the reception within the stipulated time as mentioned below. Coupon may be purchased from the reception in this regard.</li>
                    <li>Room service is not available.</li>
                    <li>While leaving, key of the room should be handed over to the reception. Compensation of Tk. 200/- will be charged if it is lost.</li>
                    <li>Use of ceiling fans solely for drying up wet clothes, use of flatiron, electric oven or heater or similar types of electronic equipment inside the room is prohibited.</li>
                    <li>Nailing or spitting on the floor or wall is prohibited. No waste material or trash should be thrown out of the window.</li>
                    <li>Before leaving the room, it should be ensured that the lights, fans and geyser are switched off and water taps are turned off.</li>
                    <li>Laundry service is available (Ext. 232).</li>
                    <li>The main gate of the hostel will be closed at 11 pm during the summer (March to September) and at 10.30 pm during winter (October to February). It will be opened at 6 am.</li>
                    <li>This hostel is considered as non-smoking zone and consumption of any kind of intoxicating material is strictly prohibited.</li>
                    <li>The highest endeavor for cleanliness of the room will be appreciated.</li>
                    <li>The beddings and furniture cannot be rearranged by the boarders.</li>
                    <li>If any item that is the soul property of the hostel is lost or damaged by the guest, then he/she will have to compensate according to the rate fixed by the authority.</li>
                    <li>Presently there is no provision of accommodation for the drivers, orderlies, bodyguards or personal attendants in the hostel.</li>
                    <li>Tips are not allowed. If anybody is willing to pay any tips, it may be dropped in the “marked Box” at the reception room.</li>
                    <li>Making any kind of loud noise or creating public nuisance in the hostel is strictly prohibited.</li>
                    <li>If any problem arises regarding electricity or water supply, then that can be noted down in the complaint register which is kept on the reception table. If urgent, it should be reported to the duty staff noting the time of reporting.</li>
                    <li>For any kind of inconvenience, it may be informed to the housekeeper (Ext.240, cell-01726627110) or the receptionist (Ext.120, phone : 9333014) for its remedy.</li>
                    <li>Booking may be cancelled due to violation of instructions stated above or providing with wrong information for hostel room booking.</li>
                    <li>Director General of BARD reserves the right to exercise his discretionary power in allocating hostel-room of BARD.</li>
                </ol>
            </div>
        </div>
    </div>


    <footer id="colorlib-footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2"
                                                                                     href="http://www.bard.gov.bd/"
                                                                                     target="_blank">BARD</a>, All rights reserved. </span>
                        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">@lang('labels.bangladesh_govt')</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>

<!-- jQuery -->
<script src="{{ asset('hostel-resources/js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('hostel-resources/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('hostel-resources/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('hostel-resources/js/jquery.waypoints.min.js') }}"></script>
<!-- Flexslider -->
<script src="{{ asset('hostel-resources/js/jquery.flexslider-min.js') }}"></script>
<!-- Owl carousel -->
<script src="{{ asset('hostel-resources/js/owl.carousel.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('hostel-resources/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('hostel-resources/js/magnific-popup-options.js') }}"></script>
<!-- Date Picker -->
<script src="{{ asset('hostel-resources/js/bootstrap-datepicker.js') }}"></script>
<!-- Main -->
<script src="{{ asset('hostel-resources/js/main.js') }}"></script>
</body>
</html>

