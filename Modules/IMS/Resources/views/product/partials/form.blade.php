@if($page == 'create')
    {{ Form::open(['route' =>  'inventory.product.store', 'class' => 'product-tab-steps wizard-circle']) }}
@else
    {{ Form::open(['route' =>  ['inventory.product.update', $product->id], 'class' => 'product-tab-steps wizard-circle']) }}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-building"></i> @lang('ims::warehouse-create-form.title')</h4>
<div class="row">
    <div class="col-4">
        {!! Form::label('name', __('ims::product-create-form.fields.name.title'), ['class' => 'form-label required']) !!}
        {!! Form::text('name', $page == 'create' ? old('name') : $product->name, ['class' => "form-control", "required ", "placeholder" => __('ims::product-create-form.fields.name.placeholder'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-4">
        {!! Form::label('code', __('ims::product-create-form.fields.code.title'), ['class' => 'form-label required']) !!}
        {!! Form::text('code', $page == 'create' ? old('code') : $product->code, ['class' => "form-control", "required ", "placeholder" => __('ims::product-create-form.fields.code.placeholder'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
        @if ($errors->has('code'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-4">
        {!! Form::label('date', __('ims::product-create-form.fields.date.title'), ['class' => 'form-label required']) !!}
        {{ Form::text('date', $page == 'create' ? date('j F, Y') : date('j F, Y', strtotime($product->date)), ['id' => 'date', 'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Pick end date', 'data-msg-required' => Lang::get('labels.This field is required')]) }}
        <div class="help-block"></div>
    </div>
</div>

<div class="row mt-lg-2">
    <div class="col-4">
        {!! Form::label('sh_code', __('ims::product-create-form.fields.sh_code.title'), ['class' => 'form-label required']) !!}
        {!! Form::text('sh_code', $page == 'create' ? old('sh_code') : $product->sh_code, ['class' => "form-control", "required ", "placeholder" => __('ims::product-create-form.fields.sh_code.placeholder'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
    </div>
    <div class="col-4">
        {!! Form::label('bar_code', __('ims::product-create-form.fields.bar_code.title'), ['class' => 'form-label required']) !!}
        {!! Form::text('bar_code', $page == 'create' ? old('bar_code') : $product->bar_code, ['class' => "form-control", "required ", "placeholder" => __('ims::product-create-form.fields.bar_code.placeholder'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
    </div>
</div>

<div class="form-actions mb-lg-3">
    <a class="btn btn-warning pull-right" role="button" href="{{ route('inventory.product.index') }}" style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
    <button type="submit" class="btn btn-primary pull-right">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
</div>
{{ Form::close() }}
