@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::income-expense.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('cafeteria::income-expense.title') @lang('cafeteria::cafeteria.list')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('income-expense-entries.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('cafeteria::income-expense.create') }}
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered income-expense-table">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.date')}}</th>
                                        <th>{{trans('accounts::journal.entry.table.reference')}}</th>
                                        <th>{{trans('accounts::journal.entry.table.journal')}}</th>
                                        <th>{{trans('accounts::fiscal-year.title')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($journalEntryData as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->journalEntry->date ?? trans('labels.not_found')}}</td>
                                        <td>
                                            <a href="{{ route('income-expense-entries.show', $item->id) }}">
                                                {{ $item->journalEntry->reference }}
                                            </a>
                                        </td>
                                        <td>{{ $item->journalEntry->journal->name ?? trans('labels.not_found') }}</td>
                                        <td>{{ $item->journalEntry->fiscalYear->name ?? trans('labels.not_found') }}</td>
                                        <td>
                                            @if( $item->journalEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[2])
                                                <p class="btn btn-danger btn-sm"
                                                   title="">{{trans('labels.rejected')}}
                                                </p>
                                            @elseif( $item->journalEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[1])
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
    <script>
        $(document).ready(function() {
            $('.income-expense-table').dataTable({
                'stateSave' : true
            })
        });
    </script>
@endpush