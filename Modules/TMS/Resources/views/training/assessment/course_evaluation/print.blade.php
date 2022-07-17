<!DOCTYPE html>
<html class="loading" lang="bn" data-textdirection="ltr">
<head>
    <title> {{ trans('hm::report.budget.annual.title') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/vendors.css')}} " media="print">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/app.css') }}" media="print">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <style>
        @media print {
            header {
                display: none;
            }

            a[href]:after {
                content: none !important;
            }

            .form-actions {
                display: none;
            }

            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 72px;
                padding-bottom: 72px;
                font-size: 18px;
            }
        }

    </style>
</head>

<body>
<!-- General Information Card -->
<div class="container ">
    <div class="row ">
        <div class="col-md-12 col-xl-12 ">
            <div class="card text-center ">

                <table class="table table-borderless text-center">
                    <tr class>
                        <td>
                            {{trans('labels.bard_title')}}
                        </td>
                    </tr>
                    <tr>
                        <td>{{trans('labels.bard_address.kotbari')}}
                            , {{trans('labels.bard_address.cumilla')}}</td>
                    </tr>

                </table>

                <div class="card-header ">
                    <h4 class="card-title">@lang('tms::budget.title') @lang('labels.show')</h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body ">
                        <div class="col-md-12">
                            <table class="table table-striped">
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

                    <div class="card-body">

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
                                            <td>{{ $courseEvaluationDetailsQuestions[$questionId] ?? "" }}</td>
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

                <div class="card-footer">
                    <div class="form-actions text-center">
                        <a class="btn btn-primary"
                           href="#">
                            <i class="la la-backward"></i> {{trans('labels.back_page')}}
                        </a>
                        <a class="btn btn-warning" href="#" onclick="window.print()">
                            <i class="la la-print"></i> {{trans('labels.print')}}
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- DataTable Card -->
    </div>
</div>

</body>
</html>


<script>
    window.onload = function () {
        window.print();
    }
</script>
