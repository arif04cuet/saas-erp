<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Simple Transactional Email</title>
    <style>
        /* -------------------------------------
            INLINED WITH htmlemail.io/inline
        ------------------------------------- */
        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }

            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }

            table[class=body] .content {
                padding: 0 !important;
            }

            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table[class=body] .btn table {
                width: 100% !important;
            }

            table[class=body] .btn a {
                width: 100% !important;
            }

            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            .btn-primary table td:hover {
                background-color: #34495e !important;
            }

            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }
    </style>
</head>
<body class=""
      style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
<table border="0" cellpadding="0" cellspacing="0" class="body"
       style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
    <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container"
            style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
            <div class="content"
                 style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <!-- START CENTERED WHITE CONTAINER -->
                <span class="preheader"
                      style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">
                    {{--This is preheader text. Some clients will show this text as a preview.--}}
                </span>
                <table class="main"
                       style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper"
                            style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                            <table border="0" cellpadding="0" cellspacing="0"
                                   style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: bold; margin: 0; Margin-bottom: 15px; border-bottom: 2px solid gray;">@lang('hm::booking-request.booking_details')
                                            ,</p>
                                        {{--<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>--}}
                                        {{--starting mailing--}}
                                        <div id="Data">

                                            <div class="card-body" style="padding-left: 20px;">
                                                {{--<p><span class="text-bold-600"></span></p>--}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="table-responsive">
                                                            <table>
                                                                <tbody>
                                                                <tr>
                                                                    <td class="width-150"
                                                                        style="margin-right: 20px">@lang('hm::booking-request.request_id')</td>
                                                                    <td class="width-300">
                                                                        : {{ isset($roomBooking->shortcode) ? $roomBooking->shortcode : '' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.requested_on')</td>
                                                                    <td>
                                                                        : {{ $roomBooking->created_at->format('d/m/Y') }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.booked_by')</td>
                                                                    <td>: {{ $roomBooking->requester->getName() }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.organization')</td>
                                                                    <td>
                                                                        : {{ $roomBooking->requester->organization }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.designation')</td>
                                                                    <td>
                                                                        : {{ $roomBooking->requester->designation }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.organization_type')</td>
                                                                    <td>
                                                                        : @if(!is_null($roomBooking->requester->organization_type))
                                                                            @lang('hm::booking-request.' .$roomBooking->requester->organization_type)
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.contact')</td>
                                                                    <td>: {{ $roomBooking->requester->contact }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.email')</td>
                                                                    <td>: {{ $roomBooking->requester->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.address')</td>
                                                                    <td>: {{ $roomBooking->requester->address }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.booking_type')</td>
                                                                    <td>
                                                                        : {{ trans("hm::booking-request.$roomBooking->booking_type")}}
                                                                        &nbsp;&nbsp;
                                                                    </td>

                                                                </tr>
                                                                @if ($roomBooking->type == 'checkin')
                                                                    <tr>
                                                                        <td style="margin-right: 20px">@lang('hm::booking-request.check_in')</td>
                                                                        <td>: {{  $roomBooking->start_date }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="margin-right: 20px">@lang('hm::booking-request.check_out')</td>
                                                                        <td>: {{ $roomBooking->end_date }}</td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.no_of_guests')</td>
                                                                    <td>: {{ $roomBooking->guestInfos->count() }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.no_of_rooms')</td>
                                                                    <td>
                                                                        : {{ $roomBooking->roomInfos->sum('quantity') }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.room_details')</td>
                                                                    <td>:
                                                                        @foreach($roomBooking->roomInfos as $roomInfo)
                                                                            {{ $roomInfo->quantity }}
                                                                            ({{ $roomInfo->roomType->name }})
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: bold; margin-top: 20px; Margin-bottom: 15px; border-bottom: 2px solid gray;">
                                            @lang('hm::booking-request.bard_reference_info'),</p>
                                        <div id="Data">

                                            <div class="card-body" style="padding-left: 20px;">
                                                {{--<p><span class="text-bold-600"></span></p>--}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive table-bordered mb-0">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="width-150"
                                                                        style="margin-right: 20px">@lang('hm::booking-request.bard_reference')</td>
                                                                    <td class="width-300">
                                                                        : {{ $roomBooking->referee ? $roomBooking->referee->getName() : null }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.designation')</td>
                                                                    <td>
                                                                        : {{ $roomBooking->referee ? $roomBooking->referee->designation->name : null }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.department')</td>
                                                                    <td>
                                                                        : {{ $roomBooking->referee ? $roomBooking->referee->employeeDepartment->name : null }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.contact')</td>
                                                                    <td>
                                                                        : {{ $roomBooking->referee ? $roomBooking->referee->getContact() : null }}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($roomBooking->guestInfos->count())

                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: bold; margin-top: 20px; Margin-bottom: 15px; border-bottom: 2px solid gray;">
                                                @lang('hm::booking-request.guest_information'),</p>
                                            <div id="Data">
                                                <div class="card-body" style="padding-left: 20px;">
                                                    {{--<p><span class="text-bold-600"></span></p>--}}
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table cellpadding="10" cellspacing="5"
                                                                   class="table table-striped table-bordered"
                                                                   style="margin-left: 15px;margin-right: 15px; border: 1px solid;">
                                                                <thead>
                                                                <tr style="border-bottom: 1px solid grey">
                                                                    <th style="margin-right: 30px">@lang('labels.serial')</th>
                                                                    <th style="margin-right: 30px">@lang('labels.name')</th>
                                                                    <th style="margin-right: 30px">@lang('hm::booking-request.age')</th>
                                                                    <th style="margin-right: 30px">@lang('hm::booking-request.gender')</th>
                                                                    <th style="margin-right: 30px">@lang('hm::booking-request.address')</th>
                                                                    <th style="margin-right: 30px">@lang('hm::booking-request.relation')</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($roomBooking->guestInfos as $guestInfo)
                                                                    <tr style="border-bottom: 1px solid gray;">
                                                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                                                        <td style="text-align: center">{{ $guestInfo->first_name . " " .$guestInfo->middle_name. " " .$guestInfo->last_name}}</td>
                                                                        <td style="text-align: center">{{ $guestInfo->age ? : '' }}</td>
                                                                        <td style="text-align: center">{{ trans("hm::booking-request.$guestInfo->gender")  }}</td>
                                                                        <td style="text-align: center">{{ $guestInfo->address }}</td>
                                                                        <td style="text-align: center">{{ trans("hm::booking-request.relation_$guestInfo->relation")  }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            {{--ending mailing--}}
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

                <!-- START FOOTER -->
            {{--<div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">--}}
            {{--<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">--}}
            {{--<tr>--}}
            {{--<td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">--}}
            {{--<span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>--}}
            {{--<br> Don't like these emails? <a href="http://i.imgur.com/CScmqnj.gif" style="text-decoration: underline; color: #999999; font-size: 12px; text-align: center;">Unsubscribe</a>.--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
            {{--<td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">--}}
            {{--Powered by <a href="http://htmlemail.io" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">HTMLemail</a>.--}}
            {{--</td>--}}
            {{--</tr>--}}
            {{--</table>--}}
            {{--</div>--}}
            <!-- END FOOTER -->

                <!-- END CENTERED WHITE CONTAINER -->
            </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
    </tr>
</table>
</body>
</html>
