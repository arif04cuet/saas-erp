@extends('pms::layouts.master')
@section('title', trans('pms::project.project_monitoring_tabular_view'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@lang('pms::attribute.project_monitoring_line_chart')</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                        <h4 class="form-section"><i class="ft-bar-chart-2"></i> @lang('pms::attribute.attribute_chart_filters')</h4>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attribute_id">@lang('pms::attribute.attribute')</label>

                                        {{ Form::select('attribute_id', $attributeSelectOptions, null, ['class' => 'form-control select2']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="chart_type">@lang('pms::attribute.chart_types')</label>

                                        <div class="row">
                                            <div class="col">
                                                <div class="skin skin-flat">
                                                    {!! Form::radio('chart_type', 'line', 'line') !!}
                                                    <label>@lang('pms::attribute.line')</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="skin skin-flat">
                                                    {!! Form::radio('chart_type', 'horizontalBar') !!}
                                                    <label>@lang('pms::attribute.bar')</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="skin skin-flat">
                                                    {!! Form::radio('chart_type', 'bar') !!}
                                                    <label>@lang('pms::attribute.column')</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="skin skin-flat">
                                                    {!! Form::radio('chart_type', 'polarArea') !!}
                                                    <label>@lang('pms::attribute.area')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body chartjs">
                            <canvas id="chart" height="500"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/plugins/forms/checkboxes-radios.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('theme/js/scripts/forms/checkbox-radio.js') }}"></script>
    <script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
    <script>
        async function getAttributeValueDetailsByMonthYear(attributeId) {
            let attributeGraphUrl = '/pms/projects/{{ $projectProposal->id }}/monitors/graphs/' + attributeId;
            return await $.get(attributeGraphUrl);
        }

        function generateChart(uniqueMonthYear, attributeValue, chartType) {
            function doesChartExist() {
                return chartObject !== undefined;
            }

            function destroyChart() {
                if (doesChartExist()) {
                    chartObject.destroy();
                }
            }

            let chartContext = $('#chart');
            let chartPersistentKey = "chart";
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
                            labelString: '{!! trans('pms::attribute.value') !!}'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: '{!! trans('pms::attribute.attribute_values_line_chart') !!}'
                }
            };
            let chartData = {
                labels: uniqueMonthYear,
                datasets: [{
                    label: `${attributeValue.name} - {!! trans('pms::attribute.planned') !!}`,
                    data: attributeValue.monthly_planned_values,
                    fill: false,
                    borderDash: [5, 5],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }, {
                    label: `${attributeValue.name} - {!! trans('pms::attribute.achieved') !!}`,
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

        $(document).ready(function () {
            let attributeId = $('select[name=attribute_id]').val();
            let self = this;
            let uniqueMonthYear = [];
            let attributeValue = {};

            getAttributeValueDetailsByMonthYear(attributeId)
                .then(({uniqueMonthYear, attributeValue}) => {
                    self.uniqueMonthYear = uniqueMonthYear;
                    self.attributeValue = attributeValue;
                    let chartType = $('input[type=radio][name=chart_type]:checked').val();
                    generateChart(uniqueMonthYear, attributeValue, chartType);
                })
                .catch(error => {
                    // TODO: show lang error message
                    console.log(error)
                });

            $('select[name=attribute_id]').on('change', function () {
                let attributeId = $(this).val();
                getAttributeValueDetailsByMonthYear(attributeId)
                    .then(({uniqueMonthYear, attributeValue}) => {
                        self.uniqueMonthYear = uniqueMonthYear;
                        self.attributeValue = attributeValue;
                        let chartType = $('input[type=radio][name=chart_type]:checked').val();
                        generateChart(uniqueMonthYear, attributeValue, chartType);
                    })
                    .catch(error => {
                        // TODO: show lang error message
                        console.log(error)
                    });
            });

            $('input[type=radio][name=chart_type]').on('ifChecked', function (event) {
                let chartType = $(this).val();
                generateChart(self.uniqueMonthYear, self.attributeValue, chartType);
            });
        });
    </script>
@endpush

