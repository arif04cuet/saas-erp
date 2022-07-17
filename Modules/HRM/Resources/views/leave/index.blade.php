@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.page_card_title'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::leave.leave_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{ route('consumed-leave-import') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> Import</a>

                            <a href="{{ route('leaves.create') }}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> @lang('hrm::leave.leave_application')</a>

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div id="test"></div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('labels.serial')</th>
                                            <th>@lang('hrm::leave.leave_type')</th>
                                            <th>@lang('hrm::leave.leave_start_date')</th>
                                            <th>@lang('hrm::leave.leave_end_date')</th>
                                            <th>@lang('hrm::leave.leave_duration')</th>
                                            <th>@lang('hrm::leave.leave_application_date')</th>
                                            <th>@lang('labels.status')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($leaveRequests as $leaveRequest)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>@lang('hrm::leave.' . $leaveRequest->type->name)</td>
                                                <td>{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $leaveRequest->getDuration() }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leaveRequest->created_at)->format('d/m/Y') }}
                                                </td>
                                                <td>@lang("labels.$leaveRequest->status")</td>
                                                <td>
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                        class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('leaves.show', $leaveRequest->id) }}"
                                                            class="dropdown-item">
                                                            <i class="ft-eye"></i> @lang('labels.details')
                                                        </a>
                                                        @if ($leaveRequest->status == 'approved' && $leaveRequest->requester_id == Auth::user()->id)
                                                            <div class="dropdown-divider"></div>
                                                            <a href="{{ route('leaves.cancel', $leaveRequest->id) }}"
                                                                class="dropdown-item">
                                                                <i class="ft-x red"></i> @lang('labels.cancel')
                                                            </a>
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
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                let filterValue = $('#filter-select').val() || '{!! trans('labels.pending') !!}';
                if (data[6] == filterValue) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            let table = $('.table').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": 6
                }],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        }
                    },
                    {
                        extend: 'print',
                        className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

            $(".dataTables_filter").prepend(`
                <label>
                    {{ trans('labels.filtered') }}
            <select id="filter-select" class="form-control form-control-sm"
                style="width: 150px; float: right; margin-left: 10px; margin-top: -6px; height: 35px;">
                    <option value="{{ trans('labels.new') }}">{{ trans('labels.new') }}</option>
                            <option value="{{ trans('labels.shared') }}">{{ trans('labels.shared') }}</option>
                            <option value="{{ trans('labels.pending') }}">{{ trans('labels.pending') }}</option>
                            <option value="{{ trans('labels.approved') }}">{{ trans('labels.approved') }}</option>
                            <option value="{{ trans('labels.rejected') }}">{{ trans('labels.rejected') }}</option>
                    </select>
                </label>
            `);

            $('#filter-select').on('change', function() {
                table.draw();
            });
        });
    </script>
@endpush
