@component('tms::training.partials.components.show_layout', [
    'training' => $training,
])
    @if($training->trainingCostSegmentation->count())
        <div class="col-md-12 pl-0">
            <div class="table-responsive">
                <table class="master table table-bordered" id="table">
                    <thead>
                    <tr>
                        <th>@lang('tms::cost_segmentation.expense_type')</th>
                        <th>@lang('tms::cost_segmentation.expense_details')</th>
                        <th>@lang('tms::cost_segmentation.unit_number')</th>
                        <th>@lang('tms::cost_segmentation.unit_price')</th>
                        <th>@lang('tms::cost_segmentation.vat')</th>
                        <th>@lang('tms::cost_segmentation.tax')</th>
                        <th>@lang('tms::cost_segmentation.total_amount')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $total_cost = 0;
                    @endphp
                    @foreach($training->trainingCostSegmentation as $segmentation)
                        @php 
                            $total_cost = $total_cost + $segmentation->total_amount;
                        @endphp
                        <tr>
                            {{-- <td>{{ trans('tms::mark_allotment_type.' . $segmentation->type->title) }}</td> --}}
                            <td>{{ $segmentation->cost_type_id }}</td>
                            <td>{{ $segmentation->cost_detail }}</td>
                            <td>{{ $segmentation->unit_number }}</td>
                            <td>{{ $segmentation->unit_price }}</td>
                            <td>{{ $segmentation->vat }}</td>
                            <td>{{ $segmentation->tax }}</td>
                            <td>{{ $segmentation->total_amount }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="5"></td>
                            <td width="10%">@lang('tms::cost_segmentation.total_cost')</td>
                            <td width="12%">{{ $total_cost }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ $costSegmentationEditRoute }}"
           class="master btn btn-sm btn-info"
        >
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','courses_administrations')"
           class="master btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        <a href="{{ $costSegmentationEditRoute }}"
           class="master btn btn-sm btn-info"
        >
            <i class="ft ft-plus"></i> @lang('labels.add')
        </a>
    @endif
@endcomponent
<script>
    // function exportTableToExcel(tableID, filename = ''){
    //     var downloadLink;
    //     var dataType = 'application/vnd.ms-excel';
    //     var tableSelect = document.getElementById(tableID);

        
    //     var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    //     filename = filename?filename+'.xls':'excel_data.xls';
    //     downloadLink = document.createElement("a");
        
    //     document.body.appendChild(downloadLink);
        
    //     if(navigator.msSaveOrOpenBlob){

    //         var blob = new Blob(['\ufeff', tableHTML], {
    //             type: dataType
    //         });
            
    //         navigator.msSaveOrOpenBlob( blob, filename);
    //     }else{
    //         downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    //         downloadLink.download = filename;
    //         downloadLink.click();
    //     }
    // }
</script>