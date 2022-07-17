@extends('hrm::layouts.master')

@section('title', trans('hrm::calendar.title'))

@section('content')
    <section id="card-footer-options">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::calendar.title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/calendars/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/calendars/fullcalendar.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/extensions/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/extensions/fullcalendar.min.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('theme/js/scripts/extensions/fullcalendar.js') }}" type="text/javascript"></script>--}}

    <script>

        let calendarEventsUrl = "{{ route('calendar.events') }}";
        $(document).ready(function () {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                // selectable: true,
                // defaultDate: '2016-06-12',
                weekends: true,
                // businessHours: true,
                // editable: true,
                // select: function(startDate, endDate) {
                //     let title = prompt('Enter title');
                //     console.log(title);
                // }
                // events: [
                //     {
                //         title: 'Business Lunch',
                //         start: '2019-06-09 13:00:00',
                //         end: '2019-06-16 13:00:00',
                //     },
                //     {
                //         title: 'Meeting',
                //         start: '2019-06-13 11:00:00',
                //         color: '#257e4a'
                //     },
                // ],
                // eventLimit: true,

                events: {
                    url: calendarEventsUrl,
                    error: function() {
                        $('#script-warning').show();
                    }
                },

                loading: function(bool) {
                    $('#loading').toggle(bool);
                }
            });

        });

    </script>
@endpush