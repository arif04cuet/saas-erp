@if($page == 'create')
    {!! Form::open(['route' =>  'payslips-workflow.post-create', 'class' => 'form', 'novalidate']) !!}
@else
    {!! Form::open(['route' =>  'payslips-workflow.store', 'class' => 'form store-approval-form', 'novalidate']) !!}
@endif
<h4 class="form-section"><i class="la la-tag"></i>
    @lang('accounts::payroll.payslip.approval')
    @lang('labels.form')
</h4>

<div class="row">
    <!--Select Employee-->
    <!-- Payslip Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('payslip_batch_id', trans('accounts::payroll.payslip.drafts_or_batch'),
 ['class' => 'form-label required']) !!}
            <select name="payslip_batch_id" class="form-control select2">
                <option value="">@lang('labels.select')</option>
                <optgroup label="{{__('labels.draft')}}">
                    <option value="draft" {{$selectedPayslipBatch == 'draft' ? 'selected' : ''}}>
                        @lang('accounts::payroll.payslip.all_drafts')
                    </option>
                </optgroup>
                <optgroup label="{{__('accounts::payroll.payslip_batch.title')}}">
                    @foreach($payslipBatches as $key => $payslipBatch)
                        <option value="{{$key}}" {{$selectedPayslipBatch == $key ? 'selected' : ''}}>
                            {{$payslipBatch}}
                        </option>
                    @endforeach
                </optgroup>
            </select>
            <div class="help-block"></div>
            @if ($errors->has('description'))
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>
    <!-- Journal -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('journal_id', trans('accounts::journal.title'), ['class' => 'form-label']) !!}
            {!! Form::select('journal_id',$journals, $selectedJournal, ['class' => 'form-control select2']) !!}
            <div class="help-block"></div>
            @if ($errors->has('journal_id'))
                <span class="invalid-feedback">{{ $errors->first('journal_id') }}</span>
            @endif
        </div>
    </div>
    <!-- Payable Economy Code -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('payable_code', trans('accounts::payroll.payslip.payable_economy_code'),
['class' => 'form-label required']) !!}
            {!! Form::select('payable_code',$economyCodes, $selectedEconomyCode, ['class' => 'form-control select2',
'required', 'data-validation-required-message' => __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('payable_code'))
                <span class="invalid-feedback">{{ $errors->first('payable_code') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <h3 class="card-title">@lang('accounts::payroll.payslip.draft_list')</h3>
            <hr>
            <table class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                <tr>
                    <th>@lang('labels.serial')</th>
                    <th width="5%">{!! Form::checkbox('check_all', 'check_all',false, ['id' => 'check_all']) !!}</th>
                    <th>@lang('labels.name')</th>
                    <th>@lang('labels.designation')</th>
                    <th>@lang('accounts::payroll.payslip.title') @lang('labels.title')</th>
                    <th>@lang('accounts::payroll.payslip.total')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payslips as $payslip)
                    @php
                        $employee = (!empty($payslip->employee))? $payslip->employee : null;
                    @endphp
                    <tr class="{{(is_null($employee))? 'red' : ''}}">
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @if(!is_null($employee)){!! Form::checkbox('payslips[]', $payslip->id, false,
['class' => 'employee-checkbox'] ) !!}
                            @endif
                        </td>
                        <td>{{$employee ? $employee->getName() : 'N/A'}}</td>
                        <td>{{$employee ? $employee->getDesignation() : 'N/A'}}</td>
                        <td>
                            <a target="_blank" href="{{route('payslips.show', $payslip->id)}}">
                                {{$payslip->payslip_name}}
                            </a>
                        </td>
                        <td>
                            <strong>
                                {{\App\Utilities\EnToBnNumberConverter::en2bn($payslip->total_amount)}}/-
                            </strong>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
<!-- Contract and Structure -->

<!-- Save / Cancel -->
<div class="form-actions text-center">
    @if(!count($payslips))
        <button type="submit" class="btn btn-success" id="btn-submit">
            <i class="ft ft-list"></i>
            @lang('accounts::payroll.payslip.load')
        </button>
    @else
        <input type="submit" name="action" class="btn btn-success" value="{{__('labels.approve')}}" id="approve">
        <input type="submit" name="action" class="btn btn-danger" value="{{__('labels.reject')}}" id="reject">
    @endif
    <a class="btn btn-warning" role="button" href="{{route('payslips-workflow.create')}}">
        <i class="ft ft-x"></i> @lang('labels.cancel')
    </a>
</div>

{!! Form::close() !!}

@push('page-js')
    <script>
        $("#check_all").click(function () {
            $('.employee-checkbox').not(this).prop('checked', this.checked);
        });

        $(".dataTable").dataTable({
            pageLength: 25,
            ordering: false,
            paging: false
        });

        $('.store-approval-form').on('submit', function () {
            $payslips = $('.employee-checkbox');
            if ($payslips.is(':checked')) {
                if (confirm("{{__('accounts::payroll.payslip.approve_confirmation')}}")) {
                    $('#approve').val('approve');
                    $('#reject').val('reject');
                    return true;
                }
            } else {
                alert("{{__('accounts::payroll.payslip.approve_validation')}}");
            }
            return false;
        });
    </script>
@endpush
