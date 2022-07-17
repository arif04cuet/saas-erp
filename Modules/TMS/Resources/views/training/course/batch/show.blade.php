@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($course->batches->count())
        <div class="col-md-12 p-0">
            <div class="table-responsive">
                <table class="master table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>@lang('tms::batch.title')</th>
                            <th>@lang('tms::batch.start_date')</th>
                            <th>@lang('tms::batch.end_date')</th>
                            <th>@lang('tms::batch.no_of_trainees')</th>
                            <th>@lang('tms::batch.hostel')</th>
                        </tr>
                    </thead>
                    @foreach($batches as $key => $batch)
                        <tr>
                            <td>{{ $batch->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($batch->start_date)->format('j F, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($batch->end_date)->format('j F, Y') }}</td>
                            <td>{{ $batch->no_of_trainees }}</td>
                            <td>
                                <a href="{{ route('trainings.courses.batches.rooms.show',
                                [
                                    'training' => $training,
                                    'course' => $course,
                                    'batch' => $batch
                                ]
                                ) }}">@lang('tms::batch.hostel')</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <a class="btn btn-sm btn-info"
           href="{{ route('trainings.courses.batches.edit', ['training' => $training, 'course' => $course]) }}">
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','course_batches')" class="btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        <a class="btn btn-sm btn-info"
           href="{{ route('trainings.courses.batches.edit', ['training' => $training, 'course' => $course]) }}">
            <i class="ft ft-plus"></i> @lang('labels.add')
        </a>
    @endif
@endcomponent
<script>
    function exportTableToExcel(tableID, filename = ''){

        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        
        let table = document.getElementById(tableID);
        let rows = table.rows;
        
        let vartual_table = document.createElement('table');
        let tableData = '';
        
        for (let i = 0; i < rows.length; i++) {

            let tr = `<tr>`
            for (let j = 0; j < (rows[i].cells.length - 1 ); j++) {

                if( j != 4 ){
                    tr += `<td> ${rows[i].cells[j].innerHTML} </td>`;
                }
            }
            tr+=`</tr>`
            tableData += tr

        }
        vartual_table.innerHTML = tableData;
        

        var tableSelect = vartual_table;
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