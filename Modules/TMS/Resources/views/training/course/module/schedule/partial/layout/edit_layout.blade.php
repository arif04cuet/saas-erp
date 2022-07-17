@extends('tms::layouts.master')
@section('title', 'Training Course')

@section('content')
    <section id="assessment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ml-1">
                            <h5 class="card-title" id="repeat-form">
                                @lang('tms::training.title') :
                                <a href="{{ route('training.show', $training->id) }}">{{ $training->getTitle() }}</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                @lang('tms::course.title') :
                                <a href="{{ route('trainings.courses.show', [$training->id, $course->id]) }}">
                                    {{ $course->getName() }}
                                </a>
                            </h5>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
