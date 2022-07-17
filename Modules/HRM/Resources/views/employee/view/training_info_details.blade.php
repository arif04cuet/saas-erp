<div class="row">
    <div class="col-md-6">
        <h4 class="mt-2 mb-1">@lang('hrm::training.training_info')</h4>
        <table class="master table">
            @foreach($employee->employeeTrainingInfo as $training)
                <tbody>
                <tr>
                    <th scope="col">{{trans('hrm::training.course_name')}}</th>
                    <td>{{$training->course_name}}</td>
                </tr>
                <tr>
                    <th scope="col">{{trans('hrm::training.institute_name')}}</th>
                    <td>{{$training->organization_name}}</td>
                </tr>
                <tr>
                    <th scope="col"> {{ trans('hrm::training.training_category') }} </th>
                    <td>{{ $training->category  }}</td>
                </tr>
                <tr>
                    <th scope="col">{{trans('hrm::training.duration')}}</th>
                    <td>{{$training->duration}}</td>
                </tr>
                <tr>
                    <th scope="col">{{trans('hrm::training.training_year')}}</th>
                    <td>{{$training->training_year}}</td>
                </tr>
                <tr>
                    <th scope="col"> {{ trans('hrm::training.region') }} </th>
                    <td>{{ $training->region  }}</td>
                </tr>
                <tr>
                    <th scope="col">{{trans('hrm::training.organization_country')}}</th>
                    <td>{{$training->organization_country}}</td>
                </tr>
                <tr>
                    <th scope="col">{{trans('hrm::training.organization_website')}}</th>
                    <td><a href="{{$training->organization_website}}" target="_blank">{{$training->organization_website}}</a>
                    </td>
                </tr>
                <tr>
                    <th scope="col">{{trans('hrm::training.result')}}</th>
                    <td>{{$training->result}}</td>
                </tr>
                <tr>
                    <th scope="col">{{ trans('hrm::training.nominating_authority') }}</th>
                    <td>{{ $training->nominating_authority }}</td>
                </tr>
                <tr>
                    <th scope="col">{{trans('hrm::training.achievement')}}</th>
                    <td>{{$training->achievement}}</td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
    <div class="col-md-6">
        <h4 class="mt-2 mb-1">@lang('hrm::training.training_summary')</h4>
        <table class="master table">
            <tr>
                <th>@lang('hrm::training.total_training')</th>
                <td class="text-right">{{ $employee->employeeTrainingInfo->count() }}</td>
            </tr>
            <tr>
                <th>@lang('hrm::training.total_national_training')</th>
                <td class="text-right">{{ $employee->employeeNationalCourse() }}</td>
            </tr>
            <tr>
                <th>@lang('hrm::training.total_foreign_training')</th>
                <td class="text-right">{{ $employee->employeeForeignCourse() }}</td>
            </tr>
            <tr>
                <th>@lang('hrm::training.training_category')</th>
                <td class="text-right">
                    @foreach ($employee->employeeCourseCategory() as $item)
                        <span class="badge badge-primary">{{ $item }}</span>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</div>

@can('hrm-user-access')
    <a class="master btn btn-small btn-info"
    href="{{ route('employee.edit', $employee->id) . '/#training') }}">@lang('labels.edit') </a>
@endcan

