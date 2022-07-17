@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.loan.circular.index'))
{{--@section("employee_create", 'active')--}}

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::employee.loan.circular.index')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            @can('hrm-user-access')
                                <a href="{{route('loan-circulars.create')}}" class="btn btn-primary btn-sm">
                                    <i class="ft-plus white"></i> @lang('hrm::employee.loan.circular.create')
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="DepartmentTable">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('hrm::employee.loan.circular.loan_circular_title')</th>
                                        <th>@lang('hrm::employee.loan.circular.reference_no')</th>
                                        <th>@lang('hrm::employee.loan.circular.circular_date')</th>
                                        <th>@lang('hrm::employee.loan.circular.last_date_of_application')</th>
                                        <th>@lang('labels.status')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($circulars as $circular)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <th scope="row">{{$circular->title }}</th>
                                            <th>{{$circular->reference_no }}</th>
                                            <th>
                                                {{ \Carbon\Carbon::parse($circular->circular_date)->format('d F, Y') }}
                                            </th>
                                            <th>
                                                {{ \Carbon\Carbon::parse($circular->last_date_of_application)->format('d F, Y') }}
                                            </th>
                                            <td>
                                                <span
                                                    class="badge badge-{{config('constants.status_classes.'. $circular->status)}}">
                                                    {{ucwords($circular->status)}}
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
                                                    <a href="{{ route('loan-circulars.show', $circular->id) }}"
                                                       class="dropdown-item">
                                                        <i class="ft-eye"></i> @lang('labels.details')
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="{{ route('loan-circulars.edit', $circular->id) }}"
                                                       class="dropdown-item">
                                                        <i class="ft-edit-2"></i>@lang('labels.edit')
                                                    </a>
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
