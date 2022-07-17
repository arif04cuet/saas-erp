@extends('layouts.public')
@section('title', trans('hrm::circular.title'))

@section('content')
    <div class="content-header row">
        <div class="content-header-right col-md-6 col-12"></div>
    </div>
    <br>
    @forelse($jobCirculars as $jobCircular)
        <section id="card-footer-options">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title pl-1"><b>Circular - {{$loop->iteration}}</b></h4>
                                <h4 class="card-text pl-1"><b>{{$jobCircular->title}}</b></h4>
                            </div>
                            <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                <div class="card collapse-icon panel mb-0 box-shadow-0 border-0">
                                    <div id="heading-{{$loop->iteration}}" role="tab"
                                         class="card-header border-bottom-blue-grey border-bottom-lighten-4">
                                        <a data-toggle="collapse" data-parent="#accordionWrap1"
                                           href="#accordion-{{$loop->iteration}}"
                                           aria-expanded="false"
                                           aria-controls="accordion-{{$loop->iteration}}" class="btn btn-info">
                                            <i class="ft ft-arrow-down"></i>
                                            @lang('hrm::job-circular.detail')
                                        </a>
                                        <a class="btn btn-success white"
                                           href="{{route('job-applications.create-public', $jobCircular->id)}}">
                                            @lang('labels.apply')
                                        </a>
                                    </div>
                                    <div id="accordion-{{$loop->iteration}}" role="tabpanel"
                                         aria-labelledby="heading-{{$loop->iteration}}"
                                         class="collapse"
                                         aria-expanded="false">
                                        <div class="card-body">
                                            @include('hrm::job-circular.partial.common-view')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @empty
        <div class="text-center">
            <p class="bold text-primary">@lang('hrm::job-circular.no_circular')</p>
        </div>
    @endforelse
@endsection

@push('page-css')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/vendors/css/extensions/sweetalert.css')}}">
    <!-- END VENDOR CSS -->
@endpush

@push('page-js')


    <script src="{{asset('theme/vendors/js/scripts/cards/draggable.js')}}"></script>

    <script src="{{asset('theme/vendors/js/extensions/dragula.min.js')}}"></script>

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('theme/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('theme/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

@endpush
