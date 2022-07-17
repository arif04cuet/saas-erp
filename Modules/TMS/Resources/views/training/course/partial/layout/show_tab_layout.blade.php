@extends('tms::layouts.master')
@section('title', trans('tms::course.title'))

@section('content')
    <style>
        .table > tbody > tr:first-child > th,
        .table > tbody > tr:first-child > td {
            border-top: 1px #EEE solid;
        }
    </style>
    <section id="assessment">
        <div class="row">
            <div class="col-12">
                <div class="card course-process-tab">
                    <div class="card-header">
                        <h5>
                            @lang('tms::course.title') :
                            <a href="{{ route('training.show', [$training->id]) }}">
                                {{ $course->getName() ?? trans('labels.not_found')}}
                            </a>
                        </h5>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <a role="button"
                                   href="{{route('trainings.courses.evaluations.settings.show',[$training->id,$course->id])}}"
                                   class="btn btn-sm btn-info custombtnbg">
                                    @lang('tms::course_evaluation.settings.title')
                                </a>
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- nav tabs -->
                        @include('tms::training.course.partial.layout.nav_tabs')
                        <!-- / end of nav tabs-->
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel"
                                     class="tab-pane active">
                                    <!-- views are injected in the slot -->
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
