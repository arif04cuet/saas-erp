@if($page == 'create')
    {{ Form::open(['route' =>  'inventory-item-category.store', 'class' => 'inventory-tab-steps wizard-circle', 'novalidate']) }}
@else
    {{ Form::open(['route' =>  ['inventory-item-category.update', $inventoryItemCategory->id], 'class' => 'inventory-tab-steps wizard-circle']) }}
    {!! Form::hidden('id', $page == 'create' ? "" : $inventoryItemCategory->id) !!}
    @method('PUT')
@endif

<h4 class="form-section"><i class="la la-building"></i> @lang('ims::inventory.new_item_category')</h4>
<div class="row">
    <!-- Name -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('name', __('labels.name'), ['class' => 'form-label required']) !!}
            {!! Form::text('name', $page == 'create' ? old('name') : $inventoryItemCategory->name,['class' => 'form-control'. ($errors->has('name') ? ' is-invalid' : ''), "required ", "placeholder" => __('labels.name'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
            'data-validation-required-message' => Lang::get('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <!-- Short Code -->
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('short_code', __('ims::inventory.short_code'), ['class' => 'form-label required']) !!}
            {!! Form::text('short_code', $page == 'create' ? old('short_code') : $inventoryItemCategory->short_code,
['class' => "form-control", "required ", "placeholder" => __('ims::inventory.short_code'), 'maxlength' => 6,
'data-validation-required-message' => Lang::get('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('short_code'))
                <div class="help-block red">
                    <strong>{{ $errors->first('short_code') }}</strong>
                </div>
            @endif
        </div>
    </div>

    <!-- Unit -->
    <div class="col-3">
        <div class="form-group">
            {!! Form::label('unit', __('ims::inventory.unit'), ['class' => 'form-label required']) !!}
            {!! Form::text('unit', $page == 'create' ? old('unit') : $inventoryItemCategory->unit,['class' => "form-control", "required ", "placeholder" => __('ims::inventory.unit'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
            'data-validation-required-message' => Lang::get('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('unit'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('unit') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <!-- Type -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('type', __('ims::inventory.type'), ['class' => 'form-label required']) !!}
            <ul class="list list-inline">
                <li class="list-inline-item">
                    <div class="skin skin-flat">
                        {!! Form::radio('type', config('constants.inventory_asset_types.fixed asset'), $page == 'create' ? old('type') == config('constants.inventory_asset_types.fixed asset') :
($inventoryItemCategory->type == config('constants.inventory_asset_types.fixed asset')), ['required', 'data-validation-required-message' =>
trans('labels.This field is required')]) !!}
                        <label>@lang('ims::inventory.fixed_asset')</label>
                    </div>
                </li>
                <li class="list-inline-item">
                    <div class="skin skin-flat">
                        {!! Form::radio('type', config('constants.inventory_asset_types.temporary asset'),
$page == 'create' ? old('type') == config('constants.inventory_asset_types.temporary asset') : ($inventoryItemCategory->type == config('constants.inventory_asset_types.temporary asset')),
['required', 'data-validation-required-message' => trans('labels.This field is required')]) !!}
                        <label>@lang('ims::inventory.temporary_asset')</label>
                    </div>
                </li>
            </ul>
            <div class="help-block"></div>
            <div class="row col-md-12 radio-error">
                @if ($errors->has('type'))
                    <span class="small text-danger"><strong>{{ $errors->first('type') }}</strong></span>
                @endif
            </div>
        </div>
    </div>

    <!-- Group -->
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('group_id', trans('ims::group.select_group'), ['class' => 'form-label required']) !!}
            {!! Form::select('group_id',
                $groups,
                $page == 'create' ? old('group_id') : $inventoryItemCategory->group_id,
                [
                    'class'=>'form-control select required',
                    'data-validation-required-message' => trans('labels.This field is required'),
                    'placeholder' => "Select",
                ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('group_id'))
                <span class="invalid-feedback">{{ $errors->first('group_id') }}</span>
            @endif
        </div>

    </div>
</div>

<div class="form-actions mb-lg-3">
    <a class="btn btn-warning pull-right" role="button" href="{{ route('inventory-item-category.index') }}"
       style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
    <button type="submit" class="btn btn-primary pull-right">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
</div>
{{ Form::close() }}
