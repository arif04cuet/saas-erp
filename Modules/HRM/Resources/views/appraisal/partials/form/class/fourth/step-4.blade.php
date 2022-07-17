<h6>{{ trans('hrm::appraisal.reporter_info') }}</h6>
<fieldset>
    <h3>@lang('hrm::appraisal.reporter_designation') : {{ $reporter->designation->name }}</h3>
    <h3>@lang('hrm::appraisal.reporter_officer_signature_seal')</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('hrm::appraisal.signature'):</label>
                        {!! Form::file('reporter_officer_signature',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('reporter_officer_signature'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('signature') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('hrm::appraisal.seal'):</label>
                        {!! Form::file('reporter_officer_seal',[
                                        'class' => 'form-control required',
                                        'accept' => '.png, .jpg, .jpeg',
                                        'data-msg-required' => trans('labels.Picture field is required')
                                        ]) !!}
                        <div class="help-block"></div>
                        @if ($errors->has('reporter_officer_seal'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('seal') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">@lang('labels.date'):</label>
                        {{ Form::text('reporter_officer_date', date('j F, Y'), [
                            'id' => 'date',
                            'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''),
                            'placeholder' => 'Pick start date',
                            'readOnly'
                        ]) }}
                        <div class="help-block"></div>
                        @if ($errors->has('reporter_officer_date'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('reporter_officer_date') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>@lang('hrm::appraisal.signer_officer')</h3>
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
                <label class="required">@lang('labels.name')</label>
                {{ Form::select('signer_id', $availableSigners, null,
                    [
                        'placeholder' => trans('labels.select'),
                        'class' => 'form-control required'.($errors->has('signer_id') ? ' is-invalid' : ''),
                        'id' => 'signer',
                        'data-msg-required' => trans('labels.This field is required'),
                    ])
                }}

                @if ($errors->has('signer_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('signer_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</fieldset>
{{ Form::hidden('reporter_id', $reporter->id) }}
{{ Form::hidden('initiator_id', $reporter->id) }}
{{ Form::hidden('type', $class) }}
@push('page-js')
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                readURL(this);
            });
        })
    </script>

    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#sealPreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#sealPreview').hide();
                        $('#sealPreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#sealUpload").change(function () {
                readURL(this);
            });
        })
    </script>

@endpush

