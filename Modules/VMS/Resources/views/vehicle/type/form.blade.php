<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <!-- Title English & Title Bangla-->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('title_english', trans('vms::vehicle.type.form_elements.title_english'),
                        ['class' => 'form-label required'])
                !!}
                {!! Form::text('title_english', old('title_english') ?? null,
                [
                    'class' => "form-control required",
                    "placeholder" => trans('labels.name'),
                    'data-rule-maxlength'=> 500,
                    'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                    'data-msg-required' => trans('labels.This field is required'),
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('title_english'))
                    <div class="help-block text-danger">
                        {{ $errors->first('title_english') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- Title Bangla -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('title_bangla', trans('vms::vehicle.type.form_elements.title_bangla'), ['class' => 'form-label required']) !!}
                {!! Form::text('title_bangla', old('title_bangla') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::vehicle.type.form_elements.title_bangla'),
                        'data-rule-maxlength'=> 500,
                        'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('title_bangla'))
                    <div class="help-block text-danger">
                        {{ $errors->first('title_bangla') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Code -->
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('code', trans('vms::vehicle.type.form_elements.code'), ['class' => 'form-label required']) !!}
                {!! Form::text('code', old('code') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => 'e.g. CAR,MICROBUS ETC',
                        'data-rule-maxlength'=> 500,
                        'data-msg-maxlength'=> trans('labels.max_length_validation_message',['length'=>500]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('code'))
                    <div class="help-block text-danger">
                        {{ $errors->first('code') }}
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
    <a class="btn btn-warning mr-1" role="button" href="{{route('vms.vehicle-types.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

