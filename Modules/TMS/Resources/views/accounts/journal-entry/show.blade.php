@extends('tms::layouts.master')
@section('title', trans('tms::tms_journal_entry.journal_entry_details.title'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('tms::tms_journal_entry.journal_entry_details.index') }}</h4>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>@lang('labels.title')</th>
                                    <td>{{$tmsJournalEntry->title ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.date')</th>
                                    <td>{{$tmsJournalEntry->date ?? trans('labels.not_found')}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('accounts::journal.history.fiscal_year')</th>
                                    <td>{{$tmsJournalEntry->training->title ?? trans('labels.not_found')}}</td>
                                </tr>
                                </tbody>
                            </table>

                            <h4 class="card-title"
                                id="basic-layout-form">@lang('accounts::journal.entry.detail.title')</h4>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center"
                                       id="journal_entry_table">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>@lang('tms::tms_journal_entry.journal_entry_details.form_elements.tms_code')</th>
                                        <th>@lang('accounts::journal.entry.detail.transaction_type.title')</th>
                                        <th>@lang('accounts::journal.entry.table.debit')</th>
                                        <th>@lang('accounts::journal.entry.table.credit')</th>
                                        <th>@lang('tms::tms_journal_entry.journal_entry_details.form_elements.vat')</th>
                                        <th>@lang('tms::tms_journal_entry.journal_entry_details.form_elements.tax')</th>
                                        <th>@lang('tms::tms_journal_entry.journal_entry_details.form_elements.employee')</th>
                                        <th>@lang('labels.remarks')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($tmsJournalEntry->tmsJournalEntryDetails  as $tmsJournalEntryDetail)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                {{$tmsJournalEntryDetail->tmsSubSector->getTitle() }}
                                            </td>
                                            <td>{{$tmsJournalEntryDetail->transaction_type ?? trans('labels.not_found')}}</td>
                                            <td>@enToBnNumber($tmsJournalEntryDetail->debit_amount ?? 0)</td>
                                            <td>@enToBnNumber($tmsJournalEntryDetail->credit_amount ?? 0)</td>
                                            <td>
                                                @enToBnNumber(optional($tmsJournalEntryDetail->tmsVatTaxDetail)->vat_amount
                                                ??
                                                0)
                                            </td>
                                            <td>
                                                @enToBnNumber(optional($tmsJournalEntryDetail->tmsVatTaxDetail)->tax_amount
                                                ?? 0)
                                            </td>
                                            <td>{{optional($tmsJournalEntryDetail->employee)->getName() ?? trans('labels.not_found')}}
                                            </td>
                                            <td>{{$tmsJournalEntryDetail->remark ?? trans('labels.not_found')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>
    <script src="{{asset('js/utility/NumberConverter.js')}}" type="text/javascript"></script> ;
    <script>
        $(document).ready(function () {
            let table = $('#journal_entry_table').DataTable({
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>

@endpush
