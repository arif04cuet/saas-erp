<h6>{{ trans('hrm::appraisal.time_duration') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-center">@lang('hrm::appraisal.reporting_period') :</h4>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div class="form-group">
                                    <h3 class="required">@lang('hrm::appraisal.start_date')</h3>
                                    <h3 class="text-center">{{ \Carbon\Carbon::parse($appraisal->start_date)->format('F j, Y') }}</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <h3 class="required">@lang('hrm::appraisal.end_date')</h3>
                                    <h3 class="text-center">{{ \Carbon\Carbon::parse($appraisal->end_date)->format('F j, Y') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>