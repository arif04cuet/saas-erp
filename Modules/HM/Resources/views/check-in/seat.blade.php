@extends('hm::layouts.master')
@section('title', __('hm::checkin.room_allocation'))
@push('page-css')
    <style type="text/css">
        .hostel-level {
            background-color: #878896;
            color: #ffffff;
        }

        .room-block {
            color: #ffffff;
        }

        .available {
            background-color: green;
            cursor: pointer;
        }

        .unavailable {
            background-color: red;
            pointer-events: none;
            cursor: not-allowed;
        }

        .partially-available {
            background-color: purple;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::checkin.guest_assaingment')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <legend>@lang('hm::booking-request.checkin_details') :</legend>
                                        <label>@lang('labels.code') : {{$roomCheckinDetails->shortcode}}</label>&nbsp;&nbsp;
                                        <label>@lang('hm::booking-request.checkin_type')
                                            :  {{ trans("hm::booking-request.$roomCheckinDetails->booking_type")}}</label>&nbsp;&nbsp;
                                        <label>@lang('hm::booking-request.start_date')
                                            : {{$roomCheckinDetails->start_date}}</label>&nbsp;&nbsp;
                                        <label>@lang('hm::booking-request.end_date')
                                            : {{$roomCheckinDetails->end_date}}</label>
                                    </fieldset>
                                </div>
                            </div>
                            <hr/>
                            <ul class="nav nav-pills nav-pills-rounded chart-action float-left btn-group mb-1"
                                role="group">
                                @foreach($hostels as $hostel)
                                    <li class="nav-item">
                                        <a data-hosid="{{$hostel->id}}"
                                           class="{{ $selectedHostelId == $hostel->id ? 'active' : '' }} nav-link"
                                           data-toggle="tab" href=".hostel-{{ $hostel->id }}">{{ $hostel->name }}</a>
                                    </li>
                                @endforeach

                            </ul>

                            <div class="widget-content tab-content bg-white p-20 mt-5">
                                @foreach($hostels as $hostel)
                                    <div
                                            class="{{ $selectedHostelId == $hostel->id ? 'active' : '' }} tab-pane hostel-{{ $hostel->id }}">
                                        <div class="table table-bordered text-center overflow-auto">
                                            <table>
                                                <tbody>
                                                @foreach($roomDetails[$hostel->name] as $key => $roomDetail)
                                                    <tr>
                                                        <td class="hostel-level"><strong>Level {{$key}}</strong></td>
                                                        @foreach($roomDetail as $room)
                                                            <td data-roomid="{{$room->id}}"
                                                                class="room-block available"
                                                                title="{{'Capacity: '.$room->roomType->capacity}}"
                                                                data-room-capacity="{{ $room->roomType->capacity }}"
                                                                data-toggle="modal" data-target="#selectionModal">
                                                                {{$room->room_number}}<br/>{{$room->roomType->name}}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr/>
                            <a class="btn btn-info" role="button"
                               href="{{route('check-in.index')}}">@lang('labels.complete')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="selectionModal" tabindex="-1" role="dialog" aria-labelledby="selectionModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="container" id="showAssignedGuest">
                    <br/>
                    <p>The following guest already assigned into this room</p>
                    <table class="table" id="guestInfo">
                        <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Address</th>
                        </tr>
                        </thead>
                        <tbody id="TableBody">
                        </tbody>
                    </table>
                </div>


                <div class="modal-header">
                    <h5 class="modal-title" id="selectionModalLabel">@lang('hm::checkin.room_allocation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' =>  'room.assign', 'class' => 'form', 'novalidate']) !!}
                <div class="modal-body">
                    <input type="hidden" name="checkin_id" value="{{$roomCheckinDetails->id}}"/>
                    <input type="hidden" name="selected_hostel_id" id="selected-hostel-id"
                           value="{{$selectedHostelId}}"/>
                    <input type="hidden" name="room_id" id="room-id" value=""/>
                    <div class="form-group">
                        <label for="booking_guest_info_id" class="col-form-label">@lang('hm::booking-request.guests')
                            :</label>
                        {!! Form::select('booking_guest_info_id', $guests, null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="checkin_date" class="col-form-label">@lang('hm::checkin.checkin_date'):</label>
                        <input type="text" class="form-control" name="checkin_date_show" id="checkin-date_show"
                               value="{{$today}}" readonly="readonly"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="addGuest" class="btn btn-primary">@lang('labels.add')</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.cancel')</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script type="text/javascript">
        $('#selectionModal').on('show.bs.modal', function (event) {
            var td = $(event.relatedTarget);// td that triggered the modal
            var roomId = td.data('roomid');
            var roomCapacity = td.data('room-capacity')
            $('#room-id').val(roomId);

            // displaying already assigned member list
            $.ajax({
                type: 'GET',
                url: '/hm/rooms/assigned-guest/' + roomId + '/' + '{{$roomCheckinDetails->id}}',
                data: '_token = @php echo csrf_token() @endphp',
                success: function (data) {
                    $('#TableBody').empty();
                    guestInfo = JSON.parse(data);
                    numberOfAlreadyAssigned = guestInfo.length;
                    if (roomCapacity == numberOfAlreadyAssigned) {
                        $("#addGuest").attr("disabled","disabled");
                    }else{
                        $("#addGuest").attr("disabled", false);
                    }
                    if (guestInfo.length > 0) {

                        var row = '';
                        $.each(guestInfo, function (i, item) {
                            row += '<tr><td>' + item.first_name + '</td><td>' + item.last_name + '</td><td>' + item.address + '</td></tr>';
                        });
                        $('#guestInfo').append(row);
                        $('#showAssignedGuest').show();
                    } else {
                        $('#showAssignedGuest').hide();
                    }

                }
            });
        });
        $('.nav-link').on('click', function () {
            $('#selected-hostel-id').val($(this).data('hosid'));
        });
    </script>
@endpush
