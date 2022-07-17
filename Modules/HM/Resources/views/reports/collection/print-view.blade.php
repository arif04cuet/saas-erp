@extends('hm::layouts.master')
@section('title', trans('hm::report.collection_register_report'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">
                <div class="card">

                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' =>  'collection-report.filter', 'id' =>'cash-book-entry-form','class' => 'form novalidate']) !!}
                            <h3 class="form-section"><i
                                    class="la la-tag"></i>@lang('hm::report.collection_register_report')</h3>

                            <!-- Employee and Structure -->
                            <div class="row">
                                <!-- Fiscal Year -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('period_month',trans('hm::report.date_from'), ['class' => 'form-label']) !!}
                                        {!! Form::text('period_from', isset($fromDate) ? $fromDate : null,
                                                ['class' => 'form-control required',
                                                        'data-validation-required-message'=>trans('validation.required',
                                                        ['attribute' => trans('labels.start')])
                                                ]
                                            )
                                         !!}
                                    </div>
                                </div>

                                <!-- Period To  -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('period_to', trans('hm::report.date_to'), ['class' => 'form-label']) !!}
                                        {!! Form::text('period_to', isset($toDate) ? $toDate: date('Y-m-t'),
                                                ['class' => 'form-control required',
                                                       'data-validation-required-message'=>trans('validation.required',
                                                        ['attribute' => trans('labels.start')])
                                                ]
                                            )
                                         !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 25px">
                                            <i class="la la-search"></i> @lang('hm::report.search')
                                        </button>

                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="text-center">
                                        <a id="PrintCommand" style="margin-top: 25px"
                                           class="form-control btn btn-default" href="#"><i class="la la-print"></i>
                                            @lang('hm::report.print')
                                        </a>
                                    </div>
                                </div>


                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="card" id="printDiv">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <section id="payslip-list">
                                <h3 class="text-center"> @lang('hm::report.bard_title')</h3>
                                <h3 class="text-center"> @lang('hm::report.bard_address')</h3>
                                <div class="row">
                                    <div class="col-xl-12 ">
                                        <div class="card">
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <div style="border: 2px solid gray">
                                                        <h2 class="text-center">@lang('hm::report.hostel_branch')</h2>
                                                        <h2 class="text-center">@lang('hm::report.bill_title')</h2>
                                                        <h2 class="text-center">
                                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn($fromDay ?? 0,false)}}
                                                            {{ \App\Utilities\MonthNameConverter::convertMonthToBn($fromMonthYear)}} -
                                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn($toDay ?? 0,false)}}
                                                            {{ \App\Utilities\MonthNameConverter::convertMonthToBn($toMonthYear)}}
{{--                                                            {{ $fromDate }} - {{$toDate}}--}}
                                                            (@lang('hm::report.eng'))</h2>
                                                    </div>
                                                    <br/>
                                                    <hr class="border-2"/>
                                                    <br/><br/>
                                                    <br/>
                                                    <div class="row ">
                                                        <div class="">
                                                            <table class="table table-responsive table-borderless">
                                                                <tr>
                                                                    <td><h3><span style="font-size: 20px">➢</span>
                                                                            @lang('hm::report.course_due_title') - </h3>
                                                                    </td>
                                                                    <td></td>
                                                                    <td><h3>

                                                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn(intval($reports['course_due_amount'] ?? 0,false))}}
                                                                            /-
                                                                            {{ \App\Utilities\EnToBnNumberConverter::convertToWords(intval($reports['course_due_amount']))}}
                                                                        </h3>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><h3><span style="font-size: 20px">➢</span>
                                                                            @lang('hm::report.other_due_title') -
                                                                        </h3>
                                                                    </td>
                                                                    <td></td>
                                                                    <td>
                                                                        <h3>
                                                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn(intval($reports['other_due_amount'] ?? 0,false))}}
                                                                            /-
                                                                            {{ \App\Utilities\EnToBnNumberConverter::convertToWords(intval($reports['other_due_amount']))}}
                                                                        </h3>
                                                                    </td>
                                                                </tr>
                                                                @if($reports['other_due_amount']>0 || $reports['course_due_amount']> 0)
                                                                    <tr>
                                                                        <td><h3><span style="font-size: 20px">➢</span>
                                                                                @lang('hm::report.remaining_amount_message')
                                                                            </h3>
                                                                        </td>
                                                                        <td></td>
                                                                    </tr>
                                                                @endif
                                                                <tr style="border-top: 2px solid gray">
                                                                    <td><h3><span style="font-size: 20px">✥</span>
                                                                            @lang('hm::report.total_due_title') -
                                                                        </h3>
                                                                    </td>
                                                                    <td></td>
                                                                    <td><h3>
                                                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn(intval($reports['total_due_amount'] ?? 0,false))}}
                                                                            /-
                                                                            {{ \App\Utilities\EnToBnNumberConverter::convertToWords(intval($reports['total_due_amount']))}}

                                                                        </h3></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <div class="row ">
                                                        <div class="">
                                                            <table class="table table-responsive table-borderless">
                                                                <tr>
                                                                    <td><h3><span style="font-size: 20px">➢</span>
                                                                            @lang('hm::report.course_paid_title')-
                                                                        </h3>
                                                                    </td>
                                                                    <td></td>
                                                                    <td><h3>

                                                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn(intval($reports['course_paid_amount'] ?? 0,false))}}
                                                                            /-
                                                                            {{ \App\Utilities\EnToBnNumberConverter::convertToWords(0)}}


                                                                        </h3></td>
                                                                </tr>
                                                                <tr style="border-top: 2px solid gray">
                                                                    <td><h3><span style="font-size: 20px">✥</span>
                                                                            @lang('hm::report.total_paid_title')-
                                                                        </h3>
                                                                    </td>
                                                                    <td></td>
                                                                    <td>
                                                                        <h3>
                                                                            {{ \App\Utilities\EnToBnNumberConverter::en2bn(intval($reports['course_paid_amount'] ?? 0,false))}}
                                                                            /-
                                                                            {{ \App\Utilities\EnToBnNumberConverter::convertToWords(intval($reports['course_paid_amount']))}}
                                                                        </h3>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <br/><br/>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <h5>{{ Auth::user()->name }}</h5>
                                                            <h5>{{ isset(Auth::user()->employee->designation->name) ? Auth::user()->employee->designation->name : '' }}</h5>
                                                            <h5>{{ isset(Auth::user()->employee->employeeDepartment->name) ? Auth::user()->employee->employeeDepartment->name : '' }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')

    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <!-- Icheck and Checkbox -->
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>

    <script type="text/javascript">

            {{--let selectPlaceholder = '{!! trans('labels.select') !!}';--}}
        let title = "";

        let year = new Date().getFullYear();
        let month = new Date().getMonth();

        let periodFrom = $('input[name=period_from]').pickadate({
            // min: new Date(year, month, 2),
            format: "yyyy-mm-dd",
        });

        let periodTo = $('input[name=period_to]').pickadate({
            // min: new Date(year, month, 1),
            format: "yyyy-mm-dd",
        });


        let table = $('#cash-book-entry-table').dataTable({});

    </script>


    <script>
        $(document).ready(function () {
            $('#PrintCommand').on('click', function () {
                printContent('printDiv');
            });

            var printContent = function (id) {
                var table = document.getElementById(id).innerHTML;
                newwin = window.open('', 'printwin', 'left=10,top=70,width=1200,height=800');
                newwin.document.write(' <html>\n <head>\n');

                newwin.document.write('\t<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"/>\n');
                newwin.document.write('<title></title>\n');
                newwin.document.write(' <script>\n');
                newwin.document.write('function chkstate(){\n');
                newwin.document.write('if(document.readyState=="complete"){\n');
                newwin.document.write('window.close()\n');
                newwin.document.write('}\n');
                newwin.document.write('else{\n');
                newwin.document.write('setTimeout("chkstate()",2000)\n');
                newwin.document.write('}\n');
                newwin.document.write('}\n');
                newwin.document.write('function print_win(){\n');
                newwin.document.write('window.print();\n');
                newwin.document.write('chkstate();\n');
                newwin.document.write('}\n');
                newwin.document.write('<\/script>\n');
                newwin.document.write('<style type="text/css">  body{margin: 0px 50px;font-size: }</style>\n');
                newwin.document.write('</head>\n');
                newwin.document.write('<body onload="print_win()"><div>\n');
                // newwin.document.write('<h1 class="text-center">  বাংলাদেশ পল্লী উন্নয়ন একাডেমি (বার্ড), কুমিল্লা </h1>\n');
                newwin.document.write(table);
                newwin.document.write('</div></body>\n');
                newwin.document.write('</html>\n');
                newwin.document.close();
                return true;
            };
        })
    </script>

@endpush
