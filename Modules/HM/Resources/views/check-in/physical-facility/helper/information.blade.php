<div class="row">
    <div class="col-md-5">
        <p>
            <span class="text-bold-600">{{ $type == 'checkin' ? trans('hm::booking-request.check_in') . ' ' . trans('labels.details') : trans('hm::booking-request.booking_details') }}</span>
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
                        {{ $roomInfo->quantity }} ({{ $roomInfo->roomType->name }})
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <p>
            <span class="text-bold-600">@lang('hm::booking-request.bard_reference')</span>
        </p>
        <table class="table table-bordered mb-0">
            <tbody>
            <tr>
                <td class="width-150">@lang('hm::booking-request.bard_reference')</td>
                <td class="width-300">{{ $roomBooking->referee ? $roomBooking->referee->getName() : null }}</td>
            </tr>
            <tr>
                <td>@lang('hm::booking-request.designation')</td>
                <td>{{ $roomBooking->referee ? $roomBooking->referee->designation->name : null }}</td>
            </tr>
            <tr>
                <td>@lang('hm::booking-request.department')</td>
                <td>{{ $roomBooking->referee ? $roomBooking->referee->employeeDepartment->name : null }}</td>
            </tr>
            <tr>
                <td>@lang('hm::booking-request.contact')</td>
                <td>{{ $roomBooking->referee ? $roomBooking->referee->getContact() : null }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
