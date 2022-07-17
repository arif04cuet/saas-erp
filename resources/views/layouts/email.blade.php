<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="BARD ERP Solution.">
    <meta name="keywords"
          content="BARD ERP Solution">
    <meta name="author" content="Brain Station - 23 & Inflack Limited.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- title -->
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('theme/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/cryptocoins/cryptocoins.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
    <!-- END Custom CSS-->
</head>
<body class="vertical-layout 2-columns fixed-navbar"
      data-open="click" data-col="2-columns">

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('theme/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>

</body>
</html>
