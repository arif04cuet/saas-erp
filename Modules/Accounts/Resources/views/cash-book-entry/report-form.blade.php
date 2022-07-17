{!! Form::open(['route' =>  'cash-book-entry.filter', 'id' =>'cash-book-entry-form','class' => 'form novalidate']) !!}

<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::journal.entry.cash_book.report')</h4>


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

    <!-- Journal -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('journal_id',
                     trans('accounts::journal.title'),
                    ['class' => 'form-label '])
            !!}
            {!!
                   Form::select('journal_id', $journals, null,
                  [
                         'class'=>'form-control select2',
                         'placeholder'=>trans('labels.all')
                     ])

           !!}

        </div>
    </div>

    <!-- Transaction Type -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('account_transaction_type', trans('accounts::journal.entry.detail.transaction_type.title'),
            ['class' => 'form-label ']) !!}
            {!!
                    Form::select('account_transaction_type', Config('constants.journal_entry.dropdown.account_transaction_type'), null,
                     [
                         'class'=>'form-control select2',
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
