<!-- General Information -->
<h4 class="form-section"><i
        class="la la-tag"></i>
    @lang('accounts::accounts.general_information')
</h4>
<div class="col">
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center alt-pagination promotion" id="promotion-table">
            <thead>
            <tr>
                <th>@lang('labels.select')</th>
                <th>@lang('labels.name')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.designation')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.department')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.current_salary_grade')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.current_increment')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.salary_grade')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.increment')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <th scope="row">
                        <div class="skin skin-flat">
                            <fieldset>
                                {!! Form::checkbox('employees['.$loop->iteration.'][selected]',1,1)!!}
                                {!! Form::hidden('employees['.$loop->iteration.'][employee_id]',$employee->id)!!}
                            </fieldset>
                        </div>
                    </th>
                    <td>{{ $employee->getName() ?? trans('labels.not_found') }}</td>
                    <td>{{ $employee->designation ?? trans('labels.not_found') }}</td>
                    <td>{{ $employee->department ?? trans('labels.not_found') }}</td>
                    <td>
                        {{ $employee->current_salary_grade ?? trans('labels.not_found') }}
{{--                        {!! Form::hidden('employees['.$loop->iteration.'][current_salary_grade]',$employee->current_salary_grade) !!}--}}
                    </td>
                    <td>
                        {{ $employee->current_increment_no ?? trans('labels.not_found') }}
{{--                        {!! Form::hidden('employees['.$loop->iteration.'][current_increment_no]',$employee->current_increment_no) !!}--}}
                    </td>
                    <td>
                        <!-- select field of salary grade -->
                        {{ Form::select(
                                   'employees['.$loop->iteration.'][salary_grade]',
                                   $salaryGrades,
                                   $employee->current_salary_grade,
                                   [
                                       'class' => 'form-control salary-grade select2',
                                       'onchange'=>'getElement(this)'
                                   ]
                        ) }}
                    </td>
                    <td>
                        <!-- select field of next increment -->
                        {{ Form::select(
                                  'employees['.$loop->iteration.'][increment]',
                                  $employee->totalIncrements,
                                  $employee->next_increment_no,
                                  [
                                      'class' => 'form-control salary-increment select2',
                                  ]
                       ) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/General Information -->

<!-- Save & Cancel Button -->
<div class="form-actions text-center">
    <button class="btn btn-success">
        <i class="la la-check-square-o"></i>@lang('labels.submit')
    </button>
</div>

