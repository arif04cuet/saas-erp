@extends('tms::layouts.master')
@section('title', 'Training Cafeteria Calendar')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <section id="basic-examples">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Training Cafeteria Calendar</h4>
                                    <a class="heading-elements-toggle"><i
                                                class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Cafeteria</label>
                                                    {{ Form::select('cafeteria', $cafeterias, null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('labels.select')
                                                    ]) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Course</label>
                                                    {{ Form::select('course', $courses, null, [
                                                        'class' => 'form-control',
                                                        'placeholder' => trans('labels.select')
                                                    ]) }}
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div id='fc-default'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/calendars/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/calendars/fullcalendar.min.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/extensions/fullcalendar.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            let events = @json($events);

            $('select').select2({
                placeholder: '{!! trans('labels.select') !!}'
            });

            let cafeteriaServiceStartTime = '8:00:00';
            let cafeteriaServiceEndTime = '23:00:00';

            $('#fc-default').fullCalendar({
                hiddenDays: [5, 6],
                minTime: cafeteriaServiceStartTime,
                maxTime: cafeteriaServiceEndTime,
                defaultDate: '2016-06-12',
                defaultView: 'agendaWeek',
                events: events
            });

            $('select').on('change', function () {
                let data = $(this).select2('data');
                if (data) {
                    let selectedText = data[0]['text'];

                    let filteredEvents = events.filter(event => {
                        return event.title.includes(selectedText);
                    });

                    let calendarSelector = '#fc-default';
                    $(calendarSelector).fullCalendar('removeEvents');
                    $(calendarSelector).fullCalendar('addEventSource', filteredEvents);
                }
            });
        });
    </script>
@endpush