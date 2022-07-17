@extends('tms::layouts.master')
@section('title', trans('tms::training.training_list'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card online-course-list">
                        <div class="card-header">
                            <h4 class="card-title"><i class="la la-list black"></i> {{trans('tms::training.course.list')}}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('training.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{trans('tms::training.training_create')}}</a>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="course-list-page">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                  <a class="nav-link active" id="continue-course-tab" data-toggle="pill" href="#continue-course" role="tab" aria-controls="continue-course" aria-selected="true">
                                                    <i class="la la-list"></i> {{ trans('tms::training.status.running') }}
                                                  </a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <a class="nav-link" id="in-coming-course-tab" data-toggle="pill" href="#in-coming-course" role="tab" aria-controls="in-coming-course" aria-selected="false"><i class="la la-list"></i> {{ trans('tms::training.status.upcoming') }}</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="la la-list"></i> {{ trans('tms::training.status.completed') }}</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="la la-list"></i> {{ trans('tms::training.status.draft') }}</a>
                                                </li>
                                              </ul>
                                              <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="continue-course" role="tabpanel" aria-labelledby="continue-course-tab">
                                                    <ul class="inner-container list-unstyled">
                                                        @foreach($courses as $course)
                                                        <li class="item">
                                                            <div class="course-modify">
                                                                <a href="#"><i class="la la-pen"></i></a>
                                                                <a href="#"><i class="la la-cog"></i></a>
                                                            </div>
                                                            <div class="img-box">
                                                                @if(!isset($course->photo) || empty($course->photo))
                                                                <img src="https://via.placeholder.com/150">
                                                                @else
                                                                <img src="{{ url("/file/get?filePath=" .  $course->photo) }}">
                                                                @endif
                                                            </div>
                                                            <div class="course-time-area">
                                                                <h4 class="mt-2"><a href="{{ route('trainings.courses.show', [$course->training->id, $course->id]) }}">
                                                                    {{ $course->getName()}}
                                                                </a></h4>
                                                                <p class="course-content">আমরা বাংলায় ওয়েব ডেডলপমেন্ট নিয়ে কাজ করতে গিয়ে প্রথম যে সমস্যাটার মুখোমুখি হই </p>
                                                                <p class="mb-0"><b>কোর্স শুর“র তারিখ</b> : {{ date('d-m-Y',strtotime($course->start_date)) }}</p>
                                                                <p class="mb-0"><b>কোর্স শেষের তারিখ</b> : {{ date('d-m-Y',strtotime($course->end_date)) }}</p>
                                                                <br>
                                                            </div>
                                                            <div class="course-icon-nav pl-0">
                                                                <a href="#"><i class="la la-school"></i></a>
                                                                <a href="#"><i class="la la-money-check-alt"></i></a>
                                                                <a href="#"><i class="la la-user-edit"></i></a>
                                                                <a href="#"><i class="la la-edit"></i></a>
                                                                <a href="#"><i class="la la-envelope"></i></a>
                                                                <a href="#" class="payment-status">Free</a>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="tab-pane fade" id="in-coming-course" role="tabpanel" aria-labelledby="in-coming-course-tab">...</div>
                                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                                              </div>
                                        </div>
                                        {{-- <div class="col-md-12">
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script>
        function getMomentDates(dateRange) {
            let dateFormat = 'DD/MM/YYYY';
            let [startDate, endDate] = dateRange.split('-');
            startDate = moment(startDate.trim(), dateFormat);
            endDate = moment(endDate.trim(), dateFormat);
            return {startDate, endDate};
        }

        $(document).ready(function () {
            let categoryFilterElementId = 'filter-category';
            let statusFilterElementId = 'filter-status';
            let dateFilterElementId = 'filter-date';

            let table = $('.training-table').dataTable({});

            
        });
    </script>
@endpush
