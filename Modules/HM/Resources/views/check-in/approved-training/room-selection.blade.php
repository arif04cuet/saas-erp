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
                    @foreach($hostelsWithDetails as $hostel)
                        <li class="nav-item">
                            <a data-hosid="{{$hostel->id}}"
                               class="{{ 1 == $hostel->id ? 'active' : '' }} nav-link"
                               data-toggle="tab" href=".hostel-{{ $hostel->id }}">{{ $hostel->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="widget-content tab-content bg-white p-20">
                    @foreach($hostelsWithDetails as $hostel)
                        <div
                            class="{{ 1 == $hostel->id ? 'active' : '' }} tab-pane hostel-{{ $hostel->id }}">
                            <div class="table table-bordered text-center overflow-auto">
                                <table>
                                    <tbody>
                                    @foreach($hostel->room_details as $key => $roomDetail)
                                        <tr>
                                            <td class="hostel-level"><strong>Level {{$key}}</strong></td>
                                            @foreach($roomDetail as $room)
                                                @php
                                                    if($room->status == 'unavailable')
                                                        $status = false;
                                                    else{
                                                          $status = true;
                                                    }
                                                @endphp
                                                <td data-hostelid="{{$room->hostel_id}}"
                                                    data-roomid="{{$room->id}}"
                                                    data-available="{{$status}}"
                                                    data-status="{{$room->status}}"
                                                    class="room-block {{$room->status}}"
                                                    title="{{'Status: '.trans('hm::hostel.'.$room->status)}} {{'Capacity: '.$room->available_capacity}}">
                                                    <input data-hosn="{{$hostel->name}}" ,
                                                           data-rmn="{{$room->room_number}}"
                                                           name="rooms"
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
                var name = getModalTriggerName();
                var value = getNumberFromString(name);
                var parentIndexNumber = value[0];
                var innerIndexNumber = value[1];

                var roomDetails = [];
                var hostelId;
                var rooms = $('.ck-rooms:checked').map(function () {
                    roomDetails.push($(this).data('rmn'));
                    hostelId = $(this).parent().data('hostelid');
                    return this.value;
                }).get().join(',');

                // assign values
                assignValueToRoomNumber(parentIndexNumber, innerIndexNumber, roomDetails);
                assignValueToHiddenRoomNumber(parentIndexNumber, innerIndexNumber, rooms);
                assignValueToHostel(parentIndexNumber, innerIndexNumber, hostelId);
                $('#selectionModal').modal('hide');
            });

            function assignValueToRoomNumber(parentIndex, innerIndex, val) {
                //sample: assign[0][room][0][room-show]
                let element = $('[name="assign[' + parentIndex + '][room][' + innerIndex + '][room_show]"]');
                $(element).val(val);
            }

            function assignValueToHiddenRoomNumber(parentIndex, innerIndex, val) {
                //sample: assign[0][room][0][room-numbers]
                let element = $('[name="assign[' + parentIndex + '][room][' + innerIndex + '][room_numbers]"]');
                $(element).val(val);
            }

            function assignValueToHostel(parentIndex, innerIndex, val) {
                //sample: assign[0][room][0][room-numbers]
                let element = $('[name="assign[' + parentIndex + '][room][' + innerIndex + '][hostel_id]"]');
                $(element).val(val);
            }

        });

        // select only one checkbox at a time
        $(document).on('click', '.ck-rooms', function () {
            $('.ck-rooms').not(this).prop('checked', false);
        });

    </script>
@endpush
