<div class="row">
    <!-- training information -->
    <table class="table text-center col-md-8">
        <tbody>
        <tr>
            <th>
                {{trans('tms::training.title')}}
            </th>
            <td>{{$training->title ?? trans('labels.not_found')}}</td>
        </tr>
        <tr>
            <th>{{trans('tms::trainee.title')}}</th>
            <td>{{$trainee->getName() ?? trans('labels.not_found')}}</td>
        </tr>
        <tr>
            <th>{{trans('labels.start')}}</th>
            <td>{{$training->start_date ?? trans('labels.not_found') }}</td>
        </tr>
        <tr>
            <th>{{trans('labels.end')}}</th>
            <td>{{$training->end_date ?? trans('labels.not_found')}}</td>
        </tr>
        </tbody>
    </table>

    <div class="col-md-4">
        <img src="{{ url("/file/get?filePath=" .  $trainee->photo) }}"
             width="200px" height="200px">
    </div>

</div>


<!-- Personal Info -->
<h4 class="form-section text-center"><i class="la la-tag"></i>
    @lang('tms::trainee.personal_info')
</h4>
@include('tms::trainee.print.partial.personal_information')

<!-- General Info -->
<h4 class="form-section text-center"><i class="la la-tag"></i>
    @lang('tms::training.general_info')
</h4>
@include('tms::trainee.print.partial.general_information')

<!-- Educational Info -->
<h4 class="form-section text-center"><i class="la la-tag"></i>
    @lang('tms::training.educational_info')
</h4>
@include('tms::trainee.print.partial.education_information')

<!-- Job information -->
<h4 class="form-section text-center"><i class="la la-tag"></i>
    @lang('tms::training.trainee_service')
</h4>
@include('tms::trainee.print.partial.job_information')

<!-- Emergency Contact  -->
<h4 class="form-section text-center"><i class="la la-tag"></i>
    @lang('tms::training.emergency_contact')
</h4>
@include('tms::trainee.print.partial.emergency_information')
