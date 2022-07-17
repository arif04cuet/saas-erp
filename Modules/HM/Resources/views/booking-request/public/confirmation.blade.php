@extends('layouts.public')
@section('title', $type == 'checkin' ? trans('hm::booking-request.check_in') : trans('hm::booking-request.booking_request'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-content collapse show">

                        <div class="card-body" id="Data">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>
                                        <span
                                            class="text-bold-600">{{ trans('hm::booking-request.booking_details')}}</span>
                                    </p>
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                        <tr>
                                            <td class="width-150">@lang('hm::booking-request.request_id')</td>
                                            <td class="width-300">{{ $roomBooking->shortcode }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.requested_on')</td>
                                            <td>{{ $roomBooking->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.booked_by')</td>
                                            <td>{{ $roomBooking->requester->getName() }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.organization')</td>
                                            <td>{{ $roomBooking->requester->organization }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.designation')</td>
                                            <td>{{ $roomBooking->requester->designation }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.organization_type')</td>
                                            <td>
                                                @if(!is_null($roomBooking->requester->organization_type))
                                                    @lang('hm::booking-request.' .$roomBooking->requester->organization_type)
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.contact')</td>
                                            <td>{{ $roomBooking->requester->contact }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.email')</td>
                                            <td>{{ $roomBooking->requester->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.address')</td>
                                            <td>{{ $roomBooking->requester->address }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <span class="text-bold-600">@lang('labels.others') @lang('labels.info')</span>
                                    </p>
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                        <tr>
                                            <td>@lang('hm::booking-request.booking_type')</td>
                                            <td>@lang('hm::booking-request.' . $roomBooking->booking_type)</td>
                                        </tr>
                                        @if($type == 'checkin')

                                            <tr>
                                                <td>@lang('hm::checkin.room_numbers')</td>
                                                <td>
                                                    @foreach($roomBooking->rooms as $room)
                                                        @if($loop->iteration == count($roomBooking->rooms))
                                                            {{ $room->room->room_number }}
                                                        @else
                                                            {{ $room->room->room_number }},
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            @if($type == 'checkin')
                                                <td>@lang('hm::booking-request.check_in')</td>
                                            @else
                                                <td>@lang('hm::booking-request.start_date')</td>
                                            @endif
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $roomBooking->start_date)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            @if($type == 'checkin')
                                                <td>@lang('hm::booking-request.check_out')</td>
                                                <td>
                                                    {{ $roomBooking->actual_end_date
                                                    ? \Carbon\Carbon::parse($roomBooking->actual_end_date)->format('d/m/Y')
                                                    : null }}
                                                </td>
                                            @else
                                                <td>@lang('hm::booking-request.end_date')</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($roomBooking->end_date)->format('d/m/Y') }}
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.no_of_guests')</td>
                                            <td>{{ $roomBooking->guestInfos->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.no_of_rooms')</td>
                                            <td>{{ $roomBooking->roomInfos->sum('quantity') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.room_details')</td>
                                            <td>
                                                @foreach($roomBooking->roomInfos as $roomInfo)
                                                    {{ $roomInfo->roomType->name }}
                                                @endforeach
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <span class="text-bold-600">@lang('hm::booking-request.billing_information')</span>
                                    </p>
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                        <tr>
                                            <td class="width-150">@lang('hm::booking-request.room_type')</td>
                                            <td class="width-300">@foreach($roomBooking->roomInfos as $roomInfo)
                                                    {{ $roomInfo->roomType->name }}
                                                @endforeach</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.quantity')</td>
                                            <td>{{ $quantity = $roomBooking->roomInfos->sum('quantity') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.duration')</td>
                                            <td>{{ \Carbon\Carbon::parse($roomBooking->start_date)->format('d M Y') }} to {{ \Carbon\Carbon::parse($roomBooking->end_date)->format('d M Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.rate_type')</td>
                                            <td> @foreach($roomBooking->roomInfos as $roomInfo)
                                                    @lang("hm::booking-request.$roomInfo->rate_type")
                                                @endforeach</td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.rate')</td>
                                            <td>{{$roomInfo->roomType->non_government_rate}} x {{ $roomBooking->roomInfos->sum('quantity') }} x {{ $days =  \Carbon\Carbon::parse($roomBooking->end_date)->diffInDays(\Carbon\Carbon::parse($roomBooking->start_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.vat_and_tax_percentage')</td>
                                            <td>{{ $vat = (($roomInfo->roomType->non_government_rate * $quantity) *
                                            $days) * .2}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.total_rate')</td>
                                            <td>{{ (($roomInfo->roomType->non_government_rate * $quantity) *
                                            $days) + $vat }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if($type == 'checkin')
                            <div class="card-body" style="padding-left: 20px;">
                                <div class="form-actions">
                                    <a class="btn btn-outline-danger mr-1" role="button"
                                       href="{{ route('check-in.index') }}">
                                        <i class="ft-x"></i> @lang('labels.cancel')
                                    </a>
                                    @if(!$roomBooking->actual_end_date)
                                        {{ Form::open(['route' => ['check-out.update', $roomBooking->id], 'style' => 'display: inline']) }}
                                        <button class="btn btn-success mr-1">
                                            <i class="ft-check-circle"></i> @lang('hm::booking-request.check_out')
                                        </button>
                                        {{ Form::close() }}
                                    @endif
                                    <a class="btn btn-outline-primary mr-1" role="button"
                                       href="{{ route('check-in-payments.index', $roomBooking->id) }}">
                                        <i class="ft-list"></i> @lang('hm::bill.bill_payment')
                                    </a>
                                    <a class="btn btn-outline-primary mr-1" role="button"
                                       href="{{ route('check-in-bill.index', $roomBooking->id) }}">
                                        <i class="ft-list"></i> @lang('hm::bill.title')
                                    </a>
                                    <button class="btn btn-success mr-1" type="button" id="PrintCommand"><i
                                            class="ft-printer"></i> @lang('labels.print')
                                    </button>
                                </div>
                            </div>
                        @else
                            {{ Form::open(['method' => 'put', 'id' => 'booking-request-status-form']) }}

                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ Form::hidden('status', $roomBooking->status, ['id' => 'status-input-hidden']) }}
                                                @if ($errors->has('note'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('note') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="card-footer">

                                @if($vendorRequest->status === 'pending')
                                    <button class="btn btn-danger mr-1" type="button"
                                            onclick="changeStatus('rejected')"><i
                                                class="ft-x-circle"></i> @lang('hm::booking-request.reject')
                                    </button>

                                    <button class="btn btn-success mr-1" type="button"
                                            onclick="changeStatus('approved')"><i
                                                class="ft-check"></i> @lang('hm::booking-request.approve')
                                    </button>
                                @endif
                            </div>
                            {{ Form::close() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        function changeStatus(payload) {
            $('#status-input-hidden').val(payload);
            let $bookingRequestStatusForm = $('#booking-request-status-form');

            if (payload == 'approved') {
                $bookingRequestStatusForm.attr('action', '{!! route('public-booking-request.approve',
                 ['VendorConfirmationID'=> $vendorRequest->id]) !!}');
            } else {
                $bookingRequestStatusForm.attr('action', '{!! route('public-booking-request.reject',
                 ['roomBookingID'=> $roomBooking,
                  'VendorConfirmationID'=> $vendorRequest->id]) !!}');
            }

            $bookingRequestStatusForm.submit();
        }
    </script>
@endpush





