<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Booking Request Approval</title>
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

            .btn {
                font-size: 14px;
                padding: 6px 12px;
                margin-bottom: 0;
                font-weight: 600;
                display: inline-block;
                text-decoration: none;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
            }

            /* default
            ---------------------------- */
            .btn-default {
                color: #fff;
                background-color: #3097d1;
                border-color: #ccc
            }
            a.btn.btn-default {
                margin-left: 35%;
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
                        <td><br><br>
                            <div class="card-body" style="padding-left: 20px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>
                                            {{__('hm::booking-request.recipient_addressing')}}
                                            {{$roomBooking->requester->getName()}},<br>

                                        </strong>
                                        @if($roomBooking->status == "approved")
                                            {{__('hm::booking-request.vendor_approval_done_mail')}}
                                        @else {{__('hm::booking-request.vendor_approval_reject_mail')}}
                                        @endif

                                        <br> <br>

                                        <a href="{{url(route('public-booking-request.confirmation',
                                            $roomBooking->getPhysicalFacilityUID()))}}" class="btn btn-default" target="_blank">এখানে ক্লিক করুন
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div> <br>
                                <img src="{{URL::asset('/images/letter-header.png')}}"
                                     width="600" alt="profile Pic">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="wrapper"
                            style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                            <table border="0" cellpadding="0" cellspacing="0"
                                   style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">

                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                                        <div id="Data">
                                            <div class="card-body" style="padding-left: 20px;">
                                                {{--<p><span class="text-bold-600"></span></p>--}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="table-responsive">
                                                            <table>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div style="width: 380px;
                                                                        float: left">
                                                                            <p>জনাব {{ $roomBooking->requester->getName() }}</p>
                                                                            <p>{{ $roomBooking->requester->designation
                                                                        }}</p>
                                                                            <p>{{ $roomBooking->requester->organization }}</p>
                                                                            <p>{{ $roomBooking->requester->address }}</p> <br>
                                                                            <p>বিষয়ঃ হোস্টেল সুবিধা বরাদ্দ প্রসঙ্গে। </p>
                                                                        </div>
                                                                        <div style="width: 150px; float: right;"><p style="text-align: right">তারিখ: {{date('d/m/Y')}}</p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                   <td>
                                                                       প্রিয় মহোদয়, <br>
                                                                       &nbsp;&nbsp;&nbsp; উপর্যুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে
                                                                       যে,
                                                                       আপনার প্রস্তাবিত সম্মেলন উপলক্ষে নিম্নোক্ত হারে
                                                                       অংশগ্রহণকারীগণ  {{ \Illuminate\Support\Carbon::parse($roomBooking->start_date)->format('d/m/Y') }}
                                                                       তারিখ অপরাহ্ণ ৪:০০ ঘটিকায় বার্ড হোস্টেলে আসবেন এবং
                                                                       {{ \Illuminate\Support\Carbon::parse($roomBooking->end_date)->format('d/m/Y') }} তারিখ অপরাহ্ণ
                                                                       ২:০০ ঘটিকায় নির্ধারিত ভাড়া পরিশোধের শর্তে একাডেমির
                                                                       হোস্টেল ত্যাগ করবেন (ফোন: পিএবিএক্স (০৮১)
                                                                       ৬০৬০১-৬ (হোস্টেল:৩৭৯)। <br><br>
                                                                       আবাসন ব্যবস্থা ও ইউটিলিটি চার্জ হবে নিম্নরূপ:
                                                                   </td>
                                                                    <td>

                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  <br>

                                        <div id="Data">
                                            <div class="card-body" style="padding-left: 20px;">
                                                {{--<p><span class="text-bold-600"></span></p>--}}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="table-responsive">
                                                            <table>
                                                                <tbody>

                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.booking_type')</td>
                                                                    <td>: @lang('hm::booking-request.' . $roomBooking->booking_type)</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.check_in')</td>
                                                                    <td>: {{  $roomBooking->start_date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="margin-right: 20px">@lang('hm::booking-request.check_out')</td>
                                                                    <td>: {{ $roomBooking->end_date }}</td>
                                                                </tr>
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
                                                                            {{--{{ $roomInfo->quantity }}--}}
                                                                            {{ $roomInfo->roomType->name }},
                                                                            {{$roomInfo->roomType->non_government_rate}} টাকা/দিন
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

                                        <div>
                                            <p>হোস্টেল স্থানান্তর/পরিবর্তন/বাতিলের পূর্ণ ক্ষমতা বার্ড কর্র্তৃপক্ষ সংরক্ষণ করে। বর্ণিত বিষয়ে আপনার আন্তরিক সহযোগিতা কামনা করি।</p>
                                        </div>

                                        <div class="row">
                                            <div style="float: left; width: 300px"></div>
                                            <div style="float: right; width: 150px">
                                                <p>(মোহাম্মদ আবদুল কাদের) <br>
                                                    পরিচালক (প্রশিক্ষণ)</p>
                                            </div>
                                        </div> <br><br>

                                        <div>
                                            <pre>
<b>অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুলিপি প্রেরণ করা হলো:</b>
০১। পরিচালক (প্রশাসন), বার্ড।
০২। যুগ্ম-পরিচালক (প্রশিক্ষণ), বার্ড।
০৩। উপ-পরিচালক (প্রশিক্ষণ), বার্ড।
০৪। সহকারী পরিচালক (প্রশিক্ষণ), বার্ড।
০৫। হিসাব রক্ষণ কর্মকর্তা, বার্ড।
০৬। সহকারী প্রকৌশলী, বার্ড-বিদ্যুৎ ব্যবস্থা নিশ্চিত করার জন্য।
০৭। প্রশিক্ষণ কর্মকর্তা, বার্ড।
০৮। সেকশন অফিসার (ক্যাফেটেরিয়া, হোস্টেল, অবধায়ন), বার্ড।
০৯। মহাপরিচালকের ব্যক্তিগত সহকারী- মহাপরিচালক মহোদয়ের সদয় অবগতির জন্য।
১০। বিদ্যুৎ সুপার, বার্ড।
১১। যোগাযোগ শাখা, বার্ড।
১২। প্রধান ফটক, বার্ড।
১৩। অফিস কপি/মাস্টার কপি।
                                            </pre>
                                        </div> <br>

                                        <div class="row">
                                            <div style="width: 400px; float: left"></div>
                                            <div style="width: 100px; float: right">
                                                পরিচালক (প্রশিক্ষণ)
                                            </div>
                                        </div>




                                    </td>
                                </tr>
                            </table>
                            {{--ending mailing--}}
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

            </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
    </tr>
</table>
</body>
</html>
