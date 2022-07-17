<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>

<!-- Designation and Overall Limits -->
<div class="col">
    <div class="row">
        <div class="col-6">
        {!! Form::label('designation_id', trans('vms::trip.limit.form_elements.designation_id'), ['class' => 'form-label required']) !!}
        {{
               Form::select('designation_id', $designations, old('designation_id') ?? null, [
                    'class' => 'form-control required select2',
                    'data-msg-required'=> __('labels.This field is required'),
               ])
        }}
        <!-- error message -->
            @if ($errors->has('designation_id'))
                <div class="help-block text-danger">
                    {{ $errors->first('designation_id') }}
                </div>
            @endif
        </div>

        <div class="col-6">
            <div class="form-group">
                {!! Form::label('limit', trans('vms::trip.limit.form_elements.limit'), ['class' => 'form-label required']) !!}
                {!! Form::number('limit', old('limit') ?? null,
                    [
                        'class' => "form-control required",
                        "placeholder" => trans('vms::trip.limit.form_elements.limit'),
                        'min'=>0,
                        'max'=>999999999,
                        'data-rule-number'=>true,
                        'data-msg-number'=> trans('labels.Please enter a valid number'),
                        'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                        'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                        'data-msg-required' => trans('labels.This field is required'),
                   ])
                 !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('limit'))
                    <div class="help-block text-danger">
                        {{ $errors->first('limit') }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>


<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.save')
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('vms.trip.limit.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

