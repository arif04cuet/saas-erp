<div class="col">
    {!! Form::open(['route' =>  ['vms.bill-sector.update',$vmsBillSector],'class' => 'form promotion-form']) !!}
    @method('put')
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center alt-pagination promotion"
               id="promotion-table">
            <thead>
            <tr>
                <th>@lang('labels.select')</th>
                <th>@lang('labels.name')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.designation')</th>
                <th>@lang('accounts::payroll.promotion.table_elements.department')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <th scope="row">
                        <div class="skin skin-flat">
                            <fieldset>
                                {!! Form::checkbox('employees['.$loop->iteration.'][selected]',1,in_array($employee->id,$assignedEmployees))!!}
                                {!! Form::hidden('employees['.$loop->iteration.'][employee_id]',$employee->id)!!}
                            </fieldset>
                        </div>
                    </th>
                    <td>{{ $employee->getName() ?? trans('labels.not_found') }}</td>
                    <td>{{ optional($employee->designation)->getName() ?? trans('labels.not_found') }}</td>
                    <td>{{ optional($employee->employeeDepartment)->name ?? trans('labels.not_found') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Save & Cancel Button -->
    <div class="form-actions text-center">
        <button class="btn btn-success">
            <i class="la la-check-square-o"></i>@lang('labels.submit')
        </button>
    </div>
    {!! Form::close() !!}
</div>
