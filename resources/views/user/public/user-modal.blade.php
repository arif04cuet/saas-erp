<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{trans('user-management.create_user_title')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                {{--<li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::open(['url' =>  route('public.registration'), 'class' => 'form', 'novalidate']) !!}
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> {{trans('user-management.user_form_title')}}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label required">{{trans('labels.name')}}</label>
                                            <input id="name" type="text"
                                                    class="form-control form-control-sm {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    name="name" value="{{ old('name') }}" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.name')])}}" autofocus>
                                            <div class="help-block"></div>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email"
                                                    class="form-label">{{trans('labels.email_address')}}</label>
                                            <input id="email" type="email"
                                                    class="form-control form-control-sm {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile"
                                                    class="form-label required">{{trans('labels.mobile')}}</label>
                                            <input id="mobile" type="text"
                                                    class="form-control form-control-sm {{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                                    name="mobile" value="{{ old('mobile') }}" placeholder="01xxxxxxxxx" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.mobile')])}}">
                                            <div class="help-block"></div>
                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username"
                                                    class="form-label required">{{trans('labels.username')}}</label>
                                            <input id="username" type="text"
                                                    class="form-control form-control-sm {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                                    name="username" value="{{ old('username') }}" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.username')])}}">
                                            <div class="help-block"></div>
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password"
                                                    class="form-label required">{{trans('labels.password')}}</label>
                                            <input id="password" type="password"
                                                    class="form-control form-control-sm {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="password" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.password')])}}">
                                            <div class="help-block"></div>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password-confirm"
                                                    class="form-label required">{{trans('labels.confirm_password')}}</label>
        
                                            <input id="password-confirm" type="password" class="form-control form-control-sm"
                                                    name="password_confirmation" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('labels.confirm_password')])}}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Profile Photo Upload -->
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6><label class="required">
                                                    @lang('labels.upload_photo')
                                                </label><br>
                                            </h6>
                                            <div class="profile-photo avatar-upload">
                                                <div class="avatar-edits">
                                                    <input type='file' name="photo" id="profileImageUpload" accept=".png, .jpg, .jpeg"
                                                        class="form-control form-control-sm validateImageFile" required
                                                        data-msg-required="{{ trans('labels.Picture field is required') }}"
                                                        data-rule-image-size="#profileImageUpload" />
                                                    <label for="profileImageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="profileImagePreview"
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
                                    </div>
                                </div> --}}
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" style="padding:9px">
                                        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                    </button>
                                    <button type="button" class="btn btn-warning mr-1 text-white" data-dismiss="modal">{{trans('labels.cancel')}}</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>