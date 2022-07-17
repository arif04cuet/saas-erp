@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.project_details'))

@section('content')
    <div class="content-header row">
        @if (Auth::user()->hasRole('ROLE_PROJECT_DIRECTOR'))

            <div class="content-header-left col-md-2 col-12">
                <div class="btn-group float-md-left" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <a class="btn btn-outline-info round" href="{{ route('project-training.index', $project->id) }}">
                            <i class="ft-plus"></i> @lang('pms::project.training_list')
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="content-header-right col-md-2 col-12">
            <div class="btn-group float-md-left" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-info round" href="{{ route('project-budget.index', $project->id) }}">
                        <i class="ft-eye"></i> @lang('pms::project_budget.title') @lang('labels.details')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- Basic tabs start -->
    <section>
        <div class="row match-height" id="project-details">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::project_proposal.project_details')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.title')</dt>
                                    <dd class="col-sm-9">{{ $project->title }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.purposes')</dt>
                                    <dd class="col-sm-9">
                                        @if ($project->purpose)
                                            <p>{{ $project->purpose }}</p>
                                        @else
                                            <p>@lang('labels.not_found')</p>
                                        @endif
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project_proposal.project_budget')</dt>
                                    <dd class="col-sm-9">
                                        @if (isset($project->budget))
                                            {{ $project->budget }}
                                        @else
                                            <p class="text-warning">Not Added</p>
                                        @endif

                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project_proposal.project_duration')</dt>
                                    <dd class="col-sm-9">
                                        @if (isset($project->duration))
                                        {{ \Carbon\Carbon::parse($project->created_at)->format('Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($project->created_at)->addYear($project->duration)->format('Y') }}
                                        ( {{ $project->duration ?? 0 }} )

                                        @else
                                            <p class="text-warning">Not Added</p>
                                        @endif
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project_proposal.submitted_by')</dt>
                                    <dd class="col-sm-9">{{ $project->projectSubmittedByUser->name }}</dd>
                                </dl>

                                {{-- New --}}
                                <dl class="row">
                                    <dt class="col-sm-3">{{ trans('pms::project.project_director_id') }}</dt>
                                    <dd class="col-sm-9">{{ is_null($project->projectAssignedRole) ? trans('labels.not_found') : optional($project->projectAssignedRole)->projectDirector->getName() }}</dd>
                                </dl>

                                <dl class="row">
                                    <dt class="col-sm-3">{{ trans('pms::project.project_sub_director_id') }}</dt>
                                    <dd class="col-sm-9">{{ is_null($project->projectAssignedRole) ? trans('labels.not_found') : optional($project->projectAssignedRole)->projectSubDirector->getName() }}</dd>
                                </dl>
                                {{-- New --}}
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project_proposal.approval_date')</dt>
                                    <dd class="col-sm-9">
                                        @if ($project->proposal)
                                            {{ date('d/m/Y,  h:iA', strtotime($project->proposal->updated_at)) }}
                                        @endif
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.status')</dt>
                                    <dd class="col-sm-9">@lang('pms::project_proposal.in_progress')</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('member.member')</dt>
                                    <dd class="col-sm-9">{{ $femaleMembersCount }} @lang('labels.female')
                                        , {{ $maleMembersCount }} @lang('labels.male')</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                @if (Auth::user()->hasAnyRole(['ROLE_PROJECT_DIRECTOR', 'ROLE_DIRECTOR_GENERAL', 'ROLE_DIRECTOR_PROJECT']))
                                    <li class="nav-item">
                                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                            href="#tab1"
                                            aria-expanded="true">@lang('pms::project.report')</a>
                                    </li>

                                    @if (Auth::user()->hasRole('ROLE_PROJECT_DIRECTOR'))
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                                href="#tab2"
                                                aria-expanded="false">@lang('pms::project.add_planned_achieved')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                                href="#tab3"
                                                aria-expanded="false">@lang('pms::project_proposal.planning')</a>
                                        </li>
                                    @endif

                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="tab5"
                                            href="#tab5" aria-expanded="false">@lang('pms::project_proposal.activities')</a>
                                    </li>

                                   

                                @endif
                                @if (in_designation('PD', 'FM'))
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab3"
                                            href="#tab4" aria-expanded="false">@lang('pms::project.beneficiary')</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <!-- tab 1  content -->
                                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true"
                                    aria-labelledby="base-tab6">

                                    <div class="row">
                                        <div class="skin skin-flat col-md-2">
                                            {!! Form::radio('graph_type', 'organization_report' ,'checked') !!}
                                            <label>@lang('organization.organization')</label>
                                        </div>

                                        <div class="skin skin-flat col-md-2">
                                            {!! Form::radio('graph_type', 'project_report') !!}
                                            <label>@lang('pms::project.title')</label>
                                        </div>
                                    </div>

                                    <br>

                                    <div id="organization-graph" style="display: block">
                                        @include('pms::organization.chart')
                                    </div>

                                    <div id="project-graph" style="display: none">
                                        @include('pms::project.attribute.chart')
                                    </div>

                                </div>


                                <!-- tab 2 content -->
                                <div role="tabpanel" class="tab-pane" id="tab2" aria-expanded="true">

                                    <div class="row">
                                        <div class="skin skin-flat col-md-2">
                                            {!! Form::radio('indicator_type', 'organization' ,'checked') !!}
                                            <label>@lang('organization.organization')</label>
                                        </div>

                                        <div class="skin skin-flat col-md-2">
                                            {!! Form::radio('indicator_type', 'project') !!}
                                            <label>@lang('pms::project.title')</label>
                                        </div>
                                    </div>

                                    <br>

                                    <div id="organization-indicator" style="display: block">
                                        @include('pms::organization.create-indicator')
                                    </div>
    
                                    <div id="project-indicator" style="display: none">
                                        @include('pms::project.attribute.index')
                                    </div>
                                   
                                </div>
                                <!-- tab 3 content -->
                                <div role="tabpanel" class="tab-pane" id="tab3" aria-expanded="true">
                                    <div class="row match-height">
                                        <div class="col-md-12">
                                            @include('../../../task.partials.gantt-chart')
                                        </div>
                                    </div>

                                    <section class="row">
                                        <div class="col-md-12">
                                            @include('pms::project.partials.plan-summary')
                                        </div>
                                    </section>

                                    <section class="row">
                                        <div class="col-md-12">
                                            @include('../../../task.partials.table', [
                                            'taskable' => $project,
                                            'module' => 'pms'
                                            ])
                                        </div>
                                    </section>

                                    <section class="row">
                                        <div class="col-md-12">
                                            @include('../../../monthly-update.partials.table', [
                                            'monthlyUpdatable' => $project,
                                            'module' => 'pms'
                                            ])
                                        </div>
                                    </section>
                                </div>
                                <!-- tab 4 content -->
                                <div id="tab4" class="tab-pane" role="tabpanel" aria-expanded="true">
                                    <div class="table-responsive">
                                        <table class="table table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('labels.serial')</th>
                                                    <th>@lang('organization.organization')</th>
                                                    <th>@lang('member.member')</th>
                                                    <th>@lang('labels.gender')</th>
                                                    <th>@lang('labels.number')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sl = 1;
                                                @endphp
                                                @foreach ($project->organizations as $organization)
                                                    @foreach ($organization->members as $member)
                                                        <tr>
                                                            <td>{{ $sl++ }}</td>
                                                            <td>{{ $organization->name }}</td>
                                                            <td>{{ $member->name }}</td>
                                                            <td>@lang('labels.' . $member->gender)</td>
                                                            <td>{{ $member->mobile }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- tab 5 content -->
                                <div id="tab5" class="tab-pane" role="tabpanel" aria-expanded="true">
                                    <section class="row">
                                        <div class="col-md-12">
                                            @include('pms::project-activity.index')
                                        </div>
                                    </section>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic badge Input end -->
@endsection

@push('page-css')
    <style>
        .card-body-min-height {
            min-height: 390px;
            height: auto;
        }

    </style>

    {{-- DateRanger --}}
    <link rel="stylesheet" href="{{  asset('theme/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/pickers/daterange/daterange.css')  }}">


    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/vendors/js/charts/dhtmlx-gantt/codebase/dhtmlxgantt-pro.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/dhtmlx-gantt/chart-pro.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">

@endpush

@push('page-js')


    <script src="{{ asset('theme/vendors/js/charts/dhtmlx-gantt/codebase/dhtmlxgantt-pro.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('theme/vendors/js/charts/dhtmlx-gantt/export/api.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/charts/dhtmlx-gantt/chart-pro.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>

    {{-- DatePicker --}}
  <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.js')  }}"></script>
  <script src="{{ asset('theme/vendors/js/pickers/pickadate/picker.date.js') }}"></script>


    <script>

        

        async function getAttributeValueDetailsByMonthYear(projectId, attributeId) {
            let attributeGraphUrl = `${projectId}/attributes/${attributeId}/graphs`;
            return await $.get(attributeGraphUrl);
        }

        async function getProjectAttributeValueDetailsByMonthYear(projectId, attributeId) {
            let attributeGraphUrl = `${projectId}/projectattributes/${attributeId}/graphs`;
            return await $.get(attributeGraphUrl);
        }

        function generateChart(monthYears, attributeValue, chartType,chartContext,chartPersistentKey ) {
            function doesChartExist() {
                return chartObject !== undefined;
            }

            function destroyChart() {
                if (doesChartExist()) {
                    chartObject.destroy();
                }
            }

            let chartObject = chartContext.data(chartPersistentKey);
            let chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: '{!! trans('month.month') !!}'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: '{!! trans('attribute.value') !!}'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: '{!! trans('attribute.attribute_values_line_chart') !!}'
                }
            };
            let chartData = {
                labels: monthYears,
                datasets: [{
                    label: `${attributeValue.name} - {!! trans('attribute.planned') !!}`,
                    data: attributeValue.monthly_planned_values,
                    fill: false,
                    borderDash: [5, 5],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }, {
                    label: `${attributeValue.name} - {!! trans('attribute.achieved') !!}`,
                    data: attributeValue.monthly_achieved_values,
                    lineTension: 0,
                    fill: false,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };
            let chartConfig = {
                type: chartType,
                options: chartOptions,
                data: chartData
            };

            if (chartType == 'polarArea') {
                delete chartOptions['scales'];
            }

            destroyChart();
            chartContext.data(chartPersistentKey, new Chart(chartContext, chartConfig));
        }

        function initializeGraphVariables(attributeName, attributeValuesByMonthYear) {
            let uniqueMonthYears = attributeValuesByMonthYear.map(attributeValue => {
                return attributeValue.monthYear;
            });
            let attributeValues = {};
            attributeValues.name = attributeName;
            attributeValues.monthly_achieved_values = attributeValuesByMonthYear.map(attributeValue => {
                return attributeValue.total_achieved_value;
            });
            attributeValues.monthly_planned_values = attributeValuesByMonthYear.map(attributeValue => {
                return attributeValue.total_planned_value;
            });
            return {
                uniqueMonthYears,
                attributeValues
            };
        }

        function renderGraph(projectId, attributeId, self) {
            getAttributeValueDetailsByMonthYear(projectId, attributeId)
                .then((attribute) => {
                    let {
                        uniqueMonthYears,
                        attributeValues
                    } = initializeGraphVariables(attribute.name, attribute.attributeValues);
                    self.uniqueMonthYear = uniqueMonthYears;
                    self.attributeValues = attributeValues;
                    let chartType = $('input[type=radio][name=chart_type]:checked').val();
                    let chartContext = $('#chart');
                    let chartPersistentKey = "chart";
                    generateChart(uniqueMonthYears, attributeValues, chartType,chartContext,chartPersistentKey);
                })
                .catch(error => {
                    // TODO: show lang error message
                    console.log(error)
                });
        }

        function renderProjectGraph(projectId, attributeId, self) {

            getProjectAttributeValueDetailsByMonthYear(projectId, attributeId)
                .then((attribute) => {
                    let {
                        uniqueMonthYears,
                        attributeValues
                    } = initializeGraphVariables(attribute.name, attribute.attributeValues);
                    self.uniqueMonthYear = uniqueMonthYears;
                    self.attributeValues = attributeValues;
                    let chartType = $('input[type=radio][name=project_chart_type]:checked').val();
                    let chartContext = $('#chartProject');
                    let chartPersistentKey = "chartProject";
                    generateChart(uniqueMonthYears, attributeValues, chartType,chartContext,chartPersistentKey);
                })
                .catch(error => {
                    // TODO: show lang error message
                    console.log(error)
                });
        }

        function calculateTotalForCol(api, intVal, colIndex) {
            let totalLabel = '{!! trans('labels.total') !!}';

            // Total over all pages
            total = api
                .column(colIndex)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(colIndex, {
                    page: 'current'
                })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(colIndex).footer()).html(`${pageTotal} (${total} ${totalLabel})`);
        }

        let tableProjectAtt;

        $(document).ready(function() {
            $('.task-table, .monthly-update-table').DataTable({
                "pageLength": 5
            });

            $('.organization-table').DataTable({
                dom: 'Bfrtip',
              
                "pageLength": 50,
                'footerCallback': function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    calculateTotalForCol(api, intVal, 2);
                    calculateTotalForCol(api, intVal, 3);
                    calculateTotalForCol(api, intVal, 4);
                    calculateTotalForCol(api, intVal, 5);
                }
            });

            let projectId = JSON.parse('{!! json_encode($project->id) !!}');
            let attributeId = $('select[name=attribute_id]').val();
            let projectAttributeId = $('select[name=project_attribute_id]').val();
            let self = this;
            let uniqueMonthYear = [];
            let attributeValues = {};




            renderGraph(projectId, attributeId, self);
            renderProjectGraph(projectId, projectAttributeId, self);

            $('select[name=attribute_id]').on('change', function() {
                let attributeId = $(this).val();
                $("input[name=project_attribute_id][value=" + attributeId + "]").attr('checked', 'checked');
                renderGraph(projectId, attributeId, self);
            });
            
            $('select[name=project_attribute_id]').on('change', function() {
                let projectAttributeId = $(this).val();
                $("input[name=attribute_id][value=" + projectAttributeId + "]").attr('checked', 'checked');
                renderProjectGraph(projectId, projectAttributeId, self);
            });


            $('input[type=radio][name=chart_type]').on('ifChecked', function(event) {
                let chartType = $(this).val();
                let chartContext = $('#chart');
                let chartPersistentKey = "chart";
                generateChart(self.uniqueMonthYear, self.attributeValues, chartType,chartContext,chartPersistentKey);
            });

            $('input[type=radio][name=project_chart_type]').on('ifChecked', function(event) {
                let chartType = $(this).val();
                chartContext = $('#chartProject');
                chartPersistentKey = "chartProject";
                generateChart(self.uniqueMonthYear, self.attributeValues, chartType,chartContext,chartPersistentKey);
            });

            //Change Organization or Project type for graph
            $('input[type=radio][name=graph_type]').on('ifChecked', function(event) {
                let chartType = $(this).val();

                if(chartType=='organization_report'){
                    $("#organization-graph").css("display", "block");
                    $("#project-graph").css("display", "none");
                    renderGraph(projectId, attributeId, self);
                }else{
                    $("#organization-graph").css("display", "none");
                    $("#project-graph").css("display", "block");
                    renderProjectGraph(projectId, projectAttributeId, self);

                }
            });


            //Change Organization or Project type for add planned/achieved value
            $('input[type=radio][name=indicator_type]').on('ifChecked', function(event) {
                let chartType = $(this).val();

                if(chartType=='organization'){
                    $("#organization-indicator").css("display", "block");
                    $("#project-indicator").css("display", "none");
                }else{
                    $("#organization-indicator").css("display", "none");
                    $("#project-indicator").css("display", "block");

                }
            });

            tableProjectAtt = $('.project-attribute ').dataTable({
                searching: false,
                "bPaginate": false,
                // dom: 'Bfrtip',
                paging: false,
                // buttons: [
                //     {
                //         extend: 'copy', className: 'copyButton',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                //     {
                //         extend: 'excel', className: 'excel',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                //     {
                //         extend: 'pdf', className: 'pdf', "charset": "utf-8",
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                //     {
                //         extend: 'print', className: 'print',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                // ],
            });

            tableOrgAtt = $('.organization-attribute ').dataTable({
                searching: false,
                "bPaginate": false,
                // dom: 'Bfrtip',
                paging: false,
                // buttons: [
                //     {
                //         extend: 'copy', className: 'copyButton',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                //     {
                //         extend: 'excel', className: 'excel',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                //     {
                //         extend: 'pdf', className: 'pdf', "charset": "utf-8",
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                //     {
                //         extend: 'print', className: 'print',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4],
                //         }
                //     },
                // ],
            });


            // Filter using DateRanger
            $('input[name=period_from], input[name=period_to]').pickadate({
                    format: 'dd/mm/yyyy',
                    selectYears: true,
                    selectMonths: true,
                    selectDates: true,
                    
            });

            $('input[name=period_from_org], input[name=period_to_org]').pickadate({
                format: 'dd/mm/yyyy',
                selectYears: true,
                selectMonths: true,
                selectDates: true,
            });
        
        });

        

        

        // AjaxWork for DateRanger
        $("#search_in_project").click(function (e) {
            e.preventDefault();
            loadData('project');            
        });

        $("#search_in_organization").click(function (e) {
            e.preventDefault();
            loadData('organization');            
        });


        // projectId

        

        function loadData(flag) {
            let buttonRef = $('#search').text(`{{trans('accounts::payroll.payslip_report.form_elements.search')}}`);
            buttonRef.removeClass("btn-success").addClass("btn-warning");
            let projectId = JSON.parse('{!! json_encode($project->id) !!}');

            let url;
            let table;
            let data ;
            let dateFrom ;

            if (flag == 'project') {
                url = "{{ url('pms/projects/getvaluebydaterange/') }}" ;
                table = tableProjectAtt; 
                data = $("#value-filter-form").serialize();
                dateFrom = $(".period_from").val();
                dateTo = $(".period_to").val();
            } else {
                url = "{{ url('pms/projects/getvaluebydaterangefororganization/') }}" ;
                table = tableOrgAtt; 
                data = $("#value-filter-form-organization").serialize();
                dateFrom = $(".period_from_org").val();
                dateTo = $(".period_to_org").val();
            }
            validateMaxOneYearDateRanger(dateFrom,dateTo);

            $.post(url + '/' + projectId , data ,function (data) {
                if(data[1]==0 || data[1]==3 ){
                    table.DataTable().clear().draw();
                    populateDatatable(table,data[0],data[1],flag);
                }else{
                    table.DataTable().clear().draw();
                    populateModifiedDatatable(table,data[0],data[1],flag);
                }
            });

        }

        function validateMaxOneYearDateRanger(dateFrom,dateTo)
        {
            let from = dateFrom[3]+dateFrom[4] + '/' + dateFrom[0]+dateFrom[1] + '/' +dateFrom[6]+dateFrom[7]+dateFrom[8]+dateFrom[9];
            let to = dateTo[3]+dateTo[4] + '/' + dateTo[0]+dateTo[1] + '/' +dateTo[6]+dateTo[7]+dateTo[8]+dateTo[9];

            from = new Date(from);
            to = new Date(to);

            var diff = new Date(to - from);
            var days = diff/1000/60/60/24;

            if(days>365){
                alert(`{{trans('pms::project.year_range_validation_message')}}`);
                return 0;
            }
        }

        function populateDatatable(table,data,flag,tableCheck) {

          
            if(flag==0){
                $('.organization-attribute th:nth-child(2),.organization-attribute td:nth-child(2)').show();
                $('.organization-attribute th:nth-child(3),.organization-attribute td:nth-child(3)').show();
                $('.organization-attribute th:nth-child(4),.organization-attribute td:nth-child(4)').show();
            }else{
                // $('.organization-attribute th:nth-child(2),.organization-attribute td:nth-child(2)').show();
                // $('.organization-attribute th:nth-child(3),.organization-attribute td:nth-child(3)').show();
                // $('.organization-attribute th:nth-child(4),.organization-attribute td:nth-child(4)').hide();
            }


            if(tableCheck=='organization'){
                changeDefaultColumnName("#organization-column1","#organization-column2","#organization-column3","#organization-column4");
            }else{
                changeDefaultColumnName("#column1","#column2","#column3","#column4");
            }

            for (let row = 0; row < data.length; row++) {
                let obj = data[row];
                table.fnAddData([
                    row + 1,
                    obj[0],
                    obj[1],
                    obj[2],
                    obj[3]
                ]);
            }
            
        }

        function changeColumnName(col1,col2,col3,col4){
            let month = `{{trans('labels.month')}}`;
            let planned_value = `{{trans('pms::attribute_planning.planning')}}`;
            let achieved_value = `{{trans('pms::attribute_planning.achieved')}}`;

            $(col1).text(month);
            $(col2).text(planned_value);
            $(col3).text(month);
            $(col4).text(achieved_value);

        }

        function changeDefaultColumnName(col1,col2,col3,col4){

            let attribute = `{{trans('attribute.attribute')}}`;
            let unit = `{{trans('labels.unit')}}`;
            let planned_value = `{{trans('pms::attribute_planning.planning')}}`;
            let achieved_value = `{{trans('pms::attribute_planning.achieved')}}`;

            $(col1).text(attribute);
            $(col2).text(unit);
            $(col3).text(planned_value);
            $(col4).text(achieved_value);

        }

        function populateModifiedDatatable(table,data,flag,tableCheck) {

            
            if(tableCheck=='organization'){
                changeColumnName("#organization-column1","#organization-column2","#organization-column3","#organization-column4");
            }else{
                changeColumnName("#column1","#column2","#column3","#column4");
            }

          
            if(flag==1){
            let maxLength = Math.max(data[0].length , data[1].length);
            for (let row = 0; row < maxLength; row++) {
                let objPlanned = data[0][row];
                let objAchieved = data[1][row];

                if(row>=data[1].length){
                    table.fnAddData([
                    row + 1,
                    objPlanned['month'],
                    objPlanned['planned_value'],
                    "",
                    ""
                ]);
                }else if(row>=data[0].length){
                    table.fnAddData([
                    row + 1,
                    "",
                    "",
                    objAchieved['month'],
                    objAchieved['achieved_value']
                ]);
                }else{
                    table.fnAddData([
                    row + 1,
                    objPlanned['month'],
                    objPlanned['planned_value'],
                    objAchieved['month'],
                    objAchieved['achieved_value']
                ]);

                }
                
            }
            $('.organization-attribute th:nth-child(2),.organization-attribute td:nth-child(2)').show();
            $('.organization-attribute th:nth-child(3),.organization-attribute td:nth-child(3)').show();
            $('.organization-attribute th:nth-child(4),.organization-attribute td:nth-child(4)').show();
            }

            if(flag==2){
                for (let row = 0; row <data[0].length; row++) {
                let objAchieved = data[0][row];
                    table.fnAddData([
                        row + 1,
                        "",
                        "",
                        objAchieved['month'],
                        objAchieved['achieved_value']
                    ]);
                }
                $('.organization-attribute th:nth-child(2),.organization-attribute td:nth-child(2)').hide();
                $('.organization-attribute th:nth-child(3),.organization-attribute td:nth-child(3)').hide();

               
            }
        }


        function loadingInfo() {
            let placeholder = `{{trans('accounts::payroll.payslip_report.form_elements.searching')}}`;
            let buttonRef = $('#search').html(placeholder);
            let counter = 1;
            myInterval = setInterval(function () {
                if (counter > 0 && counter < 4) {
                    buttonRef.append('.')
                } else {
                    counter = 0;
                    buttonRef.html(placeholder);
                }
                counter++;
            }, 200);
        }

        //Get Value from Organization Selector
        $("#org-dropdown").change(function () {
            let organizationId = this.value;
            let url = "{{ url('pms/projects/getmembers/') }}" ;
            $.get(url + '/' + organizationId ,function (data) {
                let option; 
                option =  `<option value="" selected> {{ trans('labels.all') }}</option>`;
                for (let index = 0; index < data['members_size']; index++) {
                    let id = data['members'][index]['id'];
                    let name = data['members'][index]['name'];
                    option +=  `<option value="`+id+`">`+name+` </option>`;
                }
                $('select[name="member_id"]').html(option);

            });
        });

    </script>

    <script>
        let nodeName = "GanttChartDIV";
        let chartData = {
            "data": JSON.parse('{!! json_encode($ganttChart) !!}')
        };
    </script>

    <script>
        // Print The Table 
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;

            //For reloading
            location.reload();
        }
    </script>

@endpush
