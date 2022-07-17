@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.entry.title'))


@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::journal.entry.title') }}</h4>
                        {{--                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>--}}
                        {{--                        <div class="heading-elements">--}}
                        {{--                            <a href="{{route('journal.entry.create')}}" class="btn btn-primary btn-sm"><i--}}
                        {{--                                    class="ft-plus white"></i> {{ trans('accounts::journal.entry.create') }}--}}
                        {{--                            </a>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>@lang('accounts::journal.entry.reference')</th>
                                    <td>{{$journalEntry->reference ?? 0}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('labels.date')</th>
                                    <td>{{$journalEntry->date ?? 0}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('accounts::journal.history.fiscal_year')</th>
                                    <td>{{$journalEntry->fiscalYear->name ?? 0}}</td>
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
                                        <th>@lang('accounts::economy-code.title')</th>
                                        <th>@lang('accounts::journal.entry.detail.source.title')</th>
                                        <th>@lang('accounts::journal.entry.detail.transaction_type.title')</th>
                                        <th>@lang('accounts::journal.entry.table.debit')</th>
                                        <th>@lang('accounts::journal.entry.table.credit')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($journalEntry->journalEntryDetails  as $journalEntryDetail)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                {{\App\Utilities\EnToBnNumberConverter::en2bn($journalEntryDetail->economy_code,false)}}
                                                -
                                                @if(app()->isLocale('en'))
                                                    @if(array_key_exists($journalEntryDetail->economy_code,$economySectors))
                                                        {{ $economySectors[$journalEntryDetail->economy_code]['title'] ?? trans('labels.not_found') }}
                                                    @else
                                                        {{ $journalEntryDetail->economyCode->english_name ?? trans('labels.not_found') }}
                                                    @endif
                                                @else
                                                    @if(array_key_exists($journalEntryDetail->economy_code,$economySectors))
                                                        {{ $economySectors[$journalEntryDetail->economy_code]['title_bangla'] ?? trans('labels.not_found') }}
                                                    @else
                                                        {{$journalEntryDetail->economyCode->bangla_name ?? trans('labels.not_found')}}
                                                    @endif

                                                @endif
                                            </td>

                                            <td>{{$journalEntryDetail->source ?? trans('labels.not_found')}}</td>
                                            <td>{{$journalEntryDetail->account_transaction_type ?? trans('labels.not_found')}}</td>
                                            <td>{{$journalEntryDetail->debit_amount ?? trans('labels.not_found')}}</td>
                                            <td>{{$journalEntryDetail->credit_amount ?? trans('labels.not_found')}}</td>
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
