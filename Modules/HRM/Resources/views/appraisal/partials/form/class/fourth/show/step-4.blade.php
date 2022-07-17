<h6>{{ trans('hrm::appraisal.reporter_info') }}</h6>
<fieldset>
    <h3>@lang('hrm::appraisal.reporter_designation') : {{ $appraisal->reporter->designation->name }}</h3>
    <h3>@lang('hrm::appraisal.reporter_officer_signature_seal')</h3>
    <div class="row">
        @php
            $signature = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "reporter_officer_signature";
                })->first();

            $signature = json_decode($signature->value);
            $seal =  $appraisal->metadata
                ->filter(function($meta) {
                    return $meta->key == "reporter_officer_seal";
                })->first();

            $seal = json_decode($seal->value);

            $reporterOfficerDate = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "reporter_officer_date";
                })->first();

        @endphp
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('hrm::appraisal.signature'):</h5>
                        <img src="{{ '/file/get?filePath=' . $signature->file_path }}" alt="" width="300" height="60">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('hrm::appraisal.seal'):</h5>
                        <img src="{{ '/file/get?filePath=' . $seal->file_path }}" alt="" width="300" height="60">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>@lang('labels.date'):</h5>
                        {!! \Carbon\Carbon::parse($reporterOfficerDate->value)->format('j F, Y') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
@push('page-js')

@endpush

