@foreach($employee->employeeResearchInfo as $research)
    <table class="table">
        <tbody>

        <tr>
            <th scope="col">@lang('hrm::research.organization_name')</th>
            <td>{{ $research->organization_name}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::research.research_topic')</th>
            <td>{{ $research->research_topic}}</td>
        </tr>
        <tr>
            <th scope="col">@lang('hrm::research.responsibilities')</th>
            <td>{{ $research->responsibilities}}</td>
        </tr>

        </tbody>
    </table>
@endforeach
<a class="btn btn-small btn-info" href="{{ url('/hrm/employee/' . $employee->id . '/edit#research') }}">@lang('labels.edit') </a>