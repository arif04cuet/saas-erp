<div class="col-md-7">
    <h4 class="card-title">{{trans('publication::published-research-paper.proof_comments')}}</h4>
<table class="table table-striped table-bordered">
    <thead>
    <th>{{ trans('labels.serial') }}</th>
    <th>{{ trans('labels.remarks') }}</th>
    <th>{{ trans('publication::published-research-paper.last_sub_date') }}</th>
    <th>{{ trans('publication::published-research-paper.submission_date') }}</th>
    <th>{{ trans('labels.status') }}</th>
    </thead>
    <tbody>
    @foreach($details->publishedResearchComments as $comment)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $comment->remark }}</td>
            <td>{{ is_null($comment->last_date) ? 'N/A' : date('Y-m-d h:i A', strtotime($comment->last_date))}}</td>
            <td>{{ date('Y-m-d h:i A', strtotime($comment->created_at))}}</td>
            <td>{{ trans('publication::published-research-paper.proof_status.' . $comment->action) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
