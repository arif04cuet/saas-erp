@if($page == 'create')
    {!! Form::open(['route' =>  'monthly-pension-contracts.store', 'class' => 'form ', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['monthly-pension-contracts.update', $pensionContract->id], 'class' => 'form',
    'novalidate']) !!}
    {!! Form::hidden('id', $pensionContract->id) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::pension.contract.form')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id', trans('accounts::employee-contract.employee_name'),
            ['class' => 'form-label required']) !!}
            {!! Form::select('employee_id', $employees, $page === 'create' ?
            old('employee_id') : $pensionContract->employee_id, ['class'=>'form-control select2 required']) !!}
            <div class="help-block"></div>
            @if ($errors->has('employee_id'))
                <span class="help-block danger">{{ $errors->first('employee_id') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('ppo_number', trans('accounts::pension.contract.ppo_no'),
            ['class' => 'form-label required']) !!}
            {!!
                Form::text('ppo_number',
                    $page == 'create' ? old('ppo_number') :
                    $pensionContract->ppo_number,
                    [
                        'class' => 'form-control'.($errors->has('ppo_number') ? ' is-invalid' : ''),
                        'maxlength'=>"10",
                        'required',
                        'data-validation-required-message' =>
                        trans('validation.required', ['attribute' => __('labels.name')]), 'autocomplete' => 'off']

            ) !!}
            <div class="help-block"></div>
            @if ($errors->has('ppo_number'))
                <span class="invalid-feedback">{{ $errors->first('ppo_number') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('has_payroll_increment', trans('accounts::pension.contract.has_payroll_increment'),
            ['class' => 'form-label required']) !!}
            <ul class="list-inline">
                <li class="list-inline-item">
                    {!! Form::label('has_payroll_increment', __('labels.yes')) !!}
                    {!! Form::radio('has_payroll_increment', 1, $page == 'create' ? old('has_payroll_increment') :
$pensionContract->has_payroll_increment, ['class' => 'form-control', 'required']) !!}
                </li>
                <li class=""></li>
                <li class="list-inline-item">
                    {!! Form::label('has_payroll_increment', __('labels.no')) !!}
                    {!! Form::radio('has_payroll_increment', 0, ($page == 'create' ? old('has_payroll_increment') :
$pensionContract->has_payroll_increment) == 0 ? true : false, ['class' => 'form-control', 'required']) !!}
                </li>
            </ul>
            <div class="help-block"></div>
            @if ($errors->has('has_payroll_increment'))
                <span class="invalid-feedback">{{ $errors->first('has_payroll_increment') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('receiver', trans('accounts::pension.contract.receiver'),
            ['class' => 'form-label required']) !!}
            {!! Form::select(
                        'receiver',
                        \Modules\Accounts\Entities\MonthlyPensionContract::getReceiver(),
                        $page === 'create' ?old('receiver') : $pensionContract->receiver,
                         ['class'=>'form-control required'])
              !!}
            <div class="help-block"></div>
            @if ($errors->has('receiver'))
                <span class="invalid-feedback">{{ $errors->first('receiver') }}</span>
            @endif
        </div>
    </div>

    <!-- Nominee  -->
    <div class="col-md-6" id="nominee_dropdown">
        <div class="form-group">
            {!! Form::label('nominee_id', trans('accounts::pension.nominee.title'),
            ['class' => 'form-label required']) !!}
            {!! Form::select('nominee_id', [], $page === 'create' ?
            old('nominee_id') : $pensionContract->nominee_id, ['class'=>'form-control required']) !!}
            <div class="help-block"></div>
            @if ($errors->has('nominee_id'))
                <span class="invalid-feedback">{{ $errors->first('nominee_id') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('initial_basic', trans('accounts::pension.contract.initial_basic'),
            ['class' => 'form-label required']) !!}
            {!! Form::text('initial_basic', $page == 'create' ? old('initial_basic') :
            $pensionContract->initial_basic, ['class' => 'form-control'.($errors->has('initial_basic') ? ' is-invalid' : ''),
            'required', 'data-validation-required-message' =>
            trans('validation.required', ['attribute' => __('labels.name')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('initial_basic'))
                <span class="invalid-feedback">{{ $errors->first('initial_basic') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('current_basic', trans('accounts::pension.contract.current_basic'),
            ['class' => 'form-label required']) !!}
            {!! Form::text('current_basic', $page == 'create' ? old('current_basic') :
            $pensionContract->current_basic, ['class' => 'form-control'.($errors->has('reference') ? ' is-invalid' : ''),
            'required', "placeholder" => "", 'data-validation-required-message'=>trans('validation.required',
            ['attribute' => __('accounts::pension.contract.current_basic')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('current_basic'))
                <span class="invalid-feedback">{{ $errors->first('current_basic') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('increment', trans('accounts::employee-contract.increment'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('increment', $page == 'create' ? old('increment') :
            $pensionContract->increment,
            [
                'class' => 'form-control'.($errors->has('increment') ? ' is-invalid' : ''),
                'required',
                'min' => -1,
                'data-validation-required-message'=>trans('validation.required',
                ['attribute' => __('accounts::employee-contract.increment')]),
                'onkeydown'=>"javascript: return event.keyCode == 69 ? false : true"

            ]) !!}
            <div class="help-block"></div>
            @if ($errors->has('increment'))
                <span class="invalid-feedback">{{ $errors->first('increment') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('increment_percentage', trans('accounts::pension.contract.increment_percentage'),
            ['class' => 'form-label required']) !!}
            {!! Form::number('increment_percentage', $page == 'create' ? old('increment_percentage')?? 5 :
            $pensionContract->increment_percentage, ['class' => 'form-control'.($errors->has('increment_percentage') ? ' is-invalid' : ''),
            'required', 'min' => 0, 'data-validation-required-message'=>trans('validation.required',
            ['attribute' => __('accounts::employee-contract.increment')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('increment_percentage'))
                <span class="invalid-feedback">{{ $errors->first('increment_percentage') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('disbursement_type', trans('accounts::pension.contract.disburse_type'),
            ['class' => 'form-label required']) !!}
            {!! Form::select('disbursement_type', \Modules\Accounts\Entities\MonthlyPensionContract::getDisbursementTypes(),
            $page === 'create' ? old('receiver') : $pensionContract->disbursement_type, ['class'=>'form-control required']) !!}
            <div class="help-block"></div>
            @if ($errors->has('disbursement_type'))
                <span class="invalid-feedback">{{ $errors->first('disbursement_type') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6" id="bank_div">
        <div class="form-group">
            {!! Form::label('bank_account_information', trans('accounts::pension.contract.bank_account_info'),
            ['class' => 'form-label required']) !!}
            {!! Form::text('bank_account_information', $page == 'create' ? old('bank_account_information')?? "" :
            $pensionContract->bank_account_information, ['class' => 'form-control'.($errors->has('bank_account_information')
            ? ' is-invalid' : ''), 'min' => 0, 'required', 'data-validation-required-message' =>
            __('validation.required', ['attribute' => __('accounts::pension.contract.bank_account_info')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('bank_account_information'))
                <span class="invalid-feedback">{{ $errors->first('bank_account_information') }}</span>
            @endif
        </div>
    </div>

</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{route('monthly-pension-contracts.index')}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}
