@extends('hrm::layouts.master')

@section('title', trans('hrm::complaint.title'))

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold">@lang('hrm::complaint.title')</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td>@lang('hrm::complaint.complainer')</td>
                                    <td>{{ $complaint->complainer->getName() }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('hrm::complaint.accused')</td>
                                    <td>{{ $complaint->complainee->getName() }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('hrm::complaint.reason')</td>
                                    <td>{{ $complaint->reason }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('labels.status')</td>
                                    <td>{{ $complaint->status }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('labels.attachments')</td>
                                    <td>
                                        @foreach($complaint->attachments as $attachment)
                                            <span class="badge badge-pill badge-primary">{{ $attachment->file_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            @if(!in_array($complaint->status, ['approved', 'rejected']) && !is_null($complaint->stateRecipients()->get()->last()))
                                @if($complaint->stateRecipients()->get()->last()->user_id == auth()->user()->id)
                                    <a href="{{ route('complaint.workflow.edit', ['complaint' => $complaint->id]) }}" class="btn btn-sm btn-success"><i class="ft-edit"></i> @lang('labels.workflow_review')</a>
                                <hr>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="black">@lang('labels.remarks'): </label>
                            <div class="media">
                                <div class="media-body">
                                    @foreach($complaint->stateDetails as $detail)
                                        <p class="text-bold-600 mb-0">
                                            {{ state_actor($detail->stateHistory->actor_id)->name }}
                                        </p>
                                        <p class="small m-0 comment-time">{{ date("j F, Y, g:i a",strtotime($detail->created_at)) }}</p>
                                        <p class="m-0 comment-text">{{ $detail->remark }}</p>
                                        <hr/>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection