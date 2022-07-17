@extends('hrm::layouts.master')
@section('title', trans('hrm::calendar.event') .' '. trans('labels.list'))

@section('content')
    <section id="event-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::calendar.event') @lang('labels.list')</h4>

                        <div class="heading-elements">
                            <a href="{{ route('calendar-event.create') }}" class="btn btn-primary btn-sm round">
                                <i class="ft-plus-circle"></i> @lang('hrm::calendar.add_event')
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="event-list-table table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('hrm::calendar.event_title')</th>
                                        <th scope="col">@lang('hrm::calendar.event_start_date')</th>
                                        <th scope="col">@lang('hrm::calendar.event_end_date')</th>
                                        <th scope="col">@lang('hrm::calendar.event_total_days')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($calendarEvents as $calendarEvent)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $calendarEvent->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($calendarEvent->start)->format('d F, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($calendarEvent->end)->format('d F, Y') }}</td>
                                            <td>{{ $calendarEvent->days }}</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="hrmCalendarEventtList" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="hrmCalendarEventtList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('calendar-event.edit', $calendarEvent->id) }}" class="dropdown-item"><i class="ft-plus-circle"></i> @lang('labels.edit') @lang('hrm::calendar.event')</a>

                                                        <div class="dropdown-divider"></div>
                                                        {!! Form::open([
                                                            'method'=>'DELETE',
                                                            'url' => route('calendar-event.delete', $calendarEvent->id),
                                                            'style' => 'display:inline']); !!}

                                                        {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                                'type' => 'submit',
                                                                'class' => 'dropdown-item text-danger',
                                                                'title' => 'Delete',
                                                                'onclick'=>'return confirm("Confirm delete?")',
                                                                )); !!}

                                                        {!! Form::close(); !!}

                                                    </span>
                                                </span>
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

        $(document).ready(function () {

            let table = $('.event-list-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 1}
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                }
            });

        });
    </script>

@endpush
