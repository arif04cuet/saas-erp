@extends('tms::layouts.master')
@section('title', 'Training Course')

@section('content')
    <section id="assessment">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ml-1">
                        <h5 class="card-title" id="repeat-form">
                            @lang('tms::training.training') :
                            <a href="{{ route('training.show', $training->id) }}">{{ $training->getTitle() }}</a>
                        </h5>
                        <br>
                        <h5>
                            @lang('tms::course.title') :
                            <a href="{{ route('trainings.courses.show', [$training->id, $course->id]) }}">
                                {{ $course->getName() }}
                            </a>
                        </h5>
                        <br>
                        <h5>
                            @lang('tms::module.title') :
                            <a href="{{ route('trainings.courses.modules.sessions.show', [$training->id, $course->id, $module->id]) }}">
                                {{ $module->title }}
                            </a>
                        </h5>
                        <br>
                        <h5>
                            <a href="{{ route('trainings.courses.modules.show', [$training->id, $course->id]) }}">
                                @lang('tms::module.list')
                            </a>
                        </h5>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a class="master btn btn-primary btn-sm" href="{{route('trainings.courses.modules.batches.sessions.schedules.show', [
                                            'training' => $training,
                                            'course' => $course,
                                            'module' => $module,
                                            'batch' => $batch
                                        ])}}">
                                        @lang('tms::session.preview')
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
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
