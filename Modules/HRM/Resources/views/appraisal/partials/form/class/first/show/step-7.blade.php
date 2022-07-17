<h6>@lang('hrm::appraisal.advice')</h6>
<fieldset>
    @php
        $metadata = $appraisal->metadata
            ->mapWithKeys(function($meta) {
                return [$meta->key => $meta->value];
            });

        if(isset($metadata['reporter_officer_signature'])) {
        $metadata['reporter_officer_signature'] = json_decode($metadata['reporter_officer_signature'], true);
        }

        if(isset($metadata['reporter_officer_seal'])) {
            $metadata['reporter_officer_seal'] = json_decode($metadata['reporter_officer_seal'], true);
        }

    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.advice_on_reporting_officer')</h3>
                {{ $metadata['reporter_officer_advice_on_reporting_officer'] ?? null}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.work_should_be_focused_on')</h3>
                {{ $metadata['reporting_officer_work_should_be_focused_on'] ?? null }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.type_of_responsibility_can_be_appropriate')</h3>
                {{ $metadata['reporter_officer_type_of_responsibility_can_be_appropriate'] ?? null }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.kind_of_training_guidance_need')</h3>
                {{ $metadata['reporter_officer_kind_of_training_guidance_need'] ?? null }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.any_other_advice')</h3>
                {{ $metadata['reporter_officer_any_other_advice'] ?? null }}
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.reporter_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('hrm::appraisal.signature'):</h5>
                        <img src="{{ '/file/get?filePath=' . $metadata['reporter_officer_signature']['file_path'] }}" alt="" width="300" height="60">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('hrm::appraisal.seal'):</h5>
                        <img src="{{ '/file/get?filePath=' . $metadata['reporter_officer_seal']['file_path'] }}" alt="" width="300" height="60">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('labels.date'):</h5>
                        {!! \Carbon\Carbon::parse($metadata['reporter_officer_date'])->format('j F, Y') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</fieldset>



