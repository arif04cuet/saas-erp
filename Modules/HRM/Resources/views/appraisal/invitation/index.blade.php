@extends('hrm::layouts.master')
@section('title', trans('hrm::appraisal.invitation.list'))

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
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
                        <a href="{{ route('appraisal.invitation.create') }}" class="btn btn-primary btn-sm mt-1 mr-1 float-right">
                            <i class="ft-plus white"></i> {{trans('hrm::appraisal.invitation.create')}}
                        </a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="appraisals-table table table-striped table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>@lang('labels.serial')</th>
                                    <th>@lang('hrm::appraisal.reporter')</th>
                                    <th>@lang('hrm::appraisal.signer_officer')</th>
                                    <th>@lang('hrm::appraisal.final_commenter')</th>
                                    <th>@lang('labels.created_at')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invitations as $invitation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($invitation->appraisalSetting->reporter)->getName() }}</td>
                                        <td>{{ optional($invitation->appraisalSetting->signer)->getName() }}</td>
                                        <td>{{ optional($invitation->appraisalSetting->commenter)->getName() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($invitation->created_at)->format('j F, Y') }}</td>
                                        <td>Not Initiate Yet</td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                <i class="la la-cog"></i></button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('appraisal.invitation.show', $invitation->id) }}" class="dropdown-item"><i class="ft-eye"></i> @lang('labels.details')</a>
                                                    <a href="" class="dropdown-item"><i class="ft-edit-2"></i> @lang('labels.edit')</a>
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
    </section>

@endsection

@push('page-js')
    <script type="text/javascript">
        let table = $('.appraisals-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": 1},
                {
                    "targets" : [7, 8],
                    "visible" : false
                }
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
            },

        });

    </script>
@endpush
