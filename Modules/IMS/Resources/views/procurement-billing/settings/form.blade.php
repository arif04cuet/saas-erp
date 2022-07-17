@if($page == 'create')
    {{ Form::open(['route' =>  'procurement-bill-settings.store', 'class' => 'form', 'novalidate']) }}
@else
    {{ Form::open(['route' =>  ['procurement-bill-settings.update', $setting->id], 'class' => 'form', 'novalidate']) }}
    @method('PUT')
@endif

<h4 class="form-section"><i class="la la-building"></i> @lang('ims::procurement.settings.form')</h4>
<div class="row">
    <!-- Title -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('title', __('labels.title'), ['class' => 'form-label required']) !!}
            {!! Form::text('title', $page == 'create' ? old('title') : $setting->title,
            ['class' => "form-control", "required ", "placeholder" => __('labels.name'), 'maxlength' => 255,
            'data-validation-required-message' => Lang::get('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
            @endif
        </div>
    </div>


    <!-- Journal -->
    <div class="col-4">
        <div class="form-group">
            {!! Form::label('journal_id', __('ims::procurement.settings.journal'), ['class' => 'form-label required']) !!}
            {!! Form::select('journal_id', ['' => ''] + $journals, $page == 'create' ? old('journal_id') : $setting->journal_id,
            ['class' => "form-control searchable", "required ",
            'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('journal_id'))
                <div class="help-block text-danger">
                    <strong>{{ $errors->first('journal_id') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Bill Type -->
    <div class="col-2">
        <div class="form-group">
            {!! Form::label('bill_type', __('ims::procurement.settings.bill_type'), ['class' => 'form-label required']) !!}
            {!! Form::select('bill_type', $billTypes,
             $page == 'create' ? old('bill_type') : $setting->bill_type,
             ['class' => "form-control", "required ",
            'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('bill_type'))
                <div class="help-block text-danger">
                    <strong>{{ $errors->first('bill_type') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Vat percentage deprecated here cause it will be provide in  bill form. Passing empty value -->
    {!! Form::hidden('vat_percentage', 0) !!}
{{--    <!-- Vat Percentage -->--}}
{{--    <div class="col-2">--}}
{{--        <div class="form-group">--}}
{{--            {!! Form::label('vat_percentage', __('ims::procurement.settings.vat_rate') . ' (%)', ['class' => 'form-label required']) !!}--}}
{{--            {!! Form::number('vat_percentage', $page == 'create' ? old('vat_percentage') : $setting->vat_percentage,--}}
{{--           ['class' => "form-control", "required ", 'maxlength' => 4, 'data-validation-min-min' => 0,--}}
{{--           'data-validation-min-message'=> __('validation.min.numeric',--}}
{{--           ['attribute' => __('ims::procurement.settings.vat_rate'), 'min' => __('labels.digits.0')]),--}}
{{--           'data-validation-maxlength-message'=> __('labels.At most 4 characters'),--}}
{{--           'data-validation-number-message'=> __('validation.numeric', ['attribute' => __('ims::procurement.settings.vat_rate')]),--}}
{{--           'data-validation-required-message' => __('labels.This field is required')]) !!}--}}
{{--            <div class="help-block"></div>--}}
{{--            @if ($errors->has('vat_percentage'))--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                <strong>{{ $errors->first('vat_percentage') }}</strong>--}}
{{--            </span>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Economy Code for Vat -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('vat_economy_code', __('ims::procurement.settings.vat_economy_code'), ['class' => 'form-label required']) !!}
            {!! Form::select('vat_economy_code', $economyCodes, $page == 'create' ? old('vat_economy_code') : $setting->vat_economy_code,
            ['class' => "form-control searchable", "required ",
            'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('vat_economy_code'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('vat_economy_code') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <!-- Economy Code for Income Tax (IT) -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('it_economy_code', __('ims::procurement.settings.it_economy_code'), ['class' => 'form-label required']) !!}
            {!! Form::select('it_economy_code', $economyCodes, $page == 'create' ? old('it_economy_code') : $setting->it_economy_code,
            ['class' => "form-control searchable", "required ",
            'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('it_economy_code'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('it_economy_code') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <!-- Economy Code for Items -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('items_economy_code', __('ims::procurement.settings.items_economy_code'), ['class' => 'form-label required']) !!}
            {!! Form::select('items_economy_code', $economyCodes, $page == 'create' ? old('items_economy_code') : $setting->items_economy_code,
            ['class' => "form-control searchable", "required ",
            'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('items_economy_code'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('items_economy_code') }}</strong>
            </span>
            @endif
        </div>
    </div>


    <div class="col-6">
        <div class="form-group">
            {!! Form::label('remark', __('labels.remarks'), ['class' => 'form-label']) !!}
            {!! Form::textarea('remark', $page == 'create' ? old('remark') : $setting->remark,
    ['class' => "form-control", "placeholder" => __('labels.remarks'), 'maxlength' => 1000, 'rows' => 2]) !!}
            <div class="help-block"></div>
            @if ($errors->has('remark'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('remark') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group col-md-6">

        <ul class="list-inline">
            <li class="list-inline-item">
                {!! Form::label('is_default', __('ims::procurement.settings.default') . '?', ['class' => 'form-label required']) !!}
            </li>
            <li class="list-inline-item">
                <div class="skin skin-flat">
                    <label>@lang('labels.yes')</label>
                    {!! Form::radio('is_default', 1, $page == 'create' ? old('is_default') : $setting->is_default,
                    ['class' => 'required', 'id' => 'is_default_true', 'data-validation-required-message' => trans('labels.This field is required')]) !!}
                </div>
            </li>
            <li class="list-inline-item">
                <div class="skin skin-flat">
                    <label for="is_default">@lang('labels.no')</label>
                    {!! Form::radio('is_default', 0, $page == 'create' ? old('is_default') : !$setting->is_default,
                    ['class' => 'required', 'id' => 'is_default_false', 'data-validation-required-message' =>
                    trans('labels.This field is required')]) !!}
                </div>
            </li>
        </ul>

        <div class="help-block"></div>

        <div class="row col-md-12 radio-error">
            @if ($errors->has('is_default'))
                <div class="help-block text-danger"><strong>{{ $errors->first('is_default') }}</strong></div>
            @endif
        </div>
    </div>
</div>

<div class="form-actions center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
    <a href="{{ route('procurement-bill-settings.index') }}" class="btn btn-warning">
        <i class="la la-times"></i>
        @lang('labels.cancel')
    </a>
</div>
{{ Form::close() }}
