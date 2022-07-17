<h6>{{ trans('tms::training.personal_info') }}</h6>
<fieldset>
    <div class="row">
        <div class="col-md-6">
            <!-- Name -->
            <div class="row">
                @include('tms::public.training-registration.partials.lang.name_field')
                {!! Form::hidden('training_id', $training->id) !!}
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required">@lang('tms::training.gender')</label>
                    <div class="skin skin-flat">
                        {!! Form::radio('trainee_gender', 'male', old('trainee_gender'), ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}
                        <label>@lang('tms::training.male')</label>
                    </div>
                    <div class="skin skin-flat">
                        {!! Form::radio('trainee_gender', 'female', old('trainee_gender'), ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}
                        <label>@lang('tms::training.female')</label>
                    </div>
                    <div class="row col-md-12 radio-error">
                        @if ($errors->has('trainee_gender'))
                            <span
                                class="small text-danger"><strong>{{ $errors->first('trainee_gender') }}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="dateOfBirth" class="required">@lang('tms::training.dob') :</label>
                    {{ Form::text('dob', null, ['class' => 'form-control required', 'id'=>'dateOfBirth', 'data-msg-required' => trans('labels.This field is required'), 'placeholder' => 'dd/mm/yyyy']) }}
                    @if ($errors->has('dob'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress1" class="required">@lang('tms::training.email') :</label>
                        {!! Form::email('email', old('email'), ['class' => 'form-control required' . ($errors->has('email') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'john@example.com', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At least 50 characters'), 'data-msg-email' => trans('labels.Please enter a valid email address'), 'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',]) !!}

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phoneNumber1" class="required">@lang('tms::training.mobile') :</label>
                        {!! Form::text(
                            'mobile',
                            old('mobile') ? old('mobile') : (session('mobile') ? convert_number(session('mobile')) : null),
                            [
                                'class' => 'form-control required' . ($errors->has('mobile') ? ' is-invalid' : ''),
                                'data-rule-minlength' => 11,
                                'data-msg-minlength' => trans('labels.mobile_no_validation', ['attribute'=>trans('labels.digits.11')]),
                                'data-rule-maxlength' => 11,
                                'data-msg-maxlength' => trans('labels.mobile_no_validation', ['attribute'=>trans('labels.digits.11')]),
                                'data-rule-regex' => '^([^\xE6-\xEF]|[0-9])+$',
                                'data-msg-number' => trans('labels.Please enter a valid number'),
                                'data-msg-required' => Lang::get('labels.This field is required'),
                                'data-rule-unique-mobile' => 'true',
                                'data-rule-no-white-space' => '^(\s|\S)*(\S)+(\s|\S)*$',
                                'placeholder' => '01XXXXXXXXX',
                                'readOnly' => session('mobile') ? true : false
                            ]
                        )!!}

                        @if ($errors->has('mobile'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress1">@lang('tms::training.phone') :</label>
                        {!! Form::text('phone', old('phone'),[
                                'class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''),
                                'placeholder' => '02XXXXXXX',
                                'data-rule-regex-fax' => config('regex.fax'),
                                'data-rule-maxlength' => 20,
                                'data-msg-maxlength'=>Lang::get('labels.maximum 20 characters')
                            ])
                        !!}

                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phoneNumber1">@lang('tms::training.fax') :</label>
                        {!! Form::text('fax', old('fax'), [
                            'class' => 'form-control' . ($errors->has('fax') ? ' is-invalid' : ''),
                            'placeholder' => 'XXXXXXX',
                            'data-rule-regex-fax' => config('regex.fax'),
                            'data-rule-maxlength' => 20,
                            'data-msg-maxlength'=>Lang::get('labels.maximum 20 characters')
                        ]) !!}

                        @if ($errors->has('fax'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('fax') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @include('tms::public.training-registration.partials.lang.badge_name_field')
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            @lang('tms::training.joining_with_child') (@lang('tms::training.below_3_years')) :
                        </label>
                        <div class="skin skin-flat">
                            {!! Form::checkbox('with_child', 1, old('with_child')) !!}
                            <label>@lang('labels.yes')</label>
                        </div>

                        @if ($errors->has('with_child'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('with_child') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <h1><label class="required">
                        @lang('tms::training.upload_photo')
                        (@lang('tms::trainee.fields.image.maximum') @lang('tms::trainee.fields.image.size')
                        - @lang('tms::trainee.fields.image.3mb'))
                    </label><br>
                </h1>
                <div class="avatar-upload">
                    <div class="avatar-edits">
                        <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" class="form-control"
                               required
                               data-msg-required="{{ trans('labels.Picture field is required') }}"
                               data-rule-image-size="#imageUpload" ,
                        />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview"
                             style="background-image: url({{ asset('/images/default-profile-picture.png') }});">
                        </div>
                    </div>
                    <div id="imageValidationMassage" class="text-danger" style="margin-top: 5px;">
                    </div>
                    <div class="help-block"></div>
                    @if ($errors->has('photo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {{ Form::hidden('training_id', $training->id) }}
        </div>
    </div>
</fieldset>
@push('page-css')
    <style type="text/css">
        #imageValidationMassage > label {
            font-size: 16px;
        }
    </style>
@endpush
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
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                readURL(this);
            });
        })
    </script>

@endpush

