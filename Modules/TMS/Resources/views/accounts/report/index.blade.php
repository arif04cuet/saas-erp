@extends('tms::layouts.master')
@section('title', __('tms::budget.report.title').' '.__('labels.show'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form"><i class="la la-list black"></i> @lang('tms::budget.report.title')</h4>
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
                            {!! Form::open(['route' => 'tms-accounts-reports.index', 'class' => 'form', 'method' => 'get']) !!}
                            <div class="row">
    
                                <!-- Budgets Selection -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('training_id', trans('tms::budget.for_training'),
                                        ['class' => 'form-label required']) !!}
                                        {!! Form::select('training_id', $trainings, $trainingId ?? null,
                                        ['class' => "form-control select2", 'required', "placeholder" => trans('labels.select')]) !!}
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('report_type', __('accounts::accounts.report.type'),
                                        ['class' => 'form-label required']) !!}<br>
                                        <ul class="list-inline">
                                            @foreach(config('constants.tms_accounts_report_types') as $type)
                                                <li class="list-inline-item">
                                                    <div class="skin skin-flat">
                                                        {!! Form::label($type, __('tms::budget.report.types.'.$type)) !!}
                                                        {!! Form::radio('report_type', $type,
                                                        (!empty($reportType) && $type == $reportType), ['calss' => 'form-control form-control-sm', 'required']) !!}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="master btn btn-primary" id="search_button">
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
    </div>

    @if(isset($reportType) && $reportType == config('constants.tms_accounts_report_types.expenditure'))
        <!-- Expenditure Report -->
        @include('tms::accounts.report.expenditure.report', ['data' => $data, $training])
    @elseif(isset($reportType) && $reportType == config('constants.tms_accounts_report_types.budget'))
        <!-- Budget Report -->
        @include('tms::accounts.report.budget.report', ['expenditures' => $data, $training])
    @endif

@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
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
