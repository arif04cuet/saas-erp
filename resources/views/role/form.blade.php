<div class="container">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form"><i class="ft-tag black"></i> @lang('user-management.create_role_title')</h4>
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
                        {!! Form::open(['url'=>route('roles.store'), 'class' => 'form', 'novalidate']) !!}
                        <div class="form-body">
                            {{-- <h4 class="form-section"><i class="ft-user"></i> {{trans('user-management.role_form_title')}}</h4> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label required">{{trans('user-management.role_name')}}</label>
    
                                        <input name="name" type="text" id="name" value="{{ old('name') }}" class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                               placeholder="eg. ROLE_ADMIN" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('user-management.role_name')])}}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="label" class="form-label required">{{trans('user-management.role_description')}}</label>
                                        <input name="label" type="text" value="{{ old('label') }}" id="label" class="form-control form-control-sm {{ $errors->has('name') ? 'is-invalid' : '' }}" required data-validation-required-message="{{trans('validation.required', ['attribute' => trans('user-management.role_description')])}}">
                                        @if ($errors->has('label'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('label') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @include('role.permissions',['permissions'=>$permissions,'modules'=>$modules,'role'=>$role])
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="master btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{trans('labels.save')}}
                                </button>
                                <a class="master btn btn-warning mr-1" role="button" href="{{route('roles.index')}}">
                                    <i class="ft-x"></i> {{trans('labels.cancel')}}
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>
