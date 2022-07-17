@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($course->trainingCoursePayment()->count())
        <div class="col-md-8">
            <div class="table-responsive" id="table" >
                <table class="table">
                    <tr>
                        <th>
                            Payment Type
                        </th>
                        <td>
                            {{ $course->trainingCoursePayment->payment_type }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="{{ $paymentEditRoute }}" class="btn btn-sm btn-info">
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','course_rules_guidelines')" class="btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        <a href="{{ $paymentEditRoute }}"
           class="btn btn-sm btn-info"
        >
            <i class="ft ft-plus"></i> @lang('labels.add')
        </a>
    @endif
@endcomponent

<script>
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);


        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        filename = filename?filename+'.xls':'excel_data.xls';
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){

            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });

            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            downloadLink.download = filename;
            downloadLink.click();
        }
    }
</script>
