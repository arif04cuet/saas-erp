@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.loan.apply') . ' ' . trans('labels.list'))
{{--@section("employee_create", 'active')--}}

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::employee.loan.apply') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('employee-loans.create')}}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> @lang('hrm::employee.loan.apply')
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="DepartmentTable">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('labels.designation')</th>
                                        <th>@lang('hrm::employee.loan.apply_date')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($loans as $loan)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <th>{{ $loan->employee->getName() }}</th>
                                            <th>{{ $loan->employee->designation->getName() }}</th>
                                            <td>{{ \Carbon\Carbon::parse($loan->created_at)->format('d F, Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{config('constants.status_classes.'. $loan->status)}}">
                                                    {{ucwords($loan->status)}}
                                                </span>
                                            </td>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    @if($loan->status == 'pending' && $approvalPermission)
                                                        <a href="{{ route('employee-loans.approve', $loan->id) }}"
                                                           class="dropdown-item">
                                                            <i class="ft-check-circle"></i> @lang('labels.approve')
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                    @endif
                                                    <a href="{{ route('employee-loans.show', $loan->id) }}"
                                                       class="dropdown-item">
                                                        <i class="ft-eye"></i> @lang('labels.details')
                                                    </a>
{{--                                                    <div class="dropdown-divider"></div>--}}
{{--                                                    <a href="{{ route('employee-loans.edit', $loan->id) }}"--}}
{{--                                                       class="dropdown-item">--}}
{{--                                                        <i class="ft-edit-2"></i>@lang('labels.edit')--}}
{{--                                                    </a>--}}
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

        //        table export configuration
        $(document).ready(function () {
            $('#DepartmentTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });

        });

        function confirmMessage() {
            if (!confirm("{{ trans('labels.confirm_delete') }}"))
                event.preventDefault();
        }
    </script>

@endpush
