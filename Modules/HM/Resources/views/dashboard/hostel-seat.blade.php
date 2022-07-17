<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">

                <h4 class="card-title" id="basic-layout-form">@lang('hm::hostel.menu_title') @lang('labels.chart')
                    ({{ date('j \ F Y. h:i:s A') }})</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <canvas id="hostel-pie-chart" height="374"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills nav-pills-rounded chart-action float-left btn-group" role="group">
                    @foreach ($hostels as $hostel)
                        <li class="nav-item">
                            <a class="{{ $loop->iteration == 1 ? 'active' : '' }} nav-link" data-toggle="tab"
                                href=".hostel-{{ $hostel->id }}">{{ $hostel->getName() }}</a>
                        </li>
                    @endforeach
                </ul>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="widget-content tab-content bg-white p-20">
                        @foreach ($hostels as $hostel)
                            <div
                                class="{{ $loop->iteration == 1 ? 'active' : '' }} tab-pane hostel-{{ $hostel->id }}">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach ($roomDetails[$hostel->name] as $key => $roomDetail)
                                            <tr>
                                                <td width="15%" class="hostel-level"><strong>Level
                                                        {{ $key }}</strong></td>
                                                <td width="80%">
                                                    @foreach ($roomDetail as $room)
                                                        <div title="{{ $room->roomType->name }}, {{ trans('hm::hostel.' . $room->status) }}: {{ $room->available_capacity }}"
                                                            data-toggle="tooltip"
                                                            class="badge badge-capsule rooms {{ $room->status }}">
                                                            {{ $room->room_number }}
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
