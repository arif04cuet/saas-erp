<br>
<table class="table">
    <tbody>
    <tr>
        <th>{{trans('monthly-update.monthly_achievement')}}</th>
        <td>{{$monthlyUpdate->achievements}}</td>
    </tr>
    <tr>
        <th>{{trans('monthly-update.monthly_plan')}}</th>
        <td>{{$monthlyUpdate->plannings}}</td>
    </tr>
    <tr>
        <th>{{trans('monthly-update.related_tasks')}}</th>
        <td>{{$monthlyUpdate->tasks}}</td>
    </tr>
    <tr>
        <th>{{trans('labels.attachments')}}</th>
        <td>
            @if(count($monthlyUpdate->attachments))

                <ul class="list-inline">
                    @foreach($monthlyUpdate->attachments as $attachment)
                        <li class="list-group-item"><a href="{{route('file.download', ['filePath' => $attachment->file_path, 'displayName' => $attachment->file_name.'.'.$attachment->file_ext])}}" class="badge bg-info white" title="{{$attachment->file_name}}">{{strlen($attachment->file_name)? substr($attachment->file_name,0,10).'...': $attachment->file_name }}</a><br><label class="label"><strong>{{$attachment->file_ext}}</strong> file</label></li>
                    @endforeach
                </ul>
            @else
                {{__('pms::task.no_attachments')}}
            @endif
        </td>
    </tr>
    </tbody>
</table>
<div class="form-actions">
    <a href="{{route( ($monthlyUpdate->type == 'project') ? 'project-proposal-submitted.edit-monthly-update': 'research.task.edit', $monthlyUpdate->id)}}" class="btn btn-primary"><i class="ft-edit-2"></i> {{trans('labels.edit')}}</a>
    <a class="btn btn-warning mr-1" role="button" href="{{($monthlyUpdate->type == 'project') ? route('project-proposal-submitted.view',  $monthlyUpdate->project->id) : route('research-proposal-submission.show', $monthlyUpdate->research->id )}}">
        <i class="ft-x"></i> {{trans('labels.back_page')}}
    </a>
</div>

