@extends('layouts.public')
@section('title', trans('hrm::circular.title'))

@section('content')
    @forelse($publicCirculars as $circular)
        <section id="card-footer-options">
            <div class="row">
                <div class="col-sm-12 col-md-6">

                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title">Circular - {{$loop->iteration}}</h4>
                                    </div>
                                    <div class="col-md-6"><h5>@lang('hrm::circular.published'): {{ date('d F, Y', strtotime($circular->created_at))}}</h5></div>
                                </div>
                                <p class="card-text">{{$circular->title}}</p>
                            </div>
                            <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                <div class="card collapse-icon panel mb-0 box-shadow-0 border-0">
                                    <div id="heading-{{$loop->iteration}}" role="tab"
                                         class="card-header border-bottom-blue-grey border-bottom-lighten-4">
                                        <a data-toggle="collapse" data-parent="#accordionWrap1"
                                           href="#accordion-{{$loop->iteration}}"
                                           aria-expanded="false"
                                           aria-controls="accordion-{{$loop->iteration}}" class="h6 blue">Circular
                                            Detail</a>
                                    </div>
                                    <div id="accordion-{{$loop->iteration}}" role="tabpanel"
                                         aria-labelledby="heading-{{$loop->iteration}}"
                                         class="collapse"
                                         aria-expanded="false">
                                        <div class="card-body">
                                            <p class="card-text">{!! $circular->details !!}</p>
                                            @if(!empty($circular->attachment))
                                                <hr>
                                                <div class="card-text">
                                                    <h5 class="font-weight-800 mb-1">@lang('labels.attachments'):</h5>
                                                    <a href="{{ route('circularAttachment.download', $circular->attachment->id) }}">{!! $circular->attachment->file_name  !!}</a>
                                                </div>
                                            @endif
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
            <p class="bold text-primary"> No Circular Found </p>
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