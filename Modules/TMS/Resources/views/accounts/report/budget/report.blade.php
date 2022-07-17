<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="la la-list black"></i> @lang('tms::budget.report.expenditure') @lang('labels.show')
                    </h4>
                    <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements" style="top: 5px;">
                        <ul class="list-inline mb-1">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="col-md-6">
                            <table class="master table table-responsive table-striped table-borderless">
                                <tr>
                                    <th>@lang('tms::budget.for_training')</th>
                                    <td>{{$training->title}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('tms::budget.report.participant_no')</th>
                                    <td>{{\App\Utilities\EnToBnNumberConverter::en2bn($training->no_of_trainee)}}</td>
                                </tr>
                                <tr>
                                    <th>@lang('tms::budget.report.duration')</th>
                                    <td>
                                        {{\App\Utilities\EnToBnNumberConverter::en2bn(date('d', strtotime($training->start_date))) .
     ' ' . \App\Utilities\MonthNameConverter::convertMonthToBn($training->start_date). ' - ' . \App\Utilities\EnToBnNumberConverter::en2bn(date( 'd', strtotime($training->end_date))) . ' ' . \App\Utilities\MonthNameConverter::convertMonthToBn($training->end_date) . ' (' .
     \App\Utilities\EnToBnNumberConverter::en2bn(\Carbon\Carbon::parse($training->start_date)->diffInDays($training->end_date))
     . __('tms::budget.report.day') . ')'}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('tms::budget.report.organization')</th>
                                    <td>
                                        <ul class="list-inline">
                                            @foreach($training->trainingSponsors as $key => $sponsor)
                                                <li class="list-inline-item">
                                                    {{optional($sponsor->organization)->name}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>@lang('tms::budget.report.organizer')</th>
                                    <td>@lang('labels.bard_title')</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
    
                <div class="card-header">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        {{--<a href="{{route('cost-center.create',1)}}" class="btn btn-primary btn-sm"><i--}}
                        {{--class="ft-plus white"></i> {{ trans('accounts::cost-center.create') }}--}}
                        {{--</a>--}}
                    </div>
                </div>
    
    
                <div class="card-content">
                    <div class="card-body">
                        <!-- Report Data -->
                        <h4 class="card-title">@lang('accounts::budget.sectors')</h4>
                        <table class="master table table-bordered" id="data_table">
                            <thead>
                            <tr class="text-center">
                                <td><strong>@lang('labels.serial')</strong></td>
                                <td><strong>@lang('tms::budget.report.expense_sector')</strong></td>
                                <td><strong>@lang('tms::budget.report.budget')</strong></td>
                                <td><strong>@lang('tms::budget.form_items.revised_budget')</strong></td>
                            </tr>
                            </thead>
                            <tbody data-repeater-list="category">
                            @php
                                $totalBudget = 0;
                                $totalRevisedBudget = 0;
                                $subTotalOfSectorBudget = 0;
                                $subTotalOfRevisedSectorBudget = 0;
                            @endphp
                            @foreach($expenditures as $sector => $expenditure)
                                @php
                                    $count = 0;
                                    $subTotalOfSectorBudget = 0;
                                    $subTotalOfRevisedSectorBudget = 0;
                                @endphp
                                <tr>
                                    <td><strong>{{__('tms::budget.report.sector_serials')[$loop->iteration]}}</strong></td>
                                    <td colspan="3"><strong>{{$sector}}</strong></td>
                                </tr>
                                @foreach($expenditure as $subSector => $budgetEntries)
                                    @php
                                        $count++;
                                        $totalSectorBudget = 0;
                                        $totalRevisedSectorBudget = 0;
                                    @endphp
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$subSector}}
                                            @foreach($budgetEntries as $budgetEntry)
                                                @php
                                                    $totalSectorBudget += $budgetEntry['total'];
                                                    $totalRevisedSectorBudget += $budgetEntry['revised_total'];
                                                @endphp
                                                <ul class="">
                                                    @if($budgetEntry['days'] || $budgetEntry['persons'])
                                                        <li class="">
    
                                                            (
                                                            {{$budgetEntry['days'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['days']) . ' X ' : ''}}
                                                            {{$budgetEntry['persons'] ? \App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['persons']) . ' X ' : ''}}
                                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['rate'])}}
                                                            )
                                                            = {{\App\Utilities\EnToBnNumberConverter::en2bn($budgetEntry['total'])}}
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endforeach
                                        </td>
                                        <td class="text-right">
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalSectorBudget)}}
                                        </td>
                                        <td class="text-right">
                                            {{\App\Utilities\EnToBnNumberConverter::en2bn($totalRevisedSectorBudget)}}
                                        </td>
                                        @php
                                            $subTotalOfSectorBudget += $totalSectorBudget;
                                            $subTotalOfRevisedSectorBudget += $totalRevisedSectorBudget;
                                            $totalBudget += $totalSectorBudget;
                                            $totalRevisedBudget += $totalRevisedSectorBudget;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr class="text-bold-700 text-right">
                                    <td colspan="2">@lang('tms::budget.report.sub_total')</td>
                                    <td>@enToBnNumber($subTotalOfSectorBudget)</td>
                                    <td>@enToBnNumber($subTotalOfRevisedSectorBudget)</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="text-bold-700">
                                <td></td>
                                <td class="text-right">@lang('labels.total')</td>
                                <td class="text-right">{{\App\Utilities\EnToBnNumberConverter::en2bn($totalBudget)}}</td>
                                <td class="text-right">
                                    {{\App\Utilities\EnToBnNumberConverter::en2bn($totalRevisedBudget)}}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
    
                </div>
                <div class="card-footer">
                    <div class="col-md-12">
                        <button type="button" class="master btn btn-primary" onclick="printDiv()">
                            <i class="la la-print"></i> @lang('labels.print')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- DataTable Card -->


<div id="print_report" class="hidden">
    @include('tms::accounts.report.budget.printable')
</div>
@push('page-js')
    <script>


        $('#data_table  ').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy', className: 'copyButton',
                    title: "{{"Report: ".$training? $training->title : ''}}",
                    messageTop: "Budget Report:",
                },
                {
                    extend: 'excel', className: 'excel',
                    title: "{{"Report: ".$training? $training->title : ''}}",
                    messageTop: "Budget Report:",

                },
            ],
            ordering: false,
            paging: false,
            searching: false,
            "bDestroy": true,
        });

    </script>
@endpush

<script type="text/javascript">
    function printDiv() {
        var divToPrint = document.getElementById('print_report');

        var newWin = window.open('Budget Report Print', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);
    }
</script>
