@extends('rms::layouts.master')
@section('title', trans('rms::research_proposal.submitted_research_proposal'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('rms::research_proposal.submitted_research_proposal_list')</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="proposal-submission-table table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.title')</th>
                                        <th scope="col">@lang('rms::research_proposal.submitted_by')</th>
                                        <th scope="col">@lang('rms::research_proposal.attached_file')</th>
                                        <th scope="col">@lang('rms::research_proposal.submission_date')</th>
                                        <th scope="col">@lang('labels.status')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $statusAr = [
                                            'APPROVED' => 'bg-success',
                                            'REJECTED' => 'bg-danger',
                                            'PENDING' => 'bg-warning',
                                            'REVIEWED' => 'bg-info',
                                            'CLOSED' => 'bg-danger',
                                        ];

                                    @endphp
                                    @foreach($proposals as $proposal)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            @php
                                                $featureName = 'Research Proposal';
                                                $feature = \App\Entities\workflow\Feature::where('name', $featureName)->first();
                                                $workflowMaster = \App\Entities\workflow\WorkflowMaster::where('feature_id', $feature->id)
                                                ->where('ref_table_id', $proposal->id)->first();
                                            @endphp
                                            <td>
                                                <a href="{{ route('research-proposal-view-only', [$proposal->id, $featureName, $workflowMaster->id]) }}">{{ $proposal->title }}</a>
                                            </td>
                                            <td>{{ isset($proposal->submittedBy->name) ? $proposal->submittedBy->name : '' }}</td>
                                            <td>
                                                <a href="{{url('rms/research-proposal-submission/attachment-download/'.$proposal->id)}}">@lang('labels.attachments')</a>
                                            </td>
                                            <td>{{ date('d/m/y h:i:a', strtotime($proposal->created_at)) }}</td>
                                            <td>
                                                <span class="badge {{ $statusAr[strtoupper($proposal->status)] }}">@lang('labels.status_' . strtolower($proposal->status))</span>
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
                let filterValue = $('#filter-select').val() || '{!! trans('rms::research_proposal.pending') !!}';
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
                    <option value="{{ trans('rms::research_proposal.pending') }}">{{ trans('rms::research_proposal.pending') }}</option>
                        <option value="{{ trans('rms::research_proposal.status_approved') }}">{{ trans('rms::research_proposal.status_approved') }}</option>
                        <option value="{{ trans('rms::research_proposal.status_rejected') }}">{{ trans('rms::research_proposal.status_rejected') }}</option>
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


