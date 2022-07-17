{!! Form::open(['route' =>  'prl.store', 'class' => 'form']) !!}



<!-- Employee and Basic Salary  -->
<div class="row">
    <!--Select Employee-->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id', trans('accounts::prl.form_elements.employee'), ['class' => 'form-label required']) !!}
            {!! Form::select('employee_id', $employees, null, ['class'=>'form-control employee-select', 'required' ]) !!}
        </div>
    </div>

    <!--Basic Salary -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('basic_salary',trans('accounts::prl.form_elements.basic_salary'), ['class' => 'form-label']) !!}
            {!! Form::number('basic_salary',null, ['class' => 'form-control', 'readonly',
            "placeholder" => trans('labels.name')]) !!}
        </div>
    </div>
</div>

<div class="row">
    <!-- start date  -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('start_date', trans('accounts::prl.form_elements.start_date'), ['class' => 'form-label']) !!}
            {!! Form::text('start_date', null,
                    ['class' => 'form-control required','readonly']
                )
             !!}
        </div>
    </div>

    <!-- end date  -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('end_date', trans('accounts::prl.form_elements.end_date'), ['class' => 'form-label']) !!}
            {!! Form::text('end_date', null,['class' => 'form-control', 'readonly',])
             !!}
        </div>
    </div>
</div>


<!-- Eligible Month and Amount  -->
<div class="row">

    <!-- eligible month -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('eligible_month', trans('accounts::prl.form_elements.eligible_month'),
                                              ['class' => 'form-label required']) !!}
            {!! Form::number('eligible_month',0, ['class'=>'form-control', 'required','min'=>0,'max'=>18])
              !!}
        </div>
    </div>

    <!-- total amount-->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('total_amount',trans('accounts::prl.form_elements.total_amount'), ['class' => 'form-label']) !!}
            {!! Form::number('total_amount',0, ['class' => 'form-control', 'readonly',
            "placeholder" => trans('labels.name')]) !!}
        </div>
    </div>

</div>


<!-- Disbursed -->
<div class="row icheck-checkbox">

    <!-- Disbursed checkbox -->
    <div class="col-md-12">
        <div class="skin skin-flat">
            <fieldset>
                {!! Form::label('disbursed',trans('accounts::pension.lump_sum.form_elements.disbursed')) !!}
                {!! Form::checkbox('disbursed',null)!!}
            </fieldset>
        </div>
    </div>

</div>


<!-- Save / Cancel -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-outline-success">
        <i class="la la-check-square-o"></i>{{trans('labels.save') }}
    </button>
    <a class="btn btn-outline-warning mr-1" role="button" href="{{route('prl.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
