@if($page == 'create')
    {!! Form::open(['route' =>  'salary-category.store', 'class' => 'form salary-category-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['salary-category.update', $salaryRule->id], 'class' => 'salary-category-form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::payroll.salary_category')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('labels.name'), ['class' => 'form-label']) !!} <span class="danger">*</span>
            {!! Form::text('name', $page == 'create' ? old('name') : $salaryRule->name, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g Basic", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.name')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('description', trans('labels.description'), ['class' => 'form-label']) !!}
            {!! Form::textarea('description', $page == 'create' ? old('description') : $salaryCategory->description, ['class' => 'form-control'.($errors->has('reference') ? ' is-invalid' : ''), 'required',
            "placeholder" => "", 'rows'=> 3]) !!}
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
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('salary-rule.index'))}}">
        <i class="la la-times"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
