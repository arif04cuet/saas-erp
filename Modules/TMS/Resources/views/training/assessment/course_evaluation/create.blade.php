@extends('layouts.public')
@section('title', trans('tms::training.evaluation.general_info_title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            @if (session('success'))
                    <div class="alert bg-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span style="color: black">{!! session('success') !!}</span>
                        <a href="{{ route('public-booking-requests.create') }}" class="btn btn-amber btn-accent-4" style="color: white"><b>@lang('hm::booking-request.create_booking_request')</b></a>

                    </div>
                @else
                <!-- Form wizard with number tabs section start -->
                    <section id="number-tabs">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                        {!! Form::open(['route' =>  'public.courses.evaluations.store', 'class' => 'booking-request-tab-steps wizard-circle', 'enctype' => 'multipart/form-data']) !!}
                                        @php
                                            // $page variable is used in step-1, step-2, step-3, step-4
                                            $page = 'create'
                                        @endphp
                                        <!-- Step 1 -->
                                        @include('tms::training.assessment.course_evaluation.partials.form.step-1')
                                        <!-- Step 2 -->
                                        @include('tms::training.assessment.course_evaluation.partials.form.step-2')
                                        <!-- Step 3 -->
                                        @include('tms::training.assessment.course_evaluation.partials.form.step-3')
                                        <!-- Step 4 -->
                                        @include('tms::training.assessment.course_evaluation.partials.form.step-4')
                                        <!-- Step 5 -->
                                        @include('tms::training.assessment.course_evaluation.partials.form.step-5')
                                        <!-- Step 6 -->
                                        @include('tms::training.assessment.course_evaluation.partials.form.step-6')
                                        {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Form wizard with number tabs section end -->
                @endif
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/wizard.css') }}">

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/wizard-steps.js') }}"></script>
    @include('tms::training.assessment.course_evaluation.partials.javascript')
    <script src="{{ asset('js/course_evaluation/step.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/booking-request/page.js') }}"></script>
@endpush
