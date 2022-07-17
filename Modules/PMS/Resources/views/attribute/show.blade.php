@extends('pms::layouts.master')
@section('title', trans('attribute.attribute'))

@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('attribute.attribute')</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('pms::project.title')</dt>
                                    <dd class="col-sm-9"><a
                                                href="{{ route('project.show', $project->id) }}">{{ $project->title }}</a>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.name')</dt>
                                    <dd class="col-sm-9">{{ $attribute->name }}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">@lang('labels.unit')</dt>
                                    <dd class="col-sm-9">{{ $attribute->unit }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-12">
                @include('../../../attribute.partials.graph')
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-12">
                @include('../../../attribute.partials.tabular')
            </div>
        </div>
    </section>
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
        function generateChart(monthYears, attributeValue, chartType) {
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

        function initializeGraphVariables(attributeValuesByMonthYear) {
            let uniqueMonthYears = attributeValuesByMonthYear.map(attributeValue => {
                return attributeValue.monthYear;
            });
            let attributeValues = {};
            attributeValues.name = JSON.parse('{!! json_encode($attribute->name) !!}');
            attributeValues.monthly_achieved_values = attributeValuesByMonthYear.map(attributeValue => {
                return attributeValue.total_achieved_value;
            });
            attributeValues.monthly_planned_values = attributeValuesByMonthYear.map(attributeValue => {
                return attributeValue.total_planned_value;
            });
            return {uniqueMonthYears, attributeValues};
        }

        $(document).ready(function () {
            let chartType = $('input[type=radio][name=chart_type]:checked').val();
            let attributeValuesByMonthYear = JSON.parse('{!! json_encode($achievedPlannedValuesByMonthYear) !!}');
            let {uniqueMonthYears, attributeValues} = initializeGraphVariables(attributeValuesByMonthYear);

            generateChart(uniqueMonthYears, attributeValues, chartType);

            $('input[type=radio][name=chart_type]').on('ifChecked', function (event) {
                let chartType = $(this).val();
                generateChart(uniqueMonthYears, attributeValues, chartType);
            });
        });
    </script>
@endpush