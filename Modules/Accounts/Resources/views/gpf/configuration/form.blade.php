@if($page == 'create')
    {!! Form::open(['route' =>  'gpf-configurations.store', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['gpf-configurations.update', $configuration->id], 'class' => 'form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::gpf.configuration.form_title')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('gpf_interest_percentage', trans('accounts::gpf.configuration.gpf_interest_percentage'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('gpf_interest_percentage',
            $page === 'create' ? old('gpf_interest_percentage') : $configuration->gpf_interest_percentage,
            ['class'=>'form-control required', 'required', 'step' => .01,
            'data-validation-required-message'=>trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('gpf_interest_percentage'))
                <div class="help-block red">{{$errors->first('gpf_interest_percentage') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('gpf_loan_interest_percentage', trans('accounts::gpf.configuration.gpf_loan_interest_percentage'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('gpf_loan_interest_percentage',
            $page == 'create' ? old('gpf_loan_interest_percentage') : $configuration->gpf_loan_interest_percentage,
            ['class' => 'form-control'. ($errors->has('gpf_loan_interest_percentage') ? ' is-invalid' : ''), 'required',
             'step' => .01, 'data-validation-required-message'=> trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('gpf_loan_interest_percentage'))
                <span class="invalid-feedback">{{ $errors->first('gpf_loan_interest_percentage') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('min_gpf_percentage', trans('accounts::gpf.configuration.min_gpf_percentage'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('min_gpf_percentage',
            $page == 'create' ? old('min_gpf_percentage') : $configuration->min_gpf_percentage, ['class' => 'form-control'.
            ($errors->has('min_gpf_percentage') ? ' is-invalid' : ''), 'required', 'step' => .01,
            'data-validation-required-message'=> trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('min_gpf_percentage'))
                <span class="invalid-feedback">{{ $errors->first('min_gpf_percentage') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('max_gpf_percentage', trans('accounts::gpf.configuration.max_gpf_percentage'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('max_gpf_percentage',
            $page == 'create' ? old('max_gpf_percentage') : $configuration->max_gpf_percentage, ['class' =>
            'form-control'. ($errors->has('max_gpf_percentage') ? ' is-invalid' : ''), 'required', 'step' => .01,
            'data-validation-required-message'=> trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('max_gpf_percentage'))
                <span class="invalid-feedback">{{ $errors->first('max_gpf_percentage') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('max_loan_installment', trans('accounts::gpf.configuration.max_loan_installment'),
            ['class' => 'form-label']) !!}
            {!! Form::number('max_loan_installment',
            $page == 'create' ? old('max_loan_installment') : $configuration->max_loan_installment,
            ['class' => 'form-control'. ($errors->has('max_loan_installment') ? ' is-invalid' : ''), 'min' => 1,
           'data-validation-required-message'=> trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('max_loan_installment'))
                <span class="invalid-feedback">{{ $errors->first('max_loan_installment') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('remark', trans('accounts::gpf.remark'),
            ['class' => 'form-label']) !!}
            {!! Form::textarea('remark', $page == 'create' ? old('remark') : $configuration->remark,
            ['class' => 'form-control', 'rows' => 3, 'required']) !!}
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
    <a class="btn btn-warning mr-1" role="button" href="{{route('gpf-configurations.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
