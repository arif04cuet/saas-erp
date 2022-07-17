<div class="card-body card-dashboard">
    <div class="row">
        <div class="col-md-10">
            <table class="table table-borderless">
                <tr>
                    <th>@lang('cafeteria::report.title')</th>
                    <td>@lang('cafeteria::report.sales.title')</td>
                    <th>@lang('labels.name')</th>
                    <td class="biller-name"></td>
                </tr>
                <tr>
                    <th>@lang('cafeteria::report.start_date')</th>
                    <td>{{ app('request')->input('start_date') ?? '' }}</td>
                    <th>@lang('cafeteria::report.end_date')</th>
                    <td>{{ app('request')->input('end_date') ?? '' }}</td>
                </tr>
                <tr>
                    @if (app('request')->input('payment_type') != "due")
                        <th>@lang('cafeteria::sales.paid')</th>
                        <td class="paid-total-taka">{{ $salesData->isEmpty() ? 'N/A' : '' }}</td>
                    @endif
                    @if (app('request')->input('payment_type') != "paid")
                        <th>@lang('cafeteria::sales.due')</th>
                        <td class="due-total-taka">{{ $salesData->isEmpty() ? 'N/A' : '' }}</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered" id="finish-food-table">
            <thead>
            <tr>
                <th>@lang('labels.serial')</th>
                <th>{{ trans('labels.date') }}</th>
                @if (!app('request')->input('employee_id') &&
                !app('request')->input('training_id'))
                    <th>{{ trans('labels.name') }}</th>
                @endif
                @if (app('request')->input('payment_type') != "due")
                    <th>{{ trans('cafeteria::sales.paid')}}</th>
                @endif
                @if (app('request')->input('payment_type') != "paid")
                    <th>{{ trans('cafeteria::sales.due') }}</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @if(isset($salesData) && $salesData->isNotEmpty())
                @foreach($salesData as $data)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $data->sales_date }}</td>
                        @if (!app('request')->input('employee_id') &&
                        !app('request')->input('training_id'))
                            <td> @if ($data->reference_type == "employee")
                                    {{ $data->employee->employee_id
                                                . ' - ' . $data->employee->first_name .
                                                    ' ' . $data->employee->last_name. ' - '
                                                        . $data->employee->mobile_one }}
                                @elseif($data->reference_type == "training")
                                    {{ $data->training->title }}
                                @else
                                    {{ $data->reference }}
                                @endif
                            </td>
                        @endif
                        @if (app('request')->input('payment_type') != "due")
                            <td class="total-paid">{{ $data->paid }}</td>
                        @endif
                        @if (app('request')->input('payment_type') != "paid")
                            <td class="total-due">{{ $data->due }}</td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="6">@lang('labels.empty_table')</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
