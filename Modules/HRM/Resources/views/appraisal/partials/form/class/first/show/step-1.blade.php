<h6>@lang('hrm::appraisal.bio_data')</h6>
@php
    $metadata = $appraisal->metadata
            ->mapWithKeys(function($meta) {
                return [$meta->key => $meta->value];
            });

    if(isset($metadata['reporting_officer_educational_qualifications'])) {
        $metadata['reporting_officer_educational_qualifications'] = json_decode($metadata['reporting_officer_educational_qualifications'], true);
    }

    if(isset($metadata['reporting_officer_educational_qualifications'])) {
        $metadata['reporting_officer_publications_qualification'] = json_decode($metadata['reporting_officer_publications_qualification'], true);
    }

    if(isset($metadata['reporting_officer_conducting_responsibilities'])) {
        $metadata['reporting_officer_conducting_responsibilities'] = json_decode($metadata['reporting_officer_conducting_responsibilities'], true);
    }

    if(isset($metadata['reporting_officer_signature'])) {
        $metadata['reporting_officer_signature'] = json_decode($metadata['reporting_officer_signature'], true);
    }

    if(isset($metadata['reporting_officer_seal'])) {
        $metadata['reporting_officer_seal'] = json_decode($metadata['reporting_officer_seal'], true);
    }
@endphp
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>@lang('labels.name')</td>
                    <td>{{ $appraisal->reportingEmployee->first_name }} {{ $appraisal->reportingEmployee->last_name }}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.fathers_name')</td>
                    <td>{{ $appraisal->reportingEmployee->employeePersonalInfo->father_name ?? trans('labels.not_available') }}</td>
                </tr>
                <tr>
                    <td>@lang('labels.designation')</td>
                    <td>{{ $appraisal->reportingEmployee->designation->name ?? trans('labels.not_available')}}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.date_of_birth')</td>
                    @if($appraisal->reportingEmployee->employeePersonalInfo)
                        @if($appraisal->reportingEmployee->employeePersonalInfo->date_of_birth)
                                <td>{{ date('jS F Y', strtotime($appraisal->reportingEmployee->employeePersonalInfo->date_of_birth)) }}</td>
                        @else
                            <td>@lang('labels.not_available')</td>
                        @endif
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.job_joining_date')</td>
                    @if($appraisal->reportingEmployee->employeePersonalInfo)
                        @if($appraisal->reportingEmployee->employeePersonalInfo->job_joining_date)
                            <td>{{ date('jS F Y', strtotime($appraisal->reportingEmployee->employeePersonalInfo->job_joining_date)) }}</td>
                        @else
                            <td>@lang('labels.not_available')</td>
                        @endif
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.current_position_joining_date')</td>
                    @if($appraisal->reportingEmployee->employeePersonalInfo)
                        @if($appraisal->reportingEmployee->employeePersonalInfo->current_position_joining_date)
                            <td>{{ date('jS F Y', strtotime($appraisal->reportingEmployee->employeePersonalInfo->current_position_joining_date)) }}</td>
                        @else
                            <td>@lang('labels.not_available')</td>
                        @endif
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.pay_scale')</td>
                    @if($appraisal->reportingEmployee->employeePersonalInfo)
                        <td>{{ $appraisal->reportingEmployee->employeePersonalInfo->salary_scale }} </td>
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.current_base_salary')</td>
                    @if($appraisal->reportingEmployee->employeePersonalInfo)
                        <td>{{$appraisal->reportingEmployee->employeePersonalInfo->total_salary ?? ''}} @lang('labels.bdt')</td>
                    @else
                        <td>@lang('labels.not_available')</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <h3 class="">@lang('hrm::appraisal.job_duration_under_reporter_officer')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>@lang('hrm::appraisal.start_date')</h5>
                            <h3>{{ \Carbon\Carbon::parse($appraisal->start_date)->format('j F, Y') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>@lang('hrm::appraisal.end_date')</h5>
                            <h3>{{ \Carbon\Carbon::parse($appraisal->end_date)->format('j F, Y') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.educational_qualification')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;">@lang('labels.serial')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.academic_degree')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.academic_department')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.passing_year')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.1'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.1.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][1]['department'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][1]['passing_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.2'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.2.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][2]['department'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][2]['passing_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.3'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.3.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][3]['department'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][3]['passing_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.4'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.4.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][4]['department'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][4]['passing_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.5'))</b></th>
                        <th style="vertical-align: middle; text-align: center;"><b>@lang('hrm::appraisal.educational_qualifications.5.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][5]['department'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_educational_qualifications'][5]['passing_year'] ?? null }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.medium_of_graduate_postgraduate')</h3>
    <div class="row">
        <div class="col-6">
            <h5>@lang('hrm::appraisal.medium_of_graduate_postgraduate')</h5>
            <p>{{ $metadata['reporting_officer_medium_of_graduate_postgraduate'] }}</p>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.significant_training') (@lang('hrm::appraisal.during_full_employment'))</h3>
    <h4><b>@lang('hrm::appraisal.significant_trainings.1.serial')) @lang('hrm::appraisal.significant_trainings.1.title')</b></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.course_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.organization_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.country')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.duration') (@lang('hrm::appraisal.weekly'))</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.training_year')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($metadata['reporting_officer_significant_trainings_local']))
                            @if(count(json_decode($metadata['reporting_officer_significant_trainings_local']), true))
                                @foreach(json_decode($metadata['reporting_officer_significant_trainings_local'], true) as $data)
                                    <tr>
                                        <td style="vertical-align: middle; text-align: center;">
                                            {{ $data['course'] }}
                                        </td>
                                        <td style="vertical-align: middle; text-align: center;">
                                            {{ $data['organization'] }}
                                        </td>
                                        <td style="vertical-align: middle; text-align: center;">
                                            {{ $data['country'] }}
                                        </td>
                                        <td style="vertical-align: middle; text-align: center;">
                                            {{ $data['duration'] }}
                                        </td>
                                        <td style="vertical-align: middle; text-align: center;">
                                            {{ $data['year'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h4><b>@lang('hrm::appraisal.significant_trainings.2.serial')) @lang('hrm::appraisal.significant_trainings.2.title')</b></h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.course_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.organization_name')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.country')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.duration') (@lang('hrm::appraisal.weekly'))</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.training_year')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($metadata['reporting_officer_significant_trainings_international']))
                        @if(count(json_decode($metadata['reporting_officer_significant_trainings_international']), true))
                            @foreach(json_decode($metadata['reporting_officer_significant_trainings_international'], true) as $data)
                                <tr>
                                    <td style="vertical-align: middle; text-align: center;">
                                        {{ $data['course'] }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        {{ $data['organization'] }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        {{ $data['country'] }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        {{ $data['duration'] }}
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;">
                                        {{ $data['year'] }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.publications_info')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('labels.serial')</th>
                        <th>@lang('hrm::appraisal.type_of_publication')</th>
                        <th>@lang('hrm::appraisal.publication_information.total')</th>
                        <th>@lang('hrm::appraisal.publication_information.total_this_year')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.1'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.1.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][1]['total'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][1]['total_this_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.2'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.2.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][2]['total'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][2]['total_this_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.3'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.3.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][3]['total'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][3]['total_this_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.4'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.4.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][4]['total'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][4]['total_this_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.counter.5'))</b></th>
                        <th style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.publication_information.publications.5.title')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][5]['total'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification'][5]['total_this_year'] ?? null }}
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: left;" colspan="2"><b>@lang('labels.total')</b></th>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification']['grand']['total'] ?? null }}
                        </td>
                        <td style="vertical-align: middle; text-align: center; padding: 0;">
                            {{ $metadata['reporting_officer_publications_qualification']['grand']['total_this_year'] ?? null }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.perform_research_duties_while_considering')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.1.title')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.2.title')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.3.title')</th>
                        <th style="vertical-align: middle; text-align: center;">@lang('hrm::appraisal.conducting_responsibilities.4.title')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="1" style="vertical-align: middle; text-align: center; padding: 0; width: 25%;">
                            {{ $metadata['reporting_officer_conducting_responsibilities']['training'] ?? null }}
                        </td>
                        <td colspan="1" style="vertical-align: middle; text-align: center; padding: 0; width: 25%;">
                            {{ $metadata['reporting_officer_conducting_responsibilities']['project'] ?? null }}
                        </td>
                        <td colspan="1" style="vertical-align: middle; text-align: center; padding: 0; width: 25%;">
                            {{ $metadata['reporting_officer_conducting_responsibilities']['research'] ?? null }}
                        </td>
                        <td colspan="1" style="vertical-align: middle; text-align: center; padding: 0; width: 25%;">
                            {{ $metadata['reporting_officer_conducting_responsibilities']['administrative'] ?? null }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <h3>@lang('hrm::appraisal.marital_status')</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            @if($metadata['reporting_officer_marital_status'] == 'married')
                                <h4 style="color: green;"><b>@lang('hrm::appraisal.married')</b></h4>
                            @else
                                <h4 style="color: grey;"><b>@lang('hrm::appraisal.married')</b></h4>
                            @endif
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            @if($metadata['reporting_officer_marital_status'] == 'unmarried')
                                <h4 style="color: green;"><b>@lang('hrm::appraisal.unmarried')</b></h4>
                            @else
                                <h4 style="color: grey;"><b>@lang('hrm::appraisal.unmarried')</b></h4>
                            @endif
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            @if($metadata['reporting_officer_marital_status'] == 'widower')
                                <h4 style="color: green;"><b>@lang('hrm::appraisal.widower')</b></h4>
                            @else
                                <h4 style="color: grey;"><b>@lang('hrm::appraisal.widower')</b></h4>
                            @endif
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="skin skin-flat">
                        <fieldset>
                            @if($metadata['reporting_officer_marital_status'] == 'widow')
                                <h4 style="color: green;"><b>@lang('hrm::appraisal.widow')</b></h4>
                            @else
                                <h4 style="color: grey;"><b>@lang('hrm::appraisal.widow')</b></h4>
                            @endif
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.no_of_current_children')</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                @if($metadata['reporting_officer_number_of_children'] == '1')
                                    <h4 style="color: green;"><b>@lang('hrm::appraisal.one_children')</b></h4>
                                @else
                                    <h4 style="color: grey;"><b>@lang('hrm::appraisal.one_children')</b></h4>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                @if($metadata['reporting_officer_number_of_children'] == '2')
                                    <h4 style="color: green;"><b>@lang('hrm::appraisal.two_children')</b></h4>
                                @else
                                    <h4 style="color: grey;"><b>@lang('hrm::appraisal.two_children')</b></h4>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                @if($metadata['reporting_officer_number_of_children'] == '3')
                                    <h4 style="color: green;"><b>@lang('hrm::appraisal.more_than_two_children')</b></h4>
                                @else
                                    <h4 style="color: grey;"><b>@lang('hrm::appraisal.more_than_two_children')</b></h4>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="skin skin-flat">
                            <fieldset>
                                @if($metadata['reporting_officer_number_of_children'] == '0')
                                    <h4 style="color: green;"><b>@lang('hrm::appraisal.childless')</b></h4>
                                @else
                                    <h4 style="color: grey;"><b>@lang('hrm::appraisal.childless')</b></h4>
                                @endif
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <h3>@lang('hrm::appraisal.reporting_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5 >@lang('hrm::appraisal.signature'):</h5>
                        <img src="{{ '/file/get?filePath=' . $metadata['reporting_officer_signature']['file_path'] }}" alt="" width="300" height="60">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('hrm::appraisal.seal'):</h5>
                        <img src="{{ '/file/get?filePath=' . $metadata['reporting_officer_signature']['file_path'] }}" alt="" width="300" height="60">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('labels.date'):</h5>
                        {!! \Carbon\Carbon::parse($metadata['reporting_officer_date'])->format('j F, Y') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</fieldset>


