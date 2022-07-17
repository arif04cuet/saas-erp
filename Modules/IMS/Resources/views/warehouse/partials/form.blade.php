@if($page == 'create')
    {{ Form::open(['route' =>  'inventory.warehouse.store', 'class' => 'warehouse-tab-steps wizard-circle']) }}
@else
    {{ Form::open(['route' =>  ['inventory.warehouse.update', $warehouse->id], 'class' => 'warehouse-tab-steps wizard-circle']) }}
    @method('PUT')
@endif

<h4 class="form-section"><i class="la la-building"></i> @lang('ims::warehouse-create-form.title')</h4>
<div class="row">
    <div class="col-6">
        {!! Form::label('name', __('ims::warehouse-create-form.fields.name.title'), ['class' => 'form-label required']) !!}
        {!! Form::text('name', $page == 'create' ? old('name') : $warehouse->name, ['class' => "form-control", "required ", "placeholder" => __('ims::warehouse-create-form.fields.name.placeholder'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
        @endif
    </div>
    <div class="col-6">
        {!! Form::label('date', __('ims::product-create-form.fields.date.title'), ['class' => 'form-label required']) !!}
        {{ Form::text('date', $page == 'create' ? date('j F, Y') : date('j F, Y', strtotime($warehouse->date)), ['id' => 'date', 'class' => 'form-control required' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Pick end date', 'data-msg-required' => Lang::get('labels.This field is required')]) }}
        <div class="help-block"></div>
    </div>
</div>
<div class="row mt-lg-2">
    <div class="col-6">
        {!! Form::label('department', __('ims::warehouse-create-form.fields.department.title'), ['class' => 'form-label required']) !!}
        {!! Form::select('department_id', $departments, $page == 'create' ? null : $warehouse->department_id, ['class' => "form-control", "required ", "placeholder" => __('ims::warehouse-create-form.fields.department.placeholder'),
        "data-validation-required_message" => trans('validation.required', ['attribute' => __('ims::warehouse-create-form.fields.name.title')])]) !!}
        <div class="help-block"></div>
    </div>
    {{--<div class="col-2 float-left" style="margin-left: -30px; margin-top: 22px;">
        <a href="#" title="{{ __('ims::warehouse-create-form.link_icons.title') }}" class="fonticon-container">
            <div class="fonticon-wrap">
                <i class="ft-plus-circle"></i>
            </div>
        </a>
    </div>--}}
</div>
<div class="form-actions mb-lg-3">
    <a class="btn btn-warning pull-right" role="button" href="{{ route('inventory.warehouse.list') }}" style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
    <button type="submit" class="btn btn-primary pull-right">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
</div>
{{ Form::close() }}