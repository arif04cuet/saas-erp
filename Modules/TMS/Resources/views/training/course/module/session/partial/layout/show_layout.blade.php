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
                                @lang('tms::training.training') :
                                <a href="{{ route('training.show', $training->id) }}">{{ $training->title }}</a>
                            </h5>
                            <br>
                            <h5>
                                @lang('tms::course.title') :
                                <a href="{{ route('trainings.courses.show', [$training->id, $course->id]) }}">
                                    {{ $course->name }}
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
        </div>
        
    </section>
@endsection

@push('page-css')
    <style>
        .table-th-top {
            vertical-align: top !important;
        }
    </style>
@endpush
