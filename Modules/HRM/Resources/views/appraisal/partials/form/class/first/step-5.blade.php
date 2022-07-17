<h6>@lang('hrm::appraisal.overall_evaluation')</h6>
<fieldset>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.number_obtained_in_100') : <b id="totalPoint-5"></b></h3>
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.overall_evaluation')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('reporter_officer_overall_evaluation', '91-100', false, ['class' => 'required reporter_officer_overall_evaluation', 'id' => 'unique_general_2', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                    <label><b style="font-size: 16px;">@lang('hrm::appraisal.unique_general_2') (@lang('hrm::appraisal.unique_general_key_2'))</b></label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('reporter_officer_overall_evaluation', '76-90', false, ['class' => 'required reporter_officer_overall_evaluation', 'id' => 'excellent_2', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                    <label><b style="font-size: 16px;">@lang('hrm::appraisal.excellent_2') (@lang('hrm::appraisal.excellent_key_2'))</b></label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('reporter_officer_overall_evaluation', '56-75', false, ['class' => 'required reporter_officer_overall_evaluation', 'id' => 'good_2', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                    <label><b style="font-size: 16px">@lang('hrm::appraisal.good_2') (@lang('hrm::appraisal.good_key_2'))</b></label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('reporter_officer_overall_evaluation', '40-55', false, ['class' => 'required reporter_officer_overall_evaluation', 'id' => 'aggregate_2', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                    <label><b style="font-size: 16px">@lang('hrm::appraisal.aggregate_2') (@lang('hrm::appraisal.aggregate_key_2'))</b></label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('reporter_officer_overall_evaluation', '01-39', false, ['class' => 'required reporter_officer_overall_evaluation', 'id' => 'unsatisfactory_2', 'data-msg-required' => trans('labels.This field is required')]) !!}
                                    <label><b style="font-size: 16px;">@lang('hrm::appraisal.unsatisfactory_2') (@lang('hrm::appraisal.unsatisfactory_key_2'))</b></label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row radio-error"></div>
                    @if ($errors->has('reporter_officer_overall_evaluation'))
                        <div class="small danger">
                            <strong>{{ $errors->first('reporter_officer_overall_evaluation') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.suitable_logic_title')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reporter_officer_suitable_logic">@lang('hrm::appraisal.suitable_logic')</label>
                {{ Form::textarea('reporter_officer_suitable_logic', null, [
                    'class' => 'form-control', 'placeholder' => '',
                    'data-rule-overall-evaluation' => 'reporter_officer_overall_evaluation',
                    'data-msg-overall-evaluation' => trans('labels.This field is required')
                    ]) }}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
</fieldset>



