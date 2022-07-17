@extends('layouts.front-app')
@section('content')
    <!------------ Home Gallery ---------------->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="home-message-content mt-2">
                    <h2 class="title mb-2">{{ trans('tms::static_content.training_center') }}...</h2>
                    <p class="mb-2">
                        {{-- দক্ষতা উন্নয়ন প্রশিক্ষণ কেন্দ্রে কারিগরি প্রশিক্ষণ নিন। বর্তমানে পড়াশোনার পাশাপাশি বিভিন্ন বিষয়ে
                        দক্ষতা অর্জনের কোন বিকল্প নাই। প্রতিযোগিতামূলক বিশ্বে টিকে থাকতে চাইলে চাই দক্ষতা
                        কম্পিউটার, প্রোগ্রামিং, মার্কেটিং, ডিজাইনিং ইত্যাদি কাজে অভিজ্ঞ হলে সারা বিশ্বে কর্ম মিলে। <br><br>
                        দেশের জনসাধারণকে দক্ষতা অর্জনের লক্ষ্যে ২০০৬ সাল হতে সমাজকল্যাণ মন্ত্রণালয়, সমাজসেবা অধিদফতরাধীন
                        দক্ষতা উন্নয়ন প্রশিক্ষণ কেন্দ্র, বেপাহাড়, চট্টগ্রাম খুবেই স্বল্প খরচে প্রশিক্ষণ প্রদান করে আসছে। --}}
                        {{ trans('tms::static_content.head_content_one') }} <br><br>{{ trans('tms::static_content.head_content_two') }}
                    </p>
                </div>
                <div class="block d-flex home-search mt-3">
                    {!! Form::open(['route' => ['search.course'], 'class' => 'landing-search-form w-100', 'method' => 'get']) !!}
                    <div class="input-group">
                        {!! Form::text('course_text', null, [
                            'class' => 'form-control mb-2 mr-sm-2 mb-sm-0 search-box',
                            'placeholder' => Lang::get('home.home_search'),
                            'required' => 'required',
                        ]) !!}
                        <button class="btn btn-main"><span><img src="images/training/search-icon.png"></span></button>
                        @if ($errors->has('course_text'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('course_text') }}</strong>
                            </span>
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-6 img-size">
                <div class="home-gallery d-flex mt-2 ml-2">
                    <img src="{{ asset('images/training/img-1.png') }}">
                </div>
            </div>
        </div>
    </div>
    <!----- Home Gallery End -->
    <!--------- Training Statistic ----------->
    <div class="training-statistic mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <ul class="statistic-list list-unstyled">
                        <li class="trainner">
                            <span class="trainner-count">{{ $allInstructor }}</span><br>
                            <span class="text"><a href="#" target="_blank"> 
                            {{trans('tms::training.experienced_trainer')}} 
                            </a></span>
                        </li>
                        <li class="total-online-course">
                            <span class="course-count">{{ $allOnlineCourse->count() }}</span><br>
                            <span class="text"><a target="_blank" href="{{ route('training-registration.index') }}">{{trans('tms::training.total_online_trainings')}}</a></span>
                        </li>
                        <li class="total-group-batch">
                            <span class="group-count">{{ $allOfflinecourses }}</span><br>
                            <span class="text"><a target="_blank" href="{{ route('offline.courses.public.view') }}">{{trans('tms::training.total_offline_trainings')}}</a></span>
                        </li>
                        <li class="total-registered-trainee">
                            <span class="trainee-count">{{ $allTrainee }}</span><br>
                            <span class="text"><a target="_blank" href="#">{{trans('tms::training.total_enroll_student')}}</a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--------- Training Statistic End----------->
    <!--------- Home Slider ----------->
    <div class="home-slider">
        <div class="container">
            <!--------- Main Slider ----------->
            <div class="row justify-content-center">
                <div class="col">
                    <div class="slider-message">
                        <h2>{{trans('tms::static_content.about_the_course')}}</h2>
                        <p>
                            {{trans('tms::static_content.about_course_one')}} <br>{{trans('tms::static_content.about_course_two')}}
                        </p>
                    </div>
                </div>
            </div>
            <!--------- Tab Slider ----------->
            <div class="row justify-content-center mt-4">
                <div class="col-md-3 col-sm-12">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($trainingCategories as $key => $category)
                            <a class="nav-link {{ $category->id == 1 ? 'active' : '' }}"
                                id="l-first-{{ $category->id }}-tab" data-toggle="pill"
                                href="#l-first-{{ $category->id }}" role="tab"
                                aria-controls="l-first-{{ $category->id }}"
                                aria-selected="true">{{ $category->name_bangla }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="slider-container">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($trainingCategories as $key => $category)
                                @php
                                    $categoryWiseTraining = App\Http\Controllers\HomeController::categoryWiseTraining($category);
                                @endphp

                                @php
                                    $category_data = $categoryWiseTraining->toArray();
                                    $new_sider_data = [];
                                    
                                    $total_items = ceil(count($category_data) / 3);
                                    
                                    for ($i = 0; $i < $total_items; $i++) {
                                        $new_sider_data[$i] = [];
                                    }
                                    
                                    foreach ($category_data as $key => $row) {
                                        $slug = true;
                                        foreach ($new_sider_data as $key2 => $value) {
                                            if (count($value) < 3 && $slug) {
                                                $slug = false;
                                                $new_sider_data[$key2][] = $row;
                                            }
                                        }
                                    }
                                @endphp

                                <div class="tab-pane fade show {{ $category->id == 1 ? 'active' : '' }}"
                                    id="l-first-{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="l-first-{{ $category->id }}-tab">

                                    <div id="carouselExampleIndicators{{ $key }}" class="carousel slide"
                                        data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators{{ $key }}"
                                                data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators{{ $key }}"
                                                data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators{{ $key }}"
                                                data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner inner-item-slider">
                                            @foreach ($new_sider_data as $key => $items)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <div class="row">
                                                        @foreach ($items as $item)
                                                            @php
                                                                $item = (object) $item;
                                                            @endphp
                                                            <div class="col-md-4">
                                                                <div class="each-item">
                                                                    <div class="single-item">
                                                                        @if (!isset($item->photo) || empty($item->photo))
                                                                            <img src="https://via.placeholder.com/150"
                                                                                class="d-block w-100" alt="...">
                                                                        @else
                                                                            <img src="{{ url('/file/get?filePath=' . $item->photo) }}"
                                                                                class="d-block w-100" alt="...">
                                                                        @endif
                                                                        <div class="slide-content">
                                                                            <h2>
                                                                                <a
                                                                                    href="{{ route('training-registration.index') }}">{{ $item->bangla_title }}</a>
                                                                            </h2>
                                                                            <p><b>নিবন্ধকরণের সময়সীমা</b> :
                                                                                {{ date('d-m-Y', strtotime($item->registration_deadline)) }}
                                                                            </p>
                                                                            <p><b>কোর্স শুরুর তারিখ</b> :
                                                                                {{ date('d-m-Y', strtotime($item->start_date)) }}
                                                                            </p>
                                                                            <p><b>কোর্স শেষের তারিখ</b> :
                                                                                {{ date('d-m-Y', strtotime($item->end_date)) }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-bottom">
                                                                        <div class="item">
                                                                            <img
                                                                                src="{{ asset('images/training/trainee-icon.png') }}">
                                                                            <span>মিনহাজ উদ্দিন</span>
                                                                        </div>
                                                                        <div class="item-right">
                                                                            <img
                                                                                src="{{ asset('images/training/class-icon.png') }}">
                                                                            <span>350</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- Home Slider End----------->
    <!--------- Star Online Course ----------->
    <div class="online-course mt-4 mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class="text-center mb-2">{{trans('labels.online_course')}}</h2>
                    <ul class="inner-container list-unstyled">
                        @foreach ($allOnlineCourse as $onlineCourse)
                            <li class="item">
                                <div class="img-box">
                                    @if (!isset($onlineCourse->photo) || empty($onlineCourse->photo))
                                        <img src="https://via.placeholder.com/150" class="d-block w-100" alt="...">
                                    @else
                                        <img src="{{ url('/file/get?filePath=' . $onlineCourse->photo) }}"
                                            class="d-block w-100" alt="...">
                                    @endif
                                </div>
                                <div class="course-time-area">
                                    <h4 class="mt-2"><a href="#">{{ $onlineCourse->getName() }}</a></h4>
                                    <p class="mb-0"><b>নিবন্ধকরণের সময়সীমা</b> :
                                        {{ date('d-m-Y', strtotime($onlineCourse->deadline)) }}</p>
                                    <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> :
                                        {{ date('d-m-Y', strtotime($onlineCourse->start_date)) }}</p>
                                    <p class="mb-0"><b>কোর্স শেষের তারিখ</b> :
                                        {{ date('d-m-Y', strtotime($onlineCourse->end_date)) }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--------- End Online Course ----------->
    <!--------- Specialize Programm ----------->
    <div class="specialized-program mt-4 mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class="specialized-program-heading text-center mb-2">{{trans('labels.specialized_programs')}}</h2>
                    <ul class="inner-container list-unstyled">
                        <li class="item">
                            <div class="img-box">
                                <img src="images/training\programm\item-1.png">
                            </div>
                            <div class="course-time-area">
                                <h4 class="mt-2">আমিনশীপ</h4>
                                <p class="mb-0"><b>নিবন্ধকরণের সময়সীমা</b> : ১৩-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> : ২৬-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শেষের তারিখ</b> : ৩০-০৪-২০২২</p>
                            </div>
                            <div class="item-bottom">
                                <div class="item">
                                    <img src="{{ asset('images/training/trainee-icon.png') }}">
                                    <span>মিনহাজ উদ্দিন</span>
                                </div>
                                <div class="item-right">
                                    <img src="{{ asset('images/training/class-icon.png') }}">
                                    <span>350</span>
                                </div>
                            </div>
                        </li>
                        <li class="item">
                            <div class="img-box"><img src="images/training\programm\item-2.png"></div>
                            <div class="course-time-area">
                                <h4 class="mt-2">আমিনশীপ</h4>
                                <p class="mb-0"><b>নিবন্ধকরণের সময়সীমা</b> : ১৩-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> : ২৬-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শেষের তারিখ</b> : ৩০-০৪-২০২২</p>
                            </div>
                            <div class="item-bottom">
                                <div class="item">
                                    <img src="{{ asset('images/training/trainee-icon.png') }}">
                                    <span>মিনহাজ উদ্দিন</span>
                                </div>
                                <div class="item-right">
                                    <img src="{{ asset('images/training/class-icon.png') }}">
                                    <span>350</span>
                                </div>
                            </div>
                        </li>
                        <li class="item">
                            <div class="img-box"><img src="images/training\programm\item-3.png"></div>
                            <div class="course-time-area">
                                <h4 class="mt-2">আমিনশীপ</h4>
                                <p class="mb-0"><b>নিবন্ধকরণের সময়সীমা</b> : ১৩-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> : ২৬-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শেষের তারিখ</b> : ৩০-০৪-২০২২</p>
                            </div>
                            <div class="item-bottom">
                                <div class="item">
                                    <img src="{{ asset('images/training/trainee-icon.png') }}">
                                    <span>মিনহাজ উদ্দিন</span>
                                </div>
                                <div class="item-right">
                                    <img src="{{ asset('images/training/class-icon.png') }}">
                                    <span>350</span>
                                </div>
                            </div>
                        </li>
                        <li class="item">
                            <div class="img-box"><img src="images/training\programm\item-4.png"></div>
                            <div class="course-time-area">
                                <h4 class="mt-2">আমিনশীপ</h4>
                                <p class="mb-0"><b>নিবন্ধকরণের সময়সীমা</b> : ১৩-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> : ২৬-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শেষের তারিখ</b> : ৩০-০৪-২০২২</p>
                            </div>
                            <div class="item-bottom">
                                <div class="item">
                                    <img src="{{ asset('images/training/trainee-icon.png') }}">
                                    <span>মিনহাজ উদ্দিন</span>
                                </div>
                                <div class="item-right">
                                    <img src="{{ asset('images/training/class-icon.png') }}">
                                    <span>350</span>
                                </div>
                            </div>
                        </li>
                        <li class="item">
                            <div class="img-box"><img src="images/training\programm\item-5.png"></div>
                            <div class="course-time-area">
                                <h4 class="mt-2">আমিনশীপ</h4>
                                <p class="mb-0"><b>নিবন্ধকরণের সময়সীমা</b> : ১৩-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> : ২৬-০৪-২০২২</p>
                                <p class="mb-0"><b>কোর্স শেষের তারিখ</b> : ৩০-০৪-২০২২</p>
                            </div>
                            <div class="item-bottom">
                                <div class="item">
                                    <img src="{{ asset('images/training/trainee-icon.png') }}">
                                    <span>মিনহাজ উদ্দিন</span>
                                </div>
                                <div class="item-right">
                                    <img src="{{ asset('images/training/class-icon.png') }}">
                                    <span>350</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--------- Our Instructor ----------->
    <div class="our-instructor mt-2 mb-2 pt-2 pb-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class="text-left mb-1">{{trans('labels.our_instructor')}}</h2>
                    <div id="carouselExampleControls" class="instructor-carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                // dd($instructors);
                                // foreach($instructors as $key => $each){
                                //     dd($each->employee);
                                // }
                                $instructor_data = $instructors->toArray();
                                // dd($instructors);
                                $new_instructor_data = [];
                                $total_items = ceil(count($instructor_data) / 5);
                                
                                for ($i = 0; $i < $total_items; $i++) {
                                    $new_instructor_data[$i] = [];
                                }
                                // dd($new_instructor_data);
                                foreach ($instructor_data as $key => $row) {
                                    $slug = true;
                                    foreach ($new_instructor_data as $key2 => $value) {
                                        if (count($value) < 5 && $slug) {
                                            $slug = false;
                                            $new_instructor_data[$key2][] = $row;
                                        }
                                    }
                                }
                                // dd($new_instructor_data);
                            @endphp
                            {{-- @foreach ($new_instructor_data as $key => $items) --}}
                            {{-- {{ dd($items) }} --}}
                            <div class="carousel-item active">
                                <ul class="inner-container list-unstyled">
                                    @foreach ($instructors as $key => $item)
                                        @php
                                            // $item = (object)$item;
                                            // dd($key);
                                            // dd($item->employee);
                                        @endphp
                                        <li class="item" style="position: relative">
                                            @if (empty($item->employee->photo))
                                                <div class="img">
                                                    <img src="{{ asset('/images/default-profile-picture.png') }}">
                                                </div>
                                            @else
                                                <div class="img">
                                                    <img
                                                        src="{{ asset('/upload/employee-profile') . '/' . $item->employee?->photo }}">
                                                </div>
                                            @endif
                                            <div class="instructor-des">
                                                <p class="instructor-name mb-0">{{ $item->employee?->getName() }}</p>
                                                <p class="instructor-desig mb-0">
                                                    {{ $item->employee?->designation->getName() }}</p>
                                            </div>
                                            <div class="hover-social position-absolute">
                                                <a href="#"><span><i class="la la-facebook"></i></span></a>
                                                <a href="#"><span><i class="la la-twitter"></i></span></a>
                                                <a href="#"><span><i class="la la-linkedin"></i></span></a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            {{-- @endforeach --}}
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- News Letter ----------->
    <div class="container">
        <div class="home-newsletter-container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h4 class="heading text-center">{{trans('labels.subcribe_form_title')}}</h4>
                    <p class="subscriber-meg text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus
                        felis, nibh suspnisl. Massa mauris est consequat at nunc, lobortis mauris et magna. </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="home-newsletter">
                        <div class="single">
                            {!! Form::open(['route' => ['email.create'], 'class' => ' news-letter-form', 'novalidate', 'method' => 'post']) !!}
                            <div class="input-group">
                                {!! Form::email('email', null, [
                                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                    'data-msg-required' => Lang::get('labels.This field is required'),
                                    'placeholder' => 'john@example.com',
                                    'data-rule-maxlength' => 50,
                                    'data-msg-maxlength' => Lang::get('labels.At least 50 characters'),
                                    'data-msg-email' => trans('labels.Please enter a valid email address'),
                                    'required' => 'required',
                                ]) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-theme" type="submit">Send</button>
                                </span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- Footer Container ----------->
    {{-- @include('layouts.public.footer') --}}
    <!--------- Footer Container End----------->
    <script>
        window.onload = function() {
            $('#carouselExampleIndicators01').carousel(),
                $('.instructor-carousel').carousel()
        }
    </script>
@endsection

@stack('page-js')
