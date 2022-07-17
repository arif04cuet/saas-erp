@if($action == 'create')
    {!! Form::open(['route' =>  'pension-configuration.store', 'class' => 'form', 'novalidate']) !!}
@elseif($action == 'edit')
    {!! Form::open(['route' =>  ['pension-configuration.update',$pensionConfiguration->id], 'class' => 'form', 'novalidate']) !!}
    @method('PUT')
@endif

<!-- Pension Percentage & Lump Sum Number-->
<div class="row">
    <!-- Configuration Title -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('title',trans('accounts::pension.configuration.form_elements.title'),
                ['class' => 'form-label required']) !!}
            {!! Form::text('title',$action === 'create' ? old('title') : $pensionConfiguration->title,
            ['class' => 'form-control','required','placeholder'=>trans('labels.title'),
            'data-validation-required-message' => __('labels.This field is required')
            ]) !!}
            <div class="help-block"></div>
            @if($errors->has('title'))
                <div class="help-block red">{{$errors->first('title')}}</div>
            @endif
        </div>
    </div>

    <!--Pension Percentage -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('percentage',trans('accounts::pension.configuration.form_elements.percentage'),
                ['class' => 'form-label required']) !!}
            {!! Form::number('percentage',$action === 'create' ? old('percentage') ?? 0 : $pensionConfiguration->percentage,
            ['class' => 'form-control', 'min'=>0, 'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if($errors->has('percentage'))
                <span class="help-block red">{{$errors->first('percentage')}}</span>
            @endif
        </div>
    </div>

    <!-- Lump Sum Number -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('lump_sum_number', trans('accounts::pension.configuration.form_elements.lump_sum_number'),
                ['class' => 'form-label required']) !!}
            {!! Form::number('lump_sum_number', $action === 'create' ? old('lump_sum_number') ?? 0 :
             $pensionConfiguration->lump_sum_number, ['class' => 'form-control','min'=>0,
             'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if($errors->has('lump_sum_number'))
                <span class="help-block red">{{$errors->first('lump_sum_number')}}</span>
            @endif
        </div>
    </div>
</div>

<!-- Lump Sum  and Monthly Pension Percentage -->
<div class="row">

    <!-- Lump Sum Percentage -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('lump_sum_percentage',trans('accounts::pension.configuration.form_elements.lump_sum_percentage'),
                ['class' => 'form-label required']) !!}
            {!! Form::number('lump_sum_percentage', $action === 'create' ? old('lump_sum_percentage') ?? 0
            : $pensionConfiguration->lump_sum_percentage, ['class' => 'form-control','min'=>0,
            'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if($errors->has('lump_sum_percentage'))
                <span class="help-block red">{{$errors->first('lump_sum_percentage')}}</span>
            @endif
        </div>
    </div>

    <!-- Monthly Pension Percentage -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('monthly_pension_percentage',
            trans('accounts::pension.configuration.form_elements.monthly_pension_percentage'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('monthly_pension_percentage',$action === 'create' ?
                old('monthly_pension_percentage') ?? 0 : $pensionConfiguration->monthly_pension_percentage,
                ['class' => 'form-control','min'=>0,
                'data-validation-required-message' => __('labels.This field is required')])!!}
            <div class="help-block"></div>
            @if($errors->has('monthly_pension_percentage'))
                <span class="help-block red">{{$errors->first('monthly_pension_percentage')}}</span>
            @endif
        </div>
    </div>

    <!-- Minimum Pension Amount -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('minimum_pension_amount',
            trans('accounts::pension.configuration.form_elements.minimum_pension_amount'),
            ['class' => 'form-label']) !!}
            {!! Form::number('minimum_pension_amount',$action === 'create' ?
                old('minimum_pension_amount') ?? 0 : $pensionConfiguration->minimum_pension_amount,
                ['class' => 'form-control','min'=>0])
            !!}
            <div class="help-block"></div>
            @if($errors->has('minimum_pension_amount'))
                <span class="help-block red">{{$errors->first('minimum_pension_amount')}}</span>
            @endif
        </div>
    </div>

</div>

<div class="row">

    <!--Medical Allowance Increment Age -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('medical_allowance_increment_age',
            trans('accounts::pension.configuration.form_elements.medical_allowance_increment_age'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('medical_allowance_increment_age',$action === 'create' ?
                old('medical_allowance_increment_age') ?? 0 : $pensionConfiguration->medical_allowance_increment_age,
                ['class' => 'form-control','min'=>0,
                'data-validation-required-message' => __('labels.This field is required')])!!}
            <div class="help-block"></div>
            @if($errors->has('medical_allowance_increment_age'))
                <span class="help-block red">{{$errors->first('medical_allowance_increment_age')}}</span>
            @endif
        </div>
    </div>

    <!-- Initial Medical Allowance -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('medical_allowance_increment_age',
            trans('accounts::pension.configuration.form_elements.initial_medical_allowance'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('initial_medical_allowance',$action === 'create' ?
                old('initial_medical_allowance') ?? 0 : $pensionConfiguration->initial_medical_allowance,
                ['class' => 'form-control','min'=>0,
                'data-validation-required-message' => __('labels.This field is required')])!!}
            <div class="help-block"></div>
            @if($errors->has('medical_allowance_increment_age'))
                <span class="help-block red">{{$errors->first('medical_allowance_increment_age')}}</span>
            @endif
        </div>
    </div>

    <!--Medical allowance after increment -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('medical_allowance_after_increment',
            trans('accounts::pension.configuration.form_elements.medical_allowance_after_increment'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('medical_allowance_after_increment',$action === 'create' ?
                old('medical_allowance_after_increment') ?? 0 : $pensionConfiguration->medical_allowance_after_increment,
                ['class' => 'form-control','min'=>0,
                'data-validation-required-message' => __('labels.This field is required')])!!}
            <div class="help-block"></div>
            @if($errors->has('medical_allowance_after_increment'))
                <span class="help-block red">{{$errors->first('medical_allowance_after_increment')}}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <!-- status checkbox -->
    <div class="col">
        <div class="skin skin-flat">
            <fieldset>
                {!! Form::label('status',trans('accounts::pension.configuration.form_elements.status.active')) !!}
                @if($action === 'create')
                    <p>
                        {!! Form::checkbox('status',null)!!}
                    </p>
                @else
                    @if($pensionConfiguration->status === \Modules\Accounts\Entities\PensionConfiguration::status[0])
                        <p>
                            {!! Form::checkbox('status',null,true)!!}
                        </p>
                    @else
                        <p>
                            {!! Form::checkbox('status',null)!!}
                        </p>
                    @endif
                @endif
            </fieldset>
        </div>
    </div>
</div>

@include('accounts::pension-configuration.pension-rule.form')


<!-- Save / Cancel -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-success">
        <i class="la la-check-square-o"></i>{{trans('labels.save') }}
    </button>
    <a class="btn btn-outline-warning mr-1" role="button" href="{{route('pension-configuration.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
