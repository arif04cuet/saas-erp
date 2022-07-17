@if($page == 'create')
    {!! Form::open(['route' =>  'monthly-pensions.store', 'class' => 'form ', 'novalidate']) !!}
@else
    {!! Form::open(['route' => ['monthly-pensions.update', $pension->id], 'class' => 'form', 'novalidate']) !!}
    @method('PUT')
@endif
<h4 class="form-section"><i class="la la-tag"></i>@lang('accounts::pension.monthly.form')</h4>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('month', trans('accounts::employee-contract.month'), ['class' => 'form-label required']) !!}
            {!! Form::text('month', $page == 'create' ? old('month') : $pension->month,
            ['class' => 'form-control '.($errors->has('month') ? ' is-invalid' : ''), 'required',
            "placeholder" => "Pick Pension Month", 'data-validation-required-message'=>trans('validation.required',
            ['attribute' => __('accounts::employee-contract.month')])]) !!}
            <div class="help-block"></div>
            @if ($errors->has('month'))
                <span class="invalid-feedback">{{ $errors->first('month') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('bonus', trans('accounts::pension.monthly.bonus_if_any'), ['class' => 'form-label']) !!}
            {!! Form::select('bonus[]', $occasionalRules, $page === 'create' ? null : $pension->bonus,
            ['class'=>'form-control select2 required', 'multiple', 'id' => 'bonus']) !!}
            <div class="help-block"></div>
            @if ($errors->has('bonus'))
                <span class="invalid-feedback">{{ $errors->first('bonus') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <div class="skin skin-flat">
                {!! Form::label('is_bonus_only', trans('accounts::pension.monthly.bonus_only'),
['class' => 'form-label']) !!}
                <p>
                    {!! Form::checkbox('is_bonus_only', 1, false) !!}
                </p>
            </div>
            <div class="help-block"></div>
            @if ($errors->has('month'))
                <span class="invalid-feedback">{{ $errors->first('month') }}</span>
            @endif
        </div>
    </div>

    <div class="col-md-12 text-center">
        <button class="btn btn-info" type="button" name="fetch_employee">
            @lang('accounts::payroll.payslip_batch.fetch_employees')
        </button>

    </div>
    <div class="col-md-12">
        <h4 class="form-section"><i class="la la-user"></i>
            Employees
            @if ($errors->has('employees'))
                <div class="form-group">
                    <span class="help-block red">{{ $errors->first('employees') }}</span>
                </div>
            @endif
        </h4>
        <!-- Invoice Items Details -->
        <div class="col-md-12">
            <div id="invoice-items-details" class="">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table repeater-category-request table-bordered" id="pensioner_list_table">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="check_all">
                                </th>
                                <th>@lang('accounts::employee-contract.employee_name')</th>
                                <td class="text-bold-600">@lang('labels.id')</td>
                                <td class="text-bold-600">@lang('accounts::pension.contract.receiver')</td>
                                <td class="text-bold-600">@lang('accounts::pension.contract.receiver_age')</td>
                                <td class="text-bold-600">@lang('labels.religion.religion')</td>
                                <td class="text-bold-600">@lang('accounts::pension.monthly.basic')</td>
                                <td class="text-bold-600">@lang('accounts::pension.monthly.medical')</td>
                                <td class="text-bold-600">@lang('accounts::pension.monthly.bonus')</td>
                                <td class="text-bold-600">@lang('accounts::pension.monthly.adjustment')</td>
                                <td class="text-bold-600">@lang('labels.total')</td>

                                {{--<th width="1%"><i data-repeater-create class="la la-plus-circle text-info"--}}
                                {{--style="cursor: pointer"></i></th>--}}
                            </tr>
                            </thead>
                            <tbody id="pension_list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-actions text-center">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i>{{$page == 'create' ? trans('labels.save') : trans('labels.update')}}
    </button>
    <a class="btn btn-warning mr-1" role="button" href="{{url(route('monthly-pensions.index'))}}">
        <i class="ft-x"></i> @lang('labels.cancel')
    </a>
</div>
{!! Form::close() !!}


@push('page-js')
    <script>
        $("#check_all").click(function () {
            $('.employee-checkbox').not(this).prop('checked', this.checked);
        });

        $('button[name=fetch_employee]').click(function () {
            $month = $('#month').val();
            let bonus = $('#bonus').val();
            let onlyBonus = ($("#is_bonus_only").is(":checked")) ? 1 : 0;
            if ($month == "") {
                alert("{{__('accounts::pension.monthly.select_month')}}");
                return;
            } else if(onlyBonus == 1 && !bonus.length) {
                alert("{{__('accounts::pension.monthly.only_bonus_error')}}");
                return;
            }
            $(this).html('...');
            $.ajax({
                url: '{{url('accounts/pension/fetch-employees')}}/' + $month + '/[' + bonus + ']/' + onlyBonus,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#pension_list').empty();
                    $.each(data, function (index, val) {
                        $html = "<tr>" +
                            "<td><input type='checkbox' class='employee-checkbox' name='employees[]' value='" +
                            val['employee_id'] + "'>" +
                            "</td>" +
                            "<td><label>" + val['employee_name'] + "</label></td>" +
                            "<td><label>" + val['employee_user_id'] + "</label></td>" +
                            "<td><label>" + val['receiver'] + "</label></td>" +
                            "<td><label>" + val['receiver_age'] + "</label></td>" +
                            "<td><label>" + val['religion'] + "</label></td>" +
                            "<td>" + val['basic'] + "</td>" +
                            "<td>" + val['medical'] + "</td>" +
                            "<td>" + val['bonus_remark'] + "</td>" +
                            "<td><input type='hidden' value='" + val['total'] + "' id='init_total_" + val['employee_id'] + "'>" +
                            "<input type='text' id='deduction_" + val['employee_id'] + "' name='deductions[" +
                            val['employee_id'] + "]'" +
                            "onkeyup='adjustment(" + val['employee_id'] + ")' class='form-control input-sm'></td>" +
                            "<td id='total_" + val['employee_id'] + "'>" + val['total'] + "</td>" +
                            "<tr>";
                        $('#pension_list').append($html);

                        //console.log( index + ": " + val['value']);
                    });
                    $('button[name=fetch_employee]').html("{{__('accounts::payroll.payslip_batch.fetch_employees')}}");
                    $("#pensioner_list_table").load();
                }
            });

            // $("#pensioner_list_table").DataTable({
            //     searching: true,
            // });

        });

        function adjustment(employeeId) {
            $total = $('#init_total_' + employeeId).val();
            $newTotal = $total - $('#deduction_' + employeeId).val();
            $('#total_' + employeeId).html($newTotal);
        }
    </script>
@endpush
