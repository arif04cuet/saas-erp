<table class="table table-striped table-bordered alt-pagination">
    <thead>
    <tr>
        <th>{{trans('labels.serial')}}</th>

        <th>{{trans('pms::task.task_name')}}</th>
        <th>{{trans('pms::task.expected_start_date')}}</th>
        <th>{{trans('pms::task.expected_end_date')}}</th>
        <th>{{trans('pms::task.task_description')}}</th>
        <th>{{trans('pms::task.start_date')}}</th>
        <th>{{trans('pms::task.end_date')}}</th>
        {{--<th>{{trans('labels.status')}}</th>--}}
        <th>{{trans('labels.action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allMonthlyUpdates as $monthlyUpdate)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{$monthlyUpdate->taskName->name}}</td>
            <td>{{date('d-m-Y', strtotime($task->expected_start_time))}}</td>
            <td>{{date('d-m-Y', strtotime($task->expected_end_time))}}</td>
            <td>{{$task['description']}}</td>
            <td>{{(!empty($task->start_time))? date('d-m-Y', strtotime($task->start_time)) : '-'}}</td>
            <td>{{(!empty($task->end_time))? date('d-m-Y', strtotime($task->end_time)) : '-'}}</td>
            {{--<td>{{($training->status == 1)? "Active":"Inactive"}}</td>--}}
            <td>
                <span class="dropdown">
                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="la la-cog"></i></button>
                    <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{route('task.show', ['taskId' => $task['id']])}}" class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>
                                                @if(empty($task->start_time) || empty($task->end_time))
                                                      <a href="{{route('task.toggleStartEnd', ['taskId' => $task['id']])}}" class="dropdown-item"><i class="ft-edit-2"></i> {{(empty($task->start_time))? trans('pms::task.start_date') : trans('pms::task.end_date')}}</a>
                                                  @endif
                                                <div class="dropdown-divider"></div>
                                                  {!! Form::open([
                                                  'method'=>'DELETE',
                                                  'url' => [ route('task.delete', $task->id)],
                                                  'style' => 'display:inline'
                                                  ]) !!}
                                                  {!! Form::button('<i class="ft-trash"></i> '.trans('labels.delete'), array(
                                                  'type' => 'submit',
                                                  'class' => 'dropdown-item',
                                                  'title' => 'Delete the training',
                                                  'onclick'=>'return confirm("Confirm delete?")',
                                                  )) !!}
                                                  {!!Form::close()!!}
                                              </span>
                                            </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
