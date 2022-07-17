@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.list_title'))
{{--@section("employee_create", 'active')--}}


@section('content')
    <div class="container">
        <section id="role-list">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list"></i> @lang('hrm::employee.list_title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('employee.create')}}" class="master btn btn-primary btn-sm"><i
                                        class="ft-plus white"></i> @lang('labels.add')</a>
    
                            </div>
                        </div>
    
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
    
                                <div class="table-responsive">
                                    <table class="master employee-list-table table table-striped table-bordered " id="Example1">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang('labels.serial')</th>
                                            <th scope="col">@lang('labels.id')</th>
                                            <th scope="col">@lang('labels.name')</th>
                                            <th>@lang('hrm::personal_info.father_name')</th>
                                            <th>@lang('hrm::personal_info.husband_name')</th>
                                            <th>@lang('hrm::personal_info.mother_name')</th>
                                            <th>@lang('hrm::personal_info.date_of_birth')</th>
                                            <th>@lang('hrm::personal_info.joining_date')</th>
                                            <th>@lang('hrm::personal_info.salary_scale')</th>
                                            <th>@lang('hrm::personal_info.current_basic_pay')</th>
    
                                        </thead>
                                        <tbody>
                                        @if(count($employeeList)>0)
                                            @foreach($employeeList as $employee)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <th>{{ $employee->employee_id }}</th>
                                                    <td>{{$employee->getName()}}</td>
                                                    <td>{{ optional($employee->employeePersonalInfo)->father_name ?? trans('labels.not_found')}}</td>
                                                    <td>{{optional($employee->employeePersonalInfo)->mother_name ?? trans('labels.not_found')}}</td>
                                                    <td>{{ optional($employee->employeePersonalInfo)->husband_name ?? trans('labels.not_found') }}</td>
    
                                                    <td>
                                                        @if(!is_null(optional($employee->employeePersonalInfo)->date_of_birth))
                                                            {{date('d F, Y', strtotime(optional($employee->employeePersonalInfo)->date_of_birth ?? null))}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(!is_null(optional($employee->employeePersonalInfo)->job_joining_date))
                                                            {{date('d F, Y', strtotime(optional($employee->employeePersonalInfo)->job_joining_date ?? null))}}
                                                        @endif
                                                    </td>
                                                    <td>{{$employee->employeePersonalInfo->salary_scale ?? trans('labels.not_found')}}</td>
                                                    <td>{{$employee->employeePersonalInfo->total_salary ?? trans('labels.not_found') }}</td>
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
    </div>
    
@endsection


@push('page-js')
    <script>

        $(document).ready(function () {

            let table = $('.employee-list-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 1}
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
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true
            });
        });


    </script>
@endpush
