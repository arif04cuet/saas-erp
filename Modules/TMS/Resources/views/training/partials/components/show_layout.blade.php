@extends('tms::layouts.master')
@section('title', trans('tms::training.training_details'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card training-process-tab">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form"><i class="ft-eye"></i> {{ __('tms::training.show_form_title') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="button-wrap d-block mt-2">
                            @can('add_training_courses')
                                <a href="{{ route('trainings.courses.create', [$training->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="ft-plus"></i>
                                    {{ trans('tms::training.course.add_course') }}
                                </a>
                            @endcan
                            @can('view_training_courses')
                                <a href="{{ route('training.courses', [$training->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="ft-list"></i>
                                    {{ trans('tms::training.course.list') }}
                                </a>
                            @endcan
                            @can('view_training_course_module_batch_session_schedules')
                                <a href="{{ route('trainings.schedules.sessions.index', [$training->id]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="ft-list"></i>
                                    {{ trans('tms::session.sessions') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('tms::training.partials.nab_tabs')
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active">
                                    <!-- views are injected in slot -->
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
