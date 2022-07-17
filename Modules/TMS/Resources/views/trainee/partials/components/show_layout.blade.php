@extends('tms::layouts.master')
@section('title', trans('tms::training.trainee_details'))

@section('content')
    <section id="user-list">
        <div class="row">
            <div class="col-12">
                <div class="card trainee-create-process-tab">

                    <div class="card-header hide">
                        <h4 class="card-title">{{trans('tms::training.trainee_details')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a  class="btn btn-primary" href="{{route('trainees.print',$trainee)}}">
                                        <i class="ft ft-printer"></i>
                                        @lang('labels.print')
                                    </a>
                                </li>
                                {{-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="card-body">
                                <div class="not-print">
                                    @include('tms::trainee.partials.nab-tabs.show')
                                </div>
                                <div class="tab-content px-1 pt-1">
                                    <div role="tabpanel"
                                         class="tab-pane active section-to-print">
                                        <!-- views are injected in slot -->
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <style>

        @media print {
            body * {
                visibility: visible;
            }

            .section-to-print {
                /* position: absolute; */
                background: white;
                top: -17px;
                left: 0px;
                width: 100%
            }

            .font-size {
                padding-top: 2.6rem;
                font-size: 30px
            }

            .card-print {
                width: 100%
            }

            .side-bar-print {
                position: absolute;
                left: -50%;
            }

            .hide {
                visibility: hidden;
                display: none;
            }

            .not-print {
                visibility: hidden;
                display: none;
            }

            .side-bar-print {
                left: -300px
            }

            .card-print {
                width: 1500px;
                left: 20px;
                top: 0px;
                font-size: 25px;
            }

            .main-menu .main-menu-content {
                margin-left: 1000px;
            }

            body.vertical-layout.vertical-menu.menu-expanded .main-menu {
                margin-left: -1000px;
            }

            .header-navbar.navbar-shadow {
                margin-top: -100px;
            }

            body.vertical-layout.vertical-menu.menu-expanded .content, body.vertical-layout.vertical-menu.menu-expanded .footer {
                margin-left: 0px;
            }

            .card {
                margin-bottom: 1.875rem;
                border: none;
                box-shadow: 0px 1px 15px 1px rgba(62, 57, 107, 0.07);
                width: 960px;
                left: 90px;
            }

            .table th, .table td {
                padding: 0.60rem 0.60rem;
                height: 70px;
                font-size: 35px
            }

            .general_info {
                margin-left: -40px;
                width: 1300px;
            }

            .Trainee_Service_print {
                margin-left: -40px;
                width: 1300px;
            }

            .Emergency_Contact_print {
                margin-left: -40px;
                width: 1300px;
            }

            .Health_Examination_Report_print {
                margin-left: -40px;
                width: 1300px;
            }

            .Final_Education_Information_print {
                margin-left: -40px;
                width: 1300px;
            }

        }

    </style>
@endpush

@push('page-js')
    <script>
        function printTraineeDetails() {
            window.print();
        }
    </script>
@endpush
