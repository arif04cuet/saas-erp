@foreach($employee->employeeEducationInfo as  $education)
    <table class="table">
        <tbody>

        <tr>
            <th scope="col">@lang('hrm::education.institute_name')</th>
            <td>@if(!empty($education->institutes)){{ $education->institutes->name}}  @endif</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::education.department_section_group')</th>

            <td>@if(!empty($education->academicDepartment)){{ $education->academicDepartment->name}} @endif</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::education.degree_name')</th>

            <td>@if(!empty($education->academicDegree)) {{ $education->academicDegree->name}} @endif</td>
        </tr>


        <tr>
            <th scope="col">@lang('hrm::education.passing_year')</th>

            <td>{{ $education->passing_year}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::education.medium')</th>

            <td>{{ $education->medium}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::education.result')</th>

            <td>{{ $education->result}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::education.achievement')</th>

            <td>{{ $education->achievement}}</td>
        </tr>


        </tbody>
    </table>
@endforeach
<a class="btn btn-small btn-info" href="{{ url('/hrm/employee/' . $employee->id . '/edit#education') }}">Edit </a>