{!! Form::open(['route' =>  'advance-payment.index', 'id' =>'advance-payment-form','class' => 'form novalidate']) !!}

<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::journal.entry.advance_payment.title')</h4>
<!-- Employee and Structure -->
<div class="row">

    <!-- Fiscal Year -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('fiscal_year_id',
                     trans('accounts::fiscal-year.title'),
                    ['class' => 'form-label '])
            !!}
            {!!
                   Form::select('fiscal_year_id', $fiscalYears, null,
                  [
                         'class'=>'form-control select2',
                         'placeholder'=>trans('labels.all')
                 ])
           !!}
        </div>
    </div>

    <!-- Employee Dropdown  -->
    <div class="col-6">
        <div class="form-group employee-dropdown">
            {!! Form::label('employee_id', trans('accounts::journal.entry.table.employee'),
                ['class' => 'form-label'])
            !!}
            {!! Form::select('employee_id', $employees, null,
                [
                    'class' => "form-control dropdown-select", "placeholder" => trans('accounts::journal.entry.table.employee'),
                ]
            )!!}
        </div>
    </div>
</div>


<div class="text-center">
    <!-- Search Button -->
    <a class="ft ft-search btn btn-success" id="search">
        @lang('accounts::payroll.payslip_report.form_elements.search')
    </a>
</div>


{!! Form::close() !!}
