{!! Form::open(['route' =>  'account-transaction-history.filter', 'id' =>'transaction-history-form','class' => 'form novalidate']) !!}

<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::journal.history.report')</h4>


<!-- Employee and Structure -->
<div class="row">

    <!-- Economy Codes -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('economy_code',
                     trans('accounts::journal.history.economy_code'),
                    ['class' => 'form-label  '])
            !!}
            {!!
                   Form::select('economy_code', $economyCodes, null,
                   [
                         'class'=>'form-control select2',
                         'placeholder'=>trans('labels.all')
                     ])

           !!}

        </div>
    </div>

    <!-- Fiscal Year -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('fiscal_year_id', trans('accounts::journal.history.fiscal_year'),
            ['class' => 'form-label ']) !!}
            {!!
                    Form::select('fiscal_year_id', $fiscalYears, null,
                    [
                         'class'=>'form-control',
                         'placeholder'=>trans('labels.all')
                     ])

            !!}
        </div>
    </div>

    <!-- Source Type -->
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('source', trans('accounts::journal.entry.detail.source.title'),
            ['class' => 'form-label ']) !!}
            {!!
                    Form::select('source', Config('constants.journal_entry.dropdown.source'), null,
                     [
                         'class'=>'form-control',
                         'placeholder'=>trans('labels.all')
                     ])
            !!}
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
