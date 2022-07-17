@extends('tms::layouts.master')
@section('title', trans('tms::training.course_evaluation'))

@section('content')
    <section id="assessment">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="repeat-form"><i class="ft-list black"></i> @lang('tms::training.course_evaluation')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row pl-2 pr-2">
                            <div class="col-md-3">
                                <label class="mt-1" for="training-filter">@lang('tms::training.title')</label>
                                <select class="custom-select select-filter training-filter select mr-sm-2"
                                    id="training-search">
                                    <option selected="true" value="all">@lang('labels.all')</option>
                                    @foreach ($courseEvaluationLists as $key => $courseEvaluationList)
                                        <option value="{{ $courseEvaluationList['trainingName'] }}">
                                            {{ $courseEvaluationList['trainingName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="mt-1" for="course-filter">@lang('tms::course.title')</label>
                                <select class="custom-select select-filter training-filter select mr-sm-2"
                                    id="course-search">
                                    <option selected="true" value="all">@lang('labels.all')</option>
                                    @foreach ($courseEvaluationLists as $key => $courseEvaluationList)
                                        <option value="{{ $courseEvaluationList['courseName'] }}">
                                            {{ $courseEvaluationList['courseName'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 pt-1">
                                <a href="{{ route('courses.public.index') }}" target="_blank"
                                    class="btn btn-primary btn-sm pull-right">@lang('tms::course_evaluation.add')</a>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="course-evaluation" class="master table table-striped table-bordered alt-pagination">
                                        <thead>
                                            <tr class="text-center">
                                                <th>@lang('labels.serial')</th>
                                                <th>@lang('tms::training.title')</th>
                                                <th>@lang('tms::course.title')</th>
                                                <th>@lang('tms::course.evaluator_no')</th>
                                                <th>@lang('tms::training.remark_total')</th>
                                                <th width="20%">@lang('labels.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courseEvaluationLists as $courseEvaluationList)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $courseEvaluationList['trainingName'] }}</td>
                                                    <td>{{ $courseEvaluationList['courseName'] }}</td>
                                                    <td>{{ $courseEvaluationList['evaluatorCount'] }}</td>
                                                    <td>
                                                        {{ assessment_value_in_word($courseEvaluationList['averageMark'], true) }}
                                                        ({{ bcmul(bcdiv($courseEvaluationList['averageMark'], 100, 2), 5, 2) }})
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('training.course.evaluate.show', $courseEvaluationList['courseEvaluationId']) }}">
                                                            <i class="ft ft-grid"></i>
                                                            @lang('labels.details')
                                                        </a>
                                                        <a class="btn btn-sm btn-info cmt-3"
                                                            href="{{ route('trainings.courses.evaluation_result.show', [
                                                                'training' => $courseEvaluationList['trainingId'],
                                                                'course' => $courseEvaluationList['courseId'],
                                                            ]) }}">
                                                            <i class="ft ft-bar-chart"></i>
                                                            @lang('tms::course.show_graph')
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-js')
    <script>
        $(document).ready(function() {
            let table = $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        className: 'csv',
                    },
                    {
                        extend: 'excel',
                        className: 'excel',
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
            table.draw()
            $('select').select2({});
        })


        $(document).ready(function() {
            let table = $('.table').DataTable();

            $('#training-search').on('change', function() {
                if (this.value === 'all') {
                    table.columns(1).search("").draw();
                } else {
                    table.columns(1).search(this.value).draw();
                }
            });
            $('#course-search').on('change', function() {
                if (this.value === 'all') {
                    table.columns(2).search("").draw();
                } else {
                    table.columns(2).search(this.value).draw();
                }
            });


            let a = new Array();
            $("#training-search").children("option").each(function(x) {
                test = false;
                b = a[x] = $(this).val();
                for (i = 0; i < a.length - 1; i++) {
                    if (b == a[i]) test = true;
                }
                if (test) $(this).remove();
            });

            a = new Array();
            $("#course-search").children("option").each(function(x) {
                test = false;
                b = a[x] = $(this).val();
                for (i = 0; i < a.length - 1; i++) {
                    if (b == a[i]) test = true;
                }
                if (test) $(this).remove();
            })
        });
    </script>
@endpush
