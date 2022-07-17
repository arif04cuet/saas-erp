@extends('hrm::layouts.master')
@section('title', trans('hrm::leave.leave_type') . ' ' . trans('labels.list'))
{{-- @section('employee_create', 'active') --}}


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hrm::leave.leave_type_list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            {{-- <a href="{{route('leave-types.create')}}" class="btn btn-primary btn-sm"><i --}}
                            {{-- class="ft-plus white"></i>@lang('labels.add')</a> --}}

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
                                            <th>@lang('labels.total') @lang('labels.days')</th>
                                            <th>@lang('hrm::leave.max_allowed_days')</th>
                                            <th>@lang('labels.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($types as $type)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <th>{{ __('hrm::leave.' . $type->name) ?? '' }}</th>
                                                <th>{{ $type->amount ?? '' }}</th>
                                                <th>{{ $type->maximum_allowed_days ?? 'N/A' }}</th>

                                                <td>
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                        class="dropdown-menu mt-1 dropdown-menu-right">

                                                        <a href="{{ route('leave-types.edit', $type->id) }}"
                                                            class="dropdown-item">
                                                            <i class="ft-edit-2"></i>
                                                            @lang('labels.edit')
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
        $(document).ready(function() {
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
