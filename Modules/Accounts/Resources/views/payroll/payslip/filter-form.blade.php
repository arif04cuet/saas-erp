{!! Form::open(['route' =>  'payslips.batch.export', 'id' =>'payslip-filter-form','class' => 'form novalidate']) !!}

<h4 class="form-section"><i class="la la-tag"></i>
    @lang('accounts::payroll.payslip.title')
    @lang('accounts::payroll.payslip_report.form_elements.search')
</h4>


<!-- Employee and Structure -->
<div class="row">

    <!--Select Employee-->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id[]',
                     trans('accounts::payroll.payslip.create_form_elements.employee'),
                    ['class' => 'form-label '])
            !!}
            {!!
                   Form::select('employee_id[]', $employees, null,
                   ['class'=>'form-control employee-select','multiple'=>'multiple'])
           !!}

        </div>
    </div>

    <!-- Select Salary Structure -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('salary_structures[]', trans('accounts::payroll.payslip.create_form_elements.structure'),
            ['class' => 'form-label ']) !!}
            {!!
                    Form::select('salary_structures[]', $salaryStructures, null,
                     ['class'=>'form-control employee-select','multiple'=>'multiple'])
            !!}
        </div>
    </div>

</div>

<!-- Grade and Payslip Period -->
<div class="row">
    <!-- Salary Grade -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('salary_grade[]', trans('accounts::payroll.payslip_report.form_elements.salary_grade'),
                ['class' => 'form-label'])
            !!}
            {!!
                    Form::select('salary_grade[]', $grades, null, ['class'=>'form-control employee-select','multiple'=>'multiple'])
            !!}
        </div>
    </div>

    <!-- payslip type -->
    <div class="col-md-6 col-xl-6">
        <div class="form-group">
            {!! Form::label('type', trans('accounts::payroll.payslip.type'),
                ['class' => 'form-label'])
            !!}
            {!!
                    Form::select('type', $types, null,
                        [
                            'class'=>'form-control',
                        ])
            !!}
        </div>
    </div>
</div>
<div class="row">

    <!--Payslip Month -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('period_from', trans('labels.start'), ['class' => 'form-label']) !!}
            {!! Form::text('period_from', \Carbon\Carbon::now()->format('F,Y'),
                    ['class' => 'form-control ']
                )
             !!}
        </div>
    </div>

    <!--Payslip Month -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('period_tp', trans('labels.end'), ['class' => 'form-label']) !!}
            {!! Form::text('period_to', \Carbon\Carbon::now()->format('F,Y'),
                    ['class' => 'form-control ']
                )
             !!}
        </div>
    </div>
</div>

<!-- button -->
<div class="text-center">
    <!-- Search Button -->
    <a class="ft ft-search btn btn-success" id="search">
        @lang('accounts::payroll.payslip_report.form_elements.search')
    </a>
</div>


{!! Form::close() !!}
