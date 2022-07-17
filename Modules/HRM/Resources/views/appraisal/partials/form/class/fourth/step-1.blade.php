<h6>{{ trans('hrm::appraisal.time_duration') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">@lang('hrm::appraisal.reporting_period') :</h4>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('hrm::appraisal.start_date')</label>
                                    <div class="input-group">
                                        {{ Form::text('start_date', date('j F, Y'), [
                                            'class' => 'form-control pickadate required' . ($errors->has('start_date') ? ' is-invalid' : ''),
                                            'id' => 'start_date',
                                            'placeholder' => 'Pick start date',
                                            'required' => 'required'
                                        ]) }}
                                        @if ($errors->has('start_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">@lang('hrm::appraisal.end_date')</label>
                                    <div class="input-group">
                                        {{ Form::text('end_date', date('j F, Y'), [
                                            'class' => 'form-control pickadate required' . ($errors->has('end_date') ? ' is-invalid' : ''),
                                            'id' => 'end_date',
                                            'placeholder' => 'Pick start date',
                                            'required' => 'required',
                                            'data-rule-greaterThan' => '#start_date'
                                        ]) }}

                                        @if ($errors->has('end_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('end_date') }}</strong>
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
</fieldset>