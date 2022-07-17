@extends('tms::layouts.master')
@section('title', 'Training Course Batche Rooms')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        {{-- <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @include('tms::training.course.batch.room.partial.info')
                                </div>
                            </div>
                            @if($batch->rooms->count())
                                <div class="card collapse-icon accordion-icon-rotate">
                                    @foreach($batchHostelRooms as $hostelRooms)
                                        <div id="headingCollapse{{ $loop->index }}" class="card-header border-info mt-1">
                                            <a data-toggle="collapse" href="#collapse{{ $loop->index }}"
                                               class="card-title lead info collapsed">{{ $hostelRooms->hostel_name }}
                                            </a>
                                        </div>
                                        <div id="collapse{{ $loop->index }}" role="tabpanel" class="card-collapse collapse"
                                             aria-expanded="false" style="">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    @php
                                                        $customPillClasses = 'align-items-center height-75 d-inline-flex font-size-base';
                                                    @endphp
                                                    @foreach($hostelRooms->rooms as $room)
                                                        <div class="badge badge-pill badge-glow badge-success badge-square {{ $customPillClasses }}">
                                                            {{ $room }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ $batchRoomAllocationRoute }}" class="master btn btn-sm btn-info"><i class="ft ft-edit"></i> @lang('labels.edit')</a>
                            @else
                                <a href="{{ $batchRoomAllocationRoute }}" class="master btn btn-sm btn-info"><i class="ft ft-plus"></i> @lang('labels.add')</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
