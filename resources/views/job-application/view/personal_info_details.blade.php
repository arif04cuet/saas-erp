<table class="table">
    <tbody>

    <tr>
        <th >@lang('hrm::personal_info.father_name')</th>
        <td>{{ $employee->employeePersonalInfo->father_name }}</td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.husband_name')</th>
        <td>{{ $employee->employeePersonalInfo->husband_name }}</td>
    </tr>
    <tr>

        <th >@lang('hrm::personal_info.mother_name')</th>
        <td>{{$employee->employeePersonalInfo->mother_name}}</td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.title_name')</th>
        <td>{{$employee->employeePersonalInfo->title}}</td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.nid_number')</th>
        <td>{{$employee->employeePersonalInfo->nid_number}}</td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.date_of_birth')</th>
        <td>
            @if(!is_null($employee->employeePersonalInfo->date_of_birth))
                {{date('d F, Y', strtotime($employee->employeePersonalInfo->date_of_birth))}}
            @endif
        </td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.joining_date')</th>
        <td>
            @if(!is_null($employee->employeePersonalInfo->job_joining_date))
                {{date('d F, Y', strtotime($employee->employeePersonalInfo->job_joining_date))}}
            @endif
        </td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.current_position_joining_date')</th>
        <td>
            @if(!is_null($employee->employeePersonalInfo->current_position_joining_date))
                {{date('d F, Y', strtotime($employee->employeePersonalInfo->current_position_joining_date))}}
            @endif
        </td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.current_position_duration')</th>
        <td>
            @if(!is_null($currentPostDuration))
                @foreach($currentPostDuration as $key=>$dateTerms)
                    @if($dateTerms) {{$dateTerms." ".ucwords($key)}} @endif
                @endforeach
            @endif
        </td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.current_position_expire_date')</th>
        <td>
            @if(!is_null($employee->employeePersonalInfo->current_position_expire_date))
                {{date('d F, Y', strtotime($employee->employeePersonalInfo->current_position_expire_date))}}
            @endif
        </td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.salary_scale')</th>
        <td>{{$employee->employeePersonalInfo->salary_scale}}</td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.current_basic_pay')</th>
        <td>{{$employee->employeePersonalInfo->total_salary}}</td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.marital_status')</th>
        <td>{{$employee->employeePersonalInfo->marital_status}}</td>
    </tr>
    <tr>
        <th >@lang('hrm::personal_info.number_of_children')</th>
        <td>{{$employee->employeePersonalInfo->number_of_children}}</td>
    </tr>

    </tbody>
</table>

<a class="btn btn-small btn-info" href="{{ url('/hrm/employee/' . $employee->id . '/edit#personal') }}">@lang('labels.edit') </a>
