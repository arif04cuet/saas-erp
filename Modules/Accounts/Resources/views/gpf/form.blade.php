@if($page == 'create')
    {!! Form::open(['route' =>  'gpf.store', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['gpf.update', $gpf->id], 'class' => 'form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::gpf.form_title')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id', trans('accounts::employee-contract.employee_name'),
            ['class' => 'form-label required']) !!}
            {!! Form::select('employee_id', $employees,
            $page == 'create' ? old('employee_id') : $gpf->employee_id,
            ['class' => 'form-control select2'.($errors->has('employee_id') ? ' is-invalid' : ''), 'required',
            'data-validation-required-message'=>trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('employee_id'))
                <span class="invalid-feedback">{{ $errors->first('employee_id') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fund_number', trans('accounts::gpf.fund_number'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('fund_number',
            $page == 'create' ? old('fund_number') : $gpf->fund_number, ['class' => 'form-control'.
            ($errors->has('fund_number') ? ' is-invalid' : ''), 'required',
           'data-validation-required-message'=>
           trans('validation.required', ['attribute' => __('accounts::gpf.fund_number')])]) !!}
            <div class="help-block"></div>
            @if($page == 'edit')
                <input type="hidden" name="existing_fund_no" value="{{$gpf->fund_number}}">
                @endif
            @if ($errors->has('fund_number'))
                <span class="invalid-feedback">{{ $errors->first('fund_number') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('start_date', trans('accounts::payscale.active_from'),
            ['class' => 'form-label required']) !!}
            {!! Form::text('start_date',
            $page === 'create' ? old('start_date') : date('d F Y', strtotime($gpf->start_date)),
            ['class'=>'form-control required', 'required',
            'data-validation-required-message'=>trans('validation.required',
            ['attribute' => __('accounts::payscale.active_from')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('start_date'))
                <div class="help-block red">{{$errors->first('start_date') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('current_percentage', trans('accounts::gpf.percentage'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('current_percentage',
            $page == 'create' ? old('current_percentage') : $gpf->current_percentage, ['class' => 'form-control'.
            ($errors->has('current_percentage') ? ' is-invalid' : ''), 'required',
           'data-validation-max-max' => $configuration->max_gpf_percentage,
           'data-validation-min-min' =>  $configuration->min_gpf_percentage,
           'data-validation-required-message'=>
           trans('validation.required', ['attribute' => __('accounts::gpf.percentage')]),
           'data-validation-min-message'=>
           trans('validation.gte.numeric', ['attribute' => __('accounts::gpf.percentage'),
           'value' => \App\Utilities\EnToBnNumberConverter::en2bn($configuration->min_gpf_percentage)]),
           'data-validation-max-message'=>
           trans('validation.lte.numeric', ['attribute' => __('accounts::gpf.percentage'),
           'value' => \App\Utilities\EnToBnNumberConverter::en2bn($configuration->max_gpf_percentage)])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('current_percentage'))
                <span class="invalid-feedback">{{ $errors->first('current_percentage') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('stock_balance', trans('accounts::gpf.stock_balance'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('stock_balance',
            $page == 'create' ? old('stock_balance') : $gpf->stock_balance, ['class' => 'form-control'.
            ($errors->has('stock_balance') ? ' is-invalid' : ''), 'required', 'data-validation-required-message'=>
           trans('validation.required', ['attribute' => __('accounts::gpf.stock_balance')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('stock_balance'))
                <span class="invalid-feedback">{{ $errors->first('stock_balance') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('current_balance', trans('accounts::gpf.current_balance'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('current_balance',
            $page == 'create' ? old('current_balance') : $gpf->current_balance, ['class' => 'form-control'.
            ($errors->has('current_balance') ? ' is-invalid' : ''), 'required',
           'data-validation-required-message'=>
           trans('validation.required', ['attribute' => __('accounts::gpf.current_balance')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('current_balance'))
                <span class="invalid-feedback">{{ $errors->first('current_balance') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('remark', trans('accounts::gpf.remark'),
            ['class' => 'form-label']) !!}
            {!! Form::textarea('remark', $page == 'create' ? old('remark') : $gpf->remark,
            ['class' => 'form-control', 'rows' => 3]) !!}
            <div class="help-block"></div>
            @if ($errors->has('remark'))
                <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('gpf.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
