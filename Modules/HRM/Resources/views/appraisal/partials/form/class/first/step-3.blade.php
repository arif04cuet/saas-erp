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
    @if($appraisal->status == "verified")
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="reporting_officer_other_important_responsibilities_by_reporting_officer">@lang('hrm::appraisal.according_to_reporting_officer')</label>
                    {{ Form::textarea('reporting_officer_other_important_responsibilities_by_reporting_officer', null, ['class' => 'form-control', 'placeholder' => '', 'data-msg-required' => trans('labels.This field is required')]) }}
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="from-group">
                    <h5>@lang('hrm::appraisal.according_to_reporting_officer')</h5>
                    {{ $metadata['reporting_officer_other_important_responsibilities_by_reporting_officer'] ?? null }}
                </div>
            </div>
        </div>
        <br>
    @endif
    @if($appraisal->status == "initialized")
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="reporting_officer_other_important_responsibilities_by_reporter_officer">@lang('hrm::appraisal.according_to_reporter_officer')</label>
                    {{ Form::textarea('reporting_officer_other_important_responsibilities_by_reporter_officer', null, ['class' => 'form-control', 'placeholder' => '', 'data-msg-required' => trans('labels.This field is required')]) }}
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    @endif
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
    @if($appraisal->status == "verified")
        <h3>@lang('hrm::appraisal.reporter_officer')</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required">@lang('hrm::appraisal.department')</label>
                    {{ Form::select('department_id', $departments, null,
                        [
                            'placeholder' => trans('labels.select'),
                            'class' => 'form-control required'.($errors->has('department_id') ? ' is-invalid' : ''),
                            'id' => 'department_id',
                            'data-msg-required' => trans('labels.This field is required'),
                        ])
                    }}

                    @if ($errors->has('department_id'))
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('department_id') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="required">@lang('hrm::appraisal.reporter_officer')</label>
                    {{ Form::select('reporter_id',$reporters, null,
                        [
                            'placeholder' => trans('labels.select'),
                            'class' => 'form-control required'.($errors->has('reporter_id') ? ' is-invalid' : ''),
                            'id' => 'reporter',
                            'data-msg-required' => trans('labels.This field is required'),
                        ])
                    }}

                    @if ($errors->has('reporter_id'))
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('reporter_id') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <hr>
    @endif
</fieldset>




