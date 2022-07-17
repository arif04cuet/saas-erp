@component('tms::training.course.module.schedule.partial.layout.edit_layout', [
    'training' => $training,
    'course' => $course,
    'module' => $module,
    'batch' => $batch
])

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{--<label for="sel-module">Select Module</label>--}}
                    <select id="sel-module" class="form-control form-inline">
                        @foreach($course->modules as $amodule)
                            <option value="{{$amodule->id}}">{{$amodule->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <a class="btn btn-info"
                   href="{{ route('trainings.courses.modules.show', [$training->id, $course->id]) }}">
                    @lang('tms::module.list')
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>@lang('tms::session.title')</h4>
                <div id='external-events'>
                    @if($sessions->count())
                        <div class="session-box">
                            @foreach($sessions as $session)
                                @if(!is_null($session->speaker))
                                    @php
                                        $speakerName = optional($session->speaker)->getResourceName()
                                    @endphp
                                @else
                                    @php
                                        $speakerName = __('labels.not_available');
                                    @endphp
                                @endif
                                <span
                                    class='fc-event {{ $session->is_scheduled ? 'scheduled' : 'not-scheduled' }}'
                                    data-backdrop="false"
                                    data-module-title="{{$session->module->title}}"
                                    data-session-title="{{$session->title}}"
                                    data-session-speaker="{{$speakerName}}"
                                    data-session-length="{{$session->session_length}}"
                                    data-session-id="{{$session->id}}"
                                    data-draggable="true"
                                    data-batch-id="{{ $batch->id }}"
                                    data-module-id="{{ $session->module->id }}">{{$session->title }}<br>
                                    @lang('tms::session.speaker'):
                                    {{$speakerName}}
                            </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-danger text-bold">@lang('tms::session.not_found')</span>
                    @endif

                </div>
            </div>

            <!---- shedule page -------->
            {{-- <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">{{ trans('tms::schedule.session.title') }}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tr>
                                            <th>@lang('tms::training.title') :</th>
                                            <td><a href="{{ route('training.show', $training->id) }}">{{ $training->title }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> @lang('tms::course.title') :</th>
                                            <td>
                                                <a href="{{ route('trainings.courses.show', [$training->id, $course->id]) }}">
                                                    {{ $course->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('tms::module.title') :</th>
                                            <td>
                                                <a href="{{ route('trainings.courses.modules.sessions.show', [
                                                $training->id, $course->id,
                                                $module->id
                                            ]) }}">
                                                    {{ $module->title }}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <h4 class="form-header"></h4>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered schedule-table">
                                        <thead>
                                        <tr>
                                            <th>{{trans('labels.serial')}}</th>
                                            <th>{{trans('tms::schedule.session.title')}}</th>
                                            <th>{{trans('tms::venue.venue')}}</th>
                                            <th>{{trans('tms::speaker.title')}}</th>
                                            <th>{{trans('tms::schedule.fields.start')}}</th>
                                            <th>{{trans('tms::schedule.fields.end')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
        
                                        @foreach($schedules as $schedule)
                                            <tr>
                                                <td scope="row">{{$counter++}}</td>
                                                <td> {{$schedule->session->title ?? trans('labels.not_found')}}</td>
                                                <td> {{optional($schedule->venue)->getTitle() ?? trans('labels.not_found')}}</td>
                                                @if($schedule->session->speaker)
                                                    @php
                                                        $speakerName = optional($schedule->session->speaker)->getResourceName()
                                                    @endphp
                                                @else
                                                    @php
                                                        $speakerName = __('labels.not_available');
                                                    @endphp
                                                @endif
                                                <td> {{ $speakerName ?? trans('labels.not_found')}}</td>
                                                <td>{{ \Carbon\Carbon::parse($schedule->start)->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
                                                <td>{{ \Carbon\Carbon::parse($schedule->end)->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td scope="row">{{$counter++}}</td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <h2 class="text-bold-300">
                                                    {{trans('tms::training_course.tab.break_schedules')}}
                                                </h2>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @foreach($breaks as $break)
                                            <tr>
                                                <td scope="row">{{$counter++}}</td>
                                                <td> {{$break['session_name'] ?? trans('labels.not_found')}}</td>
                                                <td> {{$break['venue_name'] ?? trans('labels.not_found')}}</td>
                                                <td> {{$break['speaker_name'] ?? trans('labels.not_found')}}</td>
                                                <td>{{ \Carbon\Carbon::parse($break['session_start'])->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
                                                <td>{{ \Carbon\Carbon::parse($break['session_end'])->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
        
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="card-footer">
                        <div class="col-md-12 float-left">
                            <!-- module list -->
                            <a class="btn btn-info"
                               href="{{ route('trainings.courses.modules.show', [$training->id, $course->id]) }}">
                                <i class="la la-list"></i> @lang('tms::module.list')
                            </a>
        
                            <!-- back page -->
                            <a class="btn btn-warning" href="{{route('trainings.courses.modules.batches.sessions.schedules.edit', [
                                        'training' => $training,
                                        'course' => $course,
                                        'module' => $module,
                                        'batch' => $batch
                                    ])}}">
                                <i class="la la-backward"></i>
                                @lang('labels.back_page')
                            </a>
        
        
                        </div>
                    </div>
        
                </div>
            </div> --}}
        </div>
        {{-- <div class="row">
            <div class="col-md-12">
                <div id="calendar"></div>
            </div>
        </div> --}}
        {{ Form::open(
            [
                'route' => ['trainings.courses.modules.batches.sessions.schedules.update', $training, $course, $module, $batch],
                'class' => 'form training-course-module-session-schedule-form',
                'novalidate',
                'method' => 'PUT'
            ]
        ) }}
        @include('tms::training.course.module.schedule.partial.form')
        {{ Form::close() }}

        <div class="modal fade text-left" id="add-session-modal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel17"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sel-venue">@lang('tms::venue.select_venue')</label>
                                    <select id="sel-venue" class="form-control form-inline">
                                        @foreach($venues as $aVenue)
                                            <option
                                                {{$aVenue['id'] == $course->venue_id ? 'selected' : ''}} value="{{$aVenue['id']}}">{{$aVenue['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt-time">@lang('tms::schedule.select_start_time')</label>
                                    <input class="form-control form-inline pickatime" name="txt-time" value="5:00 AM">
                                </div>
                            </div>
                        </div>
                        <input id="sessionid" name="sessionid" type="hidden" value="">
                    </div>
                    <div class="modal-footer">
                        <button id="btn-add" type="button" class="btn btn-success btn-outline-secondary"
                                data-dismiss="modal">
                            <i class="ft ft-save"></i>
                            @lang('labels.add')
                        </button>
                        <button type="button" class="btn btn-warning btn-outline-secondary" data-dismiss="modal">
                            <i class="ft ft-x"></i>
                            @lang('labels.cancel')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('page-css')
        <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/calendars/fullcalendar.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/calendars/fullcalendar.css') }}">
        <link href='{{ asset('js/fullcalendar-scheduler/packages/core/main.css') }}' rel='stylesheet'/>
        <link href='{{ asset('js/fullcalendar-scheduler/packages/daygrid/main.css') }}' rel='stylesheet'/>
        <link href='{{ asset('js/fullcalendar-scheduler/packages/timegrid/main.css') }}' rel='stylesheet'/>
        <link href='{{ asset('js/fullcalendar-scheduler/packages-premium/timeline/main.css') }}' rel='stylesheet'/>
        <link href='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-timeline/main.css') }}'
              rel='stylesheet'/>
        <style type="text/css">

            #external-events {
                float: left;
                margin-bottom: 15px;
                text-align: left;
            }

            #external-events .session-box {
                max-height: 200px;
                /* overflow-y: scroll; */
                border: 1px solid darkgray;
                padding: 5px;
            }

            #external-events h4 {
                font-size: 16px;
                margin-top: 0;
                padding-top: 1em;
            }

            #external-events .fc-event {
                margin: 10px 0;
                cursor: pointer;
                display: inline-block;
            }

            #external-events p {
                margin: 1.5em 0;
                font-size: 11px;
                color: #666;
            }

            #external-events p input {
                margin: 0;
                vertical-align: middle;
            }

            #calendar {
                float: right;
                /*width: 900px;*/
            }

            .fc-widget-content {
                height: 80px;
                white-space: normal;
                word-wrap: break-word;
            }

            .fc-timeline-event {
                height: 80px;
                white-space: normal;
                word-wrap: break-word;
            }

            .fc-event {
                text-align: center;
                padding: 10px;
            }

            .fc-time-wrap, .fc-title-wrap {
                display: block;
                text-align: center !important;
                position: relative !important;
                word-wrap: break-word;
            }

            .fc-sticky {
                position: static;
            }

            .fc-license-message {
                display: none;
            }

            .fc-event.scheduled {
                background-color: red;
                border: 1px solid red;
            }

            .fc-event.not-scheduled {
                background-color: #3788d8;
                border: 1px solid #3788d8;
            }

            .recurring-event {
                background: lightgrey;
                border-color: #b0b0b0;
            }

            /*.fc-timeline-event i.ft-delete {*/
            /*    position: absolute; background: red; padding: 25px; z-index: 999999999999;*/
            /*}*/
        </style>
    @endpush

    @push('page-js')
        <script src="{{ asset('theme/vendors/js/extensions/fullcalendar.min.js') }}" type="text/javascript"></script>
        <script src='{{ asset('js/fullcalendar-scheduler/packages/core/main.js') }}'></script>
        <script src='{{ asset('js/fullcalendar-scheduler/packages/interaction/main.js') }}'></script>
        <script src='{{ asset('js/fullcalendar-scheduler/packages/daygrid/main.js') }}'></script>
        <script src='{{ asset('js/fullcalendar-scheduler/packages/timegrid/main.js') }}'></script>
        <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/timeline/main.js') }}'></script>
        <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-common/main.js') }}'></script>
        <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-timeline/main.js') }}'></script>
        <script src='{{ asset('theme/vendors/js/pickers/pickadate/picker.js') }}'></script>
        <script src='{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}'></script>
        <script src='{{ asset('theme/vendors/js/pickers/pickadate/picker.time.js') }}'></script>

        <script type="text/javascript">
            function getTime(timeValue) {
                var n = new Date(0, 0);
                n.setMinutes(timeValue * 60);
                return (n.toTimeString().slice(0, 5));
            }

            function getDraggable(Draggable, containerElement) {
                return new Draggable(containerElement, {
                    itemSelector: '.fc-event',
                    eventData: function (eventEl) {
                        if (eventEl.getAttribute('data-draggable') === 'true') {
                            return {
                                title: '{{__('tms::module.title')}}: ' + eventEl.getAttribute('data-module-title').trim()
                                    + '\n{{__('tms::session.title')}}: ' + eventEl.getAttribute('data-session-title').trim()
                                    + '\n{{__('tms::session.speaker')}}: ' + eventEl.getAttribute('data-session-speaker').trim(),
                                durationEditable: false,
                                overlap: false,
                                allDay: false,
                                duration: getTime(eventEl.getAttribute('data-session-length')),
                                id: eventEl.getAttribute('data-session-id').trim(),
                                extendedProps: {
                                    draggable: true,
                                    delete: true,
                                    batch: eventEl.getAttribute('data-batch-id').trim(),
                                    module: eventEl.getAttribute('data-module-id')
                                }
                            }
                        }
                    }
                });
            }

            function resetDraggableSessionsStatus(sessions) {
                sessions.forEach(function (item, iterator) {
                    let container = $('span[data-session-id=' + item.id + ']');

                    if (container !== undefined) {
                        if (item.is_scheduled === true) {
                            container.removeClass('not-scheduled')
                                .addClass('scheduled')
                        } else {
                            container.removeClass('scheduled')
                                .addClass('not-scheduled')
                        }
                    }
                });
            }

            $(document).ready(function () {
                let Calendar = FullCalendar.Calendar,
                    Draggable = FullCalendarInteraction.Draggable,
                    calendarElement = document.getElementById('calendar'),
                    containerElement = document.getElementById('external-events'),
                    draggables = getDraggable(Draggable, containerElement),
                    calendar = new Calendar(calendarElement, {
                        plugins: ['interaction', 'dayGrid', 'timeGrid', 'resourceTimeline'],
                        slotDuration: '00:05',
                        displayEventTime: true,
                        displayEventEnd: true,
                        editable: true,
                        droppable: true,
                        aspectRatio: 1.9,
                        businessHours: {
                            daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
                            startTime: '05:00',
                            endTime: '21:00'
                        },
                        scrollTime: '00:00',
                        header: {
                            left: 'today prev,next',
                            center: 'title',
                            right: 'resourceTimelineDay,dayGridMonth'
                            /*right: 'resourceTimelineDay,resourceTimelineThreeDays,resourceTimelineWeek,resourceTimelineMonth'*/
                        },
                        defaultView: 'resourceTimelineDay',
                        validRange: {
                            start: '{{ $batch->start_date }} 05:00',
                            end: '{{ $batch->end_date }} 21:00'
                        },
                        views: {
                            resourceTimelineDay: {
                                type: 'resourceTimeline',
                                buttonText: 'Day',
                                minTime: '05:00',
                                maxTime: '21:00',
                                titleFormat: {dateStyle: 'full'}
                            },
                            dayGridMonth: {
                                buttonText: 'Month',
                            }
                        },
                        resourceLabelText: 'Venues',
                        resources: @json($venues),
                        eventSources: [@json($events)],
                        eventRender: function (info) {
                            if (info.event.id.includes("_")) {
                                info.el.className = info.el.className + ' recurring-event';
                            } else {

                                let icon = document.createElement('i');
                                icon.setAttribute('class', 'ft ft-delete');
                                icon.style.cssText = 'cursor: pointer; z-index: 10000; color: #ffffff; float: right; margin-right: 5px;';
                                icon.setAttribute('data-icon-type', 'remove');
                                icon.setAttribute('data-icon-id', info.event.id);
                                icon.setAttribute('onclick', 'removeEvent(1)');
                                info.el.insertBefore(icon, info.el.firstChild);

                            }
                        },
                        eventPositioned: function (info) {
                            let titles = document.getElementsByClassName('fc-title');
                            for (let i = 0; i < titles.length; i++) {
                                if (titles[i] !== undefined) {
                                    var sanitizedTitle = titles[i].innerHTML.replace(/;/g, "<br>");
                                    titles[i].innerHTML = sanitizedTitle;
                                    titles[i].style.position = 'static';
                                }
                            }
                        },
                        eventTimeFormat: {
                            hour: '2-digit',
                            'minute': '2-digit',
                            'meridiem': 'short'
                        },
                        drop: function (dropInfo) {
                            dropInfo.draggedEl.className = 'fc-event scheduled';
                            dropInfo.draggedEl.setAttribute('data-dragged', 'true');
                        },
                        eventConstraint: {
                            daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
                            startTime: '05:00',
                            endTime: '21:00',
                        },
                        eventAllow: function (dropInfo, draggedEvent) {
                            if (dropInfo.resource.id.includes("cafeteria")) {
                                return false;
                            }

                            let events = calendar.getEvents();

                            if (parseInt(draggedEvent.extendedProps.module) !== parseInt("{{ $module->id }}")) {
                                return false;
                            }

                            if (draggedEvent.id.includes("_")) {
                                return false;
                            }

                            if (events.length) {
                                if (events.find(event => event.id === draggedEvent.id)) {
                                    return draggedEvent.start !== null;
                                }
                            }

                            return true;
                        },
                        eventReceive: function (arg) {
                            arg.event.setExtendedProp('resource', arg.event.getResources().map(resource => resource.id)[0]);
                        },
                        eventDrop: function (arg) {
                            arg.event.setExtendedProp('resource', arg.event.getResources().map(resource => resource.id)[0]);
                        },
                        eventClick: function (eventClickInfo) {
                            if (eventClickInfo.event.extendedProps.delete === true) {
                                let answer = confirm('Dou you want to remove this event?');

                                if (answer) {
                                    eventClickInfo.event.remove();
                                    $('span[data-session-id=' + eventClickInfo.event.id + ']')
                                        .removeClass('scheduled')
                                        .addClass('not-scheduled');
                                } else {
                                    return false;
                                }
                            }
                        },
                        eventDragStop(arg) {
                            let target = arg.el.querySelector('span.fc-title');
                            target.className = "fc-title";
                            target.style.cssText = "sticky";
                        }
                    });
                calendar.render();

                $('#btn-add').on('click', function (evt) {
                    let sessionId = $('#sessionid').val();
                    let scontainer = $('span[data-session-id=' + sessionId + ']');
                    if (scontainer.hasClass('not-scheduled')) {
                        let resource = $('#sel-venue').val();

                        let duration = getTime(scontainer.data('session-length'));
                        let hM = duration.split(':');


                        let selectedDate = calendar.getDate();
                        let startDateStr = moment(selectedDate).format("YYYY-MM-DD");
                        let sessionStartTime = $('.pickatime').val();
                        startDateStr = moment(startDateStr + ' ' + sessionStartTime).format("YYYY-MM-DD HH:mm");
                        let endDate = moment(startDateStr).add(moment.duration(parseInt(hM[0]), 'hours'))
                            .add(moment.duration(parseInt(hM[1]), 'minutes')).format("YYYY-MM-DD HH:mm");


                        calendar.addEvent({
                            id: sessionId,
                            resourceId: resource,
                            title: '{{__('tms::module.title')}}: ' + scontainer.data('module-title')
                                + '\n{{__('tms::session.title')}}: ' + scontainer.data('session-title')
                                + '\n{{__('tms::session.speaker')}}: ' + scontainer.data('session-speaker'),
                            overlap: false,
                            duration: duration,
                            start: startDateStr,
                            end: endDate,
                            durationEditable: false,
                            extendedProps: {
                                resource: resource,
                                batch: scontainer.data('batch-id'),
                                module: scontainer.data('module-id'),
                                delete: true
                            }
                        });

                        scontainer.removeClass('not-scheduled')
                            .addClass('scheduled');
                    } else {
                        alert("Already added to calender, remove it first to re-schedule");
                    }
                });

                let form = $('.training-course-module-session-schedule-form');
                form.submit(function (e) {
                    e.preventDefault();
                    let message = '<div><h3>{{ trans('tms::schedule.message.submit.wait') }}</h3><br> <span class="ft-refresh-cw icon-spin font-medium-2"></span></div>';
                    $.blockUI({
                        message: message,
                        timeout: null, //unblock after 2 seconds
                        overlayCSS: {
                            backgroundColor: '#FFF',
                            opacity: 0.8,
                            cursor: 'wait'
                        },
                        css: {
                            border: 0,
                            padding: 0,
                            backgroundColor: 'transparent'
                        }
                    });

                    let events = calendar.getEvents(),
                        data = [];

                    events.forEach(function (item, iterator) {
                        if (!item.id.includes("_")) {
                            data.push({
                                training_course_module_session_id: item.id,
                                training_venue_id: item.extendedProps.resource,
                                training_course_batch_id: item.extendedProps.batch,
                                date: item.start.toDateString(),
                                start: item.start.toLocaleString(),
                                end: item.end.toLocaleString()
                            });
                        }
                    });

                    let messageContainer = $('.blockMsg>div>h3');

                    $.ajax({
                        url: form.attr('action'),
                        type: 'put',
                        dataType: 'json',
                        data: {'session_schedules': data, '_token': "{{ csrf_token() }}"},
                        success: function (response) {
                            if (response.status) {
                                messageContainer.html('<div><h3>{{ trans('tms::schedule.message.submit.success') }}</h3></div>');
                                resetDraggableSessionsStatus(response.sessions);
                            } else {
                                messageContainer.html('<div><h3>{{ trans('tms::schedule.message.submit.error') }}</h3></div>');
                                resetDraggableSessionsStatus(response.sessions);
                            }

                            window.setTimeout(function () {
                                $.unblockUI();
                            }, 2000);
                        },
                        error: function (requestObject, error, errorThrown) {
                            messageContainer.html('<div><h3>{{ trans('tms::schedule.message.submit.error') }}</h3></div>');
                            window.setTimeout(function () {
                                $.unblockUI();
                            }, 2000);
                        },
                    });

                });
            });


            $(document).ready(function () {
                let setModule = function (currentModule) {
                    $("#sel-module").val(currentModule).prop("selected", true);
                };

                setModule(getCurrentModule());

                $("#sel-module").on('change', function (evt) {
                    const currentModule = getCurrentModule();
                    const searchString = "modules/" + currentModule;
                    const replaceString = "modules/" + $(this).val();
                    window.location.href = window.location.href.replace(searchString, replaceString);
                });
                $('.pickatime').pickatime({
                    interval: 5,
                    min: [5, 0],
                    max: [21, 0]
                });

                $('.fc-event').on('click', function (evt) {
                    if ($(this).hasClass('scheduled')) {
                        alert("Already added to calender, remove it first to re-schedule");
                    } else {
                        $('#sessionid').val($(this).data('session-id'));
                        $('#add-session-modal').modal();
                    }
                });

                $('#add-session-modal').on('hide.bs.modal', function (event) {
                    $('#sessionid').val('');
                    $('.pickatime').val('5:00 AM');
                    $("#sel-venue").val({{$course->venue_id}}).prop("selected", true);
                });

            });

            function getCurrentModule() {
                return {{$module->id}};
            };

        </script>

    @endpush
@endcomponent
