@extends('vms::layouts.master')

@section('title', trans('vms::trip.title'))

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h1>@lang('vms::trip.bill.title')</h1>
            </div>
        </div>
        <div class="card-content ">
            <div class="card-body">
                <!-- trip details -->
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
                                <th>@lang('vms::trip.form_elements.billed_to')</th>
                                <td>{{$trip->billedTo->getName() ?? trans('labels.not_found')}}</td>
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
                                <td>{{ trans('vms::trip.distance.'.$trip->distance) ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.type')</th>
                                <td>
                                    {{trans('vms::trip.type.'.$trip->type) ?? trans('labels.not_found')}}
                                    @if($trip->type == $tripTypes['training'])
                                        ({{$trip->training->title ?? trans('labels.not_found')}})
                                    @endif
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th>@lang('vms::trip.form_elements.start_date_time')</th>
                                <td>{{ $trip->start_date_time->format('d F,Y g:i A') ?? trans('labels.not_found')}}</td>
                            </tr>
                            <tr>
                                <th>@lang('vms::trip.form_elements.end_date_time')</th>
                                <td>{{ $trip->end_date_time->format('d F,Y g:i A') ?? trans('labels.not_found')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Feedback -->
                @if($trip->is_feedback_given)
                    <h4 class="form-section"><i class="la la-tag"></i>
                        @lang('vms::trip.feedback.title')
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <th>@lang('vms::trip.feedback.form_elements.actual_start_date_time')</th>
                                    <td>{{ $trip->actual_start_date_time->format('d F,Y g:i A') ?? trans('labels.not_found')}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('vms::trip.feedback.form_elements.actual_end_date_time')</th>
                                    <td>{{$trip->actual_end_date_time->format('d F,Y g:i A') ?? trans('labels.not_found') }} </td>
                                </tr>
                                <tr>
                                    <th>@lang('vms::trip.feedback.form_elements.trip_length_hour')</th>
                                    <td>{{$trip->trip_length_hour ?? trans('labels.not_found') }} </td>
                                </tr>

                                <tr>
                                    <th>@lang('vms::trip.feedback.form_elements.completed_distance')</th>
                                    <td>{{$trip->completed_distance ?? trans('labels.not_found')}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif

            <!-- Billing details -->
                <h4 class="form-section"><i class="la la-tag"></i>
                    @lang('vms::trip.bill.details')
                </h4>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                            <tr>
                                <th>@lang('labels.serial')</th>
                                <th>@lang('vms::vehicle.title')</th>
                                <th>
                                    <p>@lang('vms::trip.bill.calculation')</p>
                                    <p>
                                        (@lang('vms::trip.setting.form_elements.per_km_taka')
                                        * @lang('vms::trip.feedback.form_elements.completed_distance'))
                                        + (@lang('vms::trip.setting.form_elements.per_hour_taka')
                                        * @lang('vms::trip.form_elements.length'))
                                    </p>
                                </th>
                                <th>@lang('labels.total')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trip->vehicles  as $vehicle)
                                <tr>
                                    <th scope="row">
                                        {{$loop->iteration}}
                                    </th>
                                    <td>{{$vehicle->name ?? trans('labels.not_found')}}</td>
                                    <td>
                                        ({{ $activeSetting->per_km_taka  }} * {{ $trip->calculated_distance }})
                                        +
                                        ({{ $activeSetting->per_hour_taka }} * {{ $trip->trip_length_hour }})
                                    </td>
                                    <td>
                                        {{$vehicle->bill ?? 0}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <footer>
                                <tr>
                                    <th colspan="3">@lang('labels.total')</th>
                                    <td>{{$trip->total ?? 0 }}</td>
                                </tr>
                            </footer>
                        </table>
                    </div>
                </div>
                @if(!is_null($trip->tripBillPayment))
                    @if($trip->tripBillPayment->status == $paymentStatus['pending'])
                        @include('vms::trip.bill.partial.action')
                    @else
                        <p class="text text-center text-success">
                            @lang('vms::trip.bill.flash_messages.payment_success')
                        </p>
                    @endif
                @else
                    @include('vms::trip.bill.partial.action')
                @endif
            </div>
        </div>
    </div>
@endsection


@push('page-css')
    <!-- checkbox css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <!-- custom -->
    <script>
        $(document).ready(function () {
            validateForm('.vehicle-form');
            $('input[name=purchase_date]').pickadate({
                max: moment().format('yyyy-mm-dd'),
                format: 'yyyy-mm-dd',
                selectMonths: true,
                selectYears: 50,
            });

            // $('input[name=purchase_date]').daterangepicker({
            //     minDate: new Date(),
            //     singleDatePicker: true,
            //     showDropdowns: true,
            //     locale: {
            //         format: 'yyyy-mm-dd'
            //     }
            // });
        })
    </script>
@endpush

