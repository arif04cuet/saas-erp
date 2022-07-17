@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.invitation_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('pms::project_proposal.project_invitation_details_list')</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="proposal-request-table table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('labels.remarks')</th>
                                        <th scope="col">@lang('pms::project_proposal.attached_file')</th>
                                        <th scope="col">@lang('pms::project_proposal.last_sub_date')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><a href="{{ route('project-request-details.show', $request->id) }}">{{ $request->title }}</a></td>
                                                <td>{{ substr($request->remarks, 0,100) }} {{ strlen($request->remarks)>100 ? "..." : "" }}</td>
                                                <td><a href="{{url('pms/project-requests-details/attachment-download/'.$request->id)}}">@lang('labels.attachments')</a></td>
                                                <td>{{ $request->end_date->format('d/m/Y') }}</td>
                                                <td>
                                                <span class="dropdown">
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    @if(can_submit_detail_project_proposal($request))
                                                        <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{route('project-details-proposal-submission.create', $request->id)}}"
                                                           class="dropdown-item"><i class="ft-fast-forward"></i>@lang('pms::project_proposal.proposal_submission')</a>
                                                    </span>
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
        </div>
    </section>
@endsection
@push('page-js')
    <script>
        $(document).ready(function () {
            let table = $('.proposal-request-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 5}
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
