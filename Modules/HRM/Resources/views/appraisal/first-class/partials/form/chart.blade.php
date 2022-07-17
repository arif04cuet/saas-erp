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
                            <th scope="col">@lang('labels.remarks')</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>@lang('hrm::appraisal.training')</td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 5) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 4) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 3) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 2) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td class="width-350">
                                    <div class="card-body">
                                        {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>@lang('hrm::appraisal.academic_research')</td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 5) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 4) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 3) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 2) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td class="width-350">
                                    <div class="card-body">
                                        {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>@lang('hrm::appraisal.technical_research')</td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 5) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 4) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 3) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="card-body">
                                        <div class="skin skin-flat">
                                            <fieldset>
                                                {{ Form::radio('academic_skills', 2) }}
                                            </fieldset>
                                        </div>
                                    </div>
                                </td>
                                <td class="width-350">
                                    <div class="card-body">
                                        {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
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
                            <th scope="col">@lang('labels.remarks')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>@lang('hrm::appraisal.duty')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>@lang('hrm::appraisal.reliability_of_performance')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>@lang('hrm::appraisal.awareness_law_order_security')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
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
                            <th scope="col">@lang('labels.remarks')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>@lang('hrm::appraisal.qualification_for_official_work')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>@lang('hrm::appraisal.happy_trend_in_outdoor_work')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>@lang('hrm::appraisal.moral')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>@lang('hrm::appraisal.intellectual')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>@lang('hrm::appraisal.medical')</td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 5) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 4) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 3) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="card-body">
                                    <div class="skin skin-flat">
                                        <fieldset>
                                            {{ Form::radio('academic_skills', 2) }}
                                        </fieldset>
                                    </div>
                                </div>
                            </td>
                            <td class="width-350">
                                <div class="card-body">
                                    {{ Form::text('academic_skills', null, ['class' => ($errors->has('academic_skills')) ? 'form-control is-invalid' : 'form-control']) }}
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
                            <input type="radio" name="input-radio-4" id="input-radio-15">
                            <label for="input-radio-15">@lang('hrm::appraisal.eligible_for_promotion_immediately')</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="input-radio-4" id="input-radio-16">
                            <label for="input-radio-16">@lang('hrm::appraisal.eligible_for_promotion')</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="input-radio-4" id="input-radio-15">
                            <label for="input-radio-15">@lang('hrm::appraisal.recently_promoted')</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="input-radio-4" id="input-radio-16">
                            <label for="input-radio-16">@lang('hrm::appraisal.not_eligible_for_promotion')</label>
                        </fieldset>
                        <fieldset>
                            <input type="radio" name="input-radio-4" id="input-radio-16" checked>
                            <label for="input-radio-16">@lang('hrm::appraisal.not_yet_qualified')</label>
                        </fieldset>
                    </div>
                </div>
                <div class="help-block"></div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</fieldset>




