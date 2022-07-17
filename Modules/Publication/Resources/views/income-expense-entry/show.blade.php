@extends('publication::layouts.master')
@section('title', trans('publication::income-expense.title'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('publication::income-expense.title') @lang('labels.show')</h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-content show">
                        <div class="card-body">
                            <div class="col-md-8">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>@lang('accounts::journal.entry.reference')</th>
                                            <td>{{ $publicationJournal->journalEntry->reference ?? 0 }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('labels.date')</th>
                                            <td>{{ $publicationJournal->journalEntry->date ?? 0 }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('accounts::journal.history.fiscal_year')</th>
                                            <td>{{ $publicationJournal->journalEntry->fiscalYear->name ?? 0 }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <h4 class="card-title" id="basic-layout-form">@lang('publication::income-expense.title')
                                    @lang('labels.details')
                                </h4>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered alt-pagination text-center"
                                        id="journal_entry_table">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('labels.serial') }}</th>
                                                <th>@lang('accounts::economy-code.title')</th>
                                                <th>@lang('accounts::journal.entry.detail.source.title')</th>
                                                <th>@lang('accounts::journal.entry.detail.transaction_type.title')</th>
                                                <th>@lang('accounts::journal.entry.table.debit')</th>
                                                <th>@lang('accounts::journal.entry.table.credit')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($publicationJournal->journalEntry->journalEntryDetails as $journalEntryDetail)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>
                                                        {{ \App\Utilities\EnToBnNumberConverter::en2bn($journalEntryDetail->economy_code, false) }}
                                                        -
                                                        @if (app()->isLocale('en'))
                                                            @if (array_key_exists($journalEntryDetail->economy_code, $economySectors))
                                                                {{ $economySectors[$journalEntryDetail->economy_code]['title'] ?? trans('labels.not_found') }}
                                                            @else
                                                                {{ $journalEntryDetail->economyCode->english_name ?? trans('labels.not_found') }}
                                                            @endif
                                                        @else
                                                            @if (array_key_exists($journalEntryDetail->economy_code, $economySectors))
                                                                {{ $economySectors[$journalEntryDetail->economy_code]['title_bangla'] ?? trans('labels.not_found') }}
                                                            @else
                                                                {{ $journalEntryDetail->economyCode->bangla_name ?? trans('labels.not_found') }}
                                                            @endif

                                                        @endif
                                                    </td>

                                                    <td>{{ $journalEntryDetail->source ?? trans('labels.not_found') }}
                                                    </td>
                                                    <td>{{ $journalEntryDetail->account_transaction_type ?? trans('labels.not_found') }}
                                                    </td>
                                                    <td>{{ $journalEntryDetail->debit_amount ?? trans('labels.not_found') }}
                                                    </td>
                                                    <td>{{ $journalEntryDetail->credit_amount ?? trans('labels.not_found') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="col-md-12">
                            <a href="{{ route('publication-income-expense-entries.index') }}" class="btn btn-danger">
                                <i class="la la-backward"></i> @lang('labels.back_page')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
