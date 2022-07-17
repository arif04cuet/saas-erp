<h6>
    @if(get_user_designation($appraisal->finisher->user)->short_name == "ADG")
        @lang('hrm::appraisal.adg_final_comment')
    @else
        @lang('hrm::appraisal.dg_final_comment')
    @endif
    @php
        $remarks = $appraisal->metadata->filter(function ($meta) {
            return $meta->key == 'finisher_officer_remarks';
        })->first();
    
        $signature = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "finisher_officer_signature";
                })->first();

        $signature = json_decode($signature->value);

        $seal = $appraisal->metadata
            ->filter(function($meta) {
                return $meta->key == "finisher_officer_seal";
            })->first();

        $seal = json_decode($seal->value);

        $finisherOfficerDate = $appraisal->metadata
            ->filter(function($meta) {
                return $meta->key == "finisher_officer_date";
            })->first();

    @endphp
</h6>
<fieldset>
    <h3>
        @if(get_user_designation($appraisal->finisher->user)->short_name == "DA")
            @lang('hrm::appraisal.da_final_comment')
        @else
            @lang('hrm::appraisal.dg_final_comment')
        @endif
    </h3>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h5>@lang('labels.remarks')</h5>
                {!! $remarks->value ?? '' !!}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <h3>
        @if(get_user_designation($appraisal->finisher->user)->short_name == "DA")
            @lang('hrm::appraisal.da_signature_seal')
        @else
            @lang('hrm::appraisal.dg_signature_seal')
        @endif
    </h3>
    <div class="row">
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
                        {!! \Carbon\Carbon::parse($finisherOfficerDate->value)->format('j F, Y') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
{{ Form::hidden('state', $appraisal->state) }}