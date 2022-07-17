@extends('tms::layouts.master')
@section('title', trans('tms::schedule.session.title'))
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('tms::schedule.session.title') }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th>@lang('tms::training.title') :</th>
                                        <td><a href="{{ route('training.show', $training->id) }}">{{ $training->title }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> @lang('tms::course.title') :</th>
                                        <td>
                                            <a href="{{ route('trainings.courses.show', [$training->id, $course->id]) }}">
                                                {{ $course->name }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('tms::module.title') :</th>
                                        <td>
                                            <a href="{{ route('trainings.courses.modules.sessions.show', [
                                            $training->id, $course->id,
                                            $module->id
                                        ]) }}">
                                                {{ $module->title }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <h4 class="form-header"></h4>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="master table table-striped table-bordered schedule-table">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('tms::schedule.session.title')}}</th>
                                        <th>{{trans('tms::venue.venue')}}</th>
                                        <th>{{trans('tms::speaker.title')}}</th>
                                        <th>{{trans('tms::schedule.fields.start')}}</th>
                                        <th>{{trans('tms::schedule.fields.end')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
    
                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td scope="row">{{$counter++}}</td>
                                            <td> {{$schedule->session->title ?? trans('labels.not_found')}}</td>
                                            <td> {{optional($schedule->venue)->getTitle() ?? trans('labels.not_found')}}</td>
                                            @if($schedule->session->speaker)
                                                @php
                                                    $speakerName = optional($schedule->session->speaker)->getResourceName()
                                                @endphp
                                            @else
                                                @php
                                                    $speakerName = __('labels.not_available');
                                                @endphp
                                            @endif
                                            <td> {{ $speakerName ?? trans('labels.not_found')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($schedule->start)->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($schedule->end)->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td scope="row">{{$counter++}}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h2 class="text-bold-300">
                                                {{trans('tms::training_course.tab.break_schedules')}}
                                            </h2>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- Break information -->
                                    @foreach($breaks as $break)
                                        <tr>
                                            <td scope="row">{{$counter++}}</td>
                                            <td> {{$break['session_name'] ?? trans('labels.not_found')}}</td>
                                            <td> {{$break['venue_name'] ?? trans('labels.not_found')}}</td>
                                            <td> {{$break['speaker_name'] ?? trans('labels.not_found')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($break['session_start'])->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($break['session_end'])->format('d M, yy h:m A') ?? trans('labels.not_found')}}</td>
    
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-12 float-left">
                        <!-- module list -->
                        <a class="master btn btn-info"
                           href="{{ route('trainings.courses.modules.show', [$training->id, $course->id]) }}">
                            <i class="la la-list"></i> @lang('tms::module.list')
                        </a>
                        <!-- back page -->
                        <a class="master btn btn-warning" href="{{route('trainings.courses.modules.batches.sessions.schedules.edit', [
                                    'training' => $training,
                                    'course' => $course,
                                    'module' => $module,
                                    'batch' => $batch
                                ])}}">
                            <i class="la la-backward"></i>
                            @lang('labels.back_page')
                        </a>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
</div>

@endsection

@push('page-js')
    <script type="text/javascript">
        $('.schedule-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'print'
            ]
        });
    </script>
@endpush
