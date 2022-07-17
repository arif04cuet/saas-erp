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
                                <li>
                                    <a href="{{ route('training.evaluate.index') }}" class="btn btn-sm btn-info">
                                        <i class="ft ft-list"></i> @lang('tms::training.speaker_evaluation')
                                    </a>
                                </li>
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
                                            <td>{{ $courseName }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('tms::training.module_name')</th>
                                            <td>{{ $moduleName }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('tms::training.evaluation.session_name')</th>
                                            <td>{{ $sessionName }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('labels.date')</th>
                                            <td>
                                                {{ $scheduleDuration }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('tms::training.remark_total')</th>
                                            <td>
                                                {{ assessment_value_in_word($answers->avg()) }}
                                                ({{ number_format($answers->avg(), 2) }})
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>@lang('tms::training.total_evaluators')</th>
                                            <td>{{ $assessments->count() }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <canvas id="myChart"></canvas>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>@lang('tms::training.evaluation.questions')</th>
                                                <th>@lang('tms::training.remark') (5)</th>
                                            </tr>
                                            @foreach($avgValuesOfEachQuestion as $questionAnswer)
                                                <tr>
                                                    <th>@lang('tms::assessment_questions.' . $questionAnswer->name)</th>
                                                    <td>
                                                        {{ assessment_value_in_word($questionAnswer->value) }}
                                                        ({{ number_format($questionAnswer->value, 2) }})
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </thead>
                                        </table>
                                    </div>
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
            let questions = @json($questions);
            let answers = @json($answers);

            let answerBackgrounds = answers.map(answer => {
                return 'rgba(54, 162, 235, 0.2)';
            });

            let answerBorders = answers.map(answer => {
                return 'rgba(54, 162, 235, 1)';
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: questions.concat('{!! trans('tms::training.remark_total') !!}'),
                    datasets: [{
                        label: '{!! trans('tms::training.remark') !!}',
                        data: answers.concat('{!! $answers->avg() !!}'),
                        backgroundColor: answerBackgrounds.concat('rgb(162, 242, 116)'),
                        borderColor: answerBorders.concat('rgb(70, 117, 43)'),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                max: 5
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
