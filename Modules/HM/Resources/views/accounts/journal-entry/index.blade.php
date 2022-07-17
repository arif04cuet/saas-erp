@extends('hm::layouts.master')
@section('title',trans('hm::hm_journal_entry.journal_entry.title'))
@section('content')
    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('hm::hm_journal_entry.journal_entry.index')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('hm.accounts.journal-entries.create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{ trans('hm::hm_journal_entry.journal_entry.create') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered alt-pagination text-center"
                                           id="journal_entry_table">
                                        <thead>
                                        <tr>
                                            <th>{{trans('labels.serial')}}</th>
                                            <th>@lang('labels.date')</th>
                                            <th>@lang('labels.title')</th>
                                            <th>@lang('accounts::journal.history.fiscal_year')</th>
                                            <th>@lang('labels.status')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
    
                                        @foreach($hmJournalEntries as $hmJournalEntry)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$hmJournalEntry->date ?? trans('labels.not_found')}}</td>
                                                <td>
                                                    <a href="{{route('hm.accounts.journal-entries.show',$hmJournalEntry->id)}}">
                                                        {{$hmJournalEntry->title ?? '' }}
                                                    </a>
                                                </td>
                                                <td>{{$hmJournalEntry->fiscalYear->name ?? trans('labels.not_found')}}</td>
                                                <td>
                                                    @if($hmJournalEntry->status == \Modules\HM\Entities\HmJournalEntry::getStatuses(false,true)['rejected'])
                                                        <p class="btn btn-danger btn-sm"
                                                           title="">{{trans('labels.rejected')}}
                                                        </p>
                                                    @elseif($hmJournalEntry->status == \Modules\HM\Entities\HmJournalEntry::getStatuses(false,true)['approved'])
                                                        <p class="btn btn-success btn-sm"
                                                           title="">{{trans('labels.approved')}}
                                                        </p>
                                                    @else
                                                        <p class="btn btn-warning btn-sm"
                                                           title="">{{trans('labels.draft')}}
                                                        </p>
                                                    @endif
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
