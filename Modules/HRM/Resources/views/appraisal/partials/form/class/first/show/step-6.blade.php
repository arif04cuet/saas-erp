<h6>{{ trans('hrm::appraisal.chart') }}</h6>
<fieldset>
    @php
        $metadata = $appraisal->metadata
            ->mapWithKeys(function($meta) {
                return [$meta->key => $meta->value];
            });

        if(isset($metadata['reporter_officer_academic_skills'])) {
            $reporterOfficerAcademicSkills = json_decode($metadata['reporter_officer_academic_skills'], true);

        }else {
            $reporterOfficerAcademicSkills = [];
        }

        if(isset($metadata['reporter_officer_reliability_awareness'])) {
            $reporterOfficerReliabilityAwareness = json_decode($metadata['reporter_officer_reliability_awareness'], true);

        }else {
            $reporterOfficerReliabilityAwareness = [];
        }

        if(isset($metadata['reporter_officer_qualifications_trends'])) {
            $reporterOfficerQualificationsTrends = json_decode($metadata['reporter_officer_qualifications_trends'], true);

        }else {
            $reporterOfficerQualificationsTrends = [];
        }

    @endphp
    <h3>@lang('hrm::appraisal.academic_skills')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col">@lang('hrm::appraisal.excellent')</th>
                            <th scope="col">@lang('hrm::appraisal.good')</th>
                            <th scope="col">@lang('hrm::appraisal.aggregate')</th>
                            <th scope="col">@lang('hrm::appraisal.unsatisfactory')</th>
                            <th scope="col">@lang('hrm::appraisal.not_yet_displayed')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($reporterOfficerAcademicSkills['training']))
                            <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.1')</b></td>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.training')</b></td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['training'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['training'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['training'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['training'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['training'] == 1)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if(isset($reporterOfficerAcademicSkills['academic_research']))
                            <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.2')</b></td>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.academic_research')</b></td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['academic_research'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['academic_research'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['academic_research'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['academic_research'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['academic_research'] == 1)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if(isset($reporterOfficerAcademicSkills['technical_research']))
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.3')</b></td>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.technical_research')</b></td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['technical_research'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['technical_research'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['technical_research'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['technical_research'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerAcademicSkills['technical_research'] == 1)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.1')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>@endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.reliability_awareness')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col">@lang('hrm::appraisal.excellent')</th>
                            <th scope="col">@lang('hrm::appraisal.good')</th>
                            <th scope="col">@lang('hrm::appraisal.aggregate')</th>
                            <th scope="col">@lang('hrm::appraisal.unsatisfactory')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($reporterOfficerReliabilityAwareness['duty']))
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.1')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div><b>@lang('hrm::appraisal.duty')</b></div>
                                    <div class="row .radio-error" data-radio-field-name="reporter_officer_reliability_awareness[duty]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['duty'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['duty'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['duty'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['duty'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>@endif
                        @if(isset($reporterOfficerReliabilityAwareness['performance']))
                        <tr>
                            <td style="vertical-align: middle; text-align: left;">
                                <div><b>@lang('labels.digits.2')</b></div>
                            </td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.reliability_of_performance')</b>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['performance'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['performance'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['performance'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['performance'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>@endif
                        @if(isset($reporterOfficerReliabilityAwareness['law_order_security']))
                            <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.3')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div><b>@lang('hrm::appraisal.awareness_law_order_security')</b></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['law_order_security'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['law_order_security'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    @if($reporterOfficerReliabilityAwareness['law_order_security'] == 3)
                                        <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                    @else
                                        <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                    @endif
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerReliabilityAwareness['law_order_security'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.special_comments_regarding_qualifications_and_trends')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col">@lang('labels.serial')</th>
                            <th scope="col">@lang('labels.details')</th>
                            <th scope="col">@lang('hrm::appraisal.excellent')</th>
                            <th scope="col">@lang('hrm::appraisal.good')</th>
                            <th scope="col">@lang('hrm::appraisal.aggregate')</th>
                            <th scope="col">@lang('hrm::appraisal.unsatisfactory')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($reporterOfficerQualificationsTrends['official_work']))
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.1')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.qualification_for_official_work')</b>
                                    </div>
                                    <div class="row .radio-error" data-radio-field-name="reporter_officer_qualifications_trends[official_work]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['official_work'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['official_work'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['official_work'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['official_work'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>@endif
                        @if(isset($reporterOfficerQualificationsTrends['outdoor_work']))
                            <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.2')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.happy_trend_in_outdoor_work')</b>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['outdoor_work'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['outdoor_work'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['outdoor_work'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['outdoor_work'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            </tr>
                        @endif
                        @if(isset($reporterOfficerQualificationsTrends['moral']))
                            <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.3')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.moral')</b>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['moral'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['moral'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['moral'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['moral'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if(isset($reporterOfficerQualificationsTrends['intellectual']))
                            <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.4')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.intellectual')</b>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['intellectual'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['intellectual'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['intellectual'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['intellectual'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if(isset($reporterOfficerQualificationsTrends['objective']))
                            <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.5')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.medical')</b>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['objective'] == 5)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.5')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['objective'] == 4)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.4')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['objective'] == 3)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.3')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        @if($reporterOfficerQualificationsTrends['objective'] == 2)
                                            <h5 style="color: green; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @else
                                            <h5 style="color: grey; font-size: 25px;"><b>@lang('labels.digits.2')</b></h5>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.eligibility_for_promotion')</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="row skin skin-flat">
                    <div class="col-md-12 col-sm-12">
                        <fieldset>
                            @if($metadata['reporter_officer_eligibility_for_promotion'] == 5)
                                <h4 style="color: green;"><b> @lang('hrm::appraisal.eligible_for_promotion_immediately')</b></h4>
                            @else
                                <h4 style="color: grey;"><b> @lang('hrm::appraisal.eligible_for_promotion_immediately')</b></h4>
                            @endif
                        </fieldset>
                        <fieldset>
                            @if($metadata['reporter_officer_eligibility_for_promotion'] == 4)
                                <h4 style="color: green;"><b> @lang('hrm::appraisal.eligible_for_promotion')</b></h4>
                            @else
                                <h4 style="color: grey;"><b> @lang('hrm::appraisal.eligible_for_promotion')</b></h4>
                            @endif
                        </fieldset>
                        <fieldset>
                            @if($metadata['reporter_officer_eligibility_for_promotion'] == 3)
                                <h4 style="color: green;"><b> @lang('hrm::appraisal.recently_promoted')</b></h4>
                            @else
                                <h4 style="color: grey;"><b> @lang('hrm::appraisal.recently_promoted')</b></h4>
                            @endif
                        </fieldset>
                        <fieldset>
                            @if($metadata['reporter_officer_eligibility_for_promotion'] == 2)
                                <h4 style="color: green;"><b> @lang('hrm::appraisal.not_eligible_for_promotion')</b></h4>
                            @else
                                <h4 style="color: grey;"><b> @lang('hrm::appraisal.not_eligible_for_promotion')</b></h4>
                            @endif
                        </fieldset>
                        <fieldset>
                            @if($metadata['reporter_officer_eligibility_for_promotion'] == 1)
                                <h4 style="color: green;"><b> @lang('hrm::appraisal.not_yet_qualified')</b></h4>
                            @else
                                <h4 style="color: grey;"><b> @lang('hrm::appraisal.not_yet_qualified')</b></h4>
                            @endif
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>




