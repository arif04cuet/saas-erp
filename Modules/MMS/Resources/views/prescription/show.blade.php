@extends('mms::layouts.master')
@section('title', trans('mms::prescription.title'))
@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('mms::prescription.title')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements" style="top: 5px;">
                <ul class="list-inline mb-1">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
            <div class="heading-elements mt-2" style="margin-right: 10px;">
                <a href="{{ route('inventories.prescribed.create') }}?id={{$prescription->id}}" class="btn btn-info">
                    <i class="la la-plus"></i>@lang('mms::medicine_distribution.create')
                </a>
                <button type="button" class="btn btn-sm btn-primary" id="downloadPdf" onclick="printDiv()">
                    <i class="la la-print"></i> @lang('mms::prescription.prescriptions.print')
                </button>
            </div>
        </div>
        <div class="card-content " style="padding: 10px;" id="reportPage">
            <div style="width: 100%; margin-top: 0px;">
                <table style="width: 80%; text-align: center; margin: 0px auto; line-height: 14px;">
                    <tr>
                        <td colspan="2" class="text-center" style="">
                            <img style="margin-left:100px; margin-bottom: 9px;" class="brand-logo" alt="bard erp logo"
                                 src="{{ asset('images/logo.png') }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: right" rowspan="4">

                        </td>
                        <td><h4>@lang('mms::prescription.prescriptions.top_titel')</h4></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><h5>@lang('mms::prescription.prescriptions.2nd_top')</h5></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><h5>@lang('mms::prescription.prescriptions.3rd_top')</h5></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><h5>@lang('mms::prescription.prescriptions.4th_top')</h5></td>
                        <td style="text-align: right"><p><b>@lang('labels.date')
                                    : {{ date('d-M-Y', strtotime($prescription->date)) }}</b></p></td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <table class="table" style="width: 100%; border-top:1px #000 solid; border-bottom: 1px #000 solid;">
                    <th>@lang('labels.name') : {{$prescription->name}}</th>
                    <th>{{trans('mms::patient.age')}} : {{$prescription->age}}</th>
                    <th class="text-right">{{trans('mms::patient.mobile')}} : {{$prescription->mobile_no}}</th>
                </table>
                <p><span class="form-section"><b>@lang('mms::prescription.prescriptions.past_illness')</b></span>
                    : {{$prescription->past_illness}}</p>
                <p><span class="form-section"><b>@lang('mms::prescription.tab.symptoms')</b></span>
                    : {{$prescription->symptoms}}</p>

                <div style="width: 100%; float: left">
                    <div style="width: 40%; float: left;">
                        <p><span class="form-section"><b>O/E  : </b> </span></p>
                        <table>
                            @foreach ($allOeReport as $item)
                                <tr data-repeater-item>
                                    <td style="text-align: right;">
                                        <b>{{$item->oe_name}} &nbsp;&nbsp; : &nbsp;&nbsp;</b>
                                    </td>
                                    <td style="text-align: left">{{$item->oe_value}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div style="width: 60%; float: left">
                        {{-- RH --}}
                        <p><span class="form-section"><b>R/X</b></span>: </p>
                        <table id="medicineInfo" class="table"
                               style="width: 100%; border-top:1px #000 solid; border-collapse: collapse; text-align: center">
                            <tr>
                                <th style="border-bottom: 1px solid #ddd; text-align: left">@lang('mms::prescription.medicine')</th>
                                <th style="border-bottom: 1px solid #ddd;">@lang('mms::prescription.table.dose')</th>
                                <th style="border-bottom: 1px solid #ddd;"
                                    class="inventorField">@lang('mms::prescription.table.in_stock')</th>
                                <th style="border-bottom: 1px solid #ddd;">@lang('mms::prescription.table.total_medicine')</th>
                            </tr>
                            @foreach($medicine as $info)
                                <tr>
                                    <td style="border-bottom: 1px solid #ddd; text-align: left">@if(!empty($info->medicine)) {{$info->medicine->name}}@else {{$info->medicine_name}}@endif</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{$info->dose}}</td>
                                    <td style="border-bottom: 1px solid #ddd;"
                                        class="inventorField">{{$info->in_stock}}</td>
                                    <td style="border-bottom: 1px solid #ddd;">{{$info->total_medicine}}</td>
                                </tr>
                            @endforeach
                        </table>
                        @if(!empty($prescription->acknowledgement_slip))
                            <img src="{{ '/file/get?filePath='.$prescription->acknowledgement_slip }}"
                                 style="width: 100%; border: 1px #EEE solid" id="prescription_img">
                        @endif
                    </div>
                    {{-- </div> --}}
                </div>

                <div class="row">
                    <div class="col-12 col-md-12">
                        <br>
                        <p><span class="form-section"><b>  @lang('mms::prescription.test')</b></span> :&nbsp;
                            @foreach($test as $testInfo)
                                {{$testInfo->test_name}}&nbsp;,&nbsp;
                            @endforeach
                        </p>
                        <p><span class="form-section"><b>@lang('mms::prescription.tab.comments')</b></span>
                            : &nbsp;{{$prescription->comments}}</p>

                        <p style="text-align: center">@lang('mms::prescription.prescriptions.next_visit')</p>
                        <div id="2ndPage" style="border-top: 1px #CCC dotted">
                            <br>
                            <h4 style="text-align: center; font-size: bold">@lang('mms::prescription.prescriptions.last_titel')</h4>
                            <p>@lang('mms::prescription.prescriptions.last_pera')</p>
                            <p>@lang('mms::prescription.prescriptions.signature')
                                <br> @lang('mms::prescription.prescriptions.date')
                                <br> @lang('mms::prescription.prescriptions.name')
                                <br> @lang('mms::prescription.prescriptions.designation') </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('page-js')
    <script type="text/javascript">
        function printDiv() {
            $(".inventorField").css("display", "none");
            $("#2ndPage").css("page-break-before", "always");
            var divToPrint = document.getElementById('reportPage');

            var newWin = window.open('Budget Report Print', 'Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

            newWin.document.close();

            setTimeout(function () {
                newWin.close();
            }, 10);
        }

    </script>

@endpush
