@if($page == 'create')
    {!! Form::open(['route' =>  'gpf-loans.store', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['gpf-loans.update', $loan->id], 'class' => 'form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::gpf.loan.form_title')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id', trans('accounts::employee-contract.employee_name'),
            ['class' => 'form-label required']) !!}
            {!! Form::select('employee_id',['' => __('labels.select')] + $employees,
            $page == 'create' ? old('employee_id') : $loan->employee_id,
            ['class' => 'form-control select2'.($errors->has('employee_id') ? ' is-invalid' : ''), 'required',
            'data-validation-required-message'=>trans('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('employee_id'))
                <span class="invalid-feedback">{{ $errors->first('employee_id') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('sanction_date', trans('accounts::gpf.loan.sanction_date'),
            ['class' => 'form-label required']) !!}
            {!! Form::text('sanction_date',
            $page === 'create' ? old('sanction_date') : date('d F Y', strtotime($loan->sanction_date)),
            ['class'=>'form-control required', 'required',
            'data-validation-required-message'=>trans('validation.required',
            ['attribute' => __('accounts::gpf.loan.sanction_date')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('sanction_date'))
                <div class="help-block red">{{$errors->first('sanction_date') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group" id="amount_div">
            {!! Form::label('amount', trans('accounts::gpf.loan.amount'),
            ['class' => 'form-label']) !!}
            <span>(@lang('accounts::gpf.loan.loan_limit'):</span>
            <span id='loan_limit'>0</span>)
            <span class="danger">*</span>
            {!! Form::number('amount',
            $page == 'create' ? old('amount') : $loan->amount, ['class' => 'form-control'.
            ($errors->has('amount') ? ' is-invalid' : ''), 'required', 'step' => '.01', 'data-validation-min-min' => 1,
            'data-validation-min-message' => __('validation.min.numeric', ['attribute' => __('accounts::gpf.loan.amount'),
            'min' => 1]),
            'data-validation-required-message'=> __('validation.required',
            ['attribute' => __('accounts::gpf.loan.amount')]),
            'data-validation-max-message' => __('accounts::gpf.loan.loan_limit_message')
            ])!!}
            <div class="help-block"></div>
            <input type="number" step=".01" class="hidden" name="max_loan" id="max_loan" value="{{$loanLimit?? 0}}">
            @if ($errors->has('amount'))
                <span class="invalid-feedback">{{ $errors->first('amount') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('no_of_installment', trans('accounts::gpf.loan.no_of_installment'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('no_of_installment',
            $page == 'create' ? old('no_of_installment') : $loan->no_of_installment, ['class' => 'form-control'.
            ($errors->has('stock_balance') ? ' is-invalid' : ''), 'required', 'min' => 1,
             'data-validation-required-message'=>
           trans('validation.required', ['attribute' => __('accounts::gpf.loan.no_of_installment')]),
           'data-validation-max-max' => $maxInstallment ?? 0,
           'data-validation-max-message' => __('accounts::gpf.loan.installment_limit_message'),
           ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('no_of_installment'))
                <span class="invalid-feedback">{{ $errors->first('no_of_installment') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('current_balance', trans('accounts::gpf.loan.current_balance'),
            ['class' => 'form-label']) !!}
            {!! Form::number('current_balance',
            $page == 'create' ? old('current_balance') : $loan->current_balance, ['class' => 'form-control'.
            ($errors->has('current_balance') ? ' is-invalid' : ''), 'data-validation-required-message'=>
           trans('validation.required', ['attribute' => __('accounts::gpf.current_balance')]), 'min' => 0]) !!}
            <div class="help-block"></div>
            @if ($errors->has('current_balance'))
                <span class="invalid-feedback">{{ $errors->first('current_balance') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('remark', trans('accounts::gpf.remark'),
            ['class' => 'form-label']) !!}
            {!! Form::textarea('remark', $page == 'create' ? old('remark') : $loan->remark,
            ['class' => 'form-control', 'rows' => 3]) !!}
            <div class="help-block"></div>
            @if ($errors->has('remark'))
                <span class="invalid-feedback">{{ $errors->first('remark') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('gpf-loans.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}

@push('page-js')
    <script>
        $("#employee_id").change(function () {
            $.ajax({
                beforeSend: function () {
                    //$("#amount").remove();
                    $("input").jqBootstrapValidation("destroy");
                    console.log('jq destroyed')
                },
                url: '{{url('accounts/gpf/loan-limit')}}/' + $(this).val(),
                type: 'get',
                dataType: 'text',
                success: function (data) {
                    // $input = $('<input/>')
                    //     .attr('type', "number")
                    //     .attr('name', "amount")
                    //     .attr('class', "form-control")
                    //     .attr('id', "amount");
                    //$("#amount_div").append($input);
                    $("#amount").attr('data-validation-max-max', data);
                    $("#max_loan").val(data);
                    $("#loan_limit").html(data);
                },
                complete: function () {
                    $("input").not("[type=submit]").jqBootstrapValidation();
                    console.log('jq initiated ');
                }
            });
        });
    </script>
@endpush
