<div class="card-body">
    @if ($page == "create")
    {!! Form::open(['route' => 'contacts.store', 'class' => 'form contact-form']) !!}
    @else
    {!! Form::open(['route' => ['contacts.update', $contact->id ], 'class' => 'form contact-form']) !!}
    @method('PUT')
    @endif
    <div id="invoice-items-details">
        <h4 class="form-section"><i class="ft-grid"></i>@lang('hrm::contact.type.title') @lang('labels.form')</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('first_name',  trans('hrm::contact.first_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('first_name', $page == "edit" ? $contact->first_name : null, 
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::contact.first_name'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                     ])!!}
                    <!-- error message -->
                    @if ($errors->has('first_name'))
                        <div class="help-block text-danger">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('last_name', trans('hrm::contact.last_name'), ['class' => 'form-label required']) !!}
                    {!! Form::text('last_name', $page == "edit" ? $contact->last_name : null,
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::contact.last_name'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('last_name'))
                    <div class="help-block text-danger">
                        {{ $errors->first('last_name') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('organaization', trans('hrm::contact.organaization'), ['class' => 'form-label required']) !!}
                    {!! Form::text('organaization', $page == "edit" ? $contact->organaization : null,
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::contact.organaization'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('organaization'))
                    <div class="help-block text-danger">
                        {{ $errors->first('organaization') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('designation', trans('hrm::contact.job_title'), ['class' => 'form-label required']) !!}
                    {!! Form::text('designation', $page == "edit" ? $contact->designation : null,
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::contact.job_title'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('designation'))
                    <div class="help-block text-danger">
                        {{ $errors->first('designation') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('type', trans('hrm::contact.type.title'), ['class' => 'form-label required']) !!}
                    {!! Form::select('contact_type_id', $types, $page == "edit" ? $contact->contact_type_id : null,
                    [
                        'class' => "form-control required select2",
                        'placeholder' => trans('labels.select'),
                        'data-msg-required'=> __('labels.This field is required'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('type'))
                    <div class="help-block text-danger">
                        {{ $errors->first('type') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('address', trans('hrm::contact.address'), ['class' => 'form-label required']) !!}
                    {!! Form::text('address', $page == "edit" ? $contact->address : null,
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::contact.address'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('address'))
                    <div class="help-block text-danger">
                        {{ $errors->first('address') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_one', trans('hrm::contact.mobile_one'), ['class' => 'form-label required']) !!}
                    {!! Form::number('mobile_one', $page == "edit" ? $contact->mobile_one : null,
                    [
                        'class' => "form-control required",
                        'placeholder' => trans('hrm::contact.mobile_one'),
                        'data-msg-required'=> __('labels.This field is required'),
                        'data-rule-number' => 'true',
                        'data-msg-number' => trans('labels.Please enter a valid number'),
                        'data-rule-maxlength' =>'11',
                        'data-msg-maxlength'=> trans('validation.maxlength', ['attribute'=> __('labels.mobile'), 'max'=>11])
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('mobile_one'))
                    <div class="help-block text-danger">
                        {{ $errors->first('mobile_one') }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('mobile_two', trans('hrm::contact.mobile_two'), ['class' => 'form-label']) !!}
                    {!! Form::number('mobile_two', $page == "edit" ? $contact->mobile_two : null,
                    [
                        'class' => "form-control",
                        'placeholder' => trans('hrm::contact.mobile_two'),
                        'data-rule-number' => 'true',
                        'data-msg-number' => trans('labels.Please enter a valid number'),
                        'data-rule-maxlength' =>'11',
                        'data-msg-maxlength'=> trans('validation.maxlength', ['attribute'=> __('labels.mobile'), 'max'=>11])
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('mobile_two'))
                    <div class="help-block text-danger">
                        {{ $errors->first('mobile_two') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('email', trans('hrm::contact.email'), ['class' => 'form-label']) !!}
                    {!! Form::email('email', $page == "edit" ? $contact->email : null,
                    [
                        'class' => "form-control",
                        'placeholder' => trans('hrm::contact.address'),
                        'data-rule-maxlength' => 255,
                        'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('email'))
                    <div class="help-block text-danger">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('website', trans('hrm::contact.website'), ['class' => 'form-label']) !!}
                    {!! Form::text('website', $page == "edit" ? $contact->website : null,
                    [
                    'class' => "form-control",
                    'placeholder' => trans('hrm::contact.website'),
                    'data-rule-maxlength' => 255,
                    'data-msg-maxlength'=> trans('labels.At most 255 characters'),
                    ])!!}
                    <!-- error message -->
                    @if ($errors->has('website'))
                    <div class="help-block text-danger">
                        {{ $errors->first('website') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button type="submit" class="btn {{ $page == "edit" ? 'btn-primary' : 'btn-success'}}">
            <i class="ft-check-square"></i>
            @lang('labels.save')
        </button>
        <a class="btn btn-warning mr-1" role="button" href="{{route('contact-types.index')}}">
            <i class="ft-x"></i> @lang('labels.cancel')
        </a>
    </div>
    {!! Form::close() !!}
</div>