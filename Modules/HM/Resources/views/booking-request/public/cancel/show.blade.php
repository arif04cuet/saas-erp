@extends('hm::layouts.master')
@section('title',trans('hm::booking-request.booking_request'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">{{  trans('hm::booking-request.booking_details') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><span class="badge badge-warning"
                                          style="padding: 8px;">{{ trans('hm::booking-request.pending') }}</span>
                                </li>
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">

                        <div class="card-body" id="Data">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>
                                        <span
                                            class="text-bold-600">{{ trans('hm::booking-request.booking_details') }}</span>
                                    </p>
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                        <tr>
                                            <td class="width-150">@lang('hm::booking-request.request_id')</td>
                                            <td class="width-300">{{ $roomBooking->shortcode ?? trans('labels.not_found')}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.requested_on')</td>
                                            <td>{{ $roomBooking->created_at->format('d/m/Y') ?? trans('labels.not_found') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.booked_by')</td>
                                            <td>{{ $roomBooking->requester->getName() ?? trans('labels.not_found') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.organization')</td>
                                            <td>{{ $roomBooking->requester->organization ?? trans('labels.not_found') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.designation')</td>
                                            <td>{{ $roomBooking->requester->designation ?? trans('labels.not_found') }}</td>
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
                                            <td>{{ $roomBooking->requester->contact ?? trans('labels.not_found')}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.email')</td>
                                            <td>{{ $roomBooking->requester->email ?? trans('labels.not_found') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.address')</td>
                                            <td>{{ $roomBooking->requester->address ?? trans('labels.not_found') }}</td>
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
                                        <tr>

                                            <td>@lang('hm::booking-request.start_date')</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $roomBooking->start_date)->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.end_date')</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($roomBooking->end_date)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('hm::booking-request.no_of_guests')</td>
                                            @if($roomBooking->booking_type == \Modules\HM\Entities\RoomBooking::getBookingTypes()['training']
                                                && !is_null($roomBooking->training_id)
                                            )
                                                <td>{{ $roomBooking->training->no_of_trainee ?? 0  }}</td>
                                            @else
                                                <td>{{ $roomBooking->guestInfos->count() ?? 0 }}</td>
                                            @endif
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

                            @if($roomBooking->guestInfos->count())
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <span
                                                class="text-bold-600">@lang('hm::booking-request.guest_information')</span>
                                        </p>
                                        <table class="table table-striped table-bordered md-0">
                                            <thead>
                                            <tr>
                                                <th>@lang('labels.serial')</th>
                                                <th>@lang('hm::booking-request.nationality')</th>
                                                <th>@lang('labels.name')</th>
                                                <th>@lang('hm::booking-request.age')</th>
                                                <th>@lang('hm::booking-request.gender')</th>
                                                <th>@lang('hm::booking-request.mobile_number')</th>
                                                <th>@lang('hm::booking-request.address')</th>
                                                <th>@lang('hm::booking-request.relation')</th>
                                                <th>@lang('hm::booking-request.nid_no')</th>
                                                <th>@lang('hm::booking-request.nid_copy')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($roomBooking->guestInfos as $guestInfo)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $guestInfo->getNationality() ?? trans('hm::booking-request.not_given')}}</td>
                                                    <td>
                                                        {{ $guestInfo->first_name ?? ''}}
                                                        {{ $guestInfo->middle_name ?? '' }}
                                                        {{ $guestInfo->last_name ?? ''  }}</td>
                                                    <td>{{ $guestInfo->age ?? trans('hm::booking-request.not_given') }}</td>
                                                    <td>
                                                        @if($guestInfo->gender == 'male')
                                                            {{trans('hm::booking-request.male')}}
                                                        @elseif($guestInfo->gender == 'female')
                                                            {{trans('hm::booking-request.female')}}
                                                        @else
                                                            {{trans('hm::booking-request.not_given')}}
                                                        @endif
                                                    </td>
                                                    <td>{{ $guestInfo->mobile_number ?? trans('hm::booking-request.not_given')}}</td>
                                                    <td>{{ $guestInfo->address ?? trans('hm::booking-request.not_given')}}</td>
                                                    <td>{{ trans('hm::booking-request.relation_' . $guestInfo->relation) }}</td>
                                                    <td>
                                                        @if($guestInfo->nid_no)
                                                            {{ $guestInfo->nid_no }}
                                                        @else
                                                            <p>@lang('hm::booking-request.not_given')</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($guestInfo->nid_doc)
                                                            <a href="{{ url("/file/get?filePath=" .  $guestInfo->nid_doc) }}"
                                                               target="_blank">
                                                                <i class="la la-file-o"></i>
                                                            </a>
                                                        @else
                                                            <p>@lang('hm::booking-request.not_given')</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            <br>
                            <p><span class="text-bold-600">@lang('hm::booking-request.documents')</span></p>
                            <div class="row card-deck">
                                @if ($roomBooking->requester->photo)
                                    <figure class="card card-img-top border-grey border-lighten-2"
                                            itemprop="associatedMedia" itemscope="">
                                        <a href="{{ url("/file/get?filePath=" .  $roomBooking->requester->photo) }}"
                                           target="_blank"
                                           itemprop="contentUrl"
                                           data-size="480x360">
                                            <img class="gallery-thumbnail card-img-top"
                                                 style="height: 150px;width: 150px;"
                                                 src="{{ url("/file/get?filePath=" .  $roomBooking->requester->photo) }}"
                                                 itemprop="thumbnail">
                                        </a>
                                        <div class="card-body px-0">
                                            <h4 class="card-title">@lang('hm::booking-request.your_photo')</h4>
                                        </div>
                                    </figure>
                                @else
                                    <figure class="card card-img-top border-grey border-lighten-2"
                                            itemprop="associatedMedia" itemscope="">
                                        <p>@lang('labels.no_doc_available')</p>
                                        <div class="card-body px-0">
                                            <h4 class="card-title">@lang('hm::booking-request.your_photo')</h4>
                                        </div>
                                    </figure>
                                @endif
                                @if ($roomBooking->requester->nid_doc)
                                    <figure class="card card-img-top border-grey border-lighten-2"
                                            itemprop="associatedMedia" itemscope="">
                                        <a href="{{ url("/file/get?filePath=" .  $roomBooking->requester->nid_doc) }}"
                                           target="_blank"
                                           itemprop="contentUrl"
                                           data-size="480x360">
                                            <img class="gallery-thumbnail card-img-top"
                                                 style="height: 150px;width: 150px;"
                                                 src="{{ url("/file/get?filePath=" .  $roomBooking->requester->nid_doc) }}"
                                                 itemprop="thumbnail">
                                        </a>
                                        <div class="card-body px-0">
                                            <h4 class="card-title">@lang('hm::booking-request.nid_copy')</h4>
                                        </div>
                                    </figure>
                                @else
                                    <figure class="card card-img-top border-grey border-lighten-2"
                                            itemprop="associatedMedia" itemscope="">
                                        <p>@lang('labels.no_doc_available')</p>
                                        <div class="card-body px-0">
                                            <h4 class="card-title">@lang('hm::booking-request.nid_copy')</h4>
                                        </div>
                                    </figure>
                                @endif
                                @if ($roomBooking->requester->passport_doc)
                                    <figure class="card card-img-top border-grey border-lighten-2"
                                            itemprop="associatedMedia" itemscope="">
                                        <a href="{{ url("/file/get?filePath=" .  $roomBooking->requester->passport_doc) }}"
                                           target="_blank"
                                           itemprop="contentUrl"
                                           data-size="480x360">
                                            <img class="gallery-thumbnail card-img-top"
                                                 style="height: 150px;width: 150px;"
                                                 src="{{ url("/file/get?filePath=" .  $roomBooking->requester->passport_doc) }}"
                                                 itemprop="thumbnail">
                                        </a>
                                        <div class="card-body px-0">
                                            <h4 class="card-title">@lang('hm::booking-request.passport_copy')</h4>
                                        </div>
                                    </figure>
                                @else
                                    <figure class="card card-img-top border-grey border-lighten-2"
                                            itemprop="associatedMedia" itemscope="">
                                        <p>@lang('labels.no_doc_available')</p>
                                        <div class="card-body px-0">
                                            <h4 class="card-title">@lang('hm::booking-request.passport_copy')</h4>
                                        </div>
                                    </figure>
                                @endif
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span class="text-bold-600">@lang('labels.remarks')</span></p>
                                    {{ $roomBooking->comment }}
                                </div>
                                <div class="col-md-4">
                                    <p><span class="text-bold-600">@lang('hm::booking-request.note_of_authority')</span>
                                    </p>
                                    {{ $roomBooking->note }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::open(['route' =>  'booking-requests.cancel', 'class' => 'form', 'novalidate']) !!}
                    <div class="form-actions text-center card-footer center-block">
                        <button class="btn btn-warning" type="submit">
                            @lang('hm::booking-request.cancel_booking_request')
                        </button>
                    </div>
                    {!! Form::hidden('room_booking_id',$roomBooking->id) !!}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection






