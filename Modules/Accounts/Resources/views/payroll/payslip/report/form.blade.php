{!! Form::open(['route' =>  'payslips.batch.export', 'id' =>'payslip-report-form','class' => 'form novalidate']) !!}

<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::payroll.payslip_report.form')</h4>


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

<!-- Grade and Payslip Batch -->

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

<!-- month filter -->
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
            {!! Form::label('period_to', trans('labels.end'), ['class' => 'form-label']) !!}
            {!! Form::text('period_to', \Carbon\Carbon::now()->format('F,Y'),
                    ['class' => 'form-control ']
                )
             !!}
        </div>
    </div>
</div>

<!-- report type -->
<div class="row">

    <div class="form-group col-md-6 col-xl-6">
        <label class="">@lang('accounts::payroll.payslip_report.form_elements.report_type.title')</label>
        <div class="row">
            <!-- officer -->
            <div class="col-md-auto">
                <div class="skin skin-flat">
                    {!! Form::radio('report_type', 'individual',true, ['class' => 'required']) !!}
                    <label
                        for="report_type">@lang('accounts::payroll.payslip_report.form_elements.report_type.officer')</label>
                </div>
            </div>
            <!-- cash -->
            <div class="col-md-auto">
                <div class="skin skin-flat">
                    {!! Form::radio('report_type', 'cash', null, ['class' => 'required']) !!}
                    <label
                        for="report_type">@lang('accounts::payroll.payslip_report.form_elements.report_type.cash')</label>
                </div>
            </div>
            <!-- bank -->
            <div class="col-md-auto">
                <div class="skin skin-flat">
                    {!! Form::radio('report_type', 'bank', null, ['class' => 'required']) !!}
                    <label
                        for="report_type">@lang('accounts::payroll.payslip_report.form_elements.report_type.bank')</label>
                </div>
            </div>
            <!-- sector -->
            <div class="col-md-auto">
                <div class="skin skin-flat">
                    {!! Form::radio('report_type', 'sector', null, ['class' => 'required']) !!}
                    <label
                        for="report_type">@lang('accounts::payroll.payslip_report.form_elements.report_type.sector')</label>
                </div>
            </div>
            <!-- GPF -->
            <div class="col-md-auto">
                <div class="skin skin-flat">
                    {!! Form::radio('report_type', 'gpf', null, ['class' => 'required']) !!}
                    <label
                        for="report_type">@lang('accounts::payroll.payslip_report.form_elements.report_type.gpf')</label>
                </div>
            </div>

        </div>
    </div>

    <!-- Salary Rule -->
    <div class="col-md-6">
        <div class="form-group rule-select">
            {!! Form::label('salary_rules[]', trans('accounts::payroll.payslip_report.form_elements.salary_rule'), ['class' => 'form-label ']) !!}
            {!!
                     Form::select('salary_rules[]', $salaryRules, null, ['class'=>'form-control sector-select ','multiple'=>'multiple'])
             !!}
        </div>
    </div>


</div>

<!-- PRL employee checkbox -->
<div class="row">
    <div class="col-md-6 col-xl-6">
        <div class="skin skin-flat">
            <fieldset>
                {!!
                    Form::label('only_prl_employee',
                    trans('accounts::payroll.payslip_report.form_elements.only_prl_employee'))
                !!}
                {!! Form::checkbox('only_prl_employee',null)!!}
            </fieldset>
        </div>
    </div>
</div>

<div class="text-center">
    <!-- Search Button -->
    <a class="ft ft-search btn btn-success" id="search">
        @lang('accounts::payroll.payslip_report.form_elements.search')
    </a>

    <!-- Export -->
    <button type="submit" class="ft ft-download btn btn-info" id="export"
            href="{{url(route('payslips.batch.export'))}}">
        @lang('accounts::payroll.payslip_report.form_elements.export')
    </button>

</div>


{!! Form::close() !!}
