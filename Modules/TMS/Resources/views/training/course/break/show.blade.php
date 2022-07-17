@php
    $timeFormat = 'h:i A'
@endphp

@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($course->breaks->count())
        {{-- <div class="col-md-12"> --}}
            <div class="table-responsive">
                <table class="master table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>@lang('labels.title')</th>
                            <th>@lang('tms::recurring_schedule.fields.start_time.label')</th>
                            <th>@lang('tms::recurring_schedule.fields.end_time.label')</th>
                            <th>@lang('tms::venue.title.default')</th>
                        </tr>
                    </thead>
                    @foreach($course->breaks as $break)
                        <tr>
                            <td>{{ $break->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($break->start_time)->format($timeFormat) }}</td>
                            <td>{{ \Carbon\Carbon::parse($break->end_time)->format($timeFormat) }}</td>
                            <td>{{ $break->scheduledVenueTitle() }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        {{-- </div> --}}
        <a href="{{ $recurringSchedulesEditRoute }}"
           class="master btn btn-sm btn-info"
        >
            <i class="ft ft-edit"></i> @lang('labels.add')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','course_breaks_schedules')" class="master btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        <a href="{{ $recurringSchedulesEditRoute }}"
           class="master btn btn-sm btn-info"
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