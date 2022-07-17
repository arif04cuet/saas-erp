{!! Form::open(['route' =>  'payslips.store', 'class' => 'form salary-rule-form']) !!}

<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::payroll.payslip.form')</h4>

<div class="row">

    <!-- Period From  -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('period_month', trans('accounts::payroll.payslip.create_form_elements.period_from'), ['class' => 'form-label']) !!}
            {!! Form::text('period_from', null,
                    ['class' => 'form-control required',
                            'data-validation-required-message'=>trans('validation.required',
                            ['attribute' => trans('labels.start')])
                    ]
                )
             !!}
        </div>
    </div>

    <!-- Period To  -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('period_to', trans('accounts::payroll.payslip.create_form_elements.period_to'), ['class' => 'form-label']) !!}
            {!! Form::text('period_to', date('Y-m-t'),
                    ['class' => 'form-control required',
                            'data-validation-required-message'=>trans('validation.required',
                            ['attribute' => trans('labels.start')])
                    ]
                )
             !!}
        </div>
    </div>

    <!--Select Employee-->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id', trans('accounts::payroll.payslip.create_form_elements.employee'), ['class' => 'form-label required']) !!}
            {!! Form::select('employee_id', $employees, null, ['class'=>'form-control employee-select', 'required','data-validation-required-message'=>trans('validation.required', ['attribute' => trans('accounts::payroll.payslip.create_form_elements.employee')])]) !!}
            <div class="help-block"></div>
        </div>
    </div>


</div>

<!-- Name and Reference -->

<div class="row">
    <!-- Payslip Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('payslip_name', trans('accounts::payroll.payslip.create_form_elements.payslip_name'), ['class' => 'form-label']) !!}
            {!! Form::text('payslip_name',null, ['class' => 'form-control', 'readonly',
            "placeholder" => trans('labels.name')]) !!}
        </div>
    </div>

    <!-- Reference -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('reference', trans('accounts::payroll.payslip.create_form_elements.reference'), ['class' => 'form-label required']) !!}
            {!! Form::text('reference', null, ['class' => 'form-control', 'required','readonly',
            "placeholder" => "Reference"]) !!}
        </div>
    </div>

</div>


<!-- Contract and Structure -->

<div class="row">

    <!-- Select Employee Contract  -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_contract', trans('accounts::payroll.payslip.create_form_elements.contract'), ['class' => 'form-label required']) !!}
            {!! Form::select('employee_contract', $employeeContracts, null, ['class'=>'employee-contract-select form-control']) !!}
        </div>
    </div>

    <!-- Select Employee Structure -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_structure', trans('accounts::payroll.payslip.create_form_elements.structure'), ['class' => 'form-label required']) !!}
            {!! Form::select('employee_structure', $salaryStructures, null, ['class'=>'employee-structure-select form-control']) !!}
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-6">
        <!-- Bonus checkbox -->
        <div class="icheck-checkbox">
            <div class="skin skin-flat">
                <fieldset>
                    {!! Form::label('bonus',trans('accounts::pension.monthly.bonus')) !!}
                    {!! Form::checkbox('bonus',null)!!}
                </fieldset>
            </div>
        </div>
    </div>

    <div class="col-md-6 bonus-contract-div">
        <div class="form-group">
            {!!
                Form::label('bonus_structure_id', trans('accounts::payroll.payslip_batch.create_form_elements.bonus_structure'),
                        ['class' => 'form-label required'])
             !!}
            {!!
                Form::select('bonus_structure_id', $bonusStructures, null,
                        ['class'=>'bonus-structure-select form-control']
                    )
             !!}
        </div>
    </div>
</div>

<!-- Save / Cancel -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-success">
        <i class="la la-check-square-o"></i>{{trans('labels.create') }}
    </button>
    <a class="btn btn-outline-warning mr-1" role="button" href="{{url(route('payslips.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
