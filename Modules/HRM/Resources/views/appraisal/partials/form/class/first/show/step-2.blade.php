<h6>@lang('hrm::appraisal.health_exam_report')</h6>
<fieldset>
    @php
        $metadata = $appraisal->metadata
            ->mapWithKeys(function($meta) {
                return [$meta->key => $meta->value];
            });

        if(isset($metadata['health_officer_signature'])) {
            $metadata['health_officer_signature'] = json_decode($metadata['health_officer_signature'], true);
        }

        if(isset($metadata['health_officer_seal'])) {
            $metadata['health_officer_seal'] = json_decode($metadata['health_officer_seal'], true);
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>@lang('hrm::appraisal.name_of_reporting_officer')</td>
                    <td>{{ $appraisal->reportingEmployee->first_name }} {{ $appraisal->reportingEmployee->last_name }}</td>
                </tr>
                <tr>
                    <td>@lang('labels.designation')</td>
                    <td>{{ $appraisal->reportingEmployee->designation->name ?? null }}</td>
                </tr>
                <tr>
                    <td>@lang('hrm::appraisal.age')</td>
                    @if($appraisal->reportingEmployee->employeePersonalInfo)
                        @if($appraisal->reportingEmployee->employeePersonalInfo->date_of_birth)
                            <td>{{ \Illuminate\Support\Carbon::parse($appraisal->reportingEmployee->employeePersonalInfo->date_of_birth)->age }} @lang('hrm::appraisal.years')</td>
                        @else
                            <td>0 @lang('hrm::appraisal.years')</td>
                        @endif
                    @else
                        <td>0 @lang('hrm::appraisal.years')</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h4 >@lang('hrm::appraisal.height') (@lang('hrm::appraisal.cm'))</h4>
                {{ $metadata['reporting_officer_height'] ?? null }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.weight') (@lang('hrm::appraisal.kg'))</h4>
                {{ $metadata['reporting_officer_weight'] ?? null }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.blood_group')</h4>
                {{ $metadata['reporting_officer_blood_group'] ?? null }}
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.blood_pressure')</h4>
                {{ $metadata['reporting_officer_blood_pressure'] ?? null}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.eye_vision_power')</h4>
                {{ $metadata['reporting_officer_eye_vision_power'] ?? null }}
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.x_ray_report')</h4>
                {{ $metadata['reporting_officer_x_ray_report'] ?? null }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.ecg_report')</h4>
                {{ $metadata['reporting_officer_ecg_report'] ?? null }}
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.medical_class_category')</h4>
                {{ $metadata['reporting_officer_medical_class_category'] ?? null }}
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h4>@lang('hrm::appraisal.health_impairment')/@lang('hrm::appraisal.nature_of_disability') (@lang('hrm::appraisal.in_short'))</h4>
                {{ $metadata['reporting_officer_health_impairment'] ?? null }}
            </div>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.health_officer')</h3>
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $appraisal->medicalReporter->first_name . " " . $appraisal->medicalReporter->last_name }} ({{ $appraisal->medicalReporter->designation ? $appraisal->medicalReporter->designation->name : '' }})</h4>
        </div>
    </div>
    <hr>
    <h3>@lang('hrm::appraisal.medical_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h5>@lang('hrm::appraisal.signature'):</h5>
                <img src="{{ '/file/get?filePath=' . $metadata['health_officer_signature']['file_path'] }}" alt="" width="300" height="60">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>@lang('hrm::appraisal.seal'):</h5>
                <img src="{{ '/file/get?filePath=' . $metadata['health_officer_signature']['file_path'] }}" alt="" width="300" height="60">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <h5>@lang('labels.date'):</h5>
                {!! \Carbon\Carbon::parse($metadata['health_officer_date'])->format('j F, Y') !!}
            </div>
        </div>
    </div>
    <hr>
</fieldset>
