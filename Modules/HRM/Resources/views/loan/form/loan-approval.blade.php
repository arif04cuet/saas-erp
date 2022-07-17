@if($page == 'create')
    {!! Form::open(['url' =>  route('employee-loans.approval', $loan->id), 'class' => 'form', 'novalidate', 'files' => 'true']) !!}
@else
    {!! Form::open(['url' =>  route('employee-loans.update'), 'class' => 'form', 'novalidate', 'method' => 'put', 'files' => 'true']) !!}
@endif

<div class="form-body">
    <div class="row">
        <div class="col-6">
            <h5 class="form-section"><i class="ft ft-user"></i> @lang('hrm::employee.list_title')</h5>
            <table class="table table-striped table-borderless">
                <tr>
                    <th>@lang('labels.name')</th>
                    <td>{{ $employee->getName() ?? __('labels.not_found') }}</td>
                </tr>
                <tr>
                    <th>@lang('labels.designation')</th>
                    <td>{{ optional($employee->designation)->getName() ?? __('labels.not_found') }}</td>
                </tr>
                <tr>
                    <th>@lang('hrm::department.department')</th>
                    <td>{{ optional($employee->employeeDepartment)->name ?? __('labels.not_found') }}</td>
                </tr>
                <tr>
                    <th>@lang('hrm::personal_info.joining_date')</th>
                    <td>
                        {{ $employee->employeePersonalInfo->job_joining_date ?
 \App\Utilities\MonthNameConverter::convertMonthToBn($employee->employeePersonalInfo->job_joining_date, false, true) :
 __('labels.not_found') }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 30%">@lang('hrm::employee.date_of_retirement')</th>
                    <td>
                        {{ $employee->employeePersonalInfo->job_joining_date ?
\App\Utilities\MonthNameConverter::convertMonthToBn(\Carbon\Carbon::parse($employee->employeePersonalInfo->date_of_birth)->addYears(59)->format('Y-m-d'), false, true)
  : __('labels.not_found') }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <h5 class="form-section">
                <i class="ft ft-file-text"></i>
                @lang('hrm::employee.loan.apply') @lang('labels.details')
            </h5>
            <table class="table table-striped table-borderless">
                <th style="width: 30%">
                    @lang('hrm::employee.loan.circular.title')
                    @lang('hrm::employee.loan.circular.reference_no')
                </th>
                <td>
                    <strong>
                        {{ optional($loan->circular)->reference_no ?? __('labels.not_found')}}
                    </strong>
                </td>
                <tr>
                    <th style="width: 40%">@lang('hrm::employee.loan.type')</th>
                    <td>{{ __('hrm::employee.loan.types.'. $loan->type) }}</td>
                </tr>
                <tr>
                    <th>@lang('hrm::employee.loan.apply_date')</th>
                    <td>
                        {{ \App\Utilities\MonthNameConverter::convertMonthToBn($loan->created_at, false, true) }}
                    </td>
                </tr>
                <tr>
                    <th>@lang('hrm::employee.loan.reason')</th>
                    <td>
                        {{ $loan->reason }}
                    </td>
                </tr>
                <tr>
                    <th>@lang('hrm::employee.loan.previous_loan')</th>
                    <td>
                        <ul class="list-inline">
                            @php
                                $previousLoans = explode(',', $loan->previous_loans);
                            @endphp
                            @foreach($previousLoans as $previousLoan)
                                <li class="list-inline-item">
                                    <span type="button" class="badge badge-info">
                                        @lang('hrm::employee.loan.types.' . trim($previousLoan))
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>@lang('hrm::employee.loan.association_loan')</th>
                    <td>
                        {{ $loan->association_loan ? __('labels.yes') : __('labels.no') }}
                    </td>
                </tr>
                @if($loan->association_loan)
                    <tr>
                        <th>@lang('hrm::employee.loan.loan_amount')</th>
                        <td>
                            {{ \App\Utilities\EnToBnNumberConverter::en2bn($loan->association_loan_amount, true, 2) }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>@lang('hrm::employee.loan.bank_loan')</th>
                    <td>
                        {{ $loan->bank_loan ? __('labels.yes') : __('labels.no') }}
                    </td>
                </tr>
                @if($loan->bank_loan)
                    <tr>
                        <th>@lang('hrm::employee.loan.loan_amount')</th>
                        <td>
                            {{ \App\Utilities\EnToBnNumberConverter::en2bn($loan->bank_loan_amount, true, 2) }}
                            ({{ $loan->bank_name }})
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>

    <h4 class="form-section">@lang('hrm::employee.loan.info')</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="reference_no" class="form-label required">
                    @lang('hrm::employee.loan.reference_no')
                </label>
                <input name="reference_no" id="reference_no" class="form-control" type="text" required
                       data-msg-required="{{__('labels.This field is required')}}">
                @if ($errors->has('reference_no'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('reference_no') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="amount" class="form-label required">{{trans('hrm::employee.loan.amount')}}</label>
                <input type="number" class="form-control" data-rule-min="1" min="1"
                       data-msg-min="{{__('validation.gte.numeric', ['attribute' => __('hrm::employee.loan.amount'), 'value' => __('labels.digits.1')])}}"
                       name="amount" id="amount" value="{{ old('amount') }}" required
                       data-msg-required="{{trans('validation.required', ['attribute' => trans('hrm::employee.loan.amount')])}}">
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('start_date') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="installment"
                       class="form-label required">{{trans('hrm::employee.loan.installment')}}</label>
                <input type='number' class="form-control required" value="{{ old('installment') }}"
                       id="installment" name="installment" required data-rule-min="1" min="1"
                       data-msg-min="{{__('validation.gte.numeric', ['attribute' => __('hrm::employee.loan.installment'), 'value' => __('labels.digits.1')])}}"
                       data-msg-required="{{trans('validation.required', ['attribute' => trans('hrm::employee.loan.installment')])}}">
                <div class="help-block"></div>
                @if ($errors->has('installment'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('installment') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="attachment" class="form-label">{{trans('labels.attachments')}}</label>
                <input name="attachment" id="attachment" class="form-control" type="file">
                <div class="help-block"></div>
                @if ($errors->has('attachment'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('attachment') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="remarks" class="form-label">@lang('labels.remarks')</label>
                <textarea name="remarks" id="remarks" class="form-control" maxlength="255"
                          placeholder="{{__('labels.remarks') . ': ' . __('labels.At most 255 characters')}} "></textarea>
            </div>
        </div>
    </div>

</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{trans('labels.approve')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{route('employee-loans.index')}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>

{!! Form::close() !!}

@push('page-js')
    <script>
        $('.select2').select2({
            placeholder: " {{__('labels.select')}} "
        });
    </script>
@endpush
