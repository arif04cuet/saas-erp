<h6>@lang('hrm::appraisal.signer_officer_comments')</h6>
<fieldset>
    @php
        $commentOnReportingOfficerEvaluation = $appraisal->metadata->filter(function ($meta) {
            return $meta->key == 'signer_comment_on_reporting_officer_evaluation';
        })->first();
        $reasonAndActualEvaluation = $appraisal->metadata->filter(function ($meta) {
            return $meta->key == 'signer_reason_and_actual_evaluation';
        })->first();
        $signerEvaluationValue = $appraisal->metadata->filter(function ($meta) {
            return $meta->key == 'signer_evaluation_value';
        })->first();
        $signerSpecialComment = $appraisal->metadata->filter(function ($meta) {
            return $meta->key == 'signer_special_comment';
        })->first();

        $signature = $appraisal->metadata
                ->filter(function ($meta) {
                    return $meta->key == "signer_officer_signature";
                })->first();

        $signature = json_decode($signature->value);

        $seal = $appraisal->metadata
            ->filter(function($meta) {
                return $meta->key == "signer_officer_seal";
            })->first();

        $seal = json_decode($seal->value);

        $signerOfficerDate = $appraisal->metadata
            ->filter(function($meta) {
                return $meta->key == "signer_officer_date";
            })->first();
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.comment_on_reporting_officer_evaluation')</h3>
                <p>{!! $commentOnReportingOfficerEvaluation->value ?? "" !!}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.reason_and_actual_evaluation')</h3>
                <p>{!! $reasonAndActualEvaluation->value ?? "" !!}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.signer_evaluation_value')</h3>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row skin skin-flat">
                            <div class="col-md-12 col-sm-12">
                                @if($signerEvaluationValue->value == '86-100')
                                    <h4 style="color: green;">@lang('hrm::appraisal.unique_general') (@lang('hrm::appraisal.unique_general_key'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.unique_general') (@lang('hrm::appraisal.unique_general_key'))</h4>
                                @endif
                                @if($signerEvaluationValue->value == '71-85')
                                    <h4 style="color: green;">@lang('hrm::appraisal.excellent') (@lang('hrm::appraisal.excellent_key'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.excellent') (@lang('hrm::appraisal.excellent_key'))</h4>
                                @endif
                                @if($signerEvaluationValue->value == '56-70')
                                    <h4 style="color: green;">@lang('hrm::appraisal.good') (@lang('hrm::appraisal.good_key'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.good') (@lang('hrm::appraisal.good_key'))</h4>
                                @endif
                                @if($signerEvaluationValue->value == '36-55')
                                    <h4 style="color: green;">@lang('hrm::appraisal.aggregate') (@lang('hrm::appraisal.aggregate_key'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.aggregate') (@lang('hrm::appraisal.aggregate_key'))</h4>
                                @endif
                                @if($signerEvaluationValue->value == "01-35")
                                    <h4 style="color: green;">@lang('hrm::appraisal.unsatisfactory') (@lang('hrm::appraisal.unsatisfactory_key'))</h4>
                                @else
                                    <h4 style="color: grey;">@lang('hrm::appraisal.unsatisfactory') (@lang('hrm::appraisal.unsatisfactory_key'))</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h3>@lang('hrm::appraisal.special_comment')</h3>
                {!! $signerSpecialComment->value ?? "" !!}
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.signer_officer_signature_seal')</h3>
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
                        {!! \Carbon\Carbon::parse($signerOfficerDate->value)->format('j F, Y') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>