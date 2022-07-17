@extends('hrm::layouts.master')

@section('title', trans('hrm::complaint.complaint_invitation'))

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold">@lang('hrm::complaint.complaint_invitation')</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td>@lang('hrm::complaint.complainer')</td>
                                    <td>{{ $complaintInvitation->complainer->getName() }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('hrm::complaint.accused')</td>
                                    <td>{{ $complaintInvitation->complainee->getName() }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('hrm::complaint.author')</td>
                                    <td>{{ $complaintInvitation->creator->getName() }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('hrm::complaint.reason')</td>
                                    <td>{{ $complaintInvitation->reason }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('labels.status')</td>
                                    <td>{{ $complaintInvitation->status }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('labels.attachments')</td>
                                    <td>
                                        @foreach($complaintInvitation->attachments as $attachment)
                                            <span class="badge badge-pill badge-primary">{{ $attachment->file_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            @if(!in_array($complaintInvitation->status, ['approved', 'rejected', 'submitted']) && !is_null($complaintInvitation->stateRecipients()->get()->last()))
                                @if($complaintInvitation->stateRecipients()->get()->last()->user_id == auth()->user()->id)
                                    <a href="{{ route('complaints.invitations.workflow.edit', ['complaintInvitation' => $complaintInvitation->id]) }}" class="btn btn-sm btn-success"><i class="ft-edit"></i> @lang('labels.workflow_review')</a>
                                <hr>
                                @endif
                            @endif
                            @if(in_array($complaintInvitation->status, ['approved']) && !is_null($complaintInvitation->stateRecipients()->get()->last()))
                                @if($complaintInvitation->stateRecipients()->get()->last()->user_id == auth()->user()->id)
                                    <a href="{{ route('complaint.create', ['complaintInvitation' => $complaintInvitation->id]) }}" class="btn btn-sm btn-success"><i class="ft-plus-circle"></i> @lang('hrm::complaint.create')</a>
                                <hr>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="black">@lang('labels.remarks'): </label>
                            <div class="media">
                                <div class="media-body">
                                    @foreach($complaintInvitation->stateDetails as $detail)
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