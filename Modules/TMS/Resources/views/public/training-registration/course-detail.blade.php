@extends('layouts.public')
@section('title', trans('tms::training.training_list'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="course-detail-banner" style="margin:0px -80px">
                        <h2>Course Details</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="margin-top:-30px;">
                            <div class="course-item">
                                <h4><a href="#">১৪৩তম বিশেষ বুনিয়াদি প্রশিক্ষণ কোর্স</a></h4>
                                <div class="img-box">
                                    <img src="{{ asset('images/training/programm/item-1.png') }}">
                                </div>
                                <div class="course-time-area">
                                    <p class="course-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                    <p class="mb-0"><b>নিবন্ধকরণের সময়সীমা</b> : ১৩-০৪-২০২২</p>
                                    <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> : ২৬-০৪-২০২২</p>
                                    <p class="mb-0"><b>কোর্স শেষের তারিখ</b> : ৩০-০৪-২০২২</p>
                                    <p class="mb-0"><b>মোট নিবন্ধিত</b> : 200</p>
                                    <p class="mb-0"><b>মোট প্রশিক্ষক</b> : 5</p>
                                    <div class="course-enroll">
                                        <a href="#" class="btn btn-success btn-sm mt-1">Enroll Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="direction mt-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="course-purpose">
                                            <h2>প্রশিক্ষন কোর্সের উদ্দেশ্য</h2>
                                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="training-method">
                                            <h2>প্রশিক্ষন পদ্ধতি ও কৌশল</h2>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="training-rule">
                                            <h2>প্রশিক্ষনের নিয়মাবলী/ নির্দেশিকা</h2>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="training-module">
                                            <h2>মডিউল</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="latest-course-list mt-3">
                                <h2>সর্বশেষ কোর্স</h2>
                                <ul class="inner-container list-unstyled">
                                    <li class="item">
                                        <div class="img-box">
                                            <img src="{{ asset('images/training/programm/item-1.png') }}">
                                        </div>
                                        <div class="course-time-area">
                                            <h4 class="mt-2"><a href="#">১৪৩তম বিশেষ বুনিয়াদি প্রশিক্ষণ কোর্স</a></h4>
                                            <p class="course-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s <a href="#">বিস্তারিত...</a></p>
                                            <p class="mb-0"><b>মোট নিবন্ধিত</b> : 200</p>
                                            <p class="mb-0"><b>মোট প্রশিক্ষক</b> : 5</p>
                                            <div class="course-enroll">
                                                <a href="#" class="btn btn-success btn-sm mt-1">Enroll Now</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="img-box"><img src="{{ asset('images/training/programm/item-2.png') }}"></div>
                                        <div class="course-time-area">
                                            <h4 class="mt-2"><a href="#">কম্পিউটার ট্রেনিং কোর্স</a></h4>
                                            <p class="course-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s <a href="#">বিস্তারিত...</a></p></p>
                                            <p class="mb-0"><b>মোট নিবন্ধিত</b> : 200</p>
                                            <p class="mb-0"><b>মোট প্রশিক্ষক</b> : 5</p>
                                            <div class="course-enroll">
                                                <a href="#" class="btn btn-success btn-sm mt-1">Enroll Now</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="img-box"><img src="{{ asset('images/training/programm/item-2.png') }}"></div>
                                        <div class="course-time-area">
                                            <h4 class="mt-2"><a href="#">কম্পিউটার ট্রেনিং কোর্স</a></h4>
                                            <p class="course-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s <a href="#">বিস্তারিত...</a></p></p>
                                            <p class="mb-0"><b>মোট নিবন্ধিত</b> : 200</p>
                                            <p class="mb-0"><b>মোট প্রশিক্ষক</b> : 5</p>
                                            <div class="course-enroll">
                                                <a href="#" class="btn btn-success btn-sm mt-1">Enroll Now</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="img-box"><img src="{{ asset('images/training/programm/item-2.png') }}"></div>
                                        <div class="course-time-area">
                                            <h4 class="mt-2"><a href="#">কম্পিউটার ট্রেনিং কোর্স</a></h4>
                                            <p class="course-content">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s <a href="#">বিস্তারিত...</a></p></p>
                                            <p class="mb-0"><b>মোট নিবন্ধিত</b> : 200</p>
                                            <p class="mb-0"><b>মোট প্রশিক্ষক</b> : 5</p>
                                            <div class="course-enroll">
                                                <a href="#" class="btn btn-success btn-sm mt-1">Enroll Now</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="our-instructor">
                                {{-- <h2 class="text-center mb-1">Meet Our Qualified Teachers</h2> --}}
                                <h2 class="text-center mb-1">আমাদের যোগ্য শিক্ষকদের সাথে দেখা করুন</h2>
                                <div id="carouselExampleControls" class="instructor-carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @php
                                        // dd($instructors);
                                        // foreach($instructors as $key => $each){
                                        //     dd($each->employee);
                                        // }
                                        $instructor_data  = $instructors->toArray();
                                        // dd($instructors);
                                        $new_instructor_data = [];
                                        $total_items = ceil((count($instructor_data)/5));
                                        
                                        for($i=0; $i < $total_items; $i++){
                                            $new_instructor_data[$i] = [];
                                        }
                                        // dd($new_instructor_data);
                                        foreach ($instructor_data as $key => $row) 
                                        {
                                            $slug = true;
                                            foreach ($new_instructor_data as $key2 => $value) {
                                                if(count($value) < 5 && $slug){
                                                    $slug = false;
                                                    $new_instructor_data[$key2][] = $row;
                                                }
                                            }
                                        }
                                        // dd($new_instructor_data);
                                        @endphp
                                        {{-- @foreach($new_instructor_data as $key => $items) --}}
                                        {{-- {{ dd($items) }} --}}
                                        <div class="carousel-item active">
                                            <ul class="inner-container list-unstyled">
                                                @foreach($instructors as $key => $item)
                                                @php
                                                // $item = (object)$item;
                                                // dd($key);
                                                // dd($item->employee);
                                                    
                                                @endphp
                                                <li class="item" style="position: relative">
                                                    @if(empty($item->employee->photo))
                                                    <div class="img">
                                                        <img src="{{ asset('/images/default-profile-picture.png') }}">
                                                    </div>
                                                    @else
                                                    <div class="img">
                                                        <img src="{{ asset('/upload/employee-profile').'/'.$item->employee->photo }}">
                                                    </div>
                                                    @endif
                                                    <div class="instructor-des">
                                                        <p class="instructor-name mb-0">{{ $item->employee->getName() }}</p>
                                                        <p class="instructor-desig mb-0">{{ $item->employee->designation->getName() }}</p>
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
                                {{-- <ul class="inner-container list-unstyled">
                                    @foreach($instructors as $instructor)
                                    <li class="item">
                                        @if(empty($instructor->employee->photo))
                                        <div class="img">
                                            <img src="{{ asset('/images/default-profile-picture.png') }}">
                                        </div>
                                        @else
                                        <div class="img">
                                            <img src="{{ asset('/upload/employee-profile').'/'.$instructor->employee->photo }}">
                                        </div>
                                        @endif
                                        <div class="instructor-des">
                                            <p class="instructor-name mb-0">{{ $instructor->employee->getName() }}</p>
                                            <p class="instructor-desig mb-0">{{ $instructor->employee->designation->getName() }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
