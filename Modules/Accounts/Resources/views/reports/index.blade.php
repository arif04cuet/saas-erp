@extends('accounts::layouts.master')
@section('title', __('accounts::accounts.report.title').' '.__('labels.show'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('accounts::accounts.report.title')</h4>
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
                            {!! Form::open(['route' => 'reports.show-report', 'class' => 'form']) !!}
                            <div class="row">

                                <!-- Budgets Selection -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('fiscal_year_id', trans('accounts::fiscal-year.title'),
                                        ['class' => 'form-label required']) !!}
                                        {!! Form::select('fiscal_year_id', $fiscalYears, $fiscalYearId?? null,
['class' => "form-control dropdown-select", 'required', "placeholder" => trans('labels.select')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::label('month', trans('accounts::accounts.report.month'),
                                        ['class' => 'form-label required']) !!}
                                        {!! Form::text('month', $month?? null,
['class' => "form-control", 'required', "placeholder" => trans('accounts::accounts.report.pick_month')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('report_type', __('accounts::accounts.report.type'),
['class' => 'form-label required']) !!}<br>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                {!! Form::label('expenditure', __('accounts::accounts.report.expenditure')) !!}
                                                {!! Form::radio('report_type', config('constants.report_types.expenditure')
, (!empty($type) && $type == config('constants.report_types.expenditure'))? true : false,
['class' => 'form-control', 'id' => 'expenditure', 'required']) !!}
                                            </li>
                                            <li></li>
                                            <li class="list-inline-item">
                                                {!! Form::label('receipt_payment', __('accounts::accounts.report.receipt_payment')) !!}
                                                {!! Form::radio('report_type', config('constants.report_types.receipt_payment'),
(!empty($type) && $type == config('constants.report_types.receipt_payment'))? true : false,
['class' => 'form-control', 'id' => 'receipt_payment', 'required']) !!}
                                            </li>

                                        </ul>

                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" id="search_button">
                                            <i class="ft ft-search"></i>
                                            @lang('labels.search_here')
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @if(isset($type) && $type == config('constants.report_types.expenditure'))
        <!-- Expenditure Report -->
        @include('accounts::reports.expenditure.report', [
    'expenditures' => $expenditures['expenditures'],
    'costCenterData' => $expenditures['cost_center_data'],
])
    @elseif(isset($type) && $type == config('constants.report_types.receipt_payment'))
        <!-- Receipt and Payment Report -->
            @include('accounts::reports.receipt-payment.report',
[
    'expenditures' => $expenditures['expenditures'],
    'receipts' => $expenditures['receipts'],
    'temporaries' => $expenditures['temporaries'],
    'costCenterData' => $expenditures['cost_center_data'],
]
)
        @endif
    </div>

@endsection


@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- datepicker -->
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
    <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>


    <!-- repeater -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>

    <script>
        $('#month').pickadate({
            format: 'mmmm yyyy',
            selectYears: true,
            selectMonths: true,
        });
    </script>

@endpush
