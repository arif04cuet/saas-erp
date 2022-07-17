@extends('hrm::layouts.master')

@section('title', trans('hrm::complaint.complaint_list'))

@section('content')
    <section id="complaint-list">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::complaint.complaint_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                        <a href="{{ route('complaint.create') }}" class="btn btn-primary btn-sm mt-1 mr-1 float-right">
                            <i class="ft-plus white"></i> {{trans('hrm::complaint.create')}}
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="complaint-table table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('hrm::complaint.complainer')</th>
                                        <th>@lang('hrm::complaint.accused')</th>
                                        <th>@lang('hrm::complaint.reason')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.date')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($complaints as $complaint)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $complaint->complainer ? $complaint->complainer->first_name . ' ' . $complaint->complainer->last_name : '' }}</td>
                                            <td>{{ $complaint->complainee ? $complaint->complainee->first_name . ' ' . $complaint->complainee->last_name : '' }}</td>
                                            <td>{{ $complaint->reason }}</td>
                                            <td>{{ $complaint->status }}</td>
                                            <td>{{ $complaint->created_at->format('F j, Y') }}</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="hrmComplaintList" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="hrmComplaintList" class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('complaint.show', ['complaint' => $complaint->id]) }}" class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                        @if(!in_array($complaint->status, ['approved', 'rejected']) && !is_null($complaint->stateRecipients()->get()->last()))
                                                            @if($complaint->stateRecipients()->get()->last()->user_id == auth()->user()->id)
                                                                <a href="{{ route('complaint.workflow.edit', ['complaint' => $complaint->id]) }}" class="dropdown-item"><i class="ft-edit"></i> @lang('labels.edit')</a>
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

            let table = $('.complaint-table').DataTable({
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