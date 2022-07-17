@if($page == 'create')
    {!! Form::open(['route' =>  'salary-rule.store', 'class' => 'form salary-rule-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => [ 'salary-rule.update', $salaryRule->id], 'class' => 'salary-rule-form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::salary-rule.title') @lang('labels.form')</h4>
<div class="row">

    <!-- English Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('labels.name'), ['class' => 'form-label']) !!} <span class="danger">*</span>
            {!! Form::text('name', $page == 'create' ? old('name') : $salaryRule->name, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''), 'required',
            "placeholder" => "Rule Name", 'data-validation-required-message'=>trans('validation.required',
           ['attribute' => __('labels.name')]), 'data-validation-maxlength-maxlength' => 100,
           'data-validation-maxlength-message' => __('labels.At most 100 characters')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('name'))
                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <!-- Bangla Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bangla_name', trans('accounts::salary-rule.bangla_name'), ['class' => 'form-label']) !!}
            <span class="danger">*</span>
            {!! Form::text('bangla_name', $page == 'create' ? old('bangla_name') : $salaryRule->bangla_name, ['class' => 'form-control'.($errors->has('bangla_name') ? ' is-invalid' : ''), 'required',
            "placeholder" => "Rule Name in Bangla", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.name')]),
            'data-validation-maxlength-maxlength' => 255,
            'data-validation-maxlength-message' => __('labels.At most 255 characters')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('bangla_name'))
                <span class="invalid-feedback">{{ $errors->first('bangla_name') }}</span>
            @endif
        </div>
    </div>

    <!-- Salary Category -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('salary_category_id', trans('accounts::payroll.salary_category'), ['class' => 'form-label required']) !!}
            {{--<a class="pull-right" target="_blank" href="{{route('salary-category.create')}}">+ @lang('labels.create')</a>--}}
            {!! Form::select('salary_category_id', $salaryCategories, $page == 'create' ? old('salary_category_id') : $salaryRule->salary_category_id, ['class' => 'form-control select2 required',
             'required', 'data-validation-required-message'=> __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('salary_category_id'))
                <span class="invalid-feedback">{{ $errors->first('salary_category_id') }}</span>
            @endif
        </div>
    </div>

    <!-- Code -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('code', trans('labels.code'), ['class' => 'form-label']) !!} <span class="danger">*</span>
            {!! Form::text('code', $page == 'create' ? old('code') : $salaryRule->code, ['class' => 'form-control'.($errors->has('code') ? ' is-invalid' : ''), 'required',
            "placeholder" => "", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.code')]),
            'data-validation-maxlength-maxlength' => 50,
            'data-validation-maxlength-message' => __('labels.At most 50 characters')]) !!}
            @if($page == 'edit')
                <input type="hidden" name="existing_code" value="{{$salaryRule->code?? ""}}">
            @endif
            <div class="help-block"></div>
            @if ($errors->has('code'))
                <span class="invalid-feedback">{{ $errors->first('code') }}</span>
            @endif
        </div>
    </div>

    <!-- Sequence -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('sequence', trans('labels.sequence'), ['class' => 'form-label required']) !!}
            {!! Form::number('sequence', $page == 'create' ? old('sequence') : $salaryRule->sequence,
['class' => 'form-control'.($errors->has('sequence') ? ' is-invalid' : ''), 'required', 'data-validation-max-max' => 1000,
'data-validation-min-min' => 1, 'data-validation-max-message' => __('validation.lte.numeric', ['attribute' => __('labels.sequence'), 'value' => \App\Utilities\EnToBnNumberConverter::en2bn(1000)]),
            'data-validation-min-message' => __('validation.gte.numeric', ['attribute' => __('labels.sequence'), 'value'  => \App\Utilities\EnToBnNumberConverter::en2bn(1)]),
            "placeholder" => "", 'data-validation-required-message'=>trans('validation.required',
            ['attribute' => __('labels.sequence')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('sequence'))
                <span class="invalid-feedback">{{ $errors->first('sequence') }}</span>
            @endif
        </div>
    </div>

    <!-- Show on payslip checkbox -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('show_on_payslip', __('accounts::salary-rule.show_on_payslip'), ['class' => 'form-label']) !!}
            <span class="danger">*</span><br>
            {!! Form::checkbox('show_on_payslip',1, false, [ ($page == 'edit' && $salaryRule->show_on_payslip)? 'checked' : '']) !!}
            <div class="help-block"></div>
            @if ($errors->has('show_on_payslip'))
                <span class="invalid-feedback">{{ $errors->first('show_on_payslip') }}</span>
            @endif
        </div>
    </div>

    <!-- Contribution Register -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('contribution_register', trans('accounts::salary-rule.contribution_register'), ['class' => 'form-label']) !!}
            <a class="pull-right" target="_blank" href="{{route('contribution-register.create')}}">+ @lang('labels.create')</a>
            {!! Form::select('contribution_register', $contributionRegisters, $page === 'create' ? null : $salaryRule->contribution_register, ['class'=>'form-control select2 required']) !!}

            <div class="help-block"></div>
            @if ($errors->has('contribution_register'))
                <span class="invalid-feedback">{{ $errors->first('contribution_register') }}</span>
            @endif
        </div>
    </div>
</div>

<h4>@lang('accounts::salary-rule.accounts')</h4>
<hr/>

<div class="row">

    <!-- Debit Account -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('debit_account', __('accounts::salary-rule.debit_account'), ['class' => 'form-label']) !!}
            {!! Form::select('debit_account', $economyCodeOptions, $page === 'create' ? [] : $salaryRule->debit_account, ['class'=>'form-control select2 required']) !!}

            <div class="help-block"></div>
            @if ($errors->has('debit_account'))
                <span class="invalid-feedback">{{ $errors->first('debit_account') }}</span>
            @endif
        </div>
    </div>
    <!-- Credit Account -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('credit_account', __('accounts::salary-rule.credit_account'), ['class' => 'form-label']) !!}
            {!! Form::select('credit_account', $economyCodeOptions, $page === 'create' ? [] : $salaryRule->credit_account, ['class'=>'form-control select2']) !!}

            <div class="help-block"></div>
            @if ($errors->has('credit_account'))
                <span class="invalid-feedback">{{ $errors->first('credit_account') }}</span>
            @endif
        </div>
    </div>
</div>


<h4>@lang('accounts::salary-rule.conditions')</h4>
<hr/>
<div class="row">
    <!-- Condition type -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('condition_type', __('accounts::salary-rule.conditions_based_on'), ['class' => 'form-label']) !!}
            {!! Form::select('condition_type', $conditions, $page === 'create' ? null : $salaryRule->condition_type, ['class'=>'form-control required']) !!}

            <div class="help-block"></div>
            @if ($errors->has('condition_type'))
                <span class="invalid-feedback">{{ $errors->first('condition_type') }}</span>
            @endif
        </div>
    </div>
    <!-- Range Based On -->
    <div class="col-md-6 con-range">
        <div class="form-group">
            {!! Form::label('range_based_on', __('accounts::salary-rule.range_based_on'), ['class' => 'form-label']) !!}
            {!! Form::select('range_based_on', $salaryRules, $page === 'create' ? null : $salaryRule->range_based_on, ['class'=>'form-control select2']) !!}

            <div class="help-block"></div>
            @if ($errors->has('range_based_on'))
                <span class="invalid-feedback">{{ $errors->first('range_based_on') }}</span>
            @endif
        </div>
    </div>

    <!-- Condition Expression -->
    <div class="col-md-6 con-expression">
        <div class="form-group">
            {!! Form::label('condition_expression', __('accounts::salary-rule.expression'), ['class' => 'form-label']) !!}
            {!! Form::textarea('condition_expression', $page === 'create' ? null : $salaryRule->condition_expression, ['class'=>'form-control', 'rows' => 2]) !!}
            <div class="help-block"></div>
            @if ($errors->has('condition_expression'))
                <span class="invalid-feedback">{{ $errors->first('condition_expression') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">

    <!-- Salary Rule Range -->
    <div class="col-md-6">
        <div class="form-group con-range">
            {!! Form::label('min_range', __('accounts::salary-rule.min_range'), ['class' => 'form-label']) !!}
            {!! Form::text('min_range', $page == 'create' ? old('min_range') : $salaryRule->min_range, ['class' => 'form-control'.($errors->has('code') ? ' is-invalid' : ''), "placeholder" => ""]) !!}
            <div class="help-block"></div>
            @if ($errors->has('min_range'))
                <span class="invalid-feedback">{{ $errors->first('min_range') }}</span>
            @endif
        </div>
    </div>

    <!-- Max range -->
    <div class="col-md-6 con-range">
        <div class="form-group">
            {!! Form::label('max_range', __('accounts::salary-rule.max_range'), ['class' => 'form-label']) !!}
            {!! Form::text('max_range', $page == 'create' ? old('max_range') : $salaryRule->max_range, ['class' => 'form-control'.($errors->has('sequence') ? ' is-invalid' : ''), "placeholder" => ""]) !!}
            <div class="help-block"></div>
            @if ($errors->has('max_range'))
                <span class="invalid-feedback">{{ $errors->first('max_range') }}</span>
            @endif
        </div>
    </div>
</div>
<h4>@lang('accounts::salary-rule.computations')</h4>
<hr/>
<div class="row">

    <!-- Amount Type  -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('amount_type', __('accounts::salary-rule.amount_type'), ['class' => 'form-label']) !!}
            {!! Form::select('amount_type', $amountTypes, $page === 'create' ? null : $salaryRule->amount_type, ['class'=>'form-control required']) !!}

            <div class="help-block"></div>
            @if ($errors->has('amount_type'))
                <span class="invalid-feedback">{{ $errors->first('amount_type') }}</span>
            @endif
        </div>
    </div>

    <!-- Quantity  -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('quantity', __('accounts::salary-rule.quantity'), ['class' => 'form-label']) !!}
            {!! Form::text('quantity', $page === 'create' ? null : $salaryRule->quantity, ['class'=>'form-control',
 'required', 'onkeyup' => 'getDecimal(this.id)', 'maxlength' => 3]) !!}
            <div class="help-block"></div>
            @if ($errors->has('quantity'))
                <span class="invalid-feedback">{{ $errors->first('quantity') }}</span>
            @endif
        </div>
    </div>

    <!-- Percentage Based On  -->
    <div class="col-md-6 amt-parc">
        <div class="form-group">
            {!! Form::label('percentage_based_on', __('accounts::salary-rule.percentage_based_on'), ['class' => 'form-label']) !!}
            {!! Form::select('percentage_based_on', $salaryRules, $page === 'create' ? null : $salaryRule->percentage_based_on, ['class'=>'form-control select2']) !!}
            <div class="help-block"></div>
            @if ($errors->has('percentage_based_on'))
                <span class="invalid-feedback">{{ $errors->first('percentage_based_on') }}</span>
            @endif
        </div>
    </div>

    <!-- Percentage  -->
    <div class="col-md-6 amt-parc">
        <div class="form-group">
            {!! Form::label('percentage', __('accounts::salary-rule.percentage'), ['class' => 'form-label']) !!}
            {!! Form::number('percentage', $page == 'create' ? old('percentage') : $salaryRule->percentage, ['class' => 'form-control'.($errors->has('code') ? ' is-invalid' : '')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('percentage'))
                <span class="invalid-feedback">{{ $errors->first('percentage') }}</span>
            @endif
        </div>
    </div>

    <!-- Minimum Amount  -->
    <div class="col-md-6 amt-parc">
        <div class="form-group">
            {!! Form::label('min_amount', __('accounts::salary-rule.min_amount'), ['class' => 'form-label']) !!}
            {!! Form::number('min_amount', $page == 'create' ? old('min_amount') : $salaryRule->min_amount, ['class' => 'form-control'.($errors->has('min_amount') ? ' is-invalid' : '')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('min_amount'))
                <span class="invalid-feedback">{{ $errors->first('min_amount') }}</span>
            @endif
        </div>
    </div>
    <!-- Maximum Amount  -->
    <div class="col-md-6 amt-parc">
        <div class="form-group">
            {!! Form::label('max_amount', __('accounts::salary-rule.max_amount'), ['class' => 'form-label']) !!}
            {!! Form::number('max_amount', $page == 'create' ? old('max_amount') : $salaryRule->max_amount, ['class' => 'form-control'.($errors->has('max_amount') ? ' is-invalid' : '')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('max_amount'))
                <span class="invalid-feedback">{{ $errors->first('max_amount') }}</span>
            @endif
        </div>
    </div>

    <!-- Fixed Amount  -->
    <div class="col-md-6 amt-fix">
        <div class="form-group">
            {!! Form::label('fixed_amount', __('accounts::salary-rule.fixed_amount'), ['class' => 'form-label']) !!}
            {!! Form::text('fixed_amount', $page == 'create' ? old('fixed_amount') : $salaryRule->fixed_amount, ['class' => 'form-control']) !!}
            <div class="help-block"></div>
            @if ($errors->has('fixed_amount'))
                <span class="invalid-feedback">{{ $errors->first('fixed_amount') }}</span>
            @endif
        </div>
    </div>
</div>

<!-- Child Rules -->
<h4>@lang('accounts::salary-rule.child_rules')</h4><hr>
<div class="col-md-12">
    <div class="form-group">
        {!! Form::label('child_salary_rules', trans('accounts::salary-structure.rules'), ['class' => 'form-label']) !!}
        {!! Form::select('child_salary_rules[]', $salaryRules, $page === 'create' ? null : $salaryRule->children->pluck('child_rule_id'), ['id' => 'salary_rules','class'=>'form-control select2',
        'multiple']) !!}
        <div class="help-block"></div>
        @if ($errors->has('salary_rules'))
            <span class="invalid-feedback">{{$errors->first('salary_rules')}}</span>
        @endif
    </div>

    <!-- Invoice Items Details -->
    <div class="col-md-12">
        <div id="invoice-items-details" class="">
            <div class="row">
                <div class="table-responsive">
                    <table class="table repeater-category-request table-bordered" id="salary-rules-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="">Code</th>
                            <th class="">Category</th>
                            <th class="">Contribution Register</th>
                            {{--<th width="1%"><i data-repeater-create class="la la-plus-circle text-info"--}}
                            {{--style="cursor: pointer"></i></th>--}}
                        </tr>
                        </thead>
                        <tbody data-repeater-list="category">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- save / cancel button   -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('salary-rule.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
