@extends('tms::layouts.master')
@section('title', trans('tms::training.training'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="m-0"> <i class="las la-chalkboard-teacher black"></i> @lang('tms::training.calendar')</h3>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        {{-- <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover master">
                                    <thead>
                                        <tr>
                                            <th colspan="32" class="text-center"><strong>Training Calender 2022</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Year/Month</th>
                                            <th colspan="31">Day</th>
                                        </tr>
                                        <tr>
                                            <td>2022</td>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>12</td>
                                            <td>13</td>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                            <td>17</td>
                                            <td>18</td>
                                            <td>19</td>
                                            <td>20</td>
                                            <td>21</td>
                                            <td>22</td>
                                            <td>23</td>
                                            <td>24</td>
                                            <td>25</td>
                                            <td>26</td>
                                            <td>27</td>
                                            <td>28</td>
                                            <td>29</td>
                                            <td>30</td>
                                            <td>31</td>
                                        </tr>
                                        <tr>
                                            <td>January</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>February</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="5" class="bg-info text-center text-white cursor-ponter" title="IGA (Electrical) Training">প্রশিক্ষণ ওরিয়েন্টেশন</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>March</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>April</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>May</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>June</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="6" class="bg-warning text-white cursor-pointer" title="Accounting And Auditing Training Courses">দক্ষতা উন্নয়ন</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>July</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>August</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>September</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>October</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>November</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>December</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- <div class="row">
                                <div class="col">
                                    <div id="calender"></div>
                                </div>
                            </div> -->



                            @if ($shouldShowAssessments)
                                <hr>
                                <h3 class="card-title"
                                    style="margin-left: 7px; font-size: 1.51rem; font-weight: 400;
                                                                                                        color: #464855; line-height: 1.2;">
                                    @lang('tms::training.speaker_assessments')</h3>
                                <br>

                                <div class="row filters-container">
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="speaker-evaluation-table">
                                        <thead>
                                            <tr>
                                                <th>@lang('tms::training.title')</th>
                                                <th>@lang('tms::course.title')</th>
                                                <th>@lang('tms::module.title')</th>
                                                <th>@lang('tms::session.title')</th>
                                                <th>@lang('tms::training.evaluation.speaker_name')</th>
                                                <th>@lang('tms::training.remark_total') (5)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assessmentsBySessions as $assessmentsBySession)
                                                <tr>
                                                    <td>{{ $assessmentsBySession->training_name ?? trans('labels.not_found') }}
                                                    </td>
                                                    <td><a
                                                            href="{{ route('speakers.evaluations.charts.index', [
                                                                $assessmentsBySession->course_id,
                                                                $assessmentsBySession->speaker_id,
                                                            ]) }}">{{ $assessmentsBySession->course_name }}</a>
                                                    </td>
                                                    <td>{{ $assessmentsBySession->module_name ?? trans('labels.not_found') }}
                                                    </td>
                                                    <td><a
                                                            href="{{ route('speakers.evaluations.charts.show', [$assessmentsBySession->session_id]) }}">{{ $assessmentsBySession->session_name ?? trans('labels.not_found') }}</a>
                                                    </td>
                                                    <td>{{ $assessmentsBySession->speaker_name ?? trans('labels.not_found') }}
                                                    </td>
                                                    <td>
                                                        {{ $assessmentsBySession->assessment_value_in_word ?? trans('labels.not_found') }}
                                                        ({{ $assessmentsBySession->final_average ?? trans('labels.not_found') }})
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <!-- course evaluation list  -->
                                <hr>
                                <h3 class="card-title"
                                    style="margin-left: 7px; font-size: 1.51rem; font-weight: 400; color: #464855; line-height: 1.2;">
                                    @lang('tms::training.course_evaluation')</h3>
                                <br>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="mt-1" for="training-search">@lang('tms::training.title')</label>
                                        <select class="custom-select select2 select-filter  select mr-sm-2"
                                            id="training-search">
                                            <option selected="true" value={{ trans('labels.all') }}>@lang('labels.all')
                                            </option>
                                            @foreach ($courseEvaluationLists as $courseEvaluationList)
                                                <option value="{{ $courseEvaluationList['trainingName'] }}">
                                                    {{ $courseEvaluationList['trainingName'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="mt-1" for="course-search">@lang('tms::course.title')</label>
                                        <select class="custom-select select2 select-filter select mr-sm-2" id="course-search">
                                            <option selected="true" value={{ trans('labels.all') }}>@lang('labels.all')
                                            </option>
                                            @foreach ($courseEvaluationLists as $courseEvaluationList)
                                                <option value="{{ $courseEvaluationList['courseName'] }}">
                                                    {{ $courseEvaluationList['courseName'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table id="course-evaluation" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>@lang('tms::training.title')</th>
                                                <th>@lang('tms::course.title')</th>
                                                <th>@lang('tms::training.remark_total')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courseEvaluationLists as $courseEvaluationList)
                                                <tr>
                                                    <td>{{ $courseEvaluationList['trainingName'] }}</td>
                                                    <td>{{ $courseEvaluationList['courseName'] }}</td>
                                                    <td>
                                                        {{ assessment_value_in_word($courseEvaluationList['averageMark'], true) }}
                                                        ({{ bcmul(bcdiv($courseEvaluationList['averageMark'], 100, 2), 5, 2) }})
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-css')
    <!-- Dashboard - Calender Related -->
    <link href='{{ asset('js/fullcalendar-scheduler/packages/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('js/fullcalendar-scheduler/packages-premium/timeline/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-timeline/main.css') }}' rel='stylesheet' />

    <style type="text/css">
        .custom-filter {
            width: 100px;
            float: right;
            margin-left: 10px;
            margin-top: -6px;
            height: 35px;
        }
        .fc-widget-header {
            background : #0f75bc;
            color: #fff;
        }
        .fc-widget-header .fc-cell-text {
            color: #fff;
            font-size: 13px;
        }
        .fc-license-message {
            display: none;
        }

        .popover {
            white-space: pre-wrap;
        }

        #calendar {
            margin: 40px auto;
        }
        .fc-rows table tr:nth-child(2n-1) {
            background: #f3f3f38f;
        }
        .fc-rows table tr:nth-child(2n) {
            background: #d0dbbe78;
        }
        .fc-timeline .fc-divider {
            width: 0px;
            border-style: double;
        }
        .fc-toolbar.fc-header-toolbar {
            margin-bottom: 0.5em;
        }
        .fc-button-group button {
            background: #1075bc;
            border: 1px solid #1075bc;
            border-right-color: #ddd;
            padding: 1px 9px;
            padding-bottom: 4px;
        }
        .fc-button-group button + button {
            border-left-color: #ddd;
        }
        .fc-button-group button:hover {
            background: #3a99dc;
            border: 1px solid #1075bc;
        }
        .fc-cell-text {
            font-size: 13px;
        }
        .fc-right {
            display: none;
        }
    </style>
@endpush

@push('page-js')
    <script src='{{ asset('js/fullcalendar-scheduler/packages/core/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/timeline/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-common/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages-premium/resource-timeline/main.js') }}'></script>
    <script src='{{ asset('js/fullcalendar-scheduler/packages/interaction/main.js') }}'></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}" type="text/javascript"></script>
    <script src='{{ asset('js/tms/dashboard-calender.js') }}'></script>
    <script type="text/javascript">
        let speakerEvaluationTableId = 'speaker-evaluation-table';
        let genericErrorMessage = `{{ trans('labels.generic_error_message') }}`;
        let courseEvaluationTableId = 'course-evaluation';
        let courseTable = $('#course-evaluation').DataTable();
        let data = @json($assessmentsBySessions);
        let coursesForDropdown = @json($courses->pluck('name', 'id'));
        let courseEvaluationData = @json($courseEvaluationLists);
        let all = `{{ trans('labels.all') }}`;




        function createFilter(collection, label, filterId) {
            let otherOptions = '';

            for (key in collection) {
                if (filterId != 'course-filter') {
                    otherOptions += `<option value=${all}>${all}</option>`;
                }
                otherOptions += `<option value="${key}">${collection[key]}</option>`
            }

            return `<div class="col-md-3"><div class="form-group"><labels>${label}</labels> <br>
                <select id="${filterId}" class="form-control form-control-sm select2">
                        ${otherOptions}
                         </select>
                </div></div>`;
        }

        function is_equal(value1, value2) {
            let is_equal = value1 === all ? true : (value1 == value2)
            return is_equal;
        }

        function uniqueValue(data) {
            return data.filter((item, index, self) => self.indexOf(item) === index);
        }


        $(document).ready(function() {
            let fiscalYearStart = @json($fiscalYearStart->format('Y-m-d'));
            let fiscalYearEnd = @json($fiscalYearEnd->format('Y-m-d'));
            // dashboard - calender
            let calendarEvents = @json($calendarEvents, JSON_UNESCAPED_UNICODE);
            let calendarResources = @json($calendarResources, JSON_UNESCAPED_UNICODE);
            // console.log(calendarResources);
            let calendarResourceColumns = @json($calendarResourceColumns, JSON_UNESCAPED_UNICODE);
            
            let dashboardCalender = new DashboardCalender('calender', calendarEvents, calendarResources, calendarResourceColumns);
            dashboardCalender.init();



            console.log(calendarEvents, calendarResources, calendarResourceColumns);




            {{-- 
            // assessment
            let unqiueCourses = @json($assessmentsBySessions->pluck('course_name', 'course_id')->toArray());
            let unqiueModules = @json($assessmentsBySessions->pluck('module_name', 'module_id')->toArray());
            let unqiueSessions = @json($assessmentsBySessions->pluck('session_name', 'session_id')->toArray());
            let unqiueSpeakers = @json($assessmentsBySessions->pluck('speaker_name', 'speaker_id')->toArray());

            function generateAndChangeOption(value, sectionid) {
                uniqueOptionData = uniqueValue(value);
                let option = `<option value=${all}>${all}</option>`;
                switch (sectionid) {
                    case "course-filter":
                        data.forEach(element => {
                            uniqueOptionData.forEach(element_id => {
                                if (is_equal(element_id, element.module_id)) {
                                    option +=
                                        `<option value="${element_id}">${element.module_name}</option>`;
                                    let index = uniqueOptionData.indexOf(element_id);
                                    if (index !== -1) {
                                        uniqueOptionData.splice(index, 1);
                                    }
                                }
                            });
                        });
                        $('#module-filter').html(option)
                        break;
                    case "module-filter":
                        data.forEach(element => {
                            uniqueOptionData.forEach(element_id => {
                                if (is_equal(element_id, element.session_id)) {
                                    option +=
                                        `<option value="${element_id}">${element.session_name}</option>`;
                                    let index = uniqueOptionData.indexOf(element_id);
                                    if (index !== -1) {
                                        uniqueOptionData.splice(index, 1);
                                    }
                                }
                            });
                        });
                        $('#session-filter').html(option)
                        break;
                    case "session-filter":
                        data.forEach(element => {
                            uniqueOptionData.forEach(element_id => {
                                if (is_equal(element_id, element.speaker_id)) {
                                    option +=
                                        `<option value="${element_id}">${element.speaker_name}</option>`;
                                    let index = uniqueOptionData.indexOf(element_id);
                                    if (index !== -1) {
                                        uniqueOptionData.splice(index, 1);
                                    }
                                }
                            });
                        });
                        $('#speaker-filter').html(option)
                        break;
                    case "speaker-filter":
                        break;
                }

            }

            function changeModuleDependentOptions(optionsInModule) {
                let selected_course = $(`#course-filter`).val();
                let sessionOptionValue = [];
                let speakerOptionValue = [];

                data.forEach(element => {
                    optionsInModule.forEach(module_id => {
                        if (is_equal(selected_course, element.course_id) && is_equal(module_id,
                                element.module_id)) {
                            sessionOptionValue.push(element.session_id);
                        }
                    });
                })

                data.forEach(element => {
                    optionsInModule.forEach(module_id => {
                        sessionOptionValue.forEach(session_id => {
                            if (is_equal(selected_course, element.course_id) &&
                                is_equal(module_id, element.module_id) &&
                                is_equal(session_id, element.session_id)) {
                                speakerOptionValue.push(element.speaker_id);
                            }

                        })

                    });

                })
                //
                generateAndChangeOption(sessionOptionValue, 'module-filter');
                generateAndChangeOption(speakerOptionValue, 'session-filter');
            }

            function changeSessionDependentOptions(optionsInSession) {

                let selected_course = $(`#course-filter`).val();
                let selected_module = $(`#module-filter`).val();
                let speakerOptionValue = [];

                data.forEach(element => {

                    optionsInSession.forEach(session_name => {

                        if (is_equal(selected_course, element.course_id) && is_equal(
                                selected_module, element.module_id) && is_equal(session_name,
                                element.session_id)) {
                            speakerOptionValue.push(element.speaker_id);
                        }

                    })

                });
                generateAndChangeOption(speakerOptionValue, 'session-filter');
            }

            function changeOption(value, id) {
                let selected_course = $(`#course-filter`).val();
                let selected_module = $(`#module-filter`).val();
                let selected_session = $(`#session-filter`).val();
                let selected_speaker = $(`#speaker-filter`).val();

                let optionData = [];
                switch (id) {
                    case "course-filter":
                        data.forEach(element => {
                            if (is_equal(value, element.course_id)) {
                                optionData.push(element.module_id);
                            }
                        });
                        changeModuleDependentOptions(uniqueValue(optionData));
                        break;

                    case "module-filter":

                        data.forEach(element => {

                            if (is_equal(selected_course, element.course_id) &&
                                is_equal(value, element.module_id)) {
                                optionData.push(element.session_id);
                            }

                        });
                        changeSessionDependentOptions(uniqueValue(optionData));
                        break;

                    case "session-filter":

                        data.forEach(element => {

                            if (is_equal(selected_course, element.course_id) &&
                                is_equal(selected_module, element.module_id) &&
                                is_equal(value, element.session_id)
                            ) {
                                optionData.push(element.speaker_id);
                            }

                        });

                        break;

                    case "speaker-filter":
                        break;
                }

                generateAndChangeOption(optionData, id);

            }

            //---------------------------------------------------------------------------------------------
            let table = $('#speaker-evaluation-table').dataTable();

            let courseFilter = createFilter(coursesForDropdown, '{!! trans('tms::course.title') !!}', 'course-filter');
            let moduleFilter = createFilter(unqiueModules, '{!! trans('tms::module.title') !!}', 'module-filter');
            let sessionFilter = createFilter(unqiueSessions, '{!! trans('tms::session.title') !!}', 'session-filter');
            let speakerFilter = createFilter(
                unqiueSpeakers,
                '{!! trans('tms::training.evaluation.speaker_name') !!}',
                'speaker-filter'
            );

            $('.filters-container').append(`
                ${courseFilter}
                ${moduleFilter}
                ${sessionFilter}
                ${speakerFilter}
            `);

            $('#course-filter, #module-filter, #session-filter, #speaker-filter').on('change', function() {
                if (this.id == "course-filter") {
                    // make an ajax call , update data variable
                    let value = $(this).val();
                    let url = '{{ route('training.evaluate.course-json', ':id') }}';
                    let id = 'course-filter';
                    url = url.replace(":id", value);
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(responseData) {
                            // update the global data variable
                            table.DataTable().clear().draw();
                            data = responseData;
                            populateSpeakerEvaluationDatatable(table, data);
                            changeOption(value, id);
                            table.DataTable().draw();
                        },
                        error: function(request, status, error) {
                            alert(genericErrorMessage);
                            table.DataTable().draw();
                            return;
                        }
                    });
                } else {
                    changeOption($(this).val(), this.id);
                    table.DataTable().draw();
                }
            });

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    let tableId = settings.nTable.id;
                    if (tableId == speakerEvaluationTableId) {
                        let course = $('#course-filter option:selected').text();
                        let module = $('#module-filter option:selected').text();
                        let session = $('#session-filter option:selected').text();
                        let speaker = $('#speaker-filter option:selected').text();

                        return isEqual(course, data[1], '#course-filter') &&
                            isEqual(module, data[2], '#module-filter') &&
                            isEqual(session, data[3], '#session-filter') &&
                            isEqual(speaker, data[4], '#speaker-filter');
                    }
                    if (tableId == courseEvaluationTableId) {
                        let training = $('#training-search').val();
                        let course = $('#course-search').val();
                        return isEqual(training, data[0], '#training-search') &&
                            isEqual(course, data[1], '#course-search');
                    }
                }
            );

            function isEqual(filterValue, columnValue, filter) {
                return (filterValue === all ? true : (filterValue === columnValue));
            }

            function optionNameChack(filter, columnValue) {
                // return true;
                return $(filter).find('option[value="' + columnValue + '"]').length > 0;
            }

            $(".select2").select2({});
            $("#course-filter").select2().select2("val", "" + @json($latestCourse->id));
            --}}

        });
{{-- 
        function populateSpeakerEvaluationDatatable(table, data) {
            for (let row = 0; row < data.length; row++) {
                let obj = data[row];
                table.fnAddData([
                    obj.training_name,
                    '<a href="' + obj.course_url + '">' + obj.course_name + '</a>',
                    obj.module_name,
                    '<a href="' + obj.session_url + '">' + obj.session_name + '</a>',
                    obj.speaker_name,
                    obj.assessment_value_in_word + ' - ' + obj.final_average
                ]);
            }
        }

        $(".select2").select2({
            placeholder: 'select 1',
        });

        //course evaluation lists
        $(document).ready(function() {
            $('#training-search').on('change', function() {
                modifyCourseSearchFilter(this.value);
                courseTable.draw();
            });
            $('#course-search').on('change', function() {
                courseTable.draw();
            });

            function modifyCourseSearchFilter($trainingValue) {
                let optionData = [];
                courseEvaluationData.forEach(element => {
                    if ($trainingValue == all) {
                        optionData.push(element.courseName);
                    } else {
                        if (is_equal($trainingValue, element.trainingName)) {
                            optionData.push(element.courseName);
                        }
                    }
                });
                let uniqueOptionData = uniqueValue(optionData);
                let option = `<option value=${all}>${all}</option>`;
                uniqueOptionData.forEach((element) => {
                    option += `<option value="${element}">${element}</option>`;
                });
                $('#course-search').html(option)
            }
        });
--}}
    </script>
@endpush
