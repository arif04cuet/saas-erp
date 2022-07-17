@extends('tms::layouts.master')
@section('title', trans('tms::training.speaker_evaluation'))

@section('content')
    <section id="assessment">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="repeat-form">@lang('tms::training.speaker_evaluation')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>@lang('tms::training.evaluation.speaker_name')</th>
                                        <td>{{ $employee->getName() }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('tms::training.evaluation.session_name')</th>
                                        <td>{{ $sessioName }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('tms::training.total_average_score')</th>
                                        <td>{{ $totalAverageScore }}</td>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped alt-pagination">
                                    <thead>
                                    <tr>
                                        <th>@lang('tms::training.evaluation.questions')</th>
                                        <th>@lang('tms::training.average')</th>
                                    </tr>
                                    </thead>
                                    @foreach($percentileSessionEvaluations as $evaluation)
                                        <tr>
                                            <td>{{ $evaluation->question }}</td>
                                            <td>{{ $evaluation->average_percentage }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
