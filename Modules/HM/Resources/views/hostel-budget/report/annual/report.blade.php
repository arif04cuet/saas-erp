<!DOCTYPE html>
<html class="loading" lang="bn" data-textdirection="ltr">
<head>
    <title> {{ trans('hm::report.budget.annual.title') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css')}} " media="print">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}" media="print">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-xl-12 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="repeat-form">

                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">

                        <div class="print-section">
                            @include('hm::hostel-budget.report.annual.report-content')
                        </div>
                        <div class="form-actions text-center">
                            <a class="btn btn-primary"
                               href="{{route('hm.accounts.report.annual-budgets.index')}}">
                                Back
                            </a>
                            <a class="btn btn-warning" href="#" onclick="window.print()">
                                Print
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script>

    window.onload = function () {
        window.print();
    }

</script>
