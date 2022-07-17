@extends('layouts.front-app')
@section('title', trans('tms::training.training_list'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header course-list-title">
                            <h2 class="card-title text-center">{{ trans('tms::course.offline_course_list') }}</h2>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="course-list-page">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <ul class="inner-container list-unstyled">
                                                @foreach ($courses as $course)
                                                    <li class="item">
                                                        <div class="img-box">
                                                            @if (!isset($course->photo) || empty($course->photo))
                                                                <img src="https://via.placeholder.com/150"
                                                                    class="img-fluid img-responsive">
                                                            @else
                                                                <img src="{{ url('/file/get?filePath=' . $course->photo) }}"
                                                                    class="img-fluid img-responsive">
                                                            @endif
                                                        </div>
                                                        <div class="course-time-area">
                                                            <h4 class="mt-2"><a
                                                                    href="#">{{ $course->getName() }}</a>
                                                            </h4>
                                                            <p class="mb-0"><b>Start Date</b> :
                                                                {{ date('d-m-Y', strtotime($course->start_date)) }}
                                                            </p>
                                                            <p class="mb-0"><b>End Date</b> :
                                                                {{ date('d-m-Y', strtotime($course->end_date)) }}
                                                            </p>
                                                            {{-- <div class="course-enroll">
                                                                <a href="#"
                                                                    class="btn btn-success btn-sm mt-1">@lang('tms::training.enroll')</a>
                                                            </div> --}}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination float-right">
                                                    <li class="page-item"><a class="page-link"
                                                            href="#">Previous</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------- Specialize Programm ----------->
        <div class="specialized-program mt-4 mb-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2 class="specialized-program-heading text-center mb-2">বিশেষায়িত প্রোগ্রাম</h2>
                        <ul class="inner-container list-unstyled">
                            <li class="item">
                                <div class="img-box">
                                    <img src="{{ asset('images/training/programm/item-1.png') }}">
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
                                <div class="img-box"><img src="{{ asset('images/training/programm/item-2.png') }}">
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
                                <div class="img-box"><img
                                        src="{{ asset('images/training/programm/item-3.png') }}"></div>
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
                                <div class="img-box"><img
                                        src="{{ asset('images/training/programm/item-4.png') }}"></div>
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
                                <div class="img-box"><img
                                        src="{{ asset('images/training/programm/item-5.png') }}"></div>
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
    </section>
@endsection
