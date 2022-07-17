@extends('tms::layouts.master')
@section('title', trans('tms::training_hostel.title'))

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <section id="basic-examples">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('tms::training_hostel.title')</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                    {!!
                                        Form::open([
                                          'route' =>  'check-in.approved-training.store',
                                          'class' => 'form trainee-hostel-calender-form','novalidate',
                                        ])
                                    !!}
                                    <!-- select a training -->
                                        <h4 class="form-section"><i class="la  la-building-o"></i>
                                            @lang('hm::checkin.training.select_training')
                                        </h4>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    {!! Form::label('training_id', trans('hm::checkin.training.training_title'),
                                                                    ['class' => 'form-label required'])
                                                    !!}
                                                    {{ Form::select(
                                                        'training_id',
                                                        $trainings,
                                                         null,
                                                        [
                                                            'class' => 'form-control required select-training',
                                                            'data-msg-required'=> trans('labels.This field is required'),
                                                            'placeholder'=>trans('labels.select'),
                                                            'onchange'=>'getData(this.value)'
                                                        ]
                                                    ) }}
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    {!! Form::label('hostel_id', trans('hm::checkin.training.form_elements.select_hostel'),
                                                                    ['class' => 'form-label'])
                                                    !!}
                                                    {{ Form::select(
                                                        'hostel_id',
                                                        [],
                                                         null,
                                                        [
                                                            'class' => 'form-control select-hostel',
                                                            'placeholder'=>trans('labels.select'),
                                                            'onchange'=>'changeCalenderData(this.value)'
                                                        ]
                                                    ) }}
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div id='calendar'></div>
                                            </div>
                                        </div>
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
    <link href='{{ asset('js/fullcalendar-scheduler/packages/core/main.css') }}' rel='stylesheet'/>
    <link href='{{ asset('js/fullcalendar-scheduler/packages-premium/timeline/main.css') }}' rel='stylesheet'/>
    <link href='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-timeline/main.css') }}' rel='stylesheet'/>

    <style type="text/css">


        .fc-license-message {
            display: none;
        }

        .popover {
            white-space: pre-wrap;
        }
    </style>

@endpush

@push('page-js')

    <script src='{{ asset('js/fullcalendar-scheduler/packages/core/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/timeline/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-common/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-timeline/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages/interaction/main.js') }}'></script>

    <!-- validation -->
    <script type="text/javascript"
            src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    {{--    --}}
    <!-- custom -->
    <script src='{{ asset('js/tms-hostel-calender/index.js') }}'></script>
    <!-- full-calender codes -->
    <script type="text/javascript">
        let masterData;
        let dropdownData;
        let resourceColumnData;
        let calendarEl = document.getElementById('calendar');
        const calender = new HostelCalender(calendarEl);

        $(document).ready(function () {
            validateForm('.trainee-hostel-calender-form');
        });

        function getData(trainingId) {
            url = '{{route('trainings.hostels.calendars.data',":id")}}';
            url = url.replace(":id", trainingId);
            $.get(url, function (data) {
                masterData = data.allHostelMasterData;
                dropdownData = data.hostelDropdownsWithEventsOnly;
                resourceColumnData = data.resourceColumns;
                changeHostelDropdownData(dropdownData);
            });
        }

        function changeCalenderData(hostelId) {
            if (!$('.select-training').val()) {
                $('.trainee-hostel-calender-form').valid();
                $('.select-hostel').val(null);
                return;
            }
            $(calendarEl).html('');
            calender.reInitCalender(
                masterData[hostelId].resources,
                masterData[hostelId].events,
                resourceColumnData
            );
        }

        function changeHostelDropdownData(dropdownData) {
            let selectElement = $('.select-hostel');
            selectElement.empty();
            selectElement.append(
                '<option value="">' + `{{ trans('labels.select') }}` + '</option>'
            )
            for (let key in dropdownData) {
                selectElement.append(
                    '<option value="' + key + '">' + dropdownData[key] + '</option>'
                )
            }
        }
    </script>

@endpush
