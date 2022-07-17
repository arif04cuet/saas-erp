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

        .partially_available {
            background-color: #ffd162;
            cursor: pointer;
        }

        .modal-full {
            min-width: 100%;
            margin: 0;
        }

        .modal-full .modal-content {
            min-height: 100vh;
        }
    </style>
@endpush
<div class="modal fade" id="selectionModal" tabindex="-1" role="dialog" aria-labelledby="selectionModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectionModalLabel">@lang('hm::checkin.room_allocation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills nav-pills-rounded chart-action float-left btn-group" role="group">
                    @foreach($hostels as $hostel)
                        <li class="nav-item">
                            <a data-hosid="{{$hostel->id}}"
                               class="{{ 1 == $hostel->id ? 'active' : '' }} nav-link"
                               data-toggle="tab" href=".hostel-{{ $hostel->id }}">{{ $hostel->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="widget-content tab-content bg-white p-20">
                    @foreach($hostels as $hostel)
                        <div
                            class="{{ 1 == $hostel->id ? 'active' : '' }} tab-pane hostel-{{ $hostel->id }}">
                            <div class="table table-bordered text-center overflow-auto">
                                <table>
                                    <tbody>
                                    @foreach($roomDetails[$hostel->name] as $key => $roomDetail)
                                        <tr>
                                            <td class="hostel-level"><strong>Level {{$key}}</strong></td>
                                            @foreach($roomDetail as $room)
                                                <td data-hostelid="{{$room->hostel_id}}" data-roomid="{{$room->id}}"
                                                    class="room-block {{$room->status}}"
                                                    title="{{'Status: '.trans('hm::hostel.'.$room->status)}} {{'Capacity: '.$room->available_capacity}}">
                                                    <input data-hosn="{{$hostel->name}}" ,
                                                           data-rmn="{{$room->room_number}}" name="rooms"
                                                           class="ck-rooms" value="{{$room->id}}"
                                                           data-room-type="{{$room->roomType->id}}"
                                                           type="checkbox"/>
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
            </div>
            <div class="modal-footer">
                <button type="button" id="add-room" class="btn btn-primary">@lang('labels.add')</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.cancel')</button>
            </div>
        </div>
    </div>
</div>
@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#validationError').hide();
            // -------------------
            $('#add-room').on('click', function () {

                var roomDetails = [];

                // allSelectedRoom variable capture the data which selected by input form
                // var allSelectedRoom = [];
                var rooms = $('.ck-rooms:checked').map(function () {
                    roomDetails.push($(this).data('rmn'));
                    // allSelectedRoom.push($(this).data('roomType'));
                    return this.value;
                }).get().join(',');
                $('.room-numbers').val(rooms);
                $('.rooms').val(roomDetails.toString());
                $('#selectionModal').modal('hide');


            });

        });

    </script>
@endpush
