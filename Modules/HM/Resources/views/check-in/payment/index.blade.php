@extends('hm::layouts.master')
@section('title', trans('hm::checkin.payment_details'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('hm::checkin.payment_informations')</h4>
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
                        <div class="card-body" style="padding: 20px">
                            <!-- payment information -->
                            <div class="row" id="Data">
                                <div class="col-md-6">
                                    <p>
                                        <span
                                            class="text-bold-600">@lang('hm::booking-request.check_in') @lang('labels.information')</span>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-bordered mb-0">
                                            <tbody>
                                            <tr>
                                                <td class="width-150">@lang('hm::booking-request.check_in') @lang('labels.id')</td>
                                                <td class="width-300">{{ $checkin->shortcode }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('hm::booking-request.booking_type')</td>
                                                <td>@lang('hm::booking-request.' . $checkin->booking_type)</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('hm::booking-request.check_in')</td>
                                                <td>{{ \Carbon\Carbon::parse($checkin->start_date)->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('hm::booking-request.check_out')</td>
                                                <td>{{ \Carbon\Carbon::parse($checkin->end_date)->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('hm::booking-request.no_of_guests')</td>
                                                <td>{{ $checkin->guestInfos()->count() }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('hm::booking-request.no_of_rooms')</td>
                                                <td>{{ $checkin->roomInfos()->sum('quantity') }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('hm::booking-request.room_details')</td>
                                                <td>
                                                    @foreach($checkin->roomInfos as $roomInfo)
                                                        {{ $roomInfo->quantity }} ({{ $roomInfo->roomType->name }})
                                                    @endforeach
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- training information -->
                                @if(!is_null($training))
                                    <div class="col-md-6">
                                        <p>
                                            <span
                                                class="text-bold-600">{{trans('tms::training.show_form_title')}}
                                            </span>
                                        </p>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>{{trans('tms::training.unique_id')}}</td>
                                                <td>{{$training->uid ?? trans('labels.not_found')}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('tms::training.training_name')}}</td>
                                                <td>{{$training->title ?? trans('labels.not_found')}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{trans('tms::training.participant_types')}}</td>
                                                <td>{{ $participantTypes ?? trans('labels.not_found') }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{trans('tms::training.training_participant_no')}}</td>
                                                <td>{{$training->no_of_trainee ?? trans('labels.not_found')}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('tms::training.total_registered_trainees')}}</td>
                                                <td>{{$training->totel_registered_trainee ?? trans('labels.not_found')}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('tms::training.no_batches')}}</td>
                                                <td>{{ $training->no_of_batches ?? trans('labels.not_found') }}</td>
                                            </tr>

                                            <tr>
                                                <td>{{trans('tms::training.participant_types')}}</td>
                                                <td>{{ $participantTypes ?? trans('labels.not_found')}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{trans('tms::training.level')}}</td>
                                                <td>{{ $training->level ?? trans('labels.not_found')}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('labels.status')}}</td>
                                                <td>{{ $training->status ?? trans('labels.not_found') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif

                            </div>
                            <!-- payment details -->
                            @if(count($checkin->payments))
                                <div class="row">
                                    <div class="col-12">
                                        <p>
                                            <span class="text-bold-600">{{ trans('hm::bill.payment_details') }}</span>
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table table-bordered ">
                                                <thead>
                                                <tr>
                                                    <th>@lang('labels.serial')</th>
                                                    <th>@lang('hm::bill.title') @lang('labels.number')</th>
                                                    <th>@lang('labels.date')</th>
                                                    <th>@lang('labels.amount')</th>
                                                    <th>@lang('hm::bill.payment_method')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($checkin->payments as $payment)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $payment->shortcode }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($payment->create_at)->format('d/m/Y') }}</td>
                                                        <td>{{ $payment->amount }}</td>
                                                        <td>{{ trans('hm::checkin.' . $payment->type) }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="row border border-1">
                                            <div class="col">
                                                <span class="text-bold-600">@lang('hm::checkin.total_bill')
                                                    : {{ $totalBill }}</span>
                                            </div>
                                            <div class="col">
                                                <span class="text-bold-600">@lang('hm::checkin.total_payment')
                                                    : {{ $checkin->payments()->sum('amount') }}</span>
                                            </div>
                                            <div class="col">
                                                <span class="text-bold-600">@lang('hm::checkin.total_due')
                                                    : {{ $dueAmount }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endif
                            <div class="form-actions" style="padding-top: 16px">
                                <a class="btn btn-warning mr-1" role="button"
                                   href="{{ route('check-in.show',  $checkin->id) }}">
                                    <i class="ft-x"></i> @lang('labels.cancel')
                                </a>
                                @if($dueAmount != 0 )
                                    <a class="btn btn-success mr-1" role="button"
                                       href="{{ route('check-in-payments.create', $checkin->id) }}">
                                        <i class="ft-credit-card"></i> @lang('hm::checkin.make_payment')
                                    </a>
                                @endif
                                <button class="btn btn-primary" type="button" id="PrintCommand"><i
                                        class="ft ft-printer"></i> @lang('labels.print')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-js')
    <script>
        $(document).ready(function () {
            $('#PrintCommand').on('click', function () {
                printContent('Data', '', '');
            });

            var printContent = function (id, division, report_type) {
                var table = document.getElementById(id).innerHTML;
                newwin = window.open('', 'printwin', 'left=70,top=70,width=500,height=500');
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


