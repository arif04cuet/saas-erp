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
            <b>{{ $recipient->getName() }}</b>, <br></td>
    </tr>
    <tr>
        <td class="container"
            style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0; max-width: 580px; padding: 0; width: 600px;">
            <div class="content"
                 style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <table class="text-center table-bordered" style="border: 1px solid #000000; border-collapse: collapse;"
                       border="1" align="center">
                    <thead style="border: 1px solid #000000">
                    <tr style="border: 1px solid #000000;">
                        <th style="padding: 5px; background: lightgrey;">@lang('tms::course.title')</th>
                        <th style="padding: 5px; background: lightgrey;">@lang('tms::module.title')</th>
                        <th style="padding: 5px; background: lightgrey;">@lang('tms::session.title')</th>
                        <th style="padding: 5px; background: lightgrey;">@lang('labels.date')</th>
                        <th style="padding: 5px; background: lightgrey;">@lang('tms::schedule.fields.start')</th>
                        <th style="padding: 5px; background: lightgrey;">@lang('tms::schedule.fields.end')</th>
                        <th style="padding: 5px; background: lightgrey;">@lang('tms::speaker.title')</th>
                        <th style="padding: 5px; background: lightgrey;">@lang('tms::venue.title')</th>
                    </tr>
                    </thead>
                    <tbody style="border: 1px solid #000000;">
                    <tr style="border: 1px solid #000000;">
                        <td style="padding: 5px;">{{ $data['course_name'] }}</td>
                        <td style="padding: 5px;">{{ $data['module_name'] }}</td>
                        <td style="padding: 5px;">{{ $data['session_name'] }}</td>
                        <td style="padding: 5px;">{{ $data['session_date'] }}</td>
                        <td style="padding: 5px;">{{ $data['session_start'] }}</td>
                        <td style="padding: 5px;">{{ $data['session_end'] }}</td>
                        <td style="padding: 5px;">{{ $data['speaker_name'] }}</td>
                        <td style="padding: 5px;">{{ $data['venue_name'] }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    <tr style="background: none;">
        <td style="font-family: sans-serif; font-size: 16px; vertical-align: top;">@lang('tms::trainee.email.description')</b>
            <br></td>
    </tr>
    <tr>
        <td class="container"
            style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0; max-width: 580px; padding: 0; width: 600px;">
            <div class="content"
                 style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">
                @if(count($data['trainees']))
                        <table class="text-center table-bordered"
                               style="border: 1px solid #000000; border-collapse: collapse;" border="1" align="center">
                            <thead style="border: 1px solid #000000">
                            <tr style="border: 1px solid #000000;">
                                <th style="padding: 5px; background: lightgrey;">@lang('labels.serial')</th>
                                <th data-index-key="trainee-en-name" style="padding: 5px; background: lightgrey;">@lang('tms::training.full_name')
                                    (@lang('tms::training.in_bangla'))
                                </th>
                                <th data-index-key="trainee-bn-name" style="padding: 5px; background: lightgrey;">@lang('tms::training.full_name')
                                    (@lang('tms::training.in_english'))
                                </th>
                                <th data-index-key="trainee-short_name_for_name_badge" style="padding: 5px; background: lightgrey;">@lang('tms::training.short_name_for_name_badge')
                                </th>
                                <th data-index-key="trainee-mobile" style="padding: 5px; background: lightgrey;">@lang('labels.mobile')</th>
                                <th data-index-key="trainee-email" style="padding: 5px; background: lightgrey;">@lang('tms::training.email')</th>
                            </tr>
                            </thead>
                            <tbody style="border: 1px solid #000000;">
                                @foreach($data['trainees'] as $trainee)
                                    <tr style="border: 1px solid #000000;">
                                        <td style="padding: 5px;">{{ $loop->iteration }}</td>
                                        <td style="padding: 5px;">{{ $trainee->bangla_name }}</td>
                                        <td style="padding: 5px;">{{ $trainee->english_name }}</td>
                                        <td style="padding: 5px;">{{ $trainee->badge_name }}</td>
                                        <td style="padding: 5px;">{{ $trainee->mobile }}</td>
                                        <td style="padding: 5px;">{{ $trainee->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                @endif
            </div>
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
