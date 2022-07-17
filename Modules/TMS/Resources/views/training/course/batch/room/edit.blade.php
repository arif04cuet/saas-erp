@extends('tms::layouts.master')
@section('title', 'Training Course Batch Room Create')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">প্রশিক্ষণ কোর্স ব্যাচ হোস্টেল রুম বরাদ্দ</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @include('tms::training.course.batch.room.partial.info')
                                </div>
                            </div>
                            <h3 class="text-center">No of trainees:
                                <span id="no-of-trainees">{{ $batch->no_of_trainees }}</span>
                            </h3>
                            <h3 class="text-center">Seats Allocated:
                                <span id="seats-allocated">{{ $totalSeatsAllocated }}</span>
                            </h3>
                            <hr>
                            <div class="form-group">
                                <ul class="nav nav-tabs">
                                    @foreach($hostelsWithAssignedRoomCount as $hostel)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="base-tab1"
                                               data-toggle="tab"
                                               href="#tab{{ $loop->iteration }}">{{ $hostel->name }}
                                                @php
                                                    $isHiddenClass = $hostel->assigned_room_count < 1 ? 'd-none' : '';
                                                @endphp
                                                <span class="badge badge-pill badge-glow badge-default badge-primary float-right {{ $isHiddenClass }}">
                                                    {{ $hostel->assigned_room_count }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content px-1 pt-1">
                                    @foreach($availableHostelRooms as $hostelRooms)
                                        <div class="tab-pane  {{ $loop->index == 0 ? 'active' : '' }}"
                                             id="tab{{ $loop->iteration }}">
                                            <ul class="list-group">
                                                @foreach($hostelRooms as $room)
                                                    @php
                                                        $isAssignedClass = $room->is_assigned ? 'btn-success' : '';
                                                    @endphp
                                                    <button type="button"
                                                            class="list-group-item list-group-item-action {{ $isAssignedClass }}"
                                                            data-capacity="{{ $room->capacity }}"
                                                            value="{{ $room->id }}">{{ $room->name }}</button>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{ Form::open(['route' =>
                                [
                                    'trainings.courses.batches.rooms.update',
                                    $training->id,
                                    $course->id,
                                    $batch->id
                                ],
                                'method' => 'PUT',
                                'id' => 'batch-room-form'
                            ]) }}
                            <div class="form-actions">
                                <button id="btn-submit" type="button" class="master btn btn-primary">
                                    <i class="ft-check-square"></i> {{ trans('labels.save') }}
                                </button>
                                <a href="{{ route('trainings.courses.batches.show', [$training->id, $course->id]) }}"
                                   class="master btn btn-warning">
                                    <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                </a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        function removeRoomInfo(selectedRooms, roomId) {
            let index = selectedRooms.indexOf(roomId);
            selectedRooms.splice(index, 1);
        }

        function syncSelectedRooms(selectedRooms, roomId) {
            if (selectedRooms.includes(roomId)) {
                removeRoomInfo(selectedRooms, roomId);
            } else {
                selectedRooms.push(roomId);
            }
        }

        function setTotalSeatAllocated(selectedRooms) {
            let totalSeatsAllocated = selectedRooms.reduce((accumulator, roomId) => {
                let selectedRoomCapacity = $(`button[value=${roomId}]`).data('capacity');

                return accumulator + Number(selectedRoomCapacity);
            }, 0);

            $('#seats-allocated').html(totalSeatsAllocated);
        }

        function syncTabPaneBagde() {
            let tabPaneId = $(this).parent().parent().attr('id');
            let $tabPaneBadge = $(`a[href="#${tabPaneId}"]`).find('.badge');

            let selectedBtns = $(`div[id="${tabPaneId}"]`).find('.btn-success');

            if (selectedBtns.length < 1) {
                $tabPaneBadge.addClass('d-none');
            } else {
                $tabPaneBadge.text(selectedBtns.length).removeClass('d-none');
            }
        }

        $(document).ready(function () {
            let selectedRooms = @json($selectedRooms);

            $('.list-group-item').on('click', function () {
                $(this).toggleClass('btn-success');

                let roomId = Number($(this).val());

                syncSelectedRooms(selectedRooms, roomId);

                setTotalSeatAllocated(selectedRooms);

                syncTabPaneBagde.call(this);
            });

            $('#btn-submit').on('click', function () {
                let numberOfTrainees = Number($('#no-of-trainees').text());
                let allocatedSeats = Number($('#seats-allocated').text());

                if (allocatedSeats < numberOfTrainees) {
                    alert('Allocated seats cannot be less than total number of trainees');
                    return;
                }

                selectedRooms.forEach((roomId, index) => {
                    $('#batch-room-form').append(`<input type="hidden" name="rooms[${index}]" value="${roomId}">`);
                });

                $('#batch-room-form').submit();
            });
        });
    </script>
@endpush
