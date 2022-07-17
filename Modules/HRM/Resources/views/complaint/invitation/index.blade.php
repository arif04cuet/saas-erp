@extends('hrm::layouts.master')

@section('title', trans('hrm::complaint.complaint_invitation_list'))

@section('content')
    <section id="complaint-invitation-list">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::complaint.complaint_invitation_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <a href="{{ route('complaints.invitations.create') }}" class="btn btn-primary btn-sm mt-1 mr-1 float-right">
                            <i class="ft-plus white"></i> {{trans('hrm::complaint.create')}}
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="complaint-invitation-table table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('hrm::complaint.complainer')</th>
                                        <th>@lang('hrm::complaint.accused')</th>
                                        <th>@lang('hrm::complaint.author')</th>
                                        <th>@lang('hrm::complaint.reason')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.date')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($complaintInvitations as $complaintInvitation)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $complaintInvitation->complainer ? $complaintInvitation->complainer->first_name . ' ' . $complaintInvitation->complainer->last_name : '' }}</td>
                                            <td>{{ $complaintInvitation->complainee ? $complaintInvitation->complainee->first_name . ' ' . $complaintInvitation->complainee->last_name : '' }}</td>
                                            <td>{{ $complaintInvitation->creator ? $complaintInvitation->creator->first_name . ' ' . $complaintInvitation->creator->last_name : '' }}</td>
                                            <td>{{ $complaintInvitation->reason }}</td>
                                            <td>{{ $complaintInvitation->status }}</td>
                                            <td>{{ $complaintInvitation->created_at->format('F j, Y') }}</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="hrmComplaintList" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="hrmComplaintInvitationList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('complaints.invitations.show', ['complaintInvitation' => $complaintInvitation->id]) }}" class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                        @if(!in_array($complaintInvitation->status, ['approved', 'rejected', 'submitted']) && !is_null($complaintInvitation->stateRecipients()->get()->last()))
                                                            @if($complaintInvitation->stateRecipients()->get()->last()->user_id == auth()->user()->id)
                                                                <a href="{{ route('complaints.invitations.workflow.edit', ['complaintInvitation' => $complaintInvitation->id]) }}" class="dropdown-item"><i class="ft-edit"></i> @lang('labels.edit')</a>
                                                            @endif
                                                        @endif
                                                    </span>
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
        </div>
    </section>
@endsection

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {

            let table = $('.complaint-invitation-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 1}
                ],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "{{ trans('labels.next') }}",
                        "previous": "{{ trans('labels.previous') }}"
                    },
                }
            });
        });
    </script>
@endpush

