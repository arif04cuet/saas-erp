@if($page == 'create')
    {!! Form::open(['route' =>  'employee-contracts.store', 'class' => 'form salary-structure-form', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['employee-contracts.update', $employeeContract->id], 'class' => 'salary-structure-form']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::employee-contract.title') @lang('labels.form')</h4>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('reference', trans('accounts::employee-contract.contract_reference'), ['class' => 'form-label']) !!}
            <span class="danger">*</span>
            {!! Form::text('reference', $page == 'create' ? old('reference') : $employeeContract->reference, ['class' => 'form-control'.($errors->has('reference') ? ' is-invalid' : ''), 'required',
            "placeholder" => "e.g 1152154", 'data-msg-required'=> __('labels.This field is required')]) !!}
            @if($page == 'edit')
                {!! Form::hidden('contract_id', $employeeContract->id, ['id' => 'contract_id']) !!}
            @endif
            <div class="help-block"></div>
            @if ($errors->has('reference'))
                <span class="invalid-feedback">{{ $errors->first('reference') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('employee_id', trans('accounts::employee-contract.employee_name'), ['class' => 'form-label']) !!}
            <span class="danger">*</span>
            {!! Form::select('employee_id', $employees, $page === 'create' ? old('employee_id') : $employeeContract->employee_id, ['class'=>'form-control select2 required', 'required',
            'data-msg-required'=> __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('employee_id'))
                <span class="invalid-feedback">{{ $errors->first('employee_id') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('salary_structure_id', trans('accounts::salary-structure.title_in_form'), ['class' => 'form-label required']) !!}
            {!! Form::select('salary_structure_id', $structures, $page === 'create' ? old('salary_structure_id') : $employeeContract->salary_structure_id, ['class'=>'form-control select2 required',
            'required', 'data-msg-required'=> __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('salary_structure_id'))
                <span class="invalid-feedback">{{ $errors->first('salary_structure_id') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('salary_grade', trans('accounts::employee-contract.salary_grade'), ['class' => 'form-label required']) !!}
            {!! Form::select('salary_grade', $grades, $page === 'create' ? null : $employeeContract->salary_grade, ['class'=>'form-control required',
            'onchange' => 'getBasicSalary()', 'required', 'data-msg-required'=> __('labels.This field is required')]) !!}
            <div class="help-block"></div>
            @if ($errors->has('salary_grade'))
                <span class="invalid-feedback">{{ $errors->first('salary_grade') }}</span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('increment', trans('accounts::employee-contract.increment'), ['class' => 'form-label']) !!}
            {!! Form::select('increment', $page === 'create' ? []: range(0, $maxIncrement), $page === 'create' ? null : $employeeContract->increment,
                [
                  'class'=>'form-control required',
                  'onchange' => 'getBasicSalary()',
                  'required',
                  'data-msg-required'=> __('labels.This field is required')
                ]
             )!!}
            <div class="help-block"></div>
            @if ($errors->has('increment'))
                <span class="invalid-feedback">{{ $errors->first('increment') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                        <li class="nav-item">
                            <a class="nav-link active" id="base-tab11" data-toggle="tab" aria-controls="tab11"
                               href="#tab11"
                               aria-expanded="true">@lang('accounts::employee-contract.contract_details')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab12" data-toggle="tab" aria-controls="tab12" href="#tab12"
                               aria-expanded="false">@lang('accounts::employee-contract.salary_information')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab13" data-toggle="tab" aria-controls="tab13" href="#tab13"
                               aria-expanded="false">@lang('accounts::employee-contract.deductions')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="base-tab14" data-toggle="tab" aria-controls="tab14" href="#tab14"
                               aria-expanded="false">@lang('accounts::employee-contract.outstanding.title')</a>
                        </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true"
                             aria-labelledby="base-tab11">
                            <h4 class="card-title">@lang('accounts::employee-contract.contract_terms')</h4>
                            <div class="">
                                <table class="table">
                                    <tr>
                                        <td width="30%"> {!! Form::label('start_date', __('labels.start'), ['class' => 'form-label required']) !!}</td>
                                        <td>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::text('start_date', ($page == 'edit')? date('d F Y', strtotime($employeeContract->start_date)) : null,
                                       ['class' => 'col-md-10 form-control input-sm  pickadate-dropdown', 'required', 'data-msg-required'=> __('labels.This field is required')]) !!}
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('end_date', __('labels.end'), ['class' => 'form-label label-sm']) !!}</td>
                                        <td>
                                            <div class="col-md-12">
                                                {!! Form::text('end_date', ($page == 'edit' && !empty($employeeContract->end_date))? date('d F Y', strtotime($employeeContract->end_date)) : null,
                                        ['class' => 'col-md-10 form-control input-sm']) !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('probation_end', __('accounts::employee-contract.probation_end'), ['class' => 'form-label']) !!}</td>
                                        <td>
                                            <div class="col-md-12">
                                                {!! Form::text('probation_end', ($page == 'edit' && !empty($employeeContract->probation_end))? date('d F Y', strtotime($employeeContract->probation_end)):null,
                                                ['class' => 'col-md-10 form-control input-sm']) !!}
                                            </div>
                                        </td>
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<td>{!! Form::label('working_schedule', __('accounts::employee-contract.working_schedule'), ['class' => 'form-label']) !!}</td>--}}
                                    {{--<td><div class="col-md-12">{!! Form::select('working_schedule', ['1' => 'Standard 40 Hours/Week'], null, ['class' => 'col-md-10 form-control input-sm']) !!}</div></td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td>{!! Form::label('hr_responsible', __('accounts::employee-contract.hr_responsible'), ['class' => 'form-label']) !!}</td>
                                        <td>
                                            @php
                                                $hrResponsible = ($page == 'create') ? null : $employeeContract->hrResponsible;
                                            @endphp
                                            <div class="col-md-12">{!! Form::select('hr_responsible',$employees , ($hrResponsible)? $hrResponsible->id : null ,
                                         ['class' => 'col-md-10 form-control input-sm']) !!}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{!! Form::label('bank_account_no', __('accounts::employee-contract.bank_account')." (".Config::get('constants.bank_name').")", ['class' => 'form-label']) !!}</td>
                                        <td>
                                            <div class="col-md-12">{!! Form::text('bank_account_no', ($page == 'edit')? $employeeContract->bank_account_no : null ,
                                         ['class' => 'col-md-10 form-control input-sm']) !!}</div>
                                        </td>
                                    </tr>
                                    {{--<tr>--}}
                                    {{--<td>{!! Form::label('new_contract_template', __('accounts::employee-contract.new_contract_template'), ['class' => 'form-label']) !!}</td>--}}
                                    {{--<td><div class="col-md-12">{!! Form::select('new_contract_template',[''] , null, ['class' => 'col-md-10 input-sm form-control']) !!}</div></td>--}}
                                    {{--</tr>--}}
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane" id="tab12" aria-labelledby="base-tab12">
                            <h4 class="card-title">@lang('accounts::employee-contract.monthly_advantages')</h4>

                            <table class="table">
                                <tr>
                                    <td width="30%">{!! Form::label('wage', __('accounts::employee-contract.wage'), ['class' => 'label-control required']) !!}</td>
                                    <td>{!! Form::text('wage', ($page == 'create')? old('wage') : $basicSalary, ['disabled','class' => 'form-control input-sm col-md-10']) !!}</td>
                                </tr>
                            </table>
                            <h4 class="card-title">@lang('accounts::employee-contract.monthly_benefit_in_kind')</h4>
                            <table class="table">
                                <tr>
                                    <td width="30%">{!! Form::label('house_allotment', __('accounts::employee-contract.house_allotment'), ['class' => 'label-control required']) !!}</td>
                                    <td>{!! Form::checkbox('house_allotment',1 , ($page == 'create')? false : $employeeContract->house_allotment) !!}</td>
                                    <td></td>
                                </tr>
                                {{--@foreach($baseStructureRules as $rule)--}}
                                {{--@if($rule->amount_type == 3 && $rule->salaryCategory->name != 'Deduction')--}}
                                {{--<tr>--}}
                                {{--<td>{!! Form::label($rule->name, (\Illuminate\Support\Facades\App::getLocale() == 'bn')? $rule->bangla_name : $rule->name, ['class' => 'label-control']) !!}</td>--}}
                                {{--<td>--}}
                                {{--{!! Form::number('contract_assigns[]', null, ['placeholder' => 'Amount in BDT','class' => 'input-sm  form-control']) !!}--}}
                                {{--{!! Form::hidden('assigning_rules[]',$rule->id) !!}--}}
                                {{--</td>--}}
                                {{--<td>{!! Form::text('remarks[]', null, ['placeholder' => 'Remarks','class' => 'input-sm form-control']) !!}</td>--}}
                                {{--</tr>--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                                <tfoot id="salary_information">
                                @if($page == 'edit')
                                    @foreach($assignedRules as $key=>$rule)
                                        @if($rule['category'] != 'Deduction')
                                            <tr>
                                                <td>{!! Form::label('', $rule['name'], ['class' => 'label-control']) !!}</td>
                                                <td>
                                                    {!! Form::number('contract_assigns[]', $rule['amount'],
['placeholder' => 'Amount in BDT','class' => 'input-sm  form-control', 'max' => 1000000]) !!}
                                                    {!! Form::hidden('assigning_rules[]', $key) !!}
                                                </td>
                                                <td>{!! Form::text('remarks[]', $rule['remark'], ['placeholder' => 'Remarks','class' => 'input-sm form-control']) !!}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tfoot>

                                {{--<tr>--}}
                                {{--<td>{!! Form::label('internet_bill', __('accounts::employee-contract.internet_bill'), ['class' => 'abel-control']) !!}</td>--}}
                                {{--<td>{!! Form::number('internet_bill', ($page == 'create')? null : $employeeContract->internet_bill, ['class' => 'form-control input-sm col-md-10'])!!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                {{--<td>{!! Form::label('meal_voucher', __('accounts::employee-contract.mobile_bill'), ['class' => 'label-control']) !!}</td>--}}
                                {{--<td>{!! Form::number('meal_voucher', ($page == 'create')? null : $employeeContract->meal_voucher, ['class' => 'form-control input-sm col-md-10']) !!}</td>--}}
                                {{--</tr>--}}
                            </table>
                        </div>

                        <div class="tab-pane" id="tab13" aria-labelledby="base-tab13">
                            <h4 class="card-title">@lang('accounts::payroll.deduction_payment')</h4>
                            <table class="table">
                                <tr>
                                    @php $percentageAmount = (!empty($assignedRules[$gpfRule->id]['amount'])) ? $assignedRules[$gpfRule->id]['amount'] : 0; @endphp
                                    <td width="30%">
                                        <strong>{!! Form::label($gpfRule->name, (App::getLocale() == 'bn')? $gpfRule->bangla_name : $gpfRule->name, ['class' => 'label-control']) !!}</strong>
                                    </td>
                                    <td>
                                        {!! Form::number('gpf_percentage', ($page == 'edit' )? $gpfPercentage?? "" : null, ['id' => 'gpf_percentage', 'min' => '0', 'readonly',
                                        'class' => 'form-control input-sm col-md-4 pull-left', 'placeholder' => 'Percentage']) !!}
                                        {!! Form::number('contract_assigns[]', ($page == 'edit')? (($basicSalary * $gpfPercentage) *.01) : null, ['id' =>  'gpf_amount', 'min' => 0, 'readonly',
                                        'class' => 'form-control input-sm col-md-7 pull-right', 'placeholder' => 'Amount in BDT']) !!}
                                        {!! Form::hidden('assigning_rules[]',$gpfRule->id) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('remarks[]', ($page == 'edit' && !empty($assignedRules[$gpfRule->id]['remark']))? $assignedRules[$gpfRule->id]['remark']:null, ['placeholder' => 'Remarks',
                                                   'readonly','class' => 'input-sm form-control', 'id' => 'gpf_remark']) !!}
                                    </td>
                                </tr>
                                {{--{{dd($employeeContract->assignedRules->map( function ($query){--}}
                                {{--return $query->only(['id','amount','remark']);--}}
                                {{--})->toArray())}}--}}
                                {{--@foreach($baseStructureRules as $rule)--}}
                                {{--@if($rule->amount_type == 3 && $rule->salaryCategory->name == 'Deduction')--}}
                                {{--<tr>--}}
                                {{--<td width="30%">{!! Form::label($rule->name, (\Illuminate\Support\Facades\App::getLocale() == 'bn')? $rule->bangla_name : $rule->name, ['class' => 'label-control']) !!}</td>--}}
                                {{--@if($rule->code != 'GPFC')--}}

                                {{--<td>--}}
                                {{--{!! Form::number('contract_assigns[]', ($page == 'edit')? $assignedRules[$rule->id]['amount']:null, ['placeholder' => 'Amount in BDT',--}}
                                {{--'class' => 'input-sm form-control']) !!}--}}
                                {{--{!! Form::hidden('assigning_rules[]',$rule->id) !!}--}}
                                {{--</td>--}}

                                {{--@else--}}
                                {{--@php--}}
                                {{--$percentageAmount = (!empty($assignedRules[$rule->id]['amount'])) ? $assignedRules[$rule->id]['amount'] : 0;--}}
                                {{--@endphp--}}
                                {{--<td>--}}
                                {{--<div class="form-group">--}}
                                {{--{!! Form::number('gpf_percentage', ($page == 'edit' )? round(($percentageAmount * 100)/ $basicSalary) : null, ['id' => 'gpf_percentage',--}}
                                {{--'class' => 'form-control input-sm col-md-4 pull-left', 'placeholder' => 'Percentage']) !!}--}}
                                {{--{!! Form::number('contract_assigns[]', ($page == 'edit')? $percentageAmount : null, ['id' =>  'gpf_amount',--}}
                                {{--'class' => 'form-control input-sm col-md-7 pull-right', 'placeholder' => 'Amount in BDT']) !!}--}}
                                {{--{!! Form::hidden('assigning_rules[]',$rule->id) !!}--}}
                                {{--</div>--}}
                                {{--</td>--}}
                                {{--@endif--}}
                                {{--<td>{!! Form::text('remarks[]', ($page == 'edit' && !empty($assignedRules[$rule->id]['remark']))? $assignedRules[$rule->id]['remark']:null, ['placeholder' => 'Remarks',--}}
                                {{--'class' => 'input-sm form-control']) !!}--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                                <tfoot id="salary_deduction">
                                </tfoot>
                            </table>
                        </div>

                        <!-- salary outstanding Tab-html -->
                        <div class="tab-pane" id="tab14" aria-labelledby="base-tab14">
                            @include('accounts::payroll.employee-contract.outstanding.form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-primary">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('employee-contracts.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}

@push('page-js')
    <script>
        function getBasicSalary() {
            let grade = $("#salary_grade").val();
            let increment = $("#increment").val();
            $.ajax({
                url: '{{url('accounts/salary/basic')}}/' + grade + '/' + increment,
                type: 'get',
                dataType: 'json',
                success: function (json) {
                    $('#wage').val(json);
                    $('#gpf_percentage').trigger('keyup');
                }
            });
        }

        $("#salary_grade").change(function () {
            let grade = $("#salary_grade").val();
            $.ajax({
                url: '{{url('accounts/salary/increments')}}/' + grade,
                type: 'get',
                dataType: 'json',
                success: function (json) {
                    $('#increment').empty();
                    for (let i = 0; i <= json; i++) {
                        $('#increment').append($('<option>').text(i).attr('value', i));
                    }
                }
            });
        });

        $("#gpf_percentage").keyup(function () {
            $('#gpf_amount').val(parseInt(($('#wage').val() * $(this).val()) / 100));
            $('#gpf_remark').val(($(this).val()) ? $(this).val() + '%' : '');
            console.log($(this).val());
        });
        $("#gpf_percentage").change($(this).trigger('keyup'));

        $("#employee_id").change(function () {
            $.ajax({
                url: '{{url('accounts/gpf/percentage')}}/' + $(this).val(),
                type: 'get',
                success: function (data) {
                    //console.log(data);
                    $('#gpf_percentage').val(data);
                    $('#gpf_percentage').trigger('keyup');
                }
            });
        });

        $("#salary_structure_id").change(function () {
            $contractId = $("#contract_id").val();
            $.ajax({
                url: '{{url('accounts/salary/contract-assign-rules')}}/' + $(this).val() + '/' + $contractId,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#salary_information').empty();
                    $('#salary_deduction').empty();
                    $.each(data, function (index, val) {

                        if (val['code'] == 'GPFC') return;
                        $html = "<tr>" +
                            "<td><label>" + val['name'] + "</label></td>" +
                            "<td>" +
                            "<input type='text' name='contract_assigns[]' value='" + val['value'] + "'" +
                            "placeholder='Amount in BDT' class='form-control input-sm' maxlength='6' " +
                            "id='amount_" + index + "' onkeyup='getDecimal(this.id)'>" +
                            "<input type='hidden' name='assigning_rules[]' value='" + val['rule_id'] + "'>" +
                            "<td><input type='text' placeholder='Remark' value='" + val['remark'] + "' " +
                            "name='remarks[]' class='form-control input-sm'></td>" +
                            "<tr>";

                        if (val['salary_category'] == 'Deduction') {
                            $('#salary_deduction').append($html);
                        } else {
                            $('#salary_information').append($html);
                        }
                        //console.log( index + ": " + val['value']);
                    })
                }
            });
            // reset salary-rule dropdown
            resetSalaryRuleDropdown();
        });

        function resetSalaryRuleDropdown() {
            let salaryRuleSelect = $('.salary-rule-select');
            let salaryStructureId = parseInt($("#salary_structure_id").val());
            let url = '{{route('salary-structure.rules.json',":id")}}';
            url = url.replace(":id", salaryStructureId);
            let selectPlaceholder = '{!! trans('labels.select')!!}';
            $.get(url, function (data) {
                // map the data to select2 format {id:1,text:value}
                data = $.map(data, function (value, key) {
                    return {
                        id: key,
                        text: value.name
                    };
                });
                salaryRuleSelect.next('.select2-container').remove();
                salaryRuleSelect.empty();
                salaryRuleSelect.select2({
                    placeholder: selectPlaceholder,
                    data: data
                });
                salaryRuleSelect.val('').trigger('change.select2');
            });
        }

        @if ($page == 'edit')
        $("#salary_structure_id").trigger('change');

        @endif

        function getDecimal(elementId) {
            $element = $("#" + elementId);
            $element.val($element.val().replace(/\D/g, ''));
        }
    </script>
@endpush
