<div class="row">
    <div class="col-md-12">
        <div class="card">
            {{ Form::open(['route' => ['hostels.get-vacancy-search-view'],
                                  'method' => 'post',
                                  'id' => 'hostel-vacancy-search-form',
                              ]) }}
            <div class="card-header">
                <h4>
                    @lang('hm::hostel.menu_title') @lang('labels.chart')
                </h4>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label('booking_date', trans('labels.start'), ['class' => 'form-label']) !!}
                            {!! Form::text('booking_date', $startDate ? $startDate->format('Y-m-d') :\Carbon\Carbon::now()->format('Y-m-d'),
                                    ['class' => 'form-control ']
                                )
                             !!}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label('booking_date', trans('labels.end'), ['class' => 'form-label']) !!}
                            {!! Form::text('booking_date', $endDate ? $endDate->format('Y-m-d') :\Carbon\Carbon::now()->format('Y-m-d'),
                                    ['class' => 'form-control ']
                                )
                             !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" style="margin-top: 26px;">
                            {!! Form::button('<i class="ft-search"></i> '.trans('labels.search'), array(
                              'type' => 'submit',
                              'class' => 'btn btn-success',
                              'title' => trans('labels.search'),
                                     ));
                            !!}
                        </div>
                    </div>
                </div>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            {{Form::close()}}
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>@lang('hm::hostel.menu_title')</th>
                                <th>@lang('tms::training_hostel.floor') </th>
                                <th>@lang('hm::hostel.total_rooms')</th>
                                <th>@lang('hm::hostel.booked_rooms')</th>
                                <th>@lang('hm::hostel.available_rooms')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hostels as $hostel)
                                @php
                                    $totalRooms = count($hostel->rooms);
                                    $totalAvailableRooms = 0;
                                    $totalBookedRooms = 0;
                                @endphp
                                @foreach($hostel->rooms as $room)
                                    @if($room['status'] === 'unavailable')
                                        @php $totalBookedRooms++; @endphp
                                    @elseif($room['status'] === 'available' || $room['status'] === 'partially-available')
                                        @php $totalAvailableRooms++; @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <th>
                                        <label class="text-info text-capitalize">{{ $hostel->name }}</label>
                                    </th>
                                    <th><h4>{{ $hostel->total_floor}}</h4></th>
                                    <th><h4>{{ $totalRooms }}</h4></th>
                                    <th><h4>{{ $totalBookedRooms }}</h4></th>
                                    <th><h4>{{ $totalAvailableRooms }}</h4></th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
