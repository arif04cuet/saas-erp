@extends('tms::layouts.master')
@section('title', trans('tms::training.course_evaluation') . ' ' . trans('labels.show'))

@section('content')
    <section id="assessment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="repeat-form">
                                <i class="ft-list black"></i> @lang('tms::training.course_evaluation') @lang('labels.show')
                            </h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
    
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <table class="master table table-striped">
                                            <tr>
                                                <th style="width: 20%">@lang('tms::course.title')</th>
                                                <td>{{$course->name}}</td>
                                            </tr>
                                            <tr>
                                                <th style="width: 20%">@lang('tms::training.title')</th>
                                                <td>{{$course->training->title}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('labels.date')</th>
                                                <td>{{ Carbon\Carbon::parse($course->created_at)->format('d F, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('tms::course.evaluator_no')</th>
                                                <td>{{$course->courseEvaluationSubmission->count()}}</td>
                                            </tr>
                                        </table>
    
                                    </div>
                                </div>
                                <br>
    
    
                                <!-- Tabbed View for The Section and Question -->
                                <div class="">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab11" data-toggle="tab"
                                               aria-controls="tab11"
                                               href="#tab11"
                                               aria-expanded="true">
                                                @lang('tms::course.section') @lang('labels.digits.1')
                                            </a>
                                        </li>
    
                                        @foreach($questionWiseAverageData['questionnaire'] as $sectionId => $questionnaire)
                                            <li class="nav-item">
                                                <a class="nav-link" id="base-tab{{$sectionId}}" data-toggle="tab"
                                                   aria-controls="tab{{$sectionId}}" href="#tab{{$sectionId}}"
                                                   aria-expanded="false">
                                                    @lang('tms::course.section')
                                                    {{__('labels.digits.'. ($loop->iteration + 1))}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
    
                                    <div class="tab-content px-1 pt-1">
                                        @if(isset($questionWiseAverageData['objective']))
                                            <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                                                 aria-labelledby="base-tab11">
                                                @foreach($questionWiseAverageData['objective'] as $subSectionId => $questionWiseAverageObjectiveData)
                                                    <br>
                                                    <h4 class="card-title">
                                                        {{$courseEvaluationDetailsSections[$subSectionId] ?? ""}}
                                                    </h4>
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                        @include('tms::training.assessment.course_evaluation.partials.show.table-header')
                                                        </thead>
                                                        <tbody>
                                                        @foreach($questionWiseAverageObjectiveData as $questionId => $averageMark)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $courseEvaluationDetailsQuestions[$questionId] ?? "" }}</td>
                                                                <td>
                                                                    {{ assessment_value_in_word($averageMark, false) }}
                                                                </td>
                                                                <td>{{ $averageMark }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            </div>
                                        @else
                                            <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                                                 aria-labelledby="base-tab11">
                                                @lang('tms::course.empty_objective')
                                            </div>
                                        @endif
    
    
                                        @foreach($questionWiseAverageData['questionnaire'] as $sectionId => $questionnaire)
    
                                            <div class="tab-pane" id="tab{{$sectionId}}"
                                                 aria-labelledby="base-tab{{$sectionId}}">
                                                <br>
                                                <h4 class="card-title">
                                                    {{$courseEvaluationDetailsSections[$sectionId] ?? ""}}
                                                </h4>
    
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    @include('tms::training.assessment.course_evaluation.partials.show.table-header')
                                                    </thead>
                                                    <tbody>
                                                    @foreach($questionnaire as $questionId => $averageMark)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $courseEvaluationDetailsQuestions[$questionId] ?? trans('labels.not_found') }}</td>
                                                            <td>
                                                                {{ assessment_value_in_word($averageMark, false) }}
                                                            </td>
                                                            <td>{{ $averageMark }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
    
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Tabbed View End -->
    
                            </div>
    
                            <div class="card-footer">
                                <a class="master btn btn-info"
                                   href="{{route('trainings.courses.evaluation_result.show', [
                                                'training' => $course->training->id,
                                                'course' => $course->id
                                            ])}}">
                                    <i class="ft ft-bar-chart"></i>
                                    @lang('tms::course.show_graph')
                                </a>
                                <a class="master btn btn-blue"
                                   href="{{route('training.course.evaluate.print',$courseEvaluationSubmission->id)}}">
                                    <i class="ft ft-printer"></i>
                                    @lang('labels.print')
                                </a>
                                <a class="master btn btn-warning" href="{{route('training.course.evaluate.index')}}">
                                    <i class="ft ft-skip-back"></i>
                                    @lang('labels.cancel')
                                </a>
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
        $(document).ready(function () {
            let table = $('.evaluation').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv', className: 'csv',
                    },
                    {
                        extend: 'excel', className: 'excel',
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
            table.draw()
            $('select').select2({});
        })


        $(document).ready(function () {
            let table = $('.evaluation').DataTable();

            $('#section-search').on('change', function () {
                if (this.value === 'all') {
                    table.columns(1).search("").draw();
                } else {
                    table.columns(1).search(this.value).draw();
                }
            });

            let a = new Array();
            $("#section-search").children("option").each(function (x) {
                test = false;
                b = a[x] = $(this).val();
                for (i = 0; i < a.length - 1; i++) {
                    if (b == a[i]) test = true;
                }
                if (test) $(this).remove();
            });
        });
    </script>
@endpush
