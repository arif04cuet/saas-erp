<h6>{{ trans('hrm::appraisal.chart') }}</h6>
<fieldset>
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
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.1')</b></td>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.training')</b></td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[training]', 5, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[training]', 4, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[training]', 3, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[training]', 2, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[training]', 1, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.2')</b></td>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.academic_research')</b></td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[academic_research]', 5, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[academic_research]', 4, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[academic_research]', 3, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[academic_research]', 2, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[academic_research]', 1, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.3')</b></td>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('hrm::appraisal.technical_research')</b></td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[technical_research]', 5, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[technical_research]', 4, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[technical_research]', 3, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[technical_research]', 2, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_academic_skills[technical_research]', 1, false, ['class' => '']) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
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
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[duty]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[duty]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[duty]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[duty]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;">
                                <div><b>@lang('labels.digits.2')</b></div>
                            </td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.reliability_of_performance')</b>
                                    </div>
                                    <div class="row .radio-error" data-radio-field-name="reporter_officer_reliability_awareness[performance]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[performance]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[performance]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[performance]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[performance]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.3')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div><b>@lang('hrm::appraisal.awareness_law_order_security')</b></div>
                                    <div class="row .radio-error" data-radio-field-name="reporter_officer_reliability_awareness[law_order_security]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[law_order_security]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[law_order_security]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[law_order_security]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_reliability_awareness[law_order_security]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
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
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[official_work]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[official_work]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[official_work]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[official_work]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.2')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.happy_trend_in_outdoor_work')</b>
                                    </div>
                                    <div class="row .radio-error" data-radio-field-name="reporter_officer_qualifications_trends[outdoor_work]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[outdoor_work]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[outdoor_work]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[outdoor_work]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[outdoor_work]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.3')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.moral')</b>
                                    </div>
                                    <div class="row .radio-error" data-radio-field-name="reporter_officer_qualifications_trends[moral]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[moral]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[moral]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[moral]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[moral]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.4')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.intellectual')</b>
                                    </div>
                                    <div class="row .radio-error" data-radio-field-name="reporter_officer_qualifications_trends[intellectual]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[intellectual]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[intellectual]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[intellectual]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[intellectual]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; text-align: left;"><b>@lang('labels.digits.5')</b></td>
                            <td style="vertical-align: middle; text-align: left;">
                                <div>
                                    <div>
                                        <b>@lang('hrm::appraisal.medical')</b>
                                    </div>
                                        <div class="row .radio-error" data-radio-field-name="reporter_officer_qualifications_trends[objective]"></div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[objective]', 5, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[objective]', 4, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[objective]', 3, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('reporter_officer_qualifications_trends[objective]', 2, false, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                        </tr>
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
                            {{ Form::radio('reporter_officer_eligibility_for_promotion', 5, false, ['class' => 'required reporter_officer_eligibility_for_promotion', 'data-msg-required' => trans('labels.This field is required')]) }}
                            <label for="reporter_officer_eligibility_for_promotion"><b style="font-size: 16px;"> @lang('hrm::appraisal.eligible_for_promotion_immediately')</b></label>
                        </fieldset>
                        <fieldset>
                            {{ Form::radio('reporter_officer_eligibility_for_promotion', 4, false, ['class' => 'required reporter_officer_eligibility_for_promotion', 'data-msg-required' => trans('labels.This field is required')]) }}
                            <label for="reporter_officer_eligibility_for_promotion"><b style="font-size: 16px;">@lang('hrm::appraisal.eligible_for_promotion')</b></label>
                        </fieldset>
                        <fieldset>
                            {{ Form::radio('reporter_officer_eligibility_for_promotion', 3, false, ['class' => 'required reporter_officer_eligibility_for_promotion', 'data-msg-required' => trans('labels.This field is required')]) }}
                            <label for="reporter_officer_eligibility_for_promotion"><b style="font-size: 16px;">@lang('hrm::appraisal.recently_promoted')</b></label>
                        </fieldset>
                        <fieldset>
                            {{ Form::radio('reporter_officer_eligibility_for_promotion', 2, false, ['class' => 'required reporter_officer_eligibility_for_promotion', 'data-msg-required' => trans('labels.This field is required')]) }}
                            <label for="reporter_officer_eligibility_for_promotion"><b style="font-size: 16px;">@lang('hrm::appraisal.not_eligible_for_promotion')</b></label>
                        </fieldset>
                        <fieldset>
                            {{ Form::radio('reporter_officer_eligibility_for_promotion', 1, false, ['class' => 'required reporter_officer_eligibility_for_promotion', 'data-msg-required' => trans('labels.This field is required')]) }}
                            <label for="reporter_officer_eligibility_for_promotion"><b style="font-size: 16px;">@lang('hrm::appraisal.not_yet_qualified')</b></label>
                        </fieldset>
                    </div>
                </div>
                <div class="row .radio-error" data-radio-field-name="reporter_officer_eligibility_for_promotion"></div>
                <div class="help-block"></div>
                @if ($errors->has('reporter_officer_eligibility_for_promotion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('reporter_officer_eligibility_for_promotion') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</fieldset>




