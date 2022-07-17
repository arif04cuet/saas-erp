<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">

    <!-- Title-->
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('title', trans('labels.title'), ['class' => 'form-label']) !!}
                {{
                       Form::text('title', old('title') ?? null, [
                            'class' => 'form-control required',
                            'data-msg-required'=> __('labels.This field is required'),
                       ])
                }}
            </div>
            <!-- error message -->
            @if ($errors->has('title'))
                <div class="help-block text-danger">
                    {{ $errors->first('title') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Per Km and Per Hour Taka -->
    <div class="row">
        <!-- Per Km -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('per_km_taka', trans('vms::trip.setting.form_elements.per_km_taka'), ['class' => 'form-label required']) !!}
                {!! Form::number('per_km_taka', old('per_km_taka') ?? null,
                [
                    'class' => "form-control required",
                     'min'=>0,
                     'max'=>999999999,
                     'data-rule-number'=>true,
                     'data-msg-number'=> trans('labels.Please enter a valid number'),
                     'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                     'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                     'data-msg-required'=> __('labels.This field is required')
                ]) !!}
                <div class="help-block"></div>
                <!-- error message -->
                @if ($errors->has('per_km_taka'))
                    <div class="help-block text-danger">
                        {{ $errors->first('per_km_taka') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Per Hour -->
        <div class="col-6">
            <div class="form-group">
                {!! Form::label('per_hour_taka', trans('vms::trip.setting.form_elements.per_hour_taka'), ['class' => 'form-label required']) !!}
                {!! Form::number('per_hour_taka', old('per_hour_taka') ?? null,
                    [
                        'class' => "form-control required",
                        'min'=>0,
                         'max'=>999999999,
                         'data-rule-number'=>true,
                         'data-msg-number'=> trans('labels.Please enter a valid number'),
                         'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),
                         'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),
                         'data-msg-required'=> __('labels.This field is required')
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

{{--    <!-- Oil and Gas Price-->--}}
{{--    <div class="row">--}}

{{--        <!-- Oil price -->--}}
{{--        <div class="col-6">--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::label('oil_price', trans('vms::trip.setting.form_elements.oil_price'), ['class' => 'form-label required']) !!}--}}
{{--                {!! Form::number('oil_price', old('oil_price') ?? null,--}}
{{--                [--}}
{{--                    'class' => "form-control required",--}}
{{--                    'min'=>0,--}}
{{--                     'max'=>999999999,--}}
{{--                     'data-rule-number'=>true,--}}
{{--                     'data-msg-number'=> trans('labels.Please enter a valid number'),--}}
{{--                     'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),--}}
{{--                     'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),--}}
{{--                     'data-msg-required'=> __('labels.This field is required')--}}
{{--                ]) !!}--}}
{{--                <div class="help-block"></div>--}}
{{--                <!-- error message -->--}}
{{--                @if ($errors->has('oil_price'))--}}
{{--                    <div class="help-block text-danger">--}}
{{--                        {{ $errors->first('oil_price') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Gas price -->--}}
{{--        <div class="col-6">--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::label('gas_price', trans('vms::trip.setting.form_elements.gas_price'), ['class' => 'form-label required']) !!}--}}
{{--                {!! Form::number('gas_price', old('gas_price') ?? null,--}}
{{--                    [--}}
{{--                        'class' => "form-control required",--}}
{{--                         'min'=>0,--}}
{{--                         'max'=>999999999,--}}
{{--                         'data-rule-number'=>true,--}}
{{--                         'data-msg-number'=> trans('labels.Please enter a valid number'),--}}
{{--                         'data-msg-max'=> __('labels.max_validate_equal_or_less',['max'=>999999999]),--}}
{{--                         'data-msg-min'=> __('labels.min_validate_equal_or_greater',['min'=>0]),--}}
{{--                         'data-msg-required'=> __('labels.This field is required')--}}
{{--                   ])--}}
{{--                 !!}--}}
{{--                <div class="help-block"></div>--}}
{{--                <!-- error message -->--}}
{{--                @if ($errors->has('gas_price'))--}}
{{--                    <div class="help-block text-danger">--}}
{{--                        {{ $errors->first('gas_price') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}
    <!-- checkboxes -->
    <div class="row">

        <!-- Status -->
        <div class="col-6">
            <div class="form-group">
                <div class="skin skin-flat">
                    <fieldset>
                        {!! Form::label('status', trans('labels.active'), ['class' => 'form-label']) !!}
                        {!! Form::checkbox('status',1,old('status') ?? 1)!!}
                    </fieldset>
                </div>

            </div>
        </div>

        <!-- Is Exceed Setting -->
        <div class="col-6">
            <div class="form-group">
                <div class="skin skin-flat">
                    <fieldset>
                        {!! Form::label('is_exceed_setting', trans('vms::trip.setting.form_elements.is_exceed_setting'), ['class' => 'form-label']) !!}
                        {!! Form::checkbox('is_exceed_setting',1,old('is_exceed_setting') ?? 0)!!}
                    </fieldset>
                </div>

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
    <a class="btn btn-warning mr-1" role="button" href="{{route('vms.trip.setting.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>



