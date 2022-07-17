<!-- pass a Training and RoomBooking object -->
<div class="col">
    <h4 class="card-title" id="repeat-form">
        @lang('tms::training.show_form_title')
    </h4>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>{{trans('tms::training.unique_id')}}</th>
            <td>{{$training->uid ?? ''}}</td>
        </tr>
        <tr>
            <th>{{trans('tms::training.training_name')}}</th>
            <td>{{$training->title ?? ''}}</td>
        </tr>
        <tr>
            <th>{{trans('tms::training.training_participant_no')}}</th>
            <td>{{$training->no_of_trainee ?? '' }}</td>
        </tr>
        <tr>
            <th>{{trans('tms::training.total_registered_trainees')}}</th>
            <td>{{$training->trainee()->count() ?? 0}}</td>
        </tr>
        <tr>
            <th>{{trans('tms::training.training_sponsors')}}</th>
            <td>
                @if(!is_null($training))
                    {{ optional($training->trainingSponsors->first())->organization->name ?? '' }}
                @endif
            </td>
        </tr>
        <tr>
            <th>{{trans('tms::training.level')}}</th>
            <td>{{ $training->level ?? 0 }}</td>
        </tr>
        <tr>
            <th>{{trans('tms::training.no_batches')}}</th>
            <td>{{ $training->no_of_batches }}</td>
        </tr>
        <tr>
            <th>{{trans('labels.status')}}</th>
            <td>{{ $training->status ?? '' }}</td>
        </tr>

        </tbody>
    </table>
</div>
<!-- Booking Related Information -->
<div class="col">
    <h4 class="card-title" id="repeat-form">
        {{trans('hm::booking-request.booking_details')}}
    </h4>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td class="width-150">@lang('hm::booking-request.request_id')</td>
            <td class="width-300">{{ $roomBooking->shortcode ?? '' }}</td>
        </tr>
        <tr>
            <td>@lang('hm::booking-request.booked_by')</td>
            <td>{{ $roomBooking->requester->getName() ??'' }}</td>
        </tr>
        <tr>
            <td>@lang('hm::booking-request.booking_type')</td>
            <td>@lang('hm::booking-request.' . $roomBooking->booking_type ?? '')</td>
        </tr>
        <tr>
            <td>@lang('hm::booking-request.start_date')</td>

            <td>
                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $roomBooking->start_date)
                ->format('d/m/Y') }}
            </td>
        </tr>

        <tr>
            <td>@lang('hm::booking-request.end_date')</td>
            <td>
                {{ \Carbon\Carbon::parse($roomBooking->end_date)->format('d/m/Y') }}
            </td>
        </tr>

        <tr>
            <td>@lang('hm::booking-request.no_of_guests')</td>
            <td>{{ $roomBooking->guestInfos->count() ?? 0 }}</td>
        </tr>

        <tr>
            <td>@lang('hm::booking-request.no_of_rooms')</td>
            <td>{{ $roomBooking->roomInfos->sum('quantity') ?? 0 }}</td>
        </tr>

        <tr>
            <td>@lang('hm::booking-request.room_details')</td>
            <td>
                @foreach($roomBooking->roomInfos as $roomInfo)
                    <ul>
                        <li>
                            {{ $roomInfo->roomType->name ?? '' }} -
                            ({{ $roomInfo->quantity ?? '' }})
                        </li>
                    </ul>
                @endforeach
            </td>
        </tr>

        </tbody>
    </table>
</div>
