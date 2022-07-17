@if($action == 'create')
    {!! Form::open(['route' =>  'lump-sum.store', 'class' => 'form lump-sum-form']) !!}
@elseif($action == 'edit')
    {!! Form::open(['route' =>  ['lump-sum.update',$employeeLumpSum->id], 'class' => 'form']) !!}
    @method('PUT')
@endif

<!-- Employee and Basic Salary  -->
<div class="row">

    <!--Select Employee-->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id', trans('accounts::pension.lump_sum.form_elements.employee'),
                                ['class' => 'form-label required']) !!}
            {!! Form::select('employee_id', ['' => __('labels.select')] + $employees, $action =='create' ? old('employee_id') : $employeeLumpSum->employee_id,
                    ['class'=>'form-control employee-select', 'required' ]) !!}
        </div>
    </div>

    <!--Basic Salary -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('basic_salary',trans('accounts::pension.lump_sum.form_elements.basic_salary'),
                ['class' => 'form-label']) !!}
            {!! Form::number('basic_salary', $action =='create' ? old('basic_salary') : $employeeLumpSum->basic_salary,
                         ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
</div>

<!-- Eligible Pension and Monthly Pension  -->
<div class="row">

    <!-- Eligible pension -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('eligible_pension', trans('accounts::pension.lump_sum.form_elements.eligible_pension'),
                                              ['class' => 'form-label']) !!}
            {!! Form::number('eligible_pension',$action =='create' ? old('eligible_pension') : $employeeLumpSum->eligible_pension, ['class'=>'form-control','readonly','required',])
              !!}
        </div>
    </div>

    <!-- Monthly Pension -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('monthly_pension',trans('accounts::pension.lump_sum.form_elements.monthly_pension'),
                                      ['class' => 'form-label'])
            !!}
            {!! Form::number('monthly_pension',$action =='create' ? old('monthly_pension') : $employeeLumpSum->monthly_pension,
                                     ['class' => 'form-control', 'readonly' ])
            !!}
        </div>
    </div>

    <!-- Total pension -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('total_pension', trans('accounts::pension.lump_sum.form_elements.lump_sum'),
                                              ['class' => 'form-label']) !!}
            {!! Form::number('total_pension', $action =='create' ? old('total_pension') :
$employeeLumpSum->eligible_pension, ['class'=>'form-control','readonly','required',])
              !!}
        </div>
    </div>

    <!-- Disbursed checkbox -->
    <div class="col-md-3">
        <div class="skin skin-flat">
            <fieldset>
                {!! Form::label('disbursed',trans('accounts::pension.lump_sum.form_elements.disbursed')) !!}
                @if($action === 'create')
                    <p>
                        {!! Form::checkbox('disbursed',null)!!}
                    </p>
                @else
                    @if($employeeLumpSum->status === \Modules\Accounts\Entities\EmployeeLumpSum::status[0])
                        <p>
                            {!! Form::checkbox('disbursed',null)!!}
                        </p>
                    @else
                        <p>
                            {!! Form::checkbox('disbursed',null,true)!!}
                        </p>
                    @endif
                @endif
            </fieldset>
        </div>
    </div>

</div>

<!-- Lump Sum -->
<div class="row">


    <!-- Lump Sum Nominee -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('receiver', trans('accounts::pension.lump_sum.form_elements.receiver'),
                ['class' => 'form-label']) !!}
            {!! Form::select('receiver', \Modules\Accounts\Entities\EmployeeLumpSum::getReceiver(), $action =='create' ?
                                old('receiver') : $employeeLumpSum->receiver,
                ['class'=>'form-control', 'required' ]) !!}
        </div>
    </div>

    <!-- Nominee  -->
    <div class="col-md-6" id="nominee_dropdown">
        <div class="form-group">
            {!! Form::label('nominee_id', trans('accounts::pension.nominee.title'),
            ['class' => 'form-label required']) !!}
            {!! Form::select('nominee_id', [], $action === 'create' ?
            old('nominee_id') : $employeeLumpSum->nominee_id, ['class'=>'form-control required']) !!}
            <div class="help-block"></div>
            @if ($errors->has('nominee_id'))
                <span class="invalid-feedback">{{ $errors->first('nominee_id') }}</span>
            @endif
        </div>
    </div>


</div>


@include('accounts::lump-sum.deduction-form')


<div class="row">
    <div class="col-12 text-center">
        {!! Form::label('lump_sum_amount', trans('accounts::pension.lump_sum.form_elements.total_lump_sum'),
                                          ['class' => 'form-label h3 font-weight-bold']) !!}
        {!! Form::number('lump_sum_amount',$action =='create' ? 0 : $employeeLumpSum->lump_sum_amount,
                                ['class'=>'form-control lump-sum-amount text-center','readonly','min'=>0])
        !!}
    </div>
</div>

<!-- Save / Cancel -->
<div class="form-actions text-center">

    <button type="submit" class="btn btn-outline-success">
        <i class="la la-check-square-o"></i>{{trans('labels.save') }}
    </button>

    <a class="btn btn-outline-warning mr-1" role="button" href="{{route('lump-sum.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}
