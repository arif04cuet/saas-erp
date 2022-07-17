@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($course->trainingCourseGrade()->count())
        <div class="col-md-12 p-0">
            <div class="card">
                {{-- <div class="card-header pl-0">
                    <h4 class="card-title">{{trans('tms::course_grade.grading_list')}}</h4>
                </div> --}}
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard p-0">
                        <div class="table-responsive">
                            <table class="master table table-striped table-bordered training-table">
                                <thead>
                                <tr>
                                    <th>@lang('tms::course_grade.grading_mark')</th>
                                    <th>@lang('tms::course_grade.grading')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->trainingCourseGrade as $courseGrade)
                                    <tr>
                                        <td>
                                            {{ $courseGrade->grading_mark }}
                                        </td>
                                        <td>
                                            {{ $courseGrade->grade }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ $courseGradeEditRoute }}" class="master btn btn-sm btn-info">
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','course_rules_guidelines')" class="master btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        <a href="{{ $courseGradeEditRoute }}"
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
