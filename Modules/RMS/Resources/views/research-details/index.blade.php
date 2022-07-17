@extends('rms::layouts.master')
@section('title', trans('rms::research_details.research_detail_list'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('rms::research_details.research_detail_list')</h4>
                        {{-- <div class="heading-elements"> --}}
                        {{-- <a href="" class="btn btn-primary btn-sm"><i --}}
                        {{-- class="ft-plus white"></i> </a> --}}

                        {{-- </div> --}}
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="research-detail-table table table-striped table-bordered">
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
                                            $sl = 1;
                                            $statusAr = [
                                                'APPROVED' => 'bg-success',
                                                'REJECTED' => 'bg-danger',
                                                'CLOSED' => 'bg-danger',
                                                'PENDING' => 'bg-warning',
                                                'REVIEWED' => 'bg-info',
                                            ];
                                        @endphp
                                        @if (count($researchDetails) > 0)
                                            @foreach ($researchDetails as $researchDetail)
                                                <tr>

                                                    <td>{{ $sl++ }}</td>
                                                    <td>{{ $researchDetail->title }}</td>
                                                    <td>{{ $researchDetail->user->name }}</td>
                                                    {{-- <td><a href="{{url('rms/research-proposal-details/attachment-download/'.$researchDetail->id)}}">@lang('labels.attachments')</a></td> --}}
                                                    <td><a
                                                            href="{{ url('rms/research-proposal-details/attachment-download/' . $researchDetail->id) }}">@lang('labels.attachments')</a>
                                                    </td>

                                                    <td>{{ $researchDetail->created_at }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $statusAr[$researchDetail->status] }}">@lang('labels.status_'
                                                            . strtolower($researchDetail->status))</span>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
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
        // $(document).ready(function () {
        //     // Setup - add a text input to each footer cell
        //     $('.research-detail-table thead tr').clone(true).appendTo('.research-detail-table thead');
        //     $('.research-detail-table thead tr:eq(1) th').each(function (i) {
        //         console.log(i)
        //         var title = $(this).text();
        //         $(this).html('<input type="text" placeholder="' + title + '" />');
        //
        //         $('input', this).on('keyup change', function () {
        //             if (table.column(i).search() !== this.value) {
        //                 table
        //                     .column(i)
        //                     .search(this.value)
        //                     .draw();
        //             }
        //         });
        //     });
        //
        //     var table = $('.research-detail-table').DataTable({
        //         orderCellsTop: true,
        //         fixedHeader: true,
        //     });
        // });
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                let filterValue = $('#filter-select').val() || '{!! trans('rms::research_proposal.pending') !!}';

                if (data[5] == filterValue) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            let table = $('.research-detail-table').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": 5
                }],
                "language": {
                    "search": "{{ trans('labels.search') }}",
                    "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                    "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                    "info": "{{ trans('labels.showing') }} _START_ {{ trans('labels.to') }} _END_ {{ trans('labels.of') }} _TOTAL_ {{ trans('labels.records') }}",
                    "infoFiltered": "( {{ trans('labels.total') }} _MAX_ {{ trans('labels.infoFiltered') }} )",
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
        <option value="{{ trans('rms::research_proposal.closed') }}">{{ trans('rms::research_proposal.closed') }}</option>
        <option value="{{ trans('rms::research_proposal.status_approved') }}">{{ trans('rms::research_proposal.status_approved') }}</option>
        <option value="{{ trans('rms::research_proposal.status_rejected') }}">{{ trans('rms::research_proposal.status_rejected') }}</option>
        </select>
        {{ trans('labels.records') }}
                </label>
`);

            $('#filter-select').on('change', function() {
                table.draw();
            });
        });
    </script>
@endpush
