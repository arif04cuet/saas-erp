<!DOCTYPE html>
<html class="loading" lang="bn" data-textdirection="ltr">
<head>
    <title> {{ trans('hm::report.budget.annual.title') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css')}} " media="print">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}" media="print">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <style>
        @media print {
            header {
                display: none;
            }

            a[href]:after {
                content: none !important;
            }

            .form-actions {
                display: none;
            }

            .ignore {
                display: none;
            }

            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 72px;
                padding-bottom: 72px;
                font-size: 18px;
            }
        }

    </style>
</head>

<body>
@include('tms::annual-training-notification.print.content')
</body>

<script>
    window.onload = function () {
        window.print();
    }
</script>

