@extends('hrm::layouts.master')

@section('title', trans('labels.HRM'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h1>{{ trans('labels.HRM') }}</h1>
                    </div>
                </div>
            </div>
        
            @if(count($leaveRequests))
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>@lang('labels.pending_items') : @lang('hrm::leave.leave_application') </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.requester')</th>
                                            <th>@lang('labels.message')</th>
                                            <th>@lang('ims::inventory.type')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('labels.date')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaveRequests as $leaveRequest)
                                            <tr>
                                                <td>{{ $leaveRequest->requester->name }}</td>
                                                <td>
                                                    @if(count($leaveRequest->stateDetails) > 0)
                                                        {{  $leaveRequest->stateDetails->last()->message }}
                                                    @endif
                                                </td>
                                                <td>@lang('hrm::leave.' . $leaveRequest->type->name)</td>
                                                <td>@lang('labels.' . $leaveRequest->status)</td>
                                                <td>{{ $leaveRequest->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ $leaveRequest->getStateUrl() }}">
                                                        @lang('labels.details')
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        
            @if(count($complaintInvitations))
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>@lang('labels.pending_items') : @lang('hrm::complaint.complaint_invitation')</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('hrm::complaint.author')</th>
                                            <th>@lang('hrm::complaint.complainer')</th>
                                            <th>@lang('hrm::complaint.accused')</th>
                                            <th>@lang('hrm::complaint.reason')</th>
                                            <th>@lang('labels.message')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('labels.date')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($complaintInvitations as $complaintInvitation)
                                            <tr>
                                                <td>{{ $complaintInvitation->creator->first_name . ' ' . $complaintInvitation->creator->last_name }}</td>
                                                <td>{{ $complaintInvitation->complainer->first_name . ' ' . $complaintInvitation->complainer->last_name }}</td>
                                                <td>{{ $complaintInvitation->complainee->first_name . ' ' . $complaintInvitation->complainee->last_name }}</td>
                                                <td>{{ $complaintInvitation->reason }}</td>
                                                <td>
                                                    @if(count($complaintInvitation->stateDetails) > 0)
                                                        {{  $complaintInvitation->stateDetails->last()->message }}
                                                    @endif
                                                </td>
                                                <td>@lang('labels.' . $complaintInvitation->status)</td>
                                                <td>{{ $complaintInvitation->created_at->format('F j, Y') }}</td>
                                                <td>
                                                    @if($complaintInvitation->status == "approved")
                                                        <a class="btn btn-primary btn-sm"
                                                           href="{{ route('complaint.create', [
                                                                'complaintInvitation' => $complaintInvitation->id
                                                           ]) }}">
                                                            @lang('hrm::complaint.create_complaint')
                                                        </a>
                                                    @else
        
                                                        <a class="btn btn-primary btn-sm"
                                                           href="{{ route('complaints.invitations.workflow.edit', [
                                                                'complaintInvitation' => $complaintInvitation->id
                                                           ]) }}">
                                                            @lang('labels.details')
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        
            @if(count($complaints))
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>@lang('labels.pending_items') : @lang('hrm::complaint.title') </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('hrm::complaint.complainer')</th>
                                            <th>@lang('hrm::complaint.accused')</th>
                                            <th>@lang('hrm::complaint.reason')</th>
                                            <th>@lang('labels.message')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('labels.date')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($complaints as $complaint)
                                            <tr>
                                                <td>{{ $complaint->complainer->first_name . ' ' . $complaint->complainer->last_name }}</td>
                                                <td>{{ $complaint->complainee->first_name . ' ' . $complaint->complainee->last_name }}</td>
                                                <td>{{ $complaint->reason }}</td>
                                                <td>
                                                    @if(count($complaint->stateDetails) > 0)
                                                        {{  $complaint->stateDetails->last()->message }}
                                                    @endif
                                                </td>
                                                <td>@lang('labels.' . $complaint->status)</td>
                                                <td>{{ $complaint->created_at->format('F j, Y') }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('complaint.workflow.edit', ['complaint' => $complaint->id]) }}">
                                                        @lang('labels.details')
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        
            @if(count($appraisals))
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>@lang('labels.pending_items') : @lang('hrm::appraisal.title')</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('hrm::appraisal.reporting_officer_employee')</th>
                                            <th>@lang('hrm::appraisal.reporter')</th>
                                            <th>@lang('hrm::appraisal.signer_officer')</th>
                                            <th>@lang('hrm::appraisal.final_commenter')</th>
                                            <th>@lang('labels.date')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($appraisals as $appraisal)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                @if($appraisal->reportingEmployee)
                                                    <td>{{ $appraisal->reportingEmployee->first_name  . ' ' . $appraisal->reportingEmployee->last_name }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if($appraisal->reporter)
                                                    <td>{{ $appraisal->reporter->first_name  . ' ' . $appraisal->reporter->last_name  }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if($appraisal->signer)
                                                    <td>{{ $appraisal->signer->first_name . ' ' . $appraisal->signer->last_name  }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                @if($appraisal->finisher)
                                                    <td>{{ $appraisal->finisher->first_name . ' ' . $appraisal->finisher->last_name }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ \Carbon\Carbon::parse($appraisal->created_at)->format('j F, Y') }}</td>
                                                <td>
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                            @if($appraisal->status == "completed")
                                                            <a href="{{ route('appraisals.show', ['appraisal' => $appraisal->id]) }}"
                                                               class="dropdown-item"><i
                                                                        class="ft-eye"></i> @lang('labels.details')</a>
                                                        @endif
                                                        @if(current_user_has_state($appraisal) && $appraisal->status != "completed")
                                                            <a href="{{ route('appraisals.edit', ['appraisal'=>$appraisal->id]) }}"
                                                               class="dropdown-item"><i
                                                                        class="ft-edit-2"></i> @lang('labels.edit')</a>
                                                        @endif
                                                        </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
    
@stop
