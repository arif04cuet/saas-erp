<div class="card">
    <div class="card-header"><h4 class="card-title">@lang('attribute.attribute_tabular_view')</h4></div>
    <div class="card-content">
        <div class="card-body">
            <div class="table-resposive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>@lang('labels.serial')</th>
                        <th>@lang('labels.date')</th>
                        <th>@lang('attribute.planned_value')</th>
                        <th>@lang('attribute.achieved_value')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($achievedPlannedValuesByMonthYear as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>@lang('month.' . explode(' ', $item->monthYear)[0]) {{ explode(' ', $item->monthYear)[1]  }}</td>
                            <td>{{ $item->total_planned_value }}</td>
                            <td>{{ $item->total_achieved_value }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>