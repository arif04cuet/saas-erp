<h6>@lang('hrm::appraisal.employee') @lang('hrm::appraisal.selection')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group text-center">
                        <h3>@lang('hrm::appraisal.employee')</h3>
                        <h3>{{ $appraisal->reportingEmployee->first_name . ' ' . $appraisal->reportingEmployee->last_name }}</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group text-center">
                        <h3>@lang('labels.designation')</h3>
                        <h3>{{ get_user_designation($appraisal->reportingEmployee->user)->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>

