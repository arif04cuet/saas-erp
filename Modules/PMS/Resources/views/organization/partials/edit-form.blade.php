<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <div class="row">
        <!-- organization name -->
        <div class="col-6">
            <div class="form-group">
                {{ Form::label('name', trans('pms::project_proposal.organization_name'),['class' => 'required']) }}

                {{ Form::text('name', old('name') ? old('name') : $organization->name ,  [
                    'id'=> 'name',
                    'class' => 'addOrganizationInput form-control required',
                    'placeholder' => 'Enter organization name',
                    'data-msg-required' => trans('labels.This field is required'),
                    'data-msg-maxlength' => trans('labels.max_length_validation_message',['length'=>100]),
                    'data-rule-maxlength' => 11,
                ]) }}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('name'))
                    <div class="help-block text-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
        </div>


        <!-- Email -->
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group {{ $errors->has('email') ? ' error' : '' }}">
                    {{ Form::label('email', trans('labels.email_address')) }}
                    <br/>
                    {{ Form::text('email',  old('email') ? old('email') : $organization->email, [
                        'id'=> 'email',
                        'class' => ' form-control',
                        'maxlength' => 100,
                        'placeholder' => 'Enter organization email'
                    ]) }}
                    <div class="help-block"></div>
                    <!-- error message -->
                    @if ($errors->has('email'))
                        <div class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Mobile -->
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    {{ Form::label('mobile', trans('labels.mobile')) }}
                    <br/>
                    {{ Form::text('mobile',  old('mobile') ? old('mobile') : $organization->mobile, [
                        'id'=> 'mobile',
                        'class' => ' form-control',
                        'placeholder' => 'Enter organization mobile',
                        'data-rule-maxlength' => 11,
                        'data-rule-minlength' => 7,
                        'data-msg-maxlength'=> trans('labels.At most 11 characters'),
                        'data-msg-minlength'=> trans('labels.At least 7 characters')
                    ]) }}
                    <div class="help-block"></div>
                    <!-- error message -->
                    @if ($errors->has('mobile'))
                        <div class="help-block text-danger">
                            {{ $errors->first('mobile') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    {{ Form::label('address', trans('labels.address')) }}
                    <br/>
                    {{ Form::text('address',  old('address') ? old('address') : $organization->address, [
                        'id'=>'address',
                        'class' => ' form-control',
                        'maxlength' => 100,
                        'placeholder' => 'Enter organization address'
                    ]) }}
                    <div class="help-block"></div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Division -->
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    <label for="division_id"
                           class="required">@lang('division.division')</label>
                    {{ Form::select('division_id', $divisions ?? [], $organization->division_id ? $organization->division_id : null, [
                        'class' => 'form-control select2 required',
                        'placeholder' => trans('labels.select'),
                        'data-msg-required' => trans('labels.This field is required'),
                    ]) }}
                    <div class="help-block"></div>
                    <!-- error message -->
                    @if ($errors->has('division_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('division_id') }}
                        </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- District -->
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    <div class="form-group ">
                        <label for="district_id"
                               class="required">@lang('district.district')</label>
                        {{ Form::select('district_id', $districts ?? [], $organization->district_id ? $organization->district_id : null, [
                            'class' => 'form-control select2 required',
                            'placeholder' => trans('labels.select'),
                            'data-msg-required' => trans('labels.This field is required'),
                        ]) }}
                        @if ($errors->has('district_id'))
                            <div class="help-block text-danger">
                                {{ $errors->first('district_id') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <!-- Thana -->
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    <label for="thana_id" class="required">@lang('thana.thana')</label>
                    {{ Form::select('thana_id', $thanas ?? [], $organization->thana_id ? $organization->thana_id : null, [
                        'class' => 'form-control select2 required',
                        'placeholder' => trans('labels.select'),
                         'data-msg-required' => trans('labels.This field is required'),
                    ]) }}
                    @if ($errors->has('thana_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('thana_id') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Union -->
        <div class="col-md-6 ">
            <div class="form-group ">
                <div class="form-group ">
                    <label for="union_id" class="required">@lang('union.union')</label>
                    {{ Form::select('union_id', $unions ?? [], $organization->union_id ? $organization->union_id : null, [
                        'class' => 'form-control select2 required',
                        'placeholder' => trans('labels.select'),
                        'data-msg-required' => trans('labels.This field is required'),
                    ]) }}
                    @if ($errors->has('union_id'))
                        <div class="help-block text-danger">
                            {{ $errors->first('union_id') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.update')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{ route('pms-organizations.show',[$project,$organization]) }}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
