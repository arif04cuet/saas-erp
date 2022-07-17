<h6>{{ trans('hm::booking-request.step_2') }}</h6>
<fieldset>
    <h4 class="form-section"><i class="la  la-building-o"></i>{{ trans('hm::booking-request.personal_information') }}
    </h4>
    <div class="row">
        <!-- Start of .col-md-6 -->
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="required">{{ trans('hm::booking-request.first_name') }}</label>
                    {!! Form::text('first_name', $page == 'create' ? old('first_name') : $roomBooking->requester->first_name, ['class' => 'form-control form-control-sm required' . ($errors->has('first_name') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'John', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters')]) !!}

                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label>{{ trans('hm::booking-request.middle_name') }}</label>
                    {!! Form::text('middle_name', $page == 'create' ? old('middle_name') : $roomBooking->requester->middle_name, ['class' => 'form-control form-control-sm' . ($errors->has('middle_name') ? ' is-invalid' : ''), 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters')]) !!}

                    @if ($errors->has('middle_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('middle_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label class="required">{{ trans('hm::booking-request.last_name') }}</label>
                    {!! Form::text('last_name', $page == 'create' ? old('last_name') : $roomBooking->requester->last_name, ['class' => 'form-control form-control-sm required' . ($errors->has('last_name') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'Doe', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At most 50 characters')]) !!}

                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="required">{{ trans('hm::booking-request.contact') }}</label>
                    {!! Form::text('contact', $page == 'create' ? old('contact') : $roomBooking->requester->contact,
                    [
                        'id' => 'primary-contact-contact-input',
                        'class' => 'form-control form-control-sm required' . ($errors->has('contact') ? ' is-invalid' : ''),
                        'data-msg-required' => trans('labels.This field is required'),
                        'placeholder' => '11 digit number',
                        'data-rule-minlength' => 11,
                        'data-msg-minlength'=> trans('labels.At least 11 characters'),
                        'data-rule-maxlength' => 11,
                        'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                        'data-rule-number' => 'true',
                        'data-msg-number' => trans('labels.Please enter a valid number'),
                    ]) !!}

                    @if ($errors->has('contact'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="required">{{ trans('hm::booking-request.address') }}</label>
                    {!! Form::textarea('address', $page == 'create' ? old('address') : $roomBooking->requester->address, ['class' => 'form-control form-control-sm required' . ($errors->has('address') ? ' is-invalid' : ''), 'data-msg-required' => Lang::get('labels.This field is required'), 'placeholder' => 'address', 'cols' => 5, 'rows' => 6, 'data-rule-maxlength' => 2, 'data-msg-maxlength'=>Lang::get('labels.At least 300 characters')]) !!}

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <!-- End of .col-md-6 -->
        <!-- Start of .col-md-6 -->
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="required">{{ trans('hm::booking-request.gender') }}</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                {!! Form::radio('gender', 'male', $page == 'create' ? old('gender') == 'male' : ($roomBooking->requester->gender == 'male'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                <label for="gender">{{ trans('hm::booking-request.male') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                {!! Form::radio('gender', 'female', $page == 'create' ? old('gender') == 'female' : ($roomBooking->requester->gender == 'female'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                <label for="gender">{{ trans('hm::booking-request.female') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="row radio-error"></div>

                    @if ($errors->has('gender'))
                        <div class="row">
                            <div class="col-md-12 radio-error">
                                <span class="small danger"><strong>{{ $errors->first('gender') }}</strong></span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>{{ trans('hm::booking-request.email') }}</label>
                    {!! Form::email('email', $page == 'create' ? old('email') : $roomBooking->requester->email, ['class' => 'form-control form-control-sm' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'john@example.com', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At least 50 characters'), 'data-msg-email' => trans('labels.Please enter a valid email address')]) !!}

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>{{ trans('hm::booking-request.passport_no') }}</label>
                    {!! Form::text('passport_no', $page == 'create' ? old('passport_no') : $roomBooking->requester->passport_no, ['class' => 'form-control form-control-sm' . ($errors->has('passport_no') ? ' is-invalid' : ''), 'placeholder' => 'passport number', 'data-rule-minlength' => 8, 'data-msg-minlength'=>Lang::get('labels.At least 8 characters'), 'data-rule-maxlength' => 20, 'data-msg-maxlength'=>Lang::get('labels.At most 20 characters')]) !!}

                    @if ($errors->has('passport_no'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('passport_no') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>{{ trans('hm::booking-request.nid') }}</label>


                    {!! Form::text('nid', $page == 'create' ? old('nid') : $roomBooking->requester->nid,
                            [
                                'class' => 'form-control form-control-sm' . ($errors->has('nid') ? ' is-invalid' : ''),
                                'placeholder' => 'Nid number',
                                'data-rule-number' => 'true',
                                'data-msg-number' => trans('labels.Please enter a valid number'),
                                'data-rule-nid-validation-count' => '10,13,17',
                                'data-msg-nid-validation-count' => trans('labels.nid_validation_count_error_msg'),
                            ]
                        )
                    !!}

                    @if ($errors->has('nid'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nid') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <!-- End of .col-md-6 -->
    </div>
    <h4 class="form-section"><i class="la  la-building-o"></i>{{ trans('hm::booking-request.occupation_details') }}</h4>
    <div class="row">
        <!-- Start of .col-md-6 -->
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-12">
                    <label>{{ trans('hm::booking-request.organization') }}</label>
                    {!! Form::text('organization', $page == 'create' ? old('organization') : $roomBooking->requester->organization, ['class' => 'form-control form-control-sm' . ($errors->has('organization') ? ' is-invalid' : ''), 'placeholder' => 'Organization name', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At least 50 characters')]) !!}

                    @if ($errors->has('organization'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('organization') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="required">{{ trans('hm::booking-request.organization_type') }}</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('organization_type', 'government', $page == 'create' ? old('organization_type') == 'government' : ($roomBooking->requester->organization_type == 'government_official' || $roomBooking->requester->organization_type == 'government_personal'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>@lang('hm::booking-request.government')</label>
                                </fieldset>
                            </div>
                            <div class="row ml-md-2 organization-purpose-container">
                                <div class="form-group col-md-12">
                                    <label class="required">{{ trans('hm::booking-request.organization_purpose') }}</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="skin skin-flat">
                                                <fieldset>
                                                    {!! Form::radio('organization_purpose', 'official', $page == 'create' ? old('organization_purpose') == 'official' : ($roomBooking->requester->organization_type == 'government_official'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                                    <label>@lang('hm::booking-request.official')</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="skin skin-flat">
                                                <fieldset>
                                                    {!! Form::radio('organization_purpose', 'personal', $page == 'create' ? old('organization_purpose') == 'personal' : ($roomBooking->requester->organization_type == 'government_personal'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                                    <label>@lang('hm::booking-request.personal')</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row ml-md-2 radio-error-organization-purpose"></div>
                                        @if ($errors->has('organization_purpose'))
                                            <div class="small danger">
                                                <strong>{{ $errors->first('organization_purpose') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('organization_type', 'non_government', $page == 'create' ? old('organization_type') == 'non_government' : ($roomBooking->requester->organization_type == 'non_government'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>@lang('hm::booking-request.non_government')</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('organization_type', 'international', $page == 'create' ? old('organization_type') == 'international' : ($roomBooking->requester->organization_type == 'international'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>{{ trans('hm::booking-request.international') }}</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('organization_type', 'bard', $page == 'create' ? old('organization_type') == 'bard' : ($roomBooking->requester->organization_type == 'bard'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>{{ trans('hm::booking-request.bard') }}</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="skin skin-flat">
                                <fieldset>
                                    {!! Form::radio('organization_type', 'others', $page == 'create' ? old('organization_type') == 'others' : ($roomBooking->requester->organization_type == 'others'), ['class' => 'required', 'data-msg-required' => Lang::get('labels.This field is required')]) !!}
                                    <label>{{ trans('hm::booking-request.others') }}</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row radio-error"></div>
                    @if ($errors->has('organization_type'))
                        <div class="small danger">
                            <strong>{{ $errors->first('organization_type') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- End of .col-md-6 -->
        <!-- Start of .col-md-6 -->
        <div class="col-md-6">
            <div class="row">
                <div class="form-group col-md-12">
                    <label>{{ trans('hm::booking-request.designation') }}</label>
                    {!! Form::text('designation', $page == 'create' ? old('designation') : $roomBooking->requester->designation, ['class' => 'form-control form-control-sm' . ($errors->has('designation') ? ' is-invalid' : ''), 'placeholder' => 'Designation', 'data-rule-maxlength' => 50, 'data-msg-maxlength'=>Lang::get('labels.At least 50 characters')]) !!}

                    @if ($errors->has('designation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('designation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>{{ trans('hm::booking-request.address') }}</label>
                    {!! Form::textarea('org_address', $page == 'create' ? old('org_address') : $roomBooking->requester->org_address, ['class' => 'form-control form-control-sm' . ($errors->has('org_address') ? ' is-invalid' : ''), 'cols' => 5, 'rows' => 3, 'placeholder' => 'Organization address', 'data-rule-maxlength' => 300, 'data-msg-maxlength'=>Lang::get('labels.At least 300 characters')]) !!}

                    @if ($errors->has('org_address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('org_address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <!-- End of .col-md-6 -->
    </div>
    <h4 class="form-section"><i class="la  la-building-o"></i>{{ trans('hm::booking-request.documents') }}</h4>
    <div class="row">
        <!-- Start of .col-md-6 -->
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>{{ trans('hm::booking-request.your_photo') }} (@lang('hm::booking-request.maximum') @lang('hm::booking-request.size') - @lang('hm::booking-request.3mb'))</label>
                    {!! Form::file('photo', ['class' => 'form-control form-control-sm' . ($errors->has('photo') ? ' is-invalid' : ''), 'accept' => '.png, .jpg, .jpeg']) !!}

                    @if ($errors->has('photo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </span>
                    @endif
                </div>
                @if($page == 'edit')
                    <div class="col-md-6">
                        <img src="{{ $roomBooking->requester->photo ? url('/file/get?filePath=' . $roomBooking->requester->photo) : ''}}"
                             style="width: 80px;height: 80px;margin-top: 10px;" alt="">
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>{{ trans('hm::booking-request.nid_copy') }} (@lang('hm::booking-request.maximum') @lang('hm::booking-request.size') - @lang('hm::booking-request.3mb'))</label>
                    {!! Form::file('nid_doc', [
                        'class' => 'form-control form-control-sm' . ($errors->has('nid_doc') ? ' is-invalid' : ''),
                        'accept' => '.png, .jpg, .jpeg',
                    ]) !!}

                    @if ($errors->has('nid_doc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nid_doc') }}</strong>
                        </span>
                    @endif
                </div>
                @if($page == 'edit')
                    <div class="col-md-6">
                        <img src="{{ $roomBooking->requester->nid_doc ? url('/file/get?filePath=' . $roomBooking->requester->nid_doc) : ''}}"
                             style="width: 80px; height: 80px; margin-top: 10px" alt="">
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>{{ trans('hm::booking-request.passport_copy') }} (@lang('hm::booking-request.maximum') @lang('hm::booking-request.size') - @lang('hm::booking-request.3mb'))</label>
                    {!! Form::file('passport_doc', ['class' => 'form-control form-control-sm' . ($errors->has('passport_doc') ? ' is-invalid' : ''), 'accept' => '.png, .jpg, .jpeg']) !!}

                    @if ($errors->has('passport_doc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('passport_doc') }}</strong>
                        </span>
                    @endif
                </div>
                @if($page == 'edit')
                    <div class="col-md-6">
                        <img src="{{ $roomBooking->requester->passport_doc ? url('/file/get?filePath=' . $roomBooking->requester->passport_doc) : ''}}"
                             style="width: 80px;height: 80px;margin-top: 10px" alt="">
                    </div>
                @endif
            </div>
        </div>
        <!-- End of .col-md-6 -->
    </div>
</fieldset>
