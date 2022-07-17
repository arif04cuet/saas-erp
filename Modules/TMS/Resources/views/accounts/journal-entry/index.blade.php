@extends('tms::layouts.master')
@section('title',trans('tms::tms_journal_entry.journal_entry.title'))

@section('content')
    <section id="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list black"></i> @lang('tms::tms_journal_entry.journal_entry.index')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('tms.journal-entries.create')}}" class="btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> {{ trans('tms::tms_journal_entry.journal_entry.create') }}
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
                                            <th>@lang('tms::training.title')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
    
                                        @foreach($tmsJournalEntries as $tmsJournalEntry)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$tmsJournalEntry->date ?? trans('labels.not_found')}}</td>
                                                <td>
                                                    <a href="{{route('tms.journal-entries.show',$tmsJournalEntry->id)}}">
                                                        {{$tmsJournalEntry->title ?? '' }}
                                                    </a>
                                                </td>
                                                <td>{{$tmsJournalEntry->training->title ?? trans('labels.not_found')}}</td>
                                                <td>
                                                    @if($tmsJournalEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[2])
                                                        <p class="btn btn-danger btn-sm"
                                                           title="">{{trans('labels.rejected')}}
                                                        </p>
                                                    @elseif($tmsJournalEntry->status == \Modules\Accounts\Entities\JournalEntry::getStatuses()[1])
                                                        <p class="btn btn-success btn-sm"
                                                           title="">{{trans('labels.approved')}}
                                                        </p>
                                                    @else
                                                        <p class="btn btn-warning btn-sm"
                                                           title="">{{trans('labels.draft')}}
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        @if($tmsJournalEntry->status != \Modules\Accounts\Entities\JournalEntry::getStatuses()[1])
                                                            <a href="{{ route('tms.journal-entries.edit',  $tmsJournalEntry) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                <i class="ft-edit white"></i>
                                                            </a>
                                                            <a href="{{ route('tms.journal-entries.change-status', [$tmsJournalEntry,'approved']) }}" class="master btn btn-info" title="{{trans('labels.approve')}}">
                                                                <i class="ft-check"></i>
                                                            </a>
                                                        @endif
                                                    </div>
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
