<h6>{{ trans('hrm::appraisal.employee_graph') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12 employee_graph">
            <section id="user-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="form-body">
                                        <h5 class="form-section">@lang('hrm::appraisal.employee_graph')</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-label required">{{trans('hrm::appraisal.general_idea_about_employee')}}</label>
                                                    {{ Form::text('reporter_officer_general_idea', null, ['class'=> 'form-control required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('reporter_officer_general_idea'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('reporter_officer_general_idea') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">{{trans('hrm::appraisal.suitable_for_work')}}</label>
                                                    {{ Form::textarea('reporter_officer_suitable_for_work', null, ['class' => 'form-control']) }}
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('reporter_officer_suitable_for_work'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('reporter_officer_suitable_for_work') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-label required">{{trans('hrm::appraisal.eligibility_for_promotion')}}</label>
                                                    <div class="row skin skin-flat">
                                                        <div class="col-md-12 col-sm-12">
                                                            <fieldset>
                                                                {{ Form::radio('reporter_officer_eligibility_for_promotion', 5, null, ['class' => 'reporter_officer_eligibility required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                                                <label for="unique_general">@lang('hrm::appraisal.eligible_for_promotion_immediately')</label>
                                                            </fieldset>
                                                            <fieldset>
                                                                {{ Form::radio('reporter_officer_eligibility_for_promotion', 4, null, ['class' => 'reporter_officer_eligibility required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                                                <label for="excellent">@lang('hrm::appraisal.eligible_for_promotion')</label>
                                                            </fieldset>
                                                            <fieldset>
                                                                {{ Form::radio('reporter_officer_eligibility_for_promotion', 3, null, ['class' => 'reporter_officer_eligibility required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                                                <label for="good">@lang('hrm::appraisal.recently_promoted')</label>
                                                            </fieldset>
                                                            <fieldset>
                                                                {{ Form::radio('reporter_officer_eligibility_for_promotion', 2, null, ['class' => 'rreporter_officer_eligibility equired', 'data-msg-required' => trans('labels.This field is required')]) }}
                                                                <label for="aggregate">@lang('hrm::appraisal.not_eligible_for_promotion')</label>
                                                            </fieldset>
                                                            <fieldset>
                                                                {{ Form::radio('reporter_officer_eligibility_for_promotion', 1, null, ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) }}
                                                                <label for="unsatisfactory">@lang('hrm::appraisal.not_yet_qualified')</label>
                                                            </fieldset>
                                                            <div class="row radio-error"></div>
                                                        </div>
                                                    </div>
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('reporter_officer_eligibility_for_promotion'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('reporter_officer_eligibility_for_promotion') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">@lang('hrm::appraisal.special_note')</label>
                                                    {{ Form::textarea('reporter_officer_special_note', null, ['class' => 'form-control']) }}
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('reporter_officer_special_note'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('reporter_officer_special_note') }}</strong>
                                                </span>
                                                    @endif
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