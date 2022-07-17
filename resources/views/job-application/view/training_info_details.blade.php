@foreach($employee->employeeTrainingInfo as $training)
    <table class="table">
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
            <th scope="col">{{trans('hrm::training.duration')}}</th>
            <td>{{$training->duration}}</td>
        </tr>
        <tr>
            <th scope="col">{{trans('hrm::training.training_year')}}</th>
            <td>{{$training->training_year}}</td>
        </tr>


        <tr>
            <th scope="col">{{trans('hrm::training.organization_country')}}</th>
            <td>{{$training->organization_country}}</td>
        </tr>
        <tr>
            <th scope="col">{{trans('hrm::training.organization_website')}}</th>
            <td><a href="{{$training->organization_website}}" target="_blank">{{$training->organization_website}}</a></td>
        </tr>
        <tr>
            <th scope="col">{{trans('hrm::training.result')}}</th>
            <td>{{$training->result}}</td>
        </tr>
        <tr>
            <th scope="col">{{trans('hrm::training.achievement')}}</th>
            <td>{{$training->achievement}}</td>
        </tr>

        </tbody>
    </table>
@endforeach
<a class="btn btn-small btn-info" href="{{ url('/hrm/employee/' . $employee->id . '/edit#training') }}">Edit </a>
