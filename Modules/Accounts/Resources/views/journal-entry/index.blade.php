@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.entry.title'))


@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::journal.entry.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('journal.entry.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('accounts::journal.entry.create') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center"
                                       id="journal_entry_table">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>@lang('labels.date')</th>
                                        <th>@lang('accounts::journal.entry.table.reference')</th>
                                        <th>@lang('accounts::journal.entry.table.journal')</th>
                                        <th>@lang('accounts::fiscal-year.title')</th>
                                        <th>@lang('labels.status')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($journalEntries as $journalEntry)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$journalEntry->date ?? trans('labels.not_found')}}</td>
                                            <td>
                                                <a href="{{route('journal.entry.show',$journalEntry->id)}}">
                                                    {{$journalEntry->reference}}
                                                </a>
                                            </td>
                                            <td>{{$journalEntry->journal->name ?? trans('labels.not_found')}}</td>
                                            <td>{{$journalEntry->fiscalYear->name ?? trans('labels.not_found')}}</td>
                                            <td>
                                                @if($journalEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[2])
                                                    <p class="btn btn-danger btn-sm"
                                                       title="">{{trans('labels.rejected')}}
                                                    </p>
                                                @elseif($journalEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[1])
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
