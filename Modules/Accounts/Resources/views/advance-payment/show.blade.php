@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.entry.advance_payment.title'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-xl-12 ">

                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <section id="payslip-list">
                                <div class="row">
                                    <div class="col-xl-12 ">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">@lang('accounts::journal.entry.advance_payment.index')</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table
                                                        class="table table-striped table-bordered text-center alt-pagination">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('accounts::journal.entry.advance_payment.table.employee')</th>
                                                            <th>@lang('accounts::journal.entry.advance_payment.table.reference')</th>
                                                            <th>@lang('accounts::journal.entry.advance_payment.table.total_debit_amount')</th>
                                                            <th>@lang('accounts::journal.entry.advance_payment.table.total_credit_amount')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($advancePayments as $advancePayment)
                                                            <tr>
                                                                <td scope="row">{{$loop->iteration}}</td>
                                                                <!-- Employee Name -->
                                                                <td width="10%">
                                                                    {{
                                                                        $advancePayment->employee->getName()
                                                                        ?? trans('labels.not_found')
                                                                    }}
                                                                </td>
                                                                <!-- journal reference -->
                                                                <td width="10%">
                                                                    <a href="{{route('journal.entry.show',$advancePayment->journal_entry_id)}}">
                                                                        {{$advancePayment->journalEntry->reference}}
                                                                    </a>
                                                                </td>

                                                                <td>
                                                                    {{ \App\Utilities\EnToBnNumberConverter::en2bn($advancePayment->total_debit_amount ?? 0 )}}
                                                                </td>
                                                                <td>
                                                                    {{ \App\Utilities\EnToBnNumberConverter::en2bn($advancePayment->total_credit_amount ?? 0) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
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
    <link rel="stylesheet"
          href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">
    <link rel="stylesheet"
          href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet"
          href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')

@endpush
