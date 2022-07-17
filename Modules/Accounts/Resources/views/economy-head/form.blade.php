@if($page == 'create')
    {!! Form::open(['route' =>  'economy-head.store', 'class' => 'form economy-head-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => [ 'economy-head.update', $economyHead->id], 'class' => 'economy-head-form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::economy-head.title')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('code', trans('labels.code'), ['class' => 'form-label']) !!} <span class="danger">*</span>
            {!! Form::number('code', $page == 'create' ? old('code') : $economyHead->code, ['class' => 'form-control'.($errors->has('code') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g 1152154", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.code')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('code'))
                <span class="invalid-feedback">{{ $errors->first('code') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('parent_id', trans('accounts::economy-head.title'), ['class' => 'form-label']) !!}
            {!! Form::select('parent_id', $economyHeadOptions, $page === 'create' ? null : $economyHead->parent_id, ['class'=>'form-control economy-head-select required']) !!}

            <div class="help-block"></div>
            @if ($errors->has('parent_id'))
                <span class="invalid-feedback">{{ $errors->first('parent_id') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('english_name', trans('labels.name') .' (English)', ['class' => 'form-label required']) !!}
            {!! Form::text('english_name', $page == 'create' ? old('english_name') : $economyHead->english_name, ['class' => 'form-control'.($errors->has('english_name') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g Assets", 'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.name')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('english_name'))
                <span class="invalid-feedback">{{ $errors->first('english_name') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('labels.name') .' (বাংলা)', ['class' => 'form-label required']) !!}
            {!! Form::text('bangla_name', $page == 'create' ? old('bangla_name') : $economyHead->bangla_name, ['class' => 'form-control'.($errors->has('bangla_name') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g Assets", 'data-validation-required-message'=>trans('validation.required', ['attribute' => trans('labels.name')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('bangla_name'))
                <span class="invalid-feedback">{{ $errors->first('bangla_name') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('description', trans('labels.description'), ['class' => 'form-label']) !!}
            {!! Form::textarea('description', $page == 'create' ? old('description') : $economyHead->description, ['rows' => '2', 'class' => 'form-control'.($errors->has('description') ? ' is-invalid' : ''),
            "placeholder" => trans('labels.description')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('description'))
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('economy-head.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
