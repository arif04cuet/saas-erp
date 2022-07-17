@if($page == 'create')
    {!! Form::open(['route' =>  ['gpf-loan-deposits.store', $loan->id], 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['gpf-loan-deposits.update', $deposit->id], 'class' => 'form']) !!}
    @method('PUT')
@endif
<h4 class=""><i class="la la-tag"></i>@lang('accounts::gpf.loan.deposit') @lang('labels.form')</h4>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>@lang('accounts::employee-contract.employee_name')</th>
                <td>{{$employee->getName()}}</td>
            </tr>
            <tr>
                <th>@lang('labels.designation')</th>
                <td>{{$employee->designation->name}}</td>
            </tr>
            <tr>
                <th>@lang('labels.id')</th>
                <td>{{$employee->employee_id}}</td>
            </tr>
            <tr>
                <th>@lang('accounts::gpf.loan.current_balance')</th>
                <td>
                    {{$loan->current_balance}}
                    <input type="hidden" value="{{$loan->current_balance}}">
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('amount', trans('labels.amount'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('amount',
            $page == 'create' ? old('amount') : $loan->amount, ['class' => 'form-control'.
            ($errors->has('amount') ? ' is-invalid' : ''), 'required', 'step' => '.01',
            'data-validation-max-max' => $loan->current_balance, 'min' => 1, 'data-validation-required-message'=>
            trans('validation.required', ['attribute' => __('labels.amount')]),
            'data-validation-max-message' => __('validation.lte.numeric', ['attribute' => __('labels.amount'),
             'value' => \App\Utilities\EnToBnNumberConverter::en2bn($loan->current_balance)])])!!}
            <div class="help-block"></div>
            @if ($errors->has('amount'))
                <span class="invalid-feedback">{{ $errors->first('amount') }}</span>
            @endif
        </div>
    </div>

    {{--<div class="col-md-6">--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('no_of_installment', trans('accounts::gpf.loan.no_of_installment'),--}}
            {{--['class' => 'form-label required']) !!}--}}
            {{--{!! Form::number('no_of_installment',--}}
            {{--$page == 'create' ? old('no_of_installment') : $loan->no_of_installment, ['class' => 'form-control'.--}}
            {{--($errors->has('stock_balance') ? ' is-invalid' : ''), 'required', 'min' => 1, 'max' => $maxInstallment ?? "",--}}
             {{--'data-validation-required-message'=>--}}
           {{--trans('validation.required', ['attribute' => __('accounts::gpf.loan.no_of_installment')])]) !!}--}}
            {{--<div class="help-block"></div>--}}
            {{--@if ($errors->has('no_of_installment'))--}}
                {{--<span class="invalid-feedback">{{ $errors->first('no_of_installment') }}</span>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('deposit_date', trans('accounts::gpf.loan.deposit_date'),
            ['class' => 'form-label required']) !!}
            {!! Form::text('deposit_date',
            $page === 'create' ? old('deposit_date') : date('d F Y', strtotime($loan->deposit_date)),
            ['class'=>'form-control required', 'required',
            'data-validation-required-message'=>trans('validation.required',
            ['attribute' => __('accounts::gpf.loan.deposit_date')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('deposit_date'))
                <div class="help-block red">{{$errors->first('deposit_date') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('remarks', trans('accounts::gpf.remark'),
            ['class' => 'form-label']) !!}
            {!! Form::textarea('remarks', $page == 'create' ? old('remarks') : $loan->remark,
            ['class' => 'form-control', 'rows' => 3]) !!}
            <div class="help-block"></div>
            @if ($errors->has('remarks'))
                <span class="invalid-feedback">{{ $errors->first('remarks') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?')">
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
                url: '{{url('accounts/gpf/loan-limit')}}/' + $(this).val(),
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $("#amount").attr('max', data);
                    $("#max_loan").val(data);
                }
            });
        });
    </script>
@endpush
