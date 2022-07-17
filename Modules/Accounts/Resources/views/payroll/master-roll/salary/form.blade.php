{!! Form::open(['route' =>  'master-roll.json.employee', 'class' => 'form', 'novalidate','id'=>'master-roll-salary-form']) !!}

<h4 class="form-section"><i class="la la-tag">
    </i>@lang('accounts::payroll.master_roll.create')
</h4>
<div class="row">

    <!-- Period From  -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('period_from', trans('accounts::payroll.payslip.create_form_elements.period_from'), ['class' => 'form-label']) !!}
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
    <div class="col-md-6">
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

    <!-- payment per day  -->
    {{--    <div class="col-md-4">--}}
    {{--        <div class="form-group">--}}
    {{--            {!! Form::label('payment_per_day', trans('accounts::payroll.master_roll.form_elements.payment_per_day'), ['class' => 'form-label']) !!}--}}
    {{--            {!! Form::number('payment_per_day', 345,['class' => 'form-control ', 'min'=>0 ]--}}
    {{--                )--}}
    {{--             !!}--}}
    {{--        </div>--}}
    {{--    </div>--}}

</div>

<!-- Save / Cancel -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-info" id="search">
        <i class="la la-check-square-o"></i>
        @lang('accounts::payroll.master_roll.form_elements.search_button')
    </button>
</div>

{!! Form::close() !!}
