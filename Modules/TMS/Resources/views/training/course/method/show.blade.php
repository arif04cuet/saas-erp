@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($course->methods->count())
        {{-- <div class="col-md-8"> --}}
            <div class="table-responsive">
                <table class="master table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Methods and Technologies Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    @foreach($course->methods as $method)
                        <tr>
                            <th>{{ $method->title }}</th>
                            <td>{{ $method->description }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        {{-- </div> --}}

        <a href="{{ $methodEditRoute }}" class="master btn btn-sm btn-info">
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','courses_methods')" class="master btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        <a href="{{ $methodEditRoute }}"
           class="master btn btn-sm btn-info">
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



