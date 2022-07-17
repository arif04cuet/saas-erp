<div class="card">
    <div class="card-header">
        <h4 class="card-title">@lang('task.task_list')</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
            <ul class="list-inline mb-0">
                @if(Auth::user()->hasAnyRole('ROLE_RESEARCHER') || Auth::user()->hasAnyRole('ROLE_PROJECT_DIRECTOR'))
                <li><a href="{{ route($module . '-tasks.create', $taskable->id) }}"
                       class="btn btn-sm btn-primary"><i
                                class="ft ft-plus"></i> @lang('task.add_task')</a></li>
                @endif
                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table task-table table-bordered table-striped">
                <thead>
                <th>@lang('labels.serial')</th>
                <th>@lang('labels.name')</th>
                <th>@lang('task.start_time')</th>
                <th>@lang('task.end_time')</th>
                @if(Auth::user()->hasAnyRole('ROLE_RESEARCHER') || Auth::user()->hasAnyRole('ROLE_PROJECT_DIRECTOR'))
                <th>{{ trans('labels.action') }}</th>
                @endif
                </thead>
                <tbody>
                @foreach($taskable->tasks as $task)

                    @if(in_designation('FM'))
                        @if(in_array($task->name, [ 'Sending external reviewer', 'Comments from external reviewer', 'Send to respective researcher', 'Accepted final report', 'Send for publication' ] ))
                            @continue
                        @endif
                    @endif

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route($module . '-tasks.show', [$taskable->id, $task->id]) }}">{{ $task->name }}</a>
                        </td>
                        <td class="text-center">
                            @if (isset($task->actual_start_time))
                                {{ \Carbon\Carbon::parse($task->actual_start_time)->format('d/m/Y') }}
                            @else
                                {{ Form::open(['route' => [$module . '-tasks.time', $taskable->id, $task->id], 'method' => 'PUT', 'style' => 'display: inline']) }}
                                <button class="btn btn-sm btn-success">@lang('task.start')</button>
                                {{ Form::close() }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if (isset($task->actual_end_time))
                                {{ \Carbon\Carbon::parse($task->actual_end_time)->format('d/m/Y') }}
                            @elseif (isset($task->actual_start_time) && !isset($task->actual_end_time))
                                {{ Form::open(['route' => [$module . '-tasks.time', $taskable->id, $task->id], 'method' => 'PUT', 'style' => 'display: inline']) }}
                                <button class="btn btn-sm btn-danger">@lang('task.stop')</button>
                                {{ Form::close() }}
                            @endif
                        </td>
                        @if(Auth::user()->hasAnyRole('ROLE_RESEARCHER') || Auth::user()->hasAnyRole('ROLE_PROJECT_DIRECTOR'))
                        <td class="text-center">
                            {{ Form::open(['route' => [$module . '-tasks.destroy', $taskable->id, $task->id], 'method' => 'DELETE', 'style' => 'display: inline']) }}
                            <button class="btn btn-sm btn-danger"><i class="ft ft-trash"></i></button>
                            {{ Form::close() }}
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
