@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($course->objectives->count())
        {{-- <div class="col-md-8"> --}}
            <div class="table-responsive">
                <table class="master table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Specific Points</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>{{ $courseDescription }}</td>
                        <td>
                            @foreach($courseSpecificPointObjectives as $objective)
                                <li>{{ $objective }}</li>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
        {{-- </div> --}}

        <a href="{{ $objectiveEditRoute }}"
           class="btn btn-sm btn-info">
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','course_objectives')" class="btn btn-sm btn-info">
             @lang('labels.export')
        </a>
    @else
        <a href="{{ $objectiveEditRoute }}" class="btn btn-sm btn-info">
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
