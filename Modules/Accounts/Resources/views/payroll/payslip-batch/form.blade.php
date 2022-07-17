@if($page == 'store')
    {!! Form::open(['route' =>  'payslip-batches.store', 'class' => 'form payslip-batch-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' =>  'payslip-batches.post-create', 'class' => 'form payslip-batch-form', 'novalidate']) !!}
@endif
<h4 class="form-section">
    <i class="la la-tag"></i>@lang('accounts::payroll.payslip_batch.form')
</h4>

<div class="row">
    <!-- Payslip Name -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('name', trans('accounts::payroll.payslip_batch.create_form_elements.payslip_name'), ['class' => 'form-label']) !!}
            {!! Form::text('name', $name ?? null, ['class' => 'form-control', "placeholder" => trans('labels.name')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('description'))
                <span class="invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>

    <!-- Period From  -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('period_from', trans('accounts::payroll.payslip.create_form_elements.period_from'), ['class' => 'form-label required']) !!}
            {!! Form::text('period_from', $from,
                    ['class' => 'form-control required',
                            'data-validation-required-message'=>trans('validation.required',
                            ['attribute' => trans('labels.This field is required')]),
                    ]
                )
             !!}
            <div class="help-block"></div>
            @if ($errors->has('period_from'))
                <span class="invalid-feedback">{{ $errors->first('period_from') }}</span>
            @endif
        </div>
    </div>

    <!-- Period To  -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('period_to', trans('accounts::payroll.payslip.create_form_elements.period_to'), ['class' => 'form-label']) !!}
            {!! Form::text('period_to', $to,
                    ['class' => 'form-control required',
                            'data-validation-required-message'=>trans('validation.required',
                            ['attribute' => trans('labels.This field is required')]),
                    ]
                )
             !!}
            <div class="help-block"></div>
            @if ($errors->has('period_to'))
                <span class="invalid-feedback">{{ $errors->first('period_to') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <!-- Reference -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('reference', trans('accounts::payroll.payslip.create_form_elements.reference'), ['class' => 'form-label required']) !!}
            {!! Form::text('reference', $reference ?? null, ['class' => 'form-control', 'required',
            "placeholder" => "e.g 1152154", 'data-validation-required-message'=>trans('validation.required', ['attribute' => __('labels.reference')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('reference'))
                <span class="invalid-feedback">{{ $errors->first('reference') }}</span>
            @endif
        </div>
    </div>
    <!-- Journal -->
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('journal_id', trans('accounts::journal.title'), ['class' => 'form-label']) !!}
            {!! Form::select('journal_id',$journals, null, ['class' => 'form-control select2']) !!}
            <div class="help-block"></div>
            @if ($errors->has('journal'))
                <span class="invalid-feedback">{{ $errors->first('journal') }}</span>
            @endif
        </div>
    </div>

</div>

<div class="row">

    <!-- bonus checkbox -->
    <div class="col-md-6">
        <!-- Bonus checkbox -->
        <div class="icheck-checkbox">
            <div class="skin skin-flat">
                <fieldset>
                    {!! Form::label('bonus',trans('accounts::pension.monthly.bonus')) !!}
                    {!! Form::checkbox(
                            'bonus',
                            null,
                            $bonus
                        )
                    !!}
                </fieldset>
            </div>
        </div>
        <div class="help-block"></div>
        @if ($errors->has('bonus'))
            <span class="invalid-feedback">{{ $errors->first('bonus') }}</span>
        @endif
    </div>
    <div class="col-md-6 bonus-structure-div">
        <div class="form-group">
            {!! Form::label('bonus_structure_id',
                trans('accounts::payroll.payslip_batch.create_form_elements.bonus_structure'), ['class' => 'form-label required'])
                !!}
            {!!
                Form::select(
                    'bonus_structure_id',
                    $bonusStructures,
                    $bonusStructureId ?? null,
                    ['class'=>'bonus-structure-select form-control'])
            !!}
            @if ($errors->has('bonus_structure_id'))
                <span class="invalid-feedback">{{ $errors->first('bonus_structure_id') }}</span>
            @endif

        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h4 class="form-section">
                <i class="la la-tag"></i>
                @lang('accounts::payroll.payslip_batch.index_employee')
            </h4>

            <table class="table table-bordered table-striped dataTable" role="grid">
                <thead>
                <tr>
                    <th>@lang('labels.serial')</th>
                    <th width="5%">{!! Form::checkbox('check_all', 'check_all',false, ['id' => 'check_all']) !!}</th>
                    <th>@lang('labels.name')</th>
                    <th>@lang('labels.designation')</th>
                    <th>@lang('accounts::employee-contract.title')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $key=>$employee)
                    @php
                        $contract = (!empty($employee->employeeContract))? $employee->employeeContract : null
                    @endphp
                    <tr class="{{(is_null($contract))? 'red' : ''}}">
                        <td>{{$loop->iteration}}</td>
                        <td>
                            @if(!is_null($contract)){!! Form::checkbox('employees[]', $employee->id, false, ['class' => 'employee-checkbox'] ) !!} @endif
                        </td>
                        <td>{{ $employee->getName() ?? trans('labels.not_found') }}</td>
                        <td>{{ optional($employee->designation)->name ?? trans('labels.not_found')}}</td>
                        <td>
                            @if(!is_null($contract))
                                <a target="_blank" href="{{route('employee-contracts.show', $contract->id)}}">
                                    {{$contract->reference}}
                                </a>
                            @else
                                <a target="_blank" href="{{route('employee-contracts.create')}}">
                                    + @lang('labels.create')
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

<!-- Save / Cancel -->
<div class="form-actions text-center">
    <button type="submit" class="btn btn-success" id="btn-submit">
        <i class="la la-check-square-o"></i>
        @if($page == 'create')
            @lang('accounts::payroll.payslip_batch.fetch_employees')
        @else
            @lang('accounts::payroll.payslip_batch.create')
        @endif
    </button>
    <a class="btn btn-warning" role="button" href="{{url(route('payslip-batches.index'))}}">
        <i class="la la-times"></i> @lang('labels.cancel')
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

        $("#period_from, #period_to").change(function () {
            $from = "{{$from}}";
            $to = "{{$to}}";
            $periodFrom = $('#period_from').val();
            $periodTo = $('#period_to').val();
            if ($from != $periodFrom || $to != $periodTo) {
                $(".payslip-batch-form").attr('action', "{{route('payslip-batches.post-create')}}");
                $("#btn-submit").html("{{__('accounts::payroll.payslip_batch.fetch_employees')}}")
            }
        });

    </script>
@endpush
