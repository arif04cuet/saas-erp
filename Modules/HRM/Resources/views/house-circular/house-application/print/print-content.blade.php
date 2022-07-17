<table class="table">
    <tbody>
    <tr>
        <th>@lang('labels.name')</th>
        <td>{{ $houseApplication->name }}</td>
    </tr>
    <tr>
        <th>@lang('labels.designation')</th>
        <td>{{ $houseApplication->designation }}</td>
    </tr>
    <tr>
        <th>@lang('labels.category')</th>
        <td>{{ $houseApplication->department }}</td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.salary_grade')</th>
        <td>{{ $houseApplication->salary_grade }}</td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.salary_scale')</th>
        <td>{{ $houseApplication->salary_scale }}</td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.salary')</th>
        <td>{{ $houseApplication->salary }}</td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.birth_date')</th>
        <td>{{ $houseApplication->birth_date }}</td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.current_position_date')</th>
        <td>{{ $houseApplication->current_position_date }}</td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.present_address_only')</th>
        <td>{{ $houseApplication->present_address }}</td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.house_no')</th>
        <td>
            @foreach($houseApplication->houseDetails as $houseDetail)
                {{ optional($houseDetail->houseDetail)->house_id ?? trans('labels.not_found') }}
                ,
            @endforeach
        </td>
    </tr>
    <tr>
        <th>@lang('hrm::house-circular.application.dp_head_recommand')</th>
        <td>{{ $houseApplication->dp_head_recommand }}</td>
    </tr>
    </tbody>
</table>
