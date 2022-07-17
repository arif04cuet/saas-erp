<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>@lang('tms::schedule.email.title')</title>
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
      style="background-color: transparent; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
<table border="0" cellpadding="0" cellspacing="0" class="body"
       style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: transparent;">
    <tr style="background: none;">
        <td style="font-family: sans-serif; font-size: 16px; vertical-align: top;">@lang('labels.dear')
            <b>{{ $trainee->bangla_name }}</b>, <br></td>
    </tr>
    <tr style="background: none;">
        <td style="font-family: sans-serif; font-size: 16px; vertical-align: top;">@lang('tms::schedule.email.description')</b>
            <br></td>
    </tr>
    <tr>
        <td class="container"
            style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0; max-width: 580px; padding: 0; width: 600px;">
            <div class="content"
                 style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">
                @if(count($data))
                    @foreach($data as $key => $schedules)
                        <h3 style="text-align: center; font-size: 20px;">{{ $schedules['course_name'] ?? '' }}</h3>
                        <table class="text-center table-bordered"
                               style="border: 1px solid #000000; border-collapse: collapse;" border="1">
                            <thead style="border: 1px solid #000000">
                            <tr style="border: 1px solid #000000;">
                                <th style="padding: 5px; background: lightgrey;">@lang('tms::module.title')</th>
                                <th style="padding: 5px; background: lightgrey;">@lang('tms::session.title')</th>
                                <th style="padding: 5px; background: lightgrey;">@lang('labels.date')</th>
                                <th style="padding: 5px; background: lightgrey;">@lang('tms::schedule.fields.start')</th>
                                <th style="padding: 5px; background: lightgrey;">@lang('tms::schedule.fields.end')</th>
                                <th style="padding: 5px; background: lightgrey;">@lang('tms::speaker.title')</th>
                                <th style="padding: 5px; background: lightgrey;">@lang('tms::venue.title.default')</th>
                            </tr>
                            </thead>
                            <tbody style="border: 1px solid #000000;">
                            @if(count($schedules))
                                @foreach($schedules as $schedule)
                                    <tr style="border: 1px solid #000000;">
                                        <td style="padding: 5px;">{{ $schedule['module_name'] }}</td>
                                        <td style="padding: 5px;">{{ $schedule['session_name'] }}</td>
                                        <td style="padding: 5px;">{{ $schedule['session_date'] }}</td>
                                        <td style="padding: 5px;">{{ $schedule['session_start'] }}</td>
                                        <td style="padding: 5px;">{{ $schedule['session_end'] }}</td>
                                        <td style="padding: 5px;">{{ $schedule['speaker_name'] }}</td>
                                        <td style="padding: 5px;">{{ $schedule['venue_name'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    @endforeach
                @endif
            </div>
        </td>
    </tr>
    <tr style="background: none; margin-top: 10px;">
        <td style="font-family: sans-serif; font-size: 16px; vertical-align: top; horiz-align: left;">
            <h3 style="text-align: left; color: red;">@lang('tms::schedule.evaluation.text', ['attribute' => trans('tms::schedule.evaluation.link')])</h3>
        </td>
    </tr>
    <tr style="background: none; margin-top: 10px;">
        <td style="font-family: sans-serif; font-size: 16px; vertical-align: top;">
            @lang('labels.thank_you'),
        </td>
    </tr>
    <tr style="background: none;">
        <td style="font-family: sans-serif; font-size: 16px; vertical-align: top;">
            @lang('labels.bangladesh_rural_development_academy') (@lang('labels.BARD ERP'))
        </td>
    </tr>
</table>
</body>
</html>
