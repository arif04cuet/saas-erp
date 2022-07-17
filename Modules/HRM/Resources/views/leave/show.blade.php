@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.leave_details'))


@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">@lang('hrm::leave.leave_details')</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show" style="">
            <div class="card-body">
                <div class="tab-content ">
                    <div class="tab-pane active show" role="tabpanel" id="general" aria-labelledby="general-tab"
                         aria-expanded="true">
                        <table class="table ">
                            <tbody>
                            <tr>
                                <th class="">@lang('labels.requester')</th>
                                <td>{{ $leaveRequest->requester->name }}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('labels.name')</th>
                                <td>@lang('hrm::leave.' . $leaveRequest->type->name)</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::leave.leave_start_date')</th>
                                <td>{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::leave.leave_end_date')</th>
                                <td>{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::leave.leave_duration')</th>
                                <td>{{ $leaveRequest->getDuration() }}</td>
                            </tr>
                            <tr>
                                <th class="">@lang('hrm::leave.leave_reason')</th>
                                <td>{{ $leaveRequest->reason }}</td>
                            </tr>
                            @if(count($leaveRequest->attachments))
                                <tr>
                                    <th class="">@lang('labels.attachments')</th>
                                    <td>
                                        @foreach($leaveRequest->attachments as $attachment)
                                            <a href="{{ url("/file/get?filePath={$attachment->attachment}") }}"
                                               target="_blank" class="btn btn-outline-secondary"><i
                                                        class="ft ft-file"></i> {{ $attachment->file_name }}</a>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($leaveRequest->requester_id == auth()->id() && !in_array($leaveRequest->status, ['approved', 'rejected']))
                    <div class="form-actions">
                        <a href="{{ route('leaves.edit', $leaveRequest->id) }}" class="btn btn-outline-primary">
                            <i class="ft-edit"></i> @lang('hrm::leave.leave_application') @lang('labels.edit')
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
