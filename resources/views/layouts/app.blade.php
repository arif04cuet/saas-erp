<!DOCTYPE html>
<html class="loading" lang="bn" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="RDCD ERP Solution.">
    <meta name="keywords" content="RDCD ERP Solution">
    <meta name="author" content="OrangeBD Limited.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- title -->
    <title>@yield('title') - {{ trans('labels.erp') }}</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.seat-charts.css') }}">
    <link rel="apple-touch-icon" href="{{ asset('theme/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
        rel="stylesheet"> --}}
    <link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/select2.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/toastr.min.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/cryptocoins/cryptocoins.css') }}">
    <!-- END Page Level CSS-->
    <!-- END Pick a Date CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/ui/jqueryui.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">

    <!-- Begin File uploader dropzone CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/file-uploaders/dropzone.css') }}">
    <!-- End File uploader dropzone CSS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/online-course.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master-template.css') }}">
    <!-- The Perfect Scrollbar CSS files -->
    <link href="{{asset('css/perfect-scrollbar.css')}}" rel="stylesheet">
    <!-- The Perfect Scrollbar JS files -->
    <script src="{{asset('js/perfect-scrollbar.js')}}"></script>

    <!-- Select2 -->
    <style>
        .select2 {
            width: 100% !important;
        }

    </style>
    <!-- End Select2 -->
    @stack('page-css')
</head>
<!-- <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns" > -->
<body>

    <div class="app-content">
       <!-- // NAVIGATION END // -->
        @include('layouts.partials.master_nav')

        <section class="master-template">

            <!-- // ADMIN ASIDE // -->
            <div class="exhauster">
                <div class="master-aside" id="scrollbar">
                    @yield('menu')
                </div>
            </div>

           <!-- // PAGE CONTENT // -->
            <div class="master-content">
                @yield('content')
            </div>

            @include('layouts.partials.master_footer')
        </section>
        <!-- // -->
    </div>

    <!-- fixed-top-->
    @php
        // if(!auth()){
        //     $doptorName = 'Rural Development & Coo-operative Division';
        // }else{
        //     $doptorName = auth()->user()->doptor->getName();
        // }
    @endphp


    {{-- @include('layouts.partials.fixed_top',['doptorName' => $doptorName]) --}}

    {{-- 
    @include('layouts.partials.fixed_top')
    @yield('menu')
    <div class="app-content content card-print">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @include('layouts.partials.old_alert_message')
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.partials.footer')
    --}}


    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('theme/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('theme/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('theme/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script> --}}
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "search": "{{ trans('labels.search') }}",
                "emptyTable": "{{ trans('labels.empty_table') }}",
                "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                "info": "{{ trans('labels.showing') }} _START_ {{ trans('labels.to') }} _END_ {{ trans('labels.of') }} _TOTAL_ {{ trans('labels.records') }}",
                "infoEmpty": "{{ trans('labels.showing') }} 0 {{ trans('labels.to') }} _END_ {{ trans('labels.of') }} _TOTAL_ {{ trans('labels.records') }}",
                "infoFiltered": "( {{ trans('labels.total') }} _MAX_ {{ trans('labels.infoFiltered') }} )",
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
    {{-- <script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="{{ asset('theme/vcendors/js/charts/echarts/echarts.js') }}" type="text/javascript"></script> --}}
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('theme/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('theme/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/core/app.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('theme/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/ui/jquery-ui/date-pickers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/ui/jquery.sticky.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('theme/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/moment-with-locales.min.js') }}" type="text/javascript"></script>

    
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}" type="text/javascript"></script>
    
    

    {{-- <script src="{{ asset('theme/js/scripts/customizer.js') }}" type="text/javascript"></script> --}}
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="{{ asset('theme/js/scripts/pages/dashboard-crypto.js') }}" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL JS-->
    <!-- helper js (developer-end) -->
    <script src="{{ asset('js/helper.js') }}" type="text/javascript"></script>
    <script src="http://dashboard.rdcd.orangebd.com/components/app-switcher/app-switcher.js" type="text/javascript"></script>
    <script src="{{asset('js/master-template.js')}}" type="text/javascript"></script>

    <script>
        (new AppSwitcher()).serve({
            dashboard_url : 'http://dashboard.rdcd.orangebd.com',
            token         : '',
            onLogout:(response)=>{

            },
            onSwitch:(model)=>{
               console.log(model);
            },
         });
    </script>

    @stack('page-js')
    @include('layouts.partials.alert_message')
</body>

</html>
