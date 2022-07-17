@extends('tms::layouts.master')
@section('title', __('tms::budget.sector.title').' '.__('labels.show'))

@section('content')
    <!-- General Information Card -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h4 class="">
                        <strong>@lang('pms::project-activity.details.page_title') @lang('labels.show') </strong>
                        <a class="btn btn-warning mr-1 float-right" role="button" href="{{ route('project.show', $project->id) }}">
                            <i class="ft ft-arrow-left"></i> {{trans('labels.back_page')}}
                        </a>
                        <hr class="mt-2">
                    </h4>

                </div>

                <section>
                    <div class="row match-height">
                        <div class="col-md-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-12 ml-1 mt-0">
                                                <div class="form-group">
                                                    <label>{{ trans('pms::project-activity.activity.project_title') }}: <span
                                                            class="badge bg-blue-grey">{{ isset($project) ? $project->title : null }}</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 ml-1 mt-0">
                                                <div class="form-group">
                                                    <label>{{ trans('pms::project-activity.activity.activity_title') }}: <span
                                                            class="badge bg-cyan">{{ isset($project) ? $activity->name : null }}</span></label>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row match-height">
                                                <div class="col-md-12">
                                                    @include('pms::project-activity.task.partials.gantt-chart')
                                                </div>
                                            </div>

                                            <!--Task-->
                                            <section class="row">
                                                <div class="col-md-12">
                                                    @include('pms::project-activity.task.partials.table', [
                                                        'taskable' => $activity,
                                                        'module' => 'pms-activity',
                                                        'multi_parameter' => [$project->id, $activity->id]
                                                    ])
                                                </div>
                                            </section>

{{--                                            <!--Monthly Update-->--}}
                                            <section class="row">
                                                <div class="col-md-12">
                                                    @include('pms::project-activity.monthly-update.partials.table', [
                                                        'monthlyUpdatable' => $activity,
                                                        'module' => 'pms-activity-task'
                                                    ])
                                                </div>
                                            </section>

{{--                                            <!--Financial Update-->--}}
{{--                                            <section class="row">--}}
{{--                                                <div class="col-md-12">--}}
{{--                                                    @include('../../../monthly-update.partials.table', [--}}
{{--                                                        'monthlyUpdatable' => $project,--}}
{{--                                                        'module' => 'pms'--}}
{{--                                                    ])--}}
{{--                                                </div>--}}
{{--                                            </section>--}}

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
    <style>
        .card-body-min-height {
            min-height: 390px;
            height: auto;
        }
        .gantt_task_progress {
            color: white;
        }

        .gantt_layout_cell .gantt_task_line {
            background-color: #a2a8a8
        }
        .gantt_task_line {
            border: white !important;
        }
    </style>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/js/charts/dhtmlx-gantt/codebase/dhtmlxgantt-pro.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/dhtmlx-gantt/chart-pro.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <!-- repeater -->
{{--    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}"></script>--}}

    <script src="{{ asset('theme/vendors/js/charts/dhtmlx-gantt/codebase/dhtmlxgantt-pro.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/charts/dhtmlx-gantt/export/api.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('theme/js/scripts/charts/dhtmlx-gantt/chart-pro.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
{{--    <script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>--}}



    <script>
        /* Gantt chart
        ---------------------------
            - Following - Baseline Src : https://docs.dhtmlx.com/gantt/samples/04_customization/15_baselines.html
            - Following - TaskLayer Src : https://dhtmlx.com/docs/products/dhtmlxGantt/02_features.html
            - Following - Custom Style Src : https://dhtmlx.com/docs/products/dhtmlxGantt/common/customstyles.css

            - Variables
                - let nodeName = "GanttChartDIV";
                - let chartData = {
                    "data": [],
                    "links": []
                };

        */

        var GanttChartCustomCSSUrl = window.location.protocol + window.location.host + '/theme/css/plugins/dhtmlx-gantt/chart-pro.css';

        $(window).on("load", function () {
            gantt.config.readonly = true;

            gantt.config.scale_unit = "week";
            gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
            gantt.config.task_height = 17;
            gantt.config.row_height = 45;

            // gantt.templates.progress_text=function(start, end, task){
            //     return formatProgress(task)
            // };

            // gantt.templates.progress_text = function(start, end, task){
            //     let progressToStr = task.progress.toString();
            //     return progressToStr;
            // };

            gantt.templates.task_text=function(start,end,task){
                // let progressToStr = task.progress.toString();
                // // return task.text;
                return task.text + " (" + task.progress * 100 + "%" + ")";
            };

            // adding baseline display
            gantt.addTaskLayer(function draw_planned(task) {
                if (task.planned_start && task.planned_end) {
                    var sizes = gantt.getTaskPosition(task, task.planned_start, task.planned_end);
                    var el = document.createElement('div');
                    el.className = 'baseline';
                    el.style.left = sizes.left + 'px';
                    el.style.width = sizes.width + 'px';
                    el.style.top = sizes.top + gantt.config.task_height + 13 + 'px';
                    el.setAttribute('title', gantt.templates.task_date(task.planned_end));

                    return el;
                }
                return false;
            });

            // Task Line
            gantt.addTaskLayer(function draw_planned(task) {
                if (task.planned_start && task.planned_end) {
                    var sizes = gantt.getTaskPosition(task, task.planned_start, task.planned_end);
                    var el = document.createElement('div');
                    el.className = 'gantt_bar_task';
                    el.style.left = sizes.left + 'px';
                    el.style.width = 10 + 'px';
                    el.style.top = sizes.top + gantt.config.task_height + 13 + 'px';
                    el.setAttribute('title', gantt.templates.task_date(task.planned_end));

                    return el;
                }
                return false;
            });

            gantt.templates.task_class = function (start, end, task) {
                if (task.planned_end) {
                    var classes = ['has-baseline'];
                    if (end.getTime() > task.planned_end.getTime()) {
                        classes.push('overdue');
                    }
                    return classes.join(' ');
                }
            };

            gantt.templates.rightside_text = function (start, end, task) {
                if (task.planned_end) {
                    if (end.getTime() > task.planned_end.getTime()) {
                        var overdue = Math.ceil(Math.abs((end.getTime() - task.planned_end.getTime()) / (24 * 60 * 60 * 1000)));
                        var text = "<b>Overdue: " + overdue + " days</b>";
                        return text;
                    }
                }
            };

            gantt.config.columns = [
                {
                    name: "text",
                    label: "Task name",
                    width: "*"
                },
                {
                    name: "start_date",
                    label: "Start time",
                    align: "center"
                },
                {
                    name: "duration",
                    label: "Duration",
                    align: "center"
                },
            ];


            gantt.attachEvent("onTaskLoading", function (task) {
                task.planned_start = gantt.date.parseDate(task.planned_start, "xml_date");
                task.planned_end = gantt.date.parseDate(task.planned_end, "xml_date");
                return true;
            });

            gantt.init(nodeName);
            gantt.parse(chartData);
            zoomTasks("year");

        });

        function exportGantt(mode) {
            if (mode == "png")
                gantt.exportToPNG({
                    header: `<link rel="stylesheet" href="${GanttChartCustomCSSUrl}" type="text/css">`,
                    raw:true
                });
            else if (mode == "pdf")
                gantt.exportToPDF({
                    header: `<link rel="stylesheet" href="${GanttChartCustomCSSUrl}" type="text/css">`,
                    raw:true
                });
        }

        function zoomTasks(scale){
            console.log(scale);
            switch(scale){
                case "hours":
                    gantt.config.scale_unit = "day";
                    gantt.config.date_scale = "%d %M";

                    gantt.config.scale_height = 60;
                    gantt.config.min_column_width = 30;
                    gantt.config.subscales = [
                        {unit:"hour", step:1, date:"%H"}
                    ];
                    break;
                case "day":
                    gantt.config.min_column_width = 70;
                    gantt.config.scale_unit = "day";
                    gantt.config.date_scale = "%d %M";
                    gantt.config.subscales = [ ];
                    gantt.config.scale_height = 35;
                    break;
                case "week":
                    gantt.config.min_column_width = 70;
                    gantt.config.scale_unit = "week";
                    gantt.config.date_scale = "Week %W";
                    gantt.config.subscales = [
                        {unit:"day", step:1, date:"%D"}
                    ];
                    gantt.config.scale_height = 60;
                    break;
                case "month":
                    gantt.config.min_column_width = 70;
                    gantt.config.scale_unit = "month";
                    gantt.config.date_scale = "%M";
                    gantt.config.scale_height = 60;
                    gantt.config.subscales = [
                        {unit:"week", step:1, date:"%W"}
                    ];
                    break;
                case "year":
                    gantt.config.min_column_width = 70;
                    gantt.config.scale_unit = "year";
                    gantt.config.date_scale = "%Y";
                    gantt.config.scale_height = 60;
                    gantt.config.subscales = [
                        {unit:"month", step:1, date:"%M"}
                    ];
                    break;
            }

            gantt.render();
        }
    </script>

    <script>
        let nodeName = "GanttChartDIV";
        let chartData = {
            "data": JSON.parse('{!! json_encode($ganttChart) !!}')
        };
    </script>
@endpush
