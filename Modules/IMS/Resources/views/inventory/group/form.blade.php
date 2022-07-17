@if($page == 'create')
    {{ Form::open(['route' =>  'inventory-category-group.store', 'class' => 'form']) }}
@else
    {{ Form::open(['route' =>  ['inventory-category-group.update', $group->id], 'class' => 'form']) }}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-building"></i> @lang('ims::group.form')</h4>
<div class="row">
    <div class="col-6">
        {!! Form::label('name_en', __('ims::group.name_en'), ['class' => 'form-label required']) !!}
        {!! Form::text('name_en', $page == 'create' ? old('name_en') : $group->name_en,['class' => 'form-control'. ($errors->has('name_en') ? ' is-invalid' : ''), "required ", "placeholder" => __('ims::group.name_en'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
        @if ($errors->has('name_en'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name_en') }}</strong>
            </span>
        @endif
    </div>
    <div class="col-6">
        {!! Form::label('name_bn', __('ims::group.name_bn'), ['class' => 'form-label required']) !!}
        {!! Form::text('name_bn', $page == 'create' ? old('name_bn') : $group->name_bn,['class' => "form-control", "required ", "placeholder" => __('ims::group.name_bn'), 'data-rule-maxlength' => 100, 'data-msg-maxlength'=>Lang::get('labels.At most 100 characters'),
        'data-msg-required' => Lang::get('labels.This field is required')]) !!}
        <div class="help-block"></div>
        @if ($errors->has('name_bn'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name_bn') }}</strong>
            </span>
        @endif
    </div>

</div>

<div class="form-actions mb-lg-3">

    <button type="submit" class="btn btn-primary center">
        <i class="la la-check-square-o"></i> {{trans('labels.save')}}
    </button>
    <a class="btn btn-warning center" role="button" href="{{ route('inventory-category-group.index') }}"
       style="margin-left: 2px;">
        <i class="la la-times"></i> {{trans('labels.cancel')}}
    </a>
</div>
{{ Form::close() }}
