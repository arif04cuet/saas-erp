<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="RDCD Training Solution.">
    <meta name="keywords"
          content="RDCD Training Solution">
    <meta name="author" content="OrangeBd Limited.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- title -->
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.seat-charts.css') }}">
    <link rel="apple-touch-icon" href="{{ asset('theme/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/master-template.css') }}"
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/menu/menu-types/vertical-menu.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/cryptocoins/cryptocoins.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Pick a Date CSS -->

    <!-- END Pick a Date CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/ui/jqueryui.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">


    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
    <!-- END Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}"> --}}
    <!-- Select2 -->
    <style>
        .select2 {
            width: 100% !important;
        }
        .header-navbar .navbar-container.content {
            margin-left: 120px !important;
        }

        .header-navbar .navbar-header {
            width: 120px;
        }

        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes menuSlideLeftToRight {
            from {top: 0px;}
            to {top: 200px;}
        }

        /* Standard syntax */
        @keyframes menuSlideLeftToRight {
            from {transform: translate(-300px, 0); display: block}
            to {transform: translate(0, 0)}
        }
        /*** Medium devices (tablets, less than 992px) ***/
        @media screen and (max-width: 991.98px) {
            .header-navbar .navbar-container {
                padding: 0 !important;
            }
            .navbar-light {
                background-color: transparent !important;
            }
            .header-navbar .navbar-header {
                width: 100% !important;
                background-color: #fff;
            }
            .header-navbar .navbar-toggler {
                position: absolute;
                left: 18px;
                top: 18px;
                border-radius: 2px;
                z-index: 99999;
            }
            .navbar-header ul.nav {
                justify-content: center;
            }
            .header-navbar .navbar-container ul {
                margin-top: 70px;
                width: 250px;
                min-height: 300px;
                background-color: #fff;
                padding: 10px 19px 15px 19px;
                margin-left: 0 !important;
                box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.1);
                border-radius: 0;
            }
            .header-navbar .navbar-container ul li {}
            .header-navbar .navbar-container ul li a {
                text-align: left;
                padding: 10px 0 !important;
            }
            .header-navbar .navbar-container.content {
                margin-left: auto !important;
            }
            .header-navbar .navbar-container .navbar-collapse,
            .header-navbar .navbar-container .collapse {
                transform: translate(-300px, 0);
            }
            .header-navbar .navbar-container .navbar-collapse.show,
            .header-navbar .navbar-container .collapse.show {
                transform: translate(0, 0);
                -webkit-animation: menuSlideLeftToRight 0.52s ; /* Safari 4.0 - 8.0 */
                animation: menuSlideLeftToRight 0.52s ;
            }

        }
        @media screen and (max-width: 767.98px) {
            .header-navbar .navbar-container.content {
                margin-left: 0 !important;
                background-color: transparent !important;
            }
            .header-navbar .navbar-container ul {
                flex-flow: column !important;
            }
        }

    </style>
    <!-- End Select2 -->
    @stack('page-css')
</head>
<body class="vertical-layout 2-columns fixed-navbar" data-open="click" data-col="2-columns">
<!-- fixed-top-->
{{-- @include('layouts.partials.public_fixed_top') --}}
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            {{-- @include('layouts.partials.alert_message') --}}
            @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
{{--@include('layouts.partials.footer')--}}
<!-- BEGIN VENDOR JS-->
<script src="{{ asset('theme/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "search": "{{ trans('labels.search') }}",
            "emptyTable": "{{ trans('labels.empty_table') }}",
            "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
            "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
            "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
            "infoEmpty": "{{trans('labels.showing')}} 0 {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
            "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
            "paginate": {
                "first": '{!! trans('labels.first') !!}',
                "last": '{!! trans('labels.last') !!}',
                "next": "{{ trans('labels.next') }}",
                "previous": "{{ trans('labels.previous') }}"
            },
        }
    });
</script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
{{--<script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('theme/vcendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script>--}}
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{ asset('theme/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('theme/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"></script>

<script src="{{ asset('theme/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/ui/jquery-ui/date-pickers.js') }}" type="text/javascript"></script>


<script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
<script src="{{ asset('theme/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>


{{--<script src="{{ asset('theme/js/scripts/customizer.js') }}" type="text/javascript"></script>--}}
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{--<script src="{{ asset('theme/js/scripts/pages/dashboard-crypto.js') }}" type="text/javascript"></script>--}}
<!-- END PAGE LEVEL JS-->
@stack('page-js')
@include('layouts.partials.alert_message')
</body>
</html>
