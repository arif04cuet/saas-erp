<h6>{{ trans('hrm::appraisal.employee_graph') }}</h6>
<fieldset>
    @php
        $reporterOfficerGeneralIdea = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "reporter_officer_general_idea";
                })->first();

        $reporterOfficerEligibilityForPromotion = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "reporter_officer_eligibility_for_promotion";
                })->first();

        $reporterOfficerSuitableForWork = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "reporter_officer_suitable_for_work";
                })->first();

        $reporterOfficerSpecialNote = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "reporter_officer_special_note";
                })->first();
    @endphp
    <div class="row">
        <div class="col-md-12 employee_graph">
            <section id="user-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="form-body">
                                        <h3 class="form-section">@lang('hrm::appraisal.employee_graph')</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h3>{{trans('hrm::appraisal.general_idea_about_employee')}}</h3>
                                                    <p>{{ $reporterOfficerGeneralIdea->value ?? "" }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h3>{{trans('hrm::appraisal.suitable_for_work')}}</h3>
                                                    <p>{!! $reporterOfficerSuitableForWork->value ?? "" !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h3>{{trans('hrm::appraisal.eligibility_for_promotion')}}</h3>
                                                    <div class="row skin skin-flat">
                                                        <div class="col-md-12 col-sm-12">
                                                            @if($reporterOfficerEligibilityForPromotion->value == '5')
                                                                <h4 style="color: green;">@lang('hrm::appraisal.eligible_for_promotion_immediately')</h4>
                                                            @else
                                                                <h4 style="color: grey;">@lang('hrm::appraisal.eligible_for_promotion_immediately')</h4>
                                                            @endif
                                                            @if($reporterOfficerEligibilityForPromotion->value == '4')
                                                                <h4 style="color: green;">@lang('hrm::appraisal.eligible_for_promotion')</h4>
                                                            @else
                                                                <h4 style="color: grey;">@lang('hrm::appraisal.eligible_for_promotion')</h4>
                                                            @endif
                                                            @if($reporterOfficerEligibilityForPromotion->value == '3')
                                                                <h4 style="color: green;">@lang('hrm::appraisal.recently_promoted')</h4>
                                                            @else
                                                                <h4 style="color: grey;">@lang('hrm::appraisal.recently_promoted')</h4>
                                                            @endif
                                                            @if($reporterOfficerEligibilityForPromotion->value == '2')
                                                                <h4 style="color: green;">@lang('hrm::appraisal.not_eligible_for_promotion')</h4>
                                                            @else
                                                                <h4 style="color: grey;">@lang('hrm::appraisal.not_eligible_for_promotion')</h4>
                                                            @endif
                                                            @if($reporterOfficerEligibilityForPromotion->value == "1")
                                                                <h4 style="color: green;">@lang('hrm::appraisal.not_yet_qualified')</h4>
                                                            @else
                                                                <h4 style="color: grey;">@lang('hrm::appraisal.not_yet_qualified')</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h3>@lang('hrm::appraisal.special_note')</h3>
                                                    <p>{!! $reporterOfficerSpecialNote->value ?? "" !!}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</fieldset>