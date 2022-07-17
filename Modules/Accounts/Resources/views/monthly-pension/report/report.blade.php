@extends('accounts::layouts.master')
@section('title', __('accounts::pension.report.title').' '.__('labels.show'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('accounts::pension.report.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['route' => 'monthly-pensions.report', 'method' => 'get',
                            'class' => 'form novalidate monthly-pension-report-form']) !!}
                            <div class="row">
                                <!-- Budgets Selection -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('month', trans('accounts::employee-contract.month'),
                                        ['class' => 'form-label']) !!}
                                        {!! Form::text('month', $month?? null,
                                           [
                                              'class'=>'form-control required',
                                              'required',
                                              'data-msg-required'=> __('labels.This field is required')
                                           ]
                                        )!!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ft ft-search"></i>
                                        @lang('labels.search_here')
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- General Information Card -->

        @if($month)
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('accounts::pension.report.title') @lang('labels.show')</h4>
                            <a class="heading-elements-toggle" href=""><i
                                    class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>

                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table repeater-category-request table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('labels.name')</th>
                                            <th>@lang('accounts::pension.contract.ppo_no')</th>
                                            <th>@lang('accounts::pension.report.sonali_bank_acc_no')</th>
                                            <th>@lang('accounts::pension.report.tk')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reportData as $datum)
                                            <tr>
                                                <td>
                                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($loop->iteration, false)}}
                                                </td>
                                                <td>{{$datum['name']}}</td>
                                                <td>
                                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['ppo_number'], false)}}
                                                </td>
                                                <td>
                                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['bank_account'], false)}}
                                                </td>
                                                <td>
                                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($datum['total_amount'])}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" onclick="printDiv()">
                                        <i class="la la-print"></i> @lang('labels.print')
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- DataTable Card -->
            </div>
            <div id="print_report" class="hidden">
                @include('accounts::monthly-pension.report.printable', ['month' => $month, 'reportData' => $reportData])
            </div>
        @endif
    </div>

@endsection

@push('page-css')

    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css')  }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">

@endpush

@push('page-js')

    <!-- Pick a Date -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <!-- jquery Validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script type="text/javascript">
        $(document).ready(function ($) {
            $('input,select,textarea').not('[type=submit]').jqBootstrapValidation('destroy');
        })

        $("input[name=month]").pickadate({
            format: 'mmmm yyyy',
            selectYears: true,
            selectMonths: true,
        });

        $('.monthly-pension-report-form').validate({
            ignore: 'input[type=hidden]',
            errorClass: 'danger',
            successClass: 'success',
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function (error, element) {
                    error.insertAfter(element);
            },
            rules: {},
            submitHandler: function (form, event) {
                form.submit();
            }
        })

    </script>

@endpush


<script type="text/javascript">
    function printDiv() {
        var divToPrint = document.getElementById('print_report');

        var newWin = window.open('Budget Report Print', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }
</script>
