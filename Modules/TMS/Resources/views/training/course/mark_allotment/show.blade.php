@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($course->markAllotments->count())
        <div class="col-md-12 p-0">
            <div class="table-responsive">
                <table class="master table table-bordered" id="table">
                    <thead>
                    <tr>
                        <th>@lang('labels.title')</th>
                        <th>Mark</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($course->markAllotments as $markAllotment)
                        <tr>
                            <td>{{ trans('tms::mark_allotment_type.' . $markAllotment->type->title) }}</td>
                            <td>{{ $markAllotment->mark }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a class="master btn btn-sm btn-info"
           href="{{ route('trainings.courses.marks.allotments.edit', ['training' => $training, 'course' => $course]) }}">
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('table','courses_marks_allotments')" class="master btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        
    {{-- <div class="row">
        <div class="col-md-2">
            <div class="form-group mb-0">
                {!! Form::radio(
                    'grade_wise', 'grade-wise', false,
                    ['class' => 'required',
                    'id' => 'grade_wise',
                    'onclick' => 'setRadio(this)'
                    ]) 
                !!}
                <span>@lang('tms::course_grade.grade_wise')</span>
            </div>
            <img src="{{ asset('images/training/grade-wise.png') }}" width="70px" height="70px"/>
        </div>
        <div class="col-md-2">
            <div class="form-group mb-0">
                {!! Form::radio(
                    'grade_wise', 'by-type', false, ['class' => 'required',
                    'id' => 'by_type',
                    'onclick' => 'setRadio(this)'
                    ]) 
                !!}
                <span>@lang('tms::course_grade.by_type')</span>
            </div>
            <img src="{{ asset('images/training/by-type.png') }}" width="70px" height="70px"/>
        </div>
    </div> --}}
    <a class="btn btn-sm btn-info"
        href="{{ route('trainings.courses.marks.allotments.edit', ['training' => $training, 'course' => $course]) }}">
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

    function setRadio(obj) 
    {
        if(document.getElementById('grade_wise').checked == true) {
            window.location.href= "{{route('trainings.courses.grade.show', [$training->id,$course->id])}}";
        }else if(document.getElementById('by_type').checked == true){
            window.location.href= "{{route('trainings.courses.marks.allotments.edit', [$training->id,$course->id])}}";
        }
    }
</script>