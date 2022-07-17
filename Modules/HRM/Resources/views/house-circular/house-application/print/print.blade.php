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
<!-- General Information Card -->
<div class="container ">
    <div class="row ">


        <div class="col-md-12 col-xl-12 ">
            <div class="card text-center ">

                <table class="table table-borderless text-center">
                    <tr class>
                        <td>
                            {{trans('labels.bard_title')}}
                        </td>
                    </tr>
                    <tr>
                        <td>{{trans('labels.bard_address.kotbari')}}
                            , {{trans('labels.bard_address.cumilla')}}</td>
                    </tr>

                </table>

                <div class="card-header ">
                    <h4 class="card-title">@lang('hrm::house-circular.application.details')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body ">
                        <div class="col-md-12">
                            @include('hrm::house-circular.house-application.print.print-content')
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="form-actions text-center">
                        <a class="btn btn-primary"
                           href="{{route('house-applications.index',$houseCircular->id)}}">
                            <i class="la la-backward"></i> {{trans('labels.back_page')}}
                        </a>
                        <a class="btn btn-warning" href="#" onclick="window.print()">
                            <i class="la la-print"></i> {{trans('labels.print')}}
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- DataTable Card -->
    </div>
</div>

</body>
</html>


<script>
    window.onload = function () {
        window.print();
    }
</script>
