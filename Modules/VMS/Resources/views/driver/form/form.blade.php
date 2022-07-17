<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- English and Bangla Name -->
    <div class="row">
        <!-- English Name -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('name_english', trans('vms::driver.form_elements.name_english'), ['class' => 'form-label required']) !!}
                {!! Form::text('name_english', old('name_english') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('labels.name'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('name_english'))
                    <div class="help-block text-danger">
                        {{ $errors->first('name_english') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Bangla Name -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('name_bangla', trans('vms::driver.form_elements.name_bangla'), ['class' => 'form-label required']) !!}
                {!! Form::text('name_bangla', old('name_bangla') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::driver.form_elements.name_bangla'),
                        'data-rule-maxlength'=> 500,
                        'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('name_bangla'))
                    <div class="help-block text-danger">
                        {{ $errors->first('name_bangla') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Date  -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('date_of_birth', trans('vms::driver.form_elements.date_of_birth'), ['class' => 'form-label']) !!}
                {{
                       Form::text('date_of_birth', old('date_of_birth') ?? date('Y-m-d'), [
                            'class' => 'form-control required',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('date_of_birth'))
                <div class="help-block text-danger">
                    {{ $errors->first('date_of_birth') }}
                </div>
            @endif
        </div>

        <!-- License Number -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('license_number', trans('vms::driver.form_elements.license_number'), ['class' => 'form-label required']) !!}
                {!! Form::text('license_number', old('license_number') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::driver.form_elements.license_number'),
                        'data-rule-maxlength'=> 25,
                        'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>25]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('license_number'))
                    <div class="help-block text-danger">
                        {{ $errors->first('license_number') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!--  Address -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('address', trans('vms::driver.form_elements.address'),
                    ['class' => 'form-label'])
                !!}
                {!! Form::textarea('address', null,[
                                           'class' => 'form-control',
                                           'rows'=>4,
                                           'data-rule-maxlength'=> 500,
                                           'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                                           'data-msg-required'=> trans('labels.This field is required'),
                ])!!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('address'))
                    <div class="help-block text-danger">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
<!--/General Information -->

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('vms.drivers.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

