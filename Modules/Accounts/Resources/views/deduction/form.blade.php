@if($action == 'create')
    {!! Form::open(['route' =>  'pension.deduction.store', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['pension.deduction.update', $pensionDeduction->id], 'class' => '']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i
        class="la la-tag"></i>@lang('accounts::pension.deduction.form')</h4>
<div class="row">

    <!-- Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('labels.name'), ['class' => 'form-label required']) !!}
            {!!
                    Form::text('name', $action == 'create' ? old('name') : $pensionDeduction->name,
                    [
                        'class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''),
                        'required',
                        'maxlength'=>50,
                        'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.name')])
                    ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <!-- Bangla Name-->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bangla_name', trans('accounts::pension.deduction.form_elements.bangla_name'), ['class' => 'form-label']) !!}
            {!! Form::text('bangla_name', $action == 'create' ? old('bangla_name') : $pensionDeduction->bangla_name,
                        [
                            'class' => 'form-control',
                            'maxlength'=>50,
                        ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('bangla_name'))
                <span class="invalid-feedback">{{ $errors->first('bangla_name') }}</span>
            @endif
        </div>
    </div>
</div>

<!-- description -->
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', trans('labels.description'), ['class' => 'form-label']) !!}
            {!! Form::textarea('description', $action == 'create' ? old('description') :
                    $pensionDeduction->description,
                    [
                        'class' => 'form-control',
                        "placeholder" => "", 'rows'=> 3,
                         'maxlength'=>150,
                        ])
            !!}
            <div class="help-block"></div>
            @if ($errors->has('description'))
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$action == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('pension.deduction.index'))}}">
        <i class="la la-times"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
