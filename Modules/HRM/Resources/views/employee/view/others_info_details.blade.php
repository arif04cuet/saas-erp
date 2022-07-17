<table class="table">
    <tbody>
        <tr>
            <th>@lang('hrm::others_info.interest_area')</th>
            <td>
                @foreach ($employee->employeeInterestInfo as $item)
                    <span class="badge badge-primary">{{ $item->employeeInterest->name }}</span>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>

<a class="master btn btn-small btn-info"
   href="{{ route('employee.edit', $employee->id . '/#others') }}">@lang('labels.edit') </a>
