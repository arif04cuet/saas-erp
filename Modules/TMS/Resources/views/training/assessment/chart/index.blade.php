@extends('tms::layouts.master')
@section('title', trans('tms::training.speaker_evaluation'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">@lang('tms::training.speaker_evaluation')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table">
                                        <tr>
                                            <th>@lang('tms::training.evaluation.speaker_name')</th>
                                            <td>{{ $speaker->getResourceName() }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('tms::training.evaluation.course_name')</th>
                                            <td>{{ $course->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('tms::training.remark_total')</th>
                                            <td>
                                                {{ assessment_value_in_word($marks->avg()) }}
                                                ({{ number_format($marks->avg(), 2) }})
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                               <div class="col-md-8">
                                   <canvas id="myChart" width="600" height="400"></canvas>
                               </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            let labels = @json($sessions);
            let chartData = @json($marks);

            let labelBackgrounds = labels.map(label => {
                return 'rgba(54, 162, 235, 0.2)';
            });

            let labelBorders = labels.map(label => {
                return 'rgba(54, 162, 235, 1)';
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels.concat('{!! trans('tms::training.remark_total') !!}'),
                    datasets: [{
                        label: '{!! trans('tms::training.remark') !!}',
                        data: chartData.concat('{!! $marks->avg() !!}'),
                        backgroundColor: labelBackgrounds.concat('rgb(162, 242, 116)'),
                        borderColor: labelBorders.concat('rgb(70, 117, 43)'),
                        borderWidth: 1
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Speaker Evaluation"
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 5,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                autoSkip: false,
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endpush
