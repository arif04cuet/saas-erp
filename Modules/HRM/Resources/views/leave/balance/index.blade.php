@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.leave_type') . ' ' . trans('labels.list'))
{{--@section("employee_create", 'active')--}}


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::leave.leave_balance')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination text-center">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.name')</th>
                                        <th>@lang('labels.designation')</th>
                                        <th>@lang('hrm::personal_info.joining_date')</th>
                                        <th>@lang('labels.action')</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($balances as $balance)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <th>
                                                <a href="{{ route('leave-balances.show', $balance['employeeId']) }}">
                                                    {{ $balance['name'] }}
                                                </a>
                                            </th>
                                            <td>{{ $balance['designation'] }}</td>
                                            <th>
                                                {{ \Carbon\Carbon::parse($balance['joiningDate'])->format('d F, Y') ?? '' }}
                                            </th>
                                            <td>
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                    <a href="{{ route('leave-balances.show', $balance['employeeId']) }}"
                                                       class="dropdown-item">
                                                        <i class="ft-eye"></i>
                                                        @lang('labels.show')
                                                    </a>
                                                    @can('hrm-user-access')
                                                    <a href="{{ route('leaves.edit_employee_leave', $balance['employeeId']) }}"
                                                       class="dropdown-item">
                                                        <i class="ft-edit"></i>
                                                        @lang('hrm::leave.update_leave')
                                                    </a>
                                                    @endcan
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
