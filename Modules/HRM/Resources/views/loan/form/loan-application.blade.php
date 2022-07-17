@if($page == 'create')
    {!! Form::open(['url' =>  route('employee-loans.store'), 'class' => 'form', 'novalidate', 'files' => 'true']) !!}
@else
    {!! Form::open(['url' =>  route('employee-loans.update'), 'class' => 'form', 'novalidate', 'method' => 'put', 'files' => 'true']) !!}
@endif

<div class="form-body">
    <h4 class="form-section"><i class="ft-grid"></i> @lang('hrm::employee.loan.form') </h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="employee_loan_circular_id" class="form-label required">
                    @lang('hrm::employee.loan.circular.title') @lang('labels.select')
                </label>
                {!! Form::select(
                            'employee_loan_circular_id',
                            $circulars,
                            $page == 'create' ? old('employee_loan_circular_id') : $loan->employee_loan_circular_id,
                            [
                                'class' => 'form-control select2',
                                'required' => 'required',
                                'data-msg-required' => __('labels.This field is required')
                            ]
                             )
                 !!}
                @if ($errors->has('employee_loan_circular_id'))
                    <span class="help-block red invalid-feedback"
                          role="alert"><strong>{{ $errors->first('employee_loan_circular_id') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="employee_id" class="form-label required">
                    @lang('hrm::employee.menu_name') @lang('labels.select')
                </label>
                {!! Form::select(
                            'employee_id',
                            ['' => ''] + $employees->toArray(),
                            $page == 'create' ? old('employee_id') : $loan->employee_id,
                            [
                                'class' => 'form-control select2',
                                'required' => 'required',
                                'data-msg-required' => __('labels.This field is required')
                            ]
                             )
                 !!}
                @if ($errors->has('employee_id'))
                    <span class="help-block red invalid-feedback"
                          role="alert"><strong>{{ $errors->first('employee_id') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="type" class="form-label required">{{trans('hrm::employee.loan.type')}}</label>
                {!! Form::select(
                            'type',
                            ['' => __('labels.select')] + __('hrm::employee.loan.types'),
                            $page == 'create' ? old('type') : $loan->type,
                            [
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-msg-required' => __('labels.This field is required')
                             ]
                            )
                 !!}
                <div class="help-block"></div>
                @if ($errors->has('type'))
                    <span class="help-block red invalid-feedback"
                          role="alert"><strong>{{ $errors->first('type') }}</strong></span>
                @endif
            </div>
        </div>

        <!-- Previous Loan -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="type" class="form-label">
                   @lang('hrm::employee.loan.previous_loan') (@lang('hrm::employee.loan.previous_loan_tick'))
                </label>

                <table class="table">
                    <tr>
                        <td>
                            <ul class="list-inline">
                                @foreach(__('hrm::employee.loan.types') as $key => $type)
                                    <li class="list-inline-item">
                                        <div class="skin skin-flat">
                                            <label for="{{$type}}">{{$type}}</label>
                                            {{Form::checkbox('previous_loan_type[]', $key, null, ['id' => $key])}}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </td>
                    </tr>
                </table>

                @if ($errors->has('type'))
                    <span class="help-block red invalid-feedback"
                          role="alert"><strong>{{ $errors->first('type') }}</strong></span>
                @endif
            </div>
        </div>

        <!-- Association Loan -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="association_loan" class="form-label">
                    {{trans('hrm::employee.loan.association_loan')}}
                </label>
                <div class="row">
                    <div class="col-2">
                        <div class="skin skin-flat">
                            {!! Form::checkbox('association_loan', '1', false, ['id' => 'association_loan']) !!}
                        </div>
                    </div>
                    <div class="col-8">
                        {!! Form::number('association_loan_amount', null,
                                [
                                    'class' => 'form-control',
                                    'step' => '0.01',
                                    'id' => 'association_loan_amount',
                                    'placeholder' => __('hrm::employee.loan.loan_amount'),
                                    'data-msg-required' => __('labels.This field is required')
                                 ]) !!}
                    </div>
                </div>

                @if ($errors->has('association_loan'))
                    <span class="help-block red invalid-feedback"
                          role="alert"><strong>{{ $errors->first('association_loan') }}</strong></span>
                @endif
            </div>
        </div>

        <!-- Bank Loan -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="type" class="form-label required">{{trans('hrm::employee.loan.bank_loan')}}</label>
                <div class="row">
                    <div class="col-1">
                        <div class="skin skin-flat">
                            {!! Form::checkbox('bank_loan', '1', false, ['id' => 'bank_loan']) !!}
                        </div>
                    </div>
                    <div class="col-6">
                        {!! Form::text('bank_name', null,
                                [
                                    'class' => 'form-control',
                                    'id' => 'bank_name',
                                    'placeholder' => __('hrm::employee.loan.bank_name'),
                                    'data-msg-required' => __('labels.This field is required')
                                 ]) !!}
                    </div>
                    <div class="col-5">
                        {!! Form::number('bank_loan_amount', null,
                                [
                                    'class' => 'form-control',
                                    'step' => '0.01',
                                    'id' => 'bank_loan_amount',
                                    'placeholder' => __('hrm::employee.loan.loan_amount'),
                                    'data-msg-required' => __('labels.This field is required')
                                 ]) !!}
                    </div>
                </div>
                @if ($errors->has('bank_loan'))
                    <span class="help-block red invalid-feedback"
                          role="alert"><strong>{{ $errors->first('bank_loan') }}</strong></span>
                @endif
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="reason" class="form-label required">{{trans('hrm::employee.loan.reason')}}</label>
                <textarea class="form-control" name="reason" id="reason" required="required"
                          data-msg-required="{{trans('validation.required', ['attribute' => trans('hrm::employee.loan.reason')])}}">{{ $page == 'create' ? old('reason') : $loan->reason }}</textarea>
                <div class="help-block"></div>
                @if ($errors->has('reason'))
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $errors->first('reason') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
        <i class="ft-check-square"></i> {{trans('hrm::employee.loan.apply_button')}}
    </button>
    <button class="btn btn-warning" type="button" onclick="window.location = '{{route('employee-loans.index')}}'">
        <i class="ft-x"></i> {{trans('labels.cancel')}}
    </button>
</div>

{!! Form::close() !!}

@push('page-js')
    <script>
        $('.select2').select2({
            placeholder: " {{__('labels.select')}}"
        });

        $('#association_loan_amount').hide();
        $('#bank_name').hide();
        $('#bank_loan_amount').hide();

        $('#association_loan').on('ifChanged', function () {
            if (this.checked) {
                $('#association_loan_amount').show();
                $('#association_loan_amount').attr('required', 'required');
            } else {
                $('#association_loan_amount').hide();
                $('#association_loan_amount').removeAttr('required');
                $('#association_loan_amount-error').remove();
            }
        });

        $('#bank_loan').on('ifChanged', function () {
            if (this.checked) {
                $('#bank_name').show();
                $('#bank_loan_amount').show();
                $('#bank_name').attr('required', 'required');
                $('#bank_loan_amount').attr('required', 'required');
            } else {
                $('#bank_name').hide();
                $('#bank_loan_amount').hide();
                $('#bank_name').removeAttr('required');
                $('#bank_loan_amount').removeAttr('required');
                $('#bank_name-error').remove();
                $('#bank_loan_amount-error').remove();
            }
        });

        $('.form').submit(function () {
            return confirm("{{__('labels.confirm_action')}}");
        });
    </script>
@endpush
