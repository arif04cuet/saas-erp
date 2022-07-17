@extends('tms::layouts.master')

@section('title', trans('tms::course_evaluation.settings.title'))

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @lang('tms::course_evaluation.settings.title')
                    </h4>
                    <a href="" class="heading-elements-toggle">
                        <i class="la la-ellipsis-h font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0 list-circle">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if(optional($setting)->status)
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-center text-success">
                                        @lang('tms::course_evaluation.settings.status.enabled')
                                    </h2>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>@lang('tms::course_evaluation.settings.form.edit.labels.start_date')</th>
                                                <td>{{ $startDate ?? null }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('tms::course_evaluation.settings.form.edit.labels.end_date')</th>
                                                <td>{{ $endDate ?? null }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-actions">
                                        <a href="{{ route('trainings.courses.evaluations.settings.edit', [$training, $course]) }}"
                                           class="btn btn-primary">
                                            @lang('labels.update')
                                        </a>
                                        <a href="{{ route('trainings.courses.index', ['training' => $training]) }}"
                                           class="btn btn-success">
                                            <i class="ft ft-list"></i> @lang('tms::course.title') @lang('labels.list')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12 text-center mb-lg-4">
                                    <h2 class="text-center text-warning">
                                        @lang('tms::course_evaluation.settings.status.disabled')
                                    </h2>
                                    <br>
                                    <div class="form-actions text">
                                        <a href="{{ route('trainings.courses.evaluations.settings.edit', [$training, $course]) }}"
                                           class="btn btn btn-success">
                                            @lang('tms::course_evaluation.settings.buttons.enable')
                                        </a>
                                        <a href="{{ route('trainings.courses.index', ['training' => $training]) }}"
                                           class="btn btn-primary">
                                            <i class="ft ft-list"></i> @lang('tms::course.title') @lang('labels.list')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
