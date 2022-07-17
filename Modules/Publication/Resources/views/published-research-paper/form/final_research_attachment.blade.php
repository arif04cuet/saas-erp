@if($details->status == config('publication.status.completed'))
<div class="col-md-5">
    <h4 class="card-title">@lang('publication::published-research-paper.final_paper_copy')</h4>        
        <div class="mt-1">
            <ul class="p-0">
            @foreach($details->publishedFinalAttachments as $attachment)
                <li class="list-group-item">
                    <a href="{{ route('file.download', ['filePath' => $attachment->attachment]) }}"
                        class="badge bg-info white" style="overflow: hidden;"
                        title="{{ $attachment->file_name }}">
                         {{ $attachment->file_name  }}</a><br>
                </li>
            @endforeach
            </ul>
        </div>
    </dl>
</div>
@endif
