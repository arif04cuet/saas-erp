@component('tms::training.course.module.session.partial.layout.show_layout', [
    'training' => $training,
    'course' => $course,
    'module' => $module
])
    @if($sessions->count())
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="table-th-top">@lang('labels.serial')</th>
                        <th class="table-th-top">@lang('labels.title')</th>
                        <th class="table-th-top">@lang('tms::session.length')</th>
                        <th class="table-th-top">@lang('tms::session.expire_time')</th>
                        <th class="table-th-top">@lang('labels.number')</th>
                        <th class="table-th-top">@lang('tms::speaker.title')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sessions as $session)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $session->title }}</td>
                            <td>{{ $session->session_length }}</td>
                            <td>
                                @if($session->training_course_resource_id == null)

                                @else
                                    {{ $session->speaker_expire_timeline }}
                                @endif
                            </td>
                            <td>{{ $session->mark }}</td>
                            <td>
                                @if($session->training_course_resource_id == null)

                                @else
                                {{ $session->speaker->getResourceName() . ($session->speaker->short_name ? ' - ' . $session->speaker->short_name : '') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a class="btn btn-sm btn-info"
           href="{{ route('trainings.courses.modules.sessions.edit', ['training' => $training, 'course' => $course, 'module' => $module]) }}"><i
                    class="ft ft-edit"></i> @lang('labels.edit')
        </a>
    @else
        <a class="btn btn-sm btn-info"
           href="{{ route('trainings.courses.modules.sessions.edit', ['training' => $training, 'course' => $course, 'module' => $module]) }}"><i
                    class="ft ft-plus"></i> @lang('labels.add')
        </a>
    @endif
@endcomponent
