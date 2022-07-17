<h6>@lang('hrm::appraisal.work_description')</h6>
<fieldset>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="reporting_officer_other_important_responsibilities" class="required">@lang('hrm::appraisal.according_to_reporting_officer')</label>
                {{ Form::textarea('reporting_officer_other_important_responsibilities', null, ['class' => 'form-control required', 'placeholder' => '']) }}
                <div class="help-block"></div>
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



