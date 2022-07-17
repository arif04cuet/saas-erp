<h6>@lang('hrm::appraisal.work_description')</h6>
@php
    $metadata = $appraisal->metadata
            ->mapWithKeys(function($meta) {
                return [$meta->key => $meta->value];
            });

    if(isset($metadata['reporting_officer_signature'])) {
        $metadata['reporting_officer_signature'] = json_decode($metadata['reporting_officer_signature'], true);
    }

    if(isset($metadata['reporting_officer_seal'])) {
        $metadata['reporting_officer_seal'] = json_decode($metadata['reporting_officer_seal'], true);
    }
@endphp
<fieldset>
    <h3>@lang('hrm::appraisal.other_important_responsibilities')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="from-group">
                <h5>@lang('hrm::appraisal.according_to_reporting_officer')</h5>
                {{ $metadata['reporting_officer_other_important_responsibilities_by_reporting_officer'] ?? null }}
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h5>@lang('hrm::appraisal.according_to_reporter_officer')</h5>
                {{ $metadata['reporting_officer_other_important_responsibilities_by_reporter_officer'] ?? null }}
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