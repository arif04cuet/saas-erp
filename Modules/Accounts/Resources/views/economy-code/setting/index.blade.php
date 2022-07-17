@extends('accounts::layouts.master')
@section('title', __('accounts::economy-code.settings.title'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">@lang('accounts::economy-code.settings.title')</h4>
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
                            {!! Form::open(['route' => 'economy-code-settings.store', 'class' => 'form']) !!}
                            <div class="row">
                                <!-- Temporary Economy Codes -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('temporary_economy_codes', trans('accounts::accounts.report.temporary_codes'), ['class' => 'form-label required']) !!}
                                        {!! Form::select('temporary_economy_codes[]', $economyCodes, $temporaryEconomyCodes,
                            ['id' => 'economy_codes','required','class'=>'form-control select2 required', 'multiple',
                            'data-validation-required-message' => __('labels.This field is required')]) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('temporary_economy_codes'))
                                            <span class="invalid-feedback">{{$errors->first('temporary_economy_codes')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('receipt_economy_codes', trans('accounts::economy-code.settings.receipt_codes'), ['class' => 'form-label']) !!}
                                        {!! Form::select('receipt_economy_codes[]', $economyCodes, $receiptEconomyCodes,
                            ['id' => 'economy_codes','class'=>'form-control select2', 'multiple']) !!}
                                        <div class="help-block"></div>
                                        @if ($errors->has('receipt_economy_codes'))
                                            <span class="invalid-feedback">{{$errors->first('receipt_economy_codes')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

{{--                            <div class="col-md-12">--}}
{{--                                <div id="invoice-items-details" class="">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="table-responsive">--}}
{{--                                            <table class="table repeater-category-request table-bordered"--}}
{{--                                                   id="economy-codes-table">--}}
{{--                                                <thead>--}}
{{--                                                <tr>--}}
{{--                                                    <th>#</th>--}}
{{--                                                    <th class="">Code</th>--}}
{{--                                                    <th>Name</th>--}}
{{--                                                </tr>--}}
{{--                                                </thead>--}}
{{--                                                <tbody data-repeater-list="category">--}}
{{--                                                </tbody>--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">
                                    <i class="la la-save"></i>
                                    @lang('labels.save')
                                </button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Expenditure Report -->
        @if(isset($expenditures))
            @include('accounts::reports.expenditure.report')
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
@endpush
