@if($page == 'create')
    {{ Form::open(['route' =>  'inventory-locations.store', 'class' => 'location-tab-steps wizard-circle']) }}
@else
    {{ Form::open(['route' =>  ['inventory-locations.update', $location->id], 'class' => 'location-tab-steps wizard-circle']) }}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-building"></i> @lang('ims::location.new_location')</h4>
<div class="row">
    <div class="col-6">
        {!! Form::label('name', __('labels.name'), ['class' => 'form-label required']) !!}
        {!! Form::text('name', $page == 'create' ? old('name') : $location->name, ['class' => "form-control", "required ", "placeholder" => __('labels.name'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-6">
        {!! Form::label('department', __('ims::location.department'), ['class' => 'form-label required']) !!}
        {!! Form::select('department_id', $departments, $page == 'create' ? null : $location->department_id, ['class' => "form-control", "required ", "placeholder" => __('ims::location.department'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
    </div>
</div>
<div class="row mt-lg-2">
    <div class="form-group col-md-6">
        {!! Form::label('type', __('ims::location.type'), ['class' => 'form-label required']) !!}
        <div class="skin skin-flat">
            {!! Form::radio('type', 'store', $page == 'create' ? old('type') == 'store' : ($location->type == 'store'), ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}
            <label>@lang('ims::location.store')</label>
        </div>
        <div class="skin skin-flat">
            {!! Form::radio('type', 'general', $page == 'create' ? old('type') == 'general' : ($location->type == 'general'), ['class' => 'required', 'data-msg-required' => trans('labels.This field is required')]) !!}
            <label>@lang('ims::location.general')</label>
        </div>
        <div class="row col-md-12 radio-error">
            @if ($errors->has('type'))
                <span class="small text-danger"><strong>{{ $errors->first('type') }}</strong></span>
            @endif
        </div>
    </div>
    <div class="col-6">
        {!! Form::label('description', __('ims::location.description'), ['class' => 'form-label']) !!}
        {!! Form::textarea('description', $page == 'create' ? old('description') : $location->description,
['class' => "form-control", "placeholder" => __('ims::location.description'), 'data-rule-maxlength' => 5000,
'data-msg-maxlength'=>Lang::get('labels.At most 5000 characters'), 'rows' => 3]) !!}
        <div class="help-block"></div>
        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-6">
        {!! Form::label('admin', trans('ims::location.admin'), ['class' => 'form-label required']) !!}
        {!! Form::select('admin', $employees, $page == 'create' ? null : $location->admin,
            [
                'class' => "form-control required",
                "placeholder" => trans('ims::location.admin'),
                'data-msg-required' => Lang::get('labels.This field is required')
            ])
        !!}
        <div class="help-block"></div>
    </div>
    <div class="col-6">
        {!! Form::label('admin', trans('ims::location.section'), ['class' => 'form-label']) !!}
        {!! Form::select('section_id', $sections, $page == 'create' ? null : $location->section_id,
            [
                'class' => "form-control required",
                "placeholder" => trans('ims::location.section')
            ])
        !!}
        <div class="help-block"></div>
    </div>
</div>

<div class="form-actions mb-lg-3">
    <a class="btn btn-warning pull-right" role="button" href="{{ route('inventory-locations.index') }}"
       style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
    <button type="submit" class="btn btn-primary pull-right">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
</div>
{{ Form::close() }}
