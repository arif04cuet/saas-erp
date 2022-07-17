@extends('hrm::layouts.master')
@section('title', trans('hrm::employee.list_title'))
{{--@section("employee_create", 'active')--}}
@section('content')
    <section id="role-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list black"></i> @lang('hrm::employee.list_title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <a href="{{route('employee.import')}}" class="master btn btn-primary btn-sm"><i class="ft-plus white"></i> Import</a>
                                <a href="{{route('employee.create')}}" class="master btn btn-primary btn-sm"><i class="ft-plus white"></i> @lang('labels.add')</a>
                            </div>
                        </div>
    
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
    
                                <div class="table-responsive">
                                    <table class="master employee-list-table table table-striped table-bordered" id="Example1">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang('labels.serial')</th>
                                            <th scope="col">@lang('labels.id')</th>
                                            <th scope="col">@lang('labels.name')</th>
                                            <th scope="col">@lang('hrm::designation.designation')</th>
                                            <th scope="col">@lang('labels.gender')</th>
                                            <th scope="col">@lang('hrm::department.department')</th>
                                            <th scope="col">@lang('labels.status')</th>
                                            <th scope="col">@lang('labels.tel')</th>
                                            <th scope="col">@lang('labels.mobile')</th>
                                            <th scope="col">@lang('labels.action')</th>
    
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($employeeList)>0)
                                            @foreach($employeeList as $key => $employee)
    
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <th>{{ $employee->employee_id }}</th>
                                                    <td>{{$employee->first_name . " " . $employee->last_name}}</td>
                                                    <td>
                                                        {{optional($employee->designation)->name ?? __('labels.not_found')}}
                                                    </td>
                                                    <td>{{$employee->gender}}</td>
                                                    <td>{{isset($employee->employeeDepartment->name) ? $employee->employeeDepartment->name : ''}}</td>
                                                    <td>{{$employee->status}}</td>
                                                    <td>{{$employee->tel_office}}</td>
                                                    <td>{{$employee->mobile_one}}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('employee.show', $employee->id) }}" class="master btn btn-info" title="{{trans('labels.details')}}">
                                                                <i class="ft-eye white"></i>
                                                            </a>
                                                            <a href="{{ route('employee.edit',  $employee->id) }}" class="master btn btn-success" title="{{trans('labels.edit')}}">
                                                                <i class="ft-edit white"></i>
                                                            </a>
                                                            {{-- <a href="#" class="master btn btn-danger"
                                                                onclick="delete_form{{ $key }}.submit()" title="{{ trans('labels.delete') }}">
                                                                <i class="la la-trash-o white"></i>
                                                            </a>
                                                            <!-- delete -->
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'url' => route('employee.destroy',$employee->id),
                                                                'style' => 'display:inline',
                                                                'id' => 'delete_form' . $key,
                                                                'onclick'=>'return confirm("Confirm delete?")',
                                                            ]) !!}

                                                            {!! Form::close() !!} --}}
                                                        </div>
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
        </div>
    </section>
@endsection


@push('page-js')
    <script>

        $(document).ready(function () {
            let mBottom = $('.dataTables_filter');
            mBottom.css("margin-bottom","10px !important");
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

            $("div.dataTables_filter").prepend(`
                <label style="margin-bottom: 10px;width: 250px;">
                    <span style="margin:0px 5px !important">{{ trans('hrm::department.department') }}</span>
                    <select id="filter-department-select" class="form-control form-control-sm" style="display: inline;">
                        <option value='all' selected>All</option>
                        @foreach($allDepartments as $department)
                            <option value="{{$department->name}}">{{$department->name}}</option>;
                        @endforeach
                    </select>
                </label>`);

            $("div.dataTables_filter").prepend(`
                <label style="margin-right: 5px !important;width: 250px;">
                    <span style="margin:0px 5px !important">{{ trans('hrm::designation.designation') }}</span>
                    <select id="filter-designation-select" class="form-control form-control-sm"
                    style="display: inline;  width: 200px;">
                        <option value="all">All</option>
                        @foreach($designations as $designation)
                            <option value="{{ $designation->name }}">{{ $designation->name }}</option>
                        @endforeach
                    </select>
                </label>
            `);

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let filterDepartmentValue = $('#filter-department-select').val();
                    let filterDesignationValue = $('#filter-designation-select').val();
                    let deptColValue = data[5].trim();
                    let desigColValue = data[3].trim();
                    return isFilteredMatched(filterDepartmentValue, deptColValue, filterDesignationValue, desigColValue);
                }
            );

            table.draw();

            $('#filter-department-select').on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterDepartmentValue = $('#filter-department-select').val();
                        let filterDesignationValue = $('#filter-designation-select').val();
                        let deptColValue = data[5].trim();
                        let desigColValue = data[3].trim();
                        return isFilteredMatched(filterDepartmentValue, deptColValue, filterDesignationValue, desigColValue);
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });

            $('#filter-designation-select').on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterDepartmentValue = $('#filter-department-select').val();
                        let filterDesignationValue = $('#filter-designation-select').val();
                        let deptColValue = data[5].trim();
                        let desigColValue = data[3].trim();
                        return isFilteredMatched(filterDepartmentValue, deptColValue, filterDesignationValue, desigColValue);
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });

            $('#filter-department-select, #filter-designation-select').select2({
                selectOnClose: true,
            });

        });

        function isFilteredMatched(filterDepartmentValue, deptColValue, filterDesignationValue, desigColValue) {

            if ((filterDepartmentValue == "all" || deptColValue == filterDepartmentValue) &&
                (filterDesignationValue == "all" || desigColValue == filterDesignationValue) )
            {
                return true;
            }
            return false;
        }
    </script>
@endpush
