@extends('hm::layouts.master')
@section('title', $type == 'checkin' ? trans('hm::booking-request.check_in') : trans('hm::booking-request.booking_request'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"
                            id="basic-layout-form">{{ $type == 'checkin' ? trans('hm::booking-request.check_in') . ' ' . trans('labels.details') : trans('hm::booking-request.booking_details') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                @if($type == 'booking')
                                    @if($roomBooking->status == 'pending')
                                        <li><span class="badge badge-warning"
                                                  style="padding: 8px;">{{ trans('hm::booking-request.pending') }}</span>
                                        </li>
                                    @elseif($roomBooking->status == 'verified')
                                        <li><span class="badge badge-success"
                                                  style="padding: 8px;">{{ trans('hm::booking-request.verified') }}</span>
                                        </li>
                                    @elseif($roomBooking->status == 'approved')
                                        <li><span class="badge badge-success"
                                                  style="padding: 8px;">{{ trans('hm::booking-request.approved') }}</span>
                                        </li>
                                    @else
                                        <li><span class="badge badge-danger"
                                                  style="padding: 8px;">{{ trans('hm::booking-request.rejected') }}</span>
                                        </li>
                                    @endif
                                @endif

                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
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
                                            class="text-bold-600">{{ $type == 'checkin' ? trans('hm::booking-request.check_in') . ' ' . trans('labels.details') : trans('hm::booking-request.booking_details') }}</span>
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
                                            <td>{{ $roomBooking->referee ? $roomBooking->referee->designation['name'] : null }}</td>
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
                        </div>

                        @if($type == 'checkin')
                            <div class="card-body" style="padding-left: 20px;">
                                <div class="form-actions">
                                    <a class="btn btn-outline-danger mr-1" role="button"
                                       href="{{ route('check-in.index') }}">
                                        <i class="ft-x"></i> @lang('labels.cancel')
                                    </a>
                                    @if(!$roomBooking->actual_end_date)
                                        {{ Form::open(['route' => ['check-out.update', $roomBooking->id], 'style' => 'display: inline']) }}
                                        <button class="btn btn-success mr-1">
                                            <i class="ft-check-circle"></i> @lang('hm::booking-request.check_out')
                                        </button>
                                        {{ Form::close() }}
                                    @endif
                                    <a class="btn btn-outline-primary mr-1" role="button"
                                       href="{{ route('check-in-payments.index', $roomBooking->id) }}">
                                        <i class="ft-list"></i> @lang('hm::bill.bill_payment')
                                    </a>
                                    <a class="btn btn-outline-primary mr-1" role="button"
                                       href="{{ route('check-in-bill.index', $roomBooking->id) }}">
                                        <i class="ft-list"></i> @lang('hm::bill.title')
                                    </a>
                                    <button class="btn btn-success mr-1" type="button" id="PrintCommand"><i
                                            class="ft-printer"></i> @lang('labels.print')
                                    </button>
                                </div>
                            </div>
                        @else
                            {{ Form::open(['method' => 'put', 'id' => 'booking-request-status-form']) }}
                            <div class="card-body">
                                @if (Auth::user()->hasAnyRole([
                                    'ROLE_DIRECTOR_GENERAL',
                                    'ROLE_DIRECTOR_ADMIN',
                                    'ROLE_DIRECTOR_TRAINING',
                                ]))
                                    <p><span class="text-bold-600">@lang('hm::booking-request.note_of_authority')</span>
                                    </p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ Form::hidden('status', $roomBooking->status, ['id' => 'status-input-hidden']) }}
                                                {!! Form::textarea('note', $roomBooking->note, ['class' => 'form-control required' . ($errors->has('note') ? ' is-invalid' : ''), 'placeholder' => trans('labels.note'), 'cols' => 5, 'rows' => 3, 'data-rule-maxlength' => 2, 'data-msg-maxlength'=>"At least 300 characters"]) !!}

                                                @if ($errors->has('note'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('note') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{ route('booking-requests.index') }}">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </a>
                                @can('admin-hm-access')
                                    @if($roomBooking->status == 'pending')
                                        @if (Auth::user()->hasAnyRole(['ROLE_DIRECTOR_TRAINING']))
                                            @if($roomBooking->status != 'pending')
                                                <button class="btn btn-secondary mr-1" type="button"
                                                        onclick="changeStatus('pending')"><i
                                                            class="ft-alert-circle"></i> @lang('hm::booking-request.pending')
                                                </button>
                                            @endif
                                            @if($roomBooking->status != 'rejected')
                                                <button class="btn btn-danger mr-1" type="button"
                                                        onclick="changeStatus('rejected')"><i
                                                            class="ft-x-circle"></i> @lang('hm::booking-request.reject')
                                                </button>
                                            @endif
                                            @if($roomBooking->status != 'verified')
                                                <button class="btn btn-success mr-1" type="button"
                                                        onclick="changeStatus('verified')"><i
                                                            class="ft-check"></i> @lang('hm::booking-request.verify')
                                                </button>
                                            @endif
                                        @endif
                                    @endif

                                    @if (Auth::user()->hasAnyRole(['ROLE_DIRECTOR_GENERAL']))
                                        @if($roomBooking->status == 'verified')
                                            @if($roomBooking->status != 'rejected')
                                                <button class="btn btn-danger mr-1" type="button"
                                                        onclick="changeStatus('rejected')"><i
                                                            class="ft-x-circle"></i> @lang('hm::booking-request.reject')
                                                </button>
                                            @endif
                                            @if($roomBooking->status != 'approved')
                                                <button class="btn btn-success mr-1" type="button"
                                                        onclick="changeStatus('approved')"><i
                                                            class="ft-check"></i> @lang('hm::booking-request.approve')
                                                </button>
                                            @endif
                                        @endif
                                    @endif

                                    <button class="btn btn-info mr-1 pull-right" type="button" id="PrintCommand">
                                        <i class="ft-printer"></i> @lang('labels.print')
                                    </button>
                                @endcan
                            </div>
                            {{ Form::close() }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script>
        function changeStatus(payload) {
            $('#status-input-hidden').val(payload);
            let $bookingRequestStatusForm = $('#booking-request-status-form');

            if (payload == 'verified') {
                $bookingRequestStatusForm.attr('action', '{!! route('booking-request-status.approve', $roomBooking) !!}');
            }

            if (payload == 'approved') {
                $bookingRequestStatusForm.attr('action', '{!! route('booking-request-status.approve', $roomBooking) !!}');
            } else {
                $bookingRequestStatusForm.attr('action', '{!! route('booking-request-status.edit', $roomBooking) !!}');
            }

            $bookingRequestStatusForm.submit();
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#PrintCommand').on('click', function () {
                printContent('Data', '', '');
            });

            var printContent = function (id, division, report_type) {
                var table = document.getElementById(id).innerHTML;
                newwin = window.open('', 'printwin', 'left=70,top=70,width=850,height=500');
                newwin.document.write(' <html>\n <head>\n');

                @php
                    $data = "'" .

                        '\t<link rel="stylesheet" type="text/css" href="' . asset('css/app.css') . '"/>\n' . "'";
                @endphp
                newwin.document.write(<?php echo $data ?>);
                newwin.document.write('<title></title>\n');
                newwin.document.write(' <script>\n');
                newwin.document.write('function chkstate(){\n');
                newwin.document.write('if(document.readyState=="complete"){\n');
                newwin.document.write('window.close()\n');
                newwin.document.write('}\n');
                newwin.document.write('else{\n');
                newwin.document.write('setTimeout("chkstate()",2000)\n');
                newwin.document.write('}\n');
                newwin.document.write('}\n');
                newwin.document.write('function print_win(){\n');
                newwin.document.write('window.print();\n');
                newwin.document.write('chkstate();\n');
                newwin.document.write('}\n');
                newwin.document.write('<\/script>\n');
                newwin.document.write('<style type="text/css">  body{margin: 0px 50px}</style>\n');
                newwin.document.write('</head>\n');
                newwin.document.write('<body onload="print_win()"><div>\n');
                newwin.document.write('<h1 class="text-center"> @lang('hm::booking-request.booking_request') </h1>\n');
                newwin.document.write(table);
                newwin.document.write('</div></body>\n');
                newwin.document.write('</html>\n');
                newwin.document.close();
                return true;
            };
        })
    </script>
@endpush





