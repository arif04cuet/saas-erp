<div class="row">
    <div class="col-md-12">
        <div class="card border-top-blue">
            <div class="">
                <h2 class="pl-2 pt-1"><b>{{ $jobCircular->title }}</b></h2>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- job nature -->
                            <h4 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.job_nature')</h4>
                            <p class="pl-1">{{ $jobCircular->job_nature }}</p>
                            <!-- job ref number -->
                            <h4 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.reference_number')</h4>
                            <div class="pl-1 mb-1">
                                {!! $jobCircular->reference_number!!}
                            </div>
                        </div>
                        <div class="col">
                            <h4 class="text-bold-700 pt-1 pl-1"><b>@lang('hrm::circular.published')</h4>
                            <p class="pl-1">{{date('d F, Y', strtotime($jobCircular->created_at))}}</p>

                            <h4 class="text-bold-700 pt-1 pl-1"><b>@lang('hrm::circular.application_deadline')</h4>
                            <p class="pl-1">{{date('d F, Y', strtotime($jobCircular->application_deadline))}} </p>
                        </div>
                    </div>
                    <hr>
                    @foreach($jobCircular->jobCircularDetails as $jobCircularDetail)
                        <div class="col">
                            <!-- job details section -->
                            <h3 class="text-bold-700 pt-1 pl-1">
                                @enToBnNumber($loop->iteration). {{ optional($jobCircularDetail->designation)->getName() ?? __('labels.not_found') }}
                            </h3>
                            <div class="row">
                                <div class="col">
                                    <!-- designation -->
                                    <h5 class="text-bold-700 pt-1 pl-1">@lang('labels.designation')</h5>
                                    <p class="pl-1">{{ optional($jobCircularDetail->designation)->getName() ?? __('labels.not_found') }}</p>
                                    <!-- vacancy no -->
                                    <h5 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.vacancy_no')</h5>
                                    <div class="pl-1 mb-1">
                                        {{$jobCircularDetail->vacancy_no ?? 0 }}
                                    </div>
                                    <!-- grade -->
                                    <h5 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.grade')</h5>
                                    <div class="pl-1 mb-1">
                                        {!! $jobCircularDetail->salary_grade ?? 0 !!}
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- job nature -->
                                    <h5 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.max_age')</h5>
                                    <p class="pl-1">{{ $jobCircularDetail->max_age ?? 0 }}</p>
                                    <!-- job ref number -->
                                    <h5 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.max_age_divisional')</h5>
                                    <div class="pl-1 mb-1">
                                        {!! $jobCircularDetail->max_age_divisional_employee ?? 0!!}
                                    </div>
                                    <h5 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.max_age_quota')</h5>
                                    <div class="pl-1 mb-1">
                                        {!! $jobCircularDetail->max_age_quota_employee ?? 0 !!}
                                    </div>
                                </div>
                            </div>

                            <!-- other details -->
                            <h4 class="text-bold-700 pt-1 pl-1">@lang('hrm::circular.other_requirement_title')</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('hrm::circular.educational_requirement')</th>
                                    <th>@lang('hrm::circular.experience_requirement')</th>
                                    <th>@lang('hrm::circular.job_responsibility')</th>
                                    <th>@lang('hrm::circular.common_qualification')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {!! $jobCircularDetail->educational_requirement ?? trans('labels.not_found') !!}
                                    </td>
                                    <td>
                                        {!! $jobCircularDetail->experience_requirement ?? trans('labels.not_found') !!}
                                    </td>
                                    <td>
                                        {!! $jobCircularDetail->job_responsibility ?? trans('labels.not_found') !!}
                                    </td>
                                    <td>
                                        {!! $jobCircularDetail->common_qualification ?? trans('labels.not_found') !!}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
