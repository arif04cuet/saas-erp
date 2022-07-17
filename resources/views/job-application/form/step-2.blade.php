<h6>{{ trans('hm::booking-request.step_2') }}</h6>
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/photo-upload.css') }}">
@endpush

<fieldset>
<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('job-application.job_apply_form') (@lang('labels.step')-@lang('labels.digits.2'))</h4>

    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                @foreach($errors->all() as $message)
                    <div class="alert alert-danger">{{$message}}</div>
                @endforeach
            @endif
            <div class="form-group">
                <h4><label class="required">@lang('job-application.upload_photo')</label></h4>
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" @if(empty($employee->photo))
                        required  data-validation-required-message ="{{ trans('job-circular.upload_photo') }}" @endif />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview"
                             style="background-image: url({!! asset('images/default-profile-picture.png') !!});">
                        </div>
                    </div>
                    <div class="help-block"></div>
                    @if ($errors->has('photo'))
                        <div class="help-block red"><strong>{{ $errors->first('photo') }}</strong></div>
                    @endif
                </div>
            </div>
            <br/>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <h4><label class="required">@lang('job-application.upload_signature')</label></h4>
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' name="signature" id="signatureUpload" accept=".png, .jpg, .jpeg" required
                               data-validation-required-message ="{{ trans('job-circular.upload_signature') }}">
                        <label for="signatureUpload"></label>
                    </div>
                    <div class="avatar-preview" style="width: 380px; height: 80px;">
                        <div id="signaturePreview"
                             style="background-image: url({!! asset('images/signature-sample.png') !!});">
                        </div>
                    </div>
                    <div class="help-block"></div>
                    @if ($errors->has('signature'))
                        <div class="help-block red"><strong>{{ $errors->first('signature') }}</strong></div>
                    @endif
                </div>
            </div>
            <br/>
        </div>
        <hr>
        {{ Form::hidden('job_application_id', $jobApplicationId) }}
    </div>
</div>
    <div class="text-info">* {{ trans('job-application.request_before_submit') }}</div>
<input type="hidden" name="step" value="2">
</fieldset>
@push('page-js')
    <script>
        $(document).ready(function () {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e)   {
                        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function readSignURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e)   {
                        $('#signaturePreview').css('background-image', 'url(' + e.target.result + ')');
                        $('#signaturePreview').hide();
                        $('#signaturePreview').fadeIn(650);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                readURL(this);
            });
            $("#signatureUpload").change(function () {
                readSignURL(this);
            });
        });

    </script>

@endpush
