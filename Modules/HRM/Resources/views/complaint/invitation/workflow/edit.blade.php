@extends('hrm::layouts.master')
@section('title', trans('hrm::complaint.complaint_invitation'))

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="font-weight-bold">@lang('hrm::complaint.complaint_invitation')</h5>
            </div>
            <div class="card-content">
                <div class="card-body">
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
                            <td>@lang('labels.attachments')</td>
                            <td>
                                @foreach($complaintInvitation->attachments as $attachment)
                                    <a href="{{ route('file.download', [
                                            'filePath' => $attachment->file_path,
                                            'fileName' => $attachment->file_name
                                        ]) }}"
                                       class="badge badge-pill badge-primary">{{ $attachment->file_name }}</a>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::open([
                                'route' => ['complaints.invitations.workflow.update', $complaintInvitation->id],
                                'method' => 'PUT'
                            ]) }}
                            @if(in_array('review', $possibleTransitions) || in_array('approve', $possibleTransitions))
                                <div class="form-group">
                                    <!-- user with whom invitation will be shared -->
                                    <label for="">@lang('labels.share')</label>
                                    {{ Form::select('employee_id', $employeeDropdown, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => trans('labels.select')
                                    ]) }}

                                    @if($errors->has('employee_id'))
                                        <span class="help-block danger">{{ $errors->first('employee_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <!-- user who will be assigned as reviewer when the final complaint is made -->
                                    <label for="">@lang('hrm::complaint.reviewer')</label>
                                    {{ Form::select('reviewer_id', $employeeDropdown, null, [
                                        'class' => 'form-control select2',
                                        'placeholder' => trans('labels.select')
                                    ]) }}

                                    @if($errors->has('reviewer_id'))
                                        <span class="help-block danger">{{ $errors->first('reviewer_id') }}</span>
                                    @endif
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="">@lang('labels.remarks')</label>
                                {{ Form::textarea('remark', null, ['class' => 'form-control', 'required']) }}

                                @if($errors->has('remark'))
                                    <span class="help-block danger">{{ $errors->first('remark') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">@lang('labels.message')</label>
                                {{ Form::textarea('message', null, ['class' => 'form-control']) }}

                                @if($errors->has('message'))
                                    <span class="help-block danger">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                            <div class="form-actions">
                                @foreach($possibleTransitions as $transition)
                                    <button name="transition" value="{{ $transition }}"
                                            class="btn btn-info">@lang('hrm::complaint.' . $transition)</button>
                                @endforeach
                                <a href="{{ route('complaints.invitations.index') }}"
                                   class="btn btn-warning">@lang('labels.cancel')</a>
                            </div>
                            {{ Form::close() }}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection