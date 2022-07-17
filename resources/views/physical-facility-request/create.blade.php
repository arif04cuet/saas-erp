@extends('layouts.public')
@section('title', trans('hm::booking-request.title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert bg-success alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span style="color: black">{!! session('success') !!}</span>&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('physical-facility-requests.create') }}"
                           class="btn btn-round btn-info"><b>
                               + @lang('hm::booking-request.facility.title')</b>
                        </a>

                    </div>
                @else
                <!-- Form wizard with number tabs section start -->
                    <section id="number-tabs">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{ trans('hm::booking-request.facility.form')}}</h4>
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
                                            @include('physical-facility-request.form')
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
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/wizard-steps.js') }}"></script>
    @include('physical-facility-request.javascript')
    <script src="{{ asset('js/physical-facility-request/step.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/physical-facility-request/page.js') }}"></script>
@endpush

