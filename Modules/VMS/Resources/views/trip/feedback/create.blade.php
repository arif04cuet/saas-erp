@extends('vms::layouts.master')
@section('title', trans('vms::trip.title'))
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('labels.create') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        {!! Form::open(['route' =>  'vms.trip.feedback.store','class' => 'form']) !!}
                        @include('vms::trip.feedback.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <!-- Trip Information -->

                        <h4 class="form-section"><i class="la la-tag"></i>
                            @lang('vms::trip.details')
                        </h4>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>@lang('vms::trip.form_elements.requester_id')</th>
                                        <td>{{$trip->requester->getName() ?? trans('labels.not_found')}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('vms::trip.form_elements.no_of_passenger')</th>
                                        <td>@enToBnNumber($trip->no_of_passenger ?? 0)</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('vms::trip.form_elements.destination')</th>
                                        <td>{{$trip->destination ?? trans('labels.not_found')}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('vms::trip.form_elements.distance')</th>
                                        <td>{{$trip->distance ?? trans('labels.not_found')}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('vms::trip.form_elements.type')</th>
                                        <td>{{$trip->type ?? trans('labels.not_found')}}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="table">
                                    <tr>
                                        <th>@lang('vms::trip.form_elements.start_date_time')</th>
                                        <td>{{ $trip->start_date_time ?? trans('labels.not_found')}}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('vms::trip.form_elements.end_date_time')</th>
                                        <td>{{ $trip->end_date_time ?? trans('labels.not_found')}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')

    <!-- pickadate -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <!-- bootstrap date time picker -->
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <!-- custom -->
    <script>
        let startTime = @json($trip->start_date_time);
        let endTime = @json($trip->end_date_time);
        $(document).ready(function () {
            $('.actual-start-date-time').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                startDate: moment(startTime.date).format('YYYY-MM-DD hh:mm A'),
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss'
                }
            });
            $('.actual-end-date-time').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                startDate: moment(endTime.date).format('YYYY-MM-DD hh:mm A'),
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss'
                }
            });
        })
    </script>
@endpush
