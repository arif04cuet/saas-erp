<div class="col">
    <div class="table-responsive">
        {!! Form::hidden('date',$date) !!}
        <table class="table table-striped table-bordered text-center alt-pagination bill-submission"
               id="bill-submission-table">
            <thead>
            <tr>
                <th>@lang('labels.select')</th>
                <th>@lang('labels.name')</th>
                <th>@lang('vms::trip.bill.submission.trip_bill')</th>
                <th>@lang('vms::trip.bill.submission.sector_bill')</th>
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
                    <td>{{ $employee->trip_bill['pending_trip_bill'] ?? 0  }}</td>
                    <td>{{ $employee->fixed_bill['pending_fixed_bill'] ?? 0  }}</td>
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
</div>
