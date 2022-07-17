<table class="master table ">
    <tbody>
    <tr>
        <th>@lang('labels.image')</th>
        <td><img src="{{ '/file/get?filePath='.$photoUrl }}" width="200px" height="200px"></td>
    </tr>
    <tr>
        <th class="">@lang('labels.first_name')</th>
        <td>{{$employee->first_name}}</td>
    </tr>
    <tr>

        <th class="">@lang('labels.last_name')</th>
        <td>{{$employee->last_name}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.email_address')</th>
        <td>{{$employee->email}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.gender')</th>
        <td>{{$employee->gender}}</td>
    </tr>
    <tr>
        <th class="">@lang('hrm::department.department')</th>
        <td>{{$employee->employeeDepartment->name ?? 'Not Found' }}</td>
    </tr>
    <tr>
        <th class="">@lang('hrm::department.section_title')</th>
        <td>{{$employee->employeeSection->name ?? 'Not Found'}}</td>
    </tr>
    <tr>
        <th class="">@lang('hrm::designation.designation')</th>
        <td>{{ $employee->designation->name ?? 'Not Found' }}</td>
    </tr>
    <tr>
        <th class="">@lang('hrm::employee_general_info.employee_current_status')</th>
        <td>{{ucwords($employee->status ?? 'Not Found' )}}</td>
    </tr>
    <tr>
        <th class="">@lang('hrm::employee.religion.title')</th>
        <td>{{ucwords(optional($employee->religion)->getTitle() ?? 'Not Found' )}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.tel_office')</th>
        <td>{{$employee->tel_office ?? 'Not Found'}}</td>
    </tr>

    <tr>
        <th class="">@lang('labels.tel_office')</th>
        <td>{{$employee->tel_home ?? 'Not Found'}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.mobile') (1)</th>
        <td>{{$employee->mobile_one ?? 'Not Found'}}</td>
    </tr>
    <tr>
        <th class="">@lang('labels.mobile') (2)</th>
        <td>{{$employee->mobile_two ?? 'Not Found'}}</td>
    </tr>
    </tbody>
</table>
{{--<a href="{{url('/hrm/employee/')}}"--}}
<a class="master btn btn-small btn-info" href="{{ route('employee.edit', $employee->id) }}">@lang('labels.edit') </a>
