@extends('tms::layouts.master')
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
                                                <h4 class="card-title"><i class="ft-list black"></i> @lang('accounts::journal.entry.advance_payment.index')</h4>
                                                <a class="heading-elements-toggle"><i
                                                        class="la la-ellipsis-h font-medium-3"></i></a>

                                            </div>
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <table
                                                        class="master table table-striped table-bordered text-center alt-pagination"
                                                        id="cash-book-entry-table">
                                                        <thead>
                                                        <tr>
                                                            <th>@lang('labels.serial')</th>
                                                            <th>@lang('accounts::journal.entry.advance_payment.table.employee')</th>
                                                            <th>@lang('accounts::journal.entry.advance_payment.table.total_debit_amount')</th>
                                                            <th>@lang('accounts::journal.entry.advance_payment.table.total_credit_amount')</th>
                                                            <th>@lang('labels.action')</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($tmsAdvancePayments as $tmsAdvancePayment)
                                                            <tr>
                                                                <td scope="row">{{$loop->iteration}}</td>
                                                                <!-- Employee Name -->
                                                                <td width="10%">
                                                                    {{
                                                                        $tmsAdvancePayment->employee->getName()
                                                                        ?? trans('labels.not_found')
                                                                    }}
                                                                </td>
                                                                <td>
                                                                    {{ \App\Utilities\EnToBnNumberConverter::en2bn($tmsAdvancePayment->total_debit_amount ?? 0 )}}
                                                                </td>
                                                                <td>
                                                                    {{ \App\Utilities\EnToBnNumberConverter::en2bn($tmsAdvancePayment->total_credit_amount ?? 0) }}
                                                                </td>
                                                                <td>
                                                                    <a class="master btn btn-sm btn-primary"
                                                                       href="{{route('tms.advance-payments.show', $tmsAdvancePayment->id)}}" title="{{trans('labels.details')}}">
                                                                        <i class="la la-eye"></i>
                                                                    </a>
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

@endpush

@push('page-js')

@endpush
