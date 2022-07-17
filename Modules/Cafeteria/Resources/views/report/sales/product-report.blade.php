<div class="card-body card-dashboard">
    <div class="row">
        <div class="col-md-10">
            <table class="table table-borderless">
                <tr>
                    <th>@lang('cafeteria::report.title')</th>
                    <td>@lang('cafeteria::report.sales.title')</td>
                    <th>@lang('cafeteria::raw-material.title')</th>
                    <td class="material-name"></td>
                </tr>
                <tr>
                    <th>@lang('cafeteria::report.start_date')</th>
                    <td>{{ app('request')->input('start_date') ?? '' }}</td>
                    <th>@lang('cafeteria::report.end_date')</th>
                    <td>{{ app('request')->input('end_date') ?? '' }}</td>
                </tr>
                <tr>
                    <th>@lang('labels.grand_total')</th>
                    <td class="product-total-taka"></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered" id="finish-food-table">
            <thead>
            <tr>
                <th>@lang('labels.serial')</th>
                <th>@lang('labels.date')</th>
                <th>@lang('labels.quantity')</th>
                <th>@lang('labels.total') @lang('cafeteria::cafeteria.taka')</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($salesData) && $salesData->isNotEmpty())
                @foreach($salesData as $data)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $data->sales_date }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td class="total-product">{{ $data->total_price }}</td>
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
