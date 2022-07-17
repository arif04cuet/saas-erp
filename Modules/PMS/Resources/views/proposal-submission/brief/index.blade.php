@extends('pms::layouts.master')
@section('title', trans('pms::project_proposal.submitted_proposal'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{trans('pms::project_proposal.submitted_proposal_list')}}</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="proposal-submission-table table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('pms::project_proposal.attached_file')</th>
                                        <th scope="col">@lang('pms::project_proposal.submitted_by')</th>
                                        <th scope="col">@lang('rms::research_proposal.submission_date')</th>
                                        <th scope="col">@lang('labels.status')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $statusAr = array(
                                            'APPROVED' => 'bg-success',
                                            'REJECTED' => 'bg-danger',
                                            'PENDING' => 'bg-warning',
                                            'REVIEWED' => 'bg-info',
                                            'CLOSED' => 'bg-danger',
                                        );
                                    @endphp

                                    @foreach($proposals as $proposal)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            @php
                                                $wfMaster = $proposal->workflowMasters->first();
                                                if ($wfMaster) {
                                                    $wfMasterId = $wfMaster->id;
                                                    $wfConvId = $wfMaster->workflowConversations->first()->id;
                                                    $wfRuleDetailsId = $wfMaster->ruleMaster->ruleDetails->first()->id;
                                                }

                                            @endphp
                                            <td>
                                                @if($wfMaster)
                                                    <a href="{{ route('project-proposal-submitted-review',
                                                    [$proposal->id, $wfMasterId, $wfConvId, $featureId, $wfRuleDetailsId,
                                                    'viewOnly'=>1]) }}">{{ $proposal->title }}
                                                    </a>
                                                @else
                                                    {{ $proposal->title }}
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{url('pms/project-proposal-submission/attachment-download/'.$proposal->id)}}">
                                                    @lang('labels.attachments')
                                                </a>
                                            </td>
                                            <td>{{ $proposal->ProposalSubmittedBy->name }}</td>
                                            <td>
                                                {{\Carbon\Carbon::parse($proposal->created_at)->format('d M,Y')}}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge {{ $statusAr[strtoupper($proposal->status)] }}">@lang('labels.status_' . strtolower($proposal->status))</span>
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
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                let filterValue = $('#filter-select').val() || '{{trans('pms::project_proposal.pending') }}';
                if (data[5] == filterValue) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function () {
            let table = $('.proposal-submission-table').DataTable({
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

            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                    {{ trans('labels.filtered') }}
                <select id="filter-select" class="form-control form-control-sm" style="width: 100px">
                    <option value="{{ trans('pms::project_proposal.pending') }}">{{ trans('pms::project_proposal.pending') }}</option>
                    <option value="{{ trans('pms::project_proposal.pending') }}">{{ trans('pms::project_proposal.pending') }}</option>
                    <option value="{{ trans('pms::project_proposal.closed') }}">{{ trans('pms::project_proposal.closed') }}</option>
                    <option value="{{ trans('pms::project_proposal.status_approved') }}">{{ trans('pms::project_proposal.status_approved') }}</option>
                    <option value="{{ trans('pms::project_proposal.status_rejected') }}">{{ trans('pms::project_proposal.status_rejected') }}</option>
                </select>
                    {{ trans('labels.records') }}
                </label>
            `);

            $('#filter-select').on('change', function () {
                table.draw();
            });
        });
    </script>
@endpush

