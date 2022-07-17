@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    <!-- TODO: change if parameter to mark value count-->
    @if($course->markAllotments->count())
        <div class="col-md-12 p-0">
            <div class="pull-right mb-2">
                <!-- certificate send trainees button -->
                <a target="_blank"
                   href="{{ route('training.certificate.send',$course->training) }}"
                   class="btn btn-primary btn-sm">
                    <i class="ft ft-award"></i> @lang('tms::certificate.link.send_button_title')
                </a>
                <!-- all certificate print button -->
                <a target="_blank"
                   href="{{ route('trainings.courses.certificates.archives.show', ['training' => $course->training, 'course' => $course]) }}"
                   class="btn btn-primary btn-sm">
                    <i class="ft ft-printer"></i> @lang('tms::certificate.archive.button.title')
                </a>
                <!-- export option -->
                <a role="button" href="" onclick="exportTableToExcel('table','courses_marks_values')"
                   class="btn btn-sm btn-info">
                    @lang('labels.export')
                </a>
            </div>

            <div class="card-body">
                {!! Form::open(['url' =>  route('trainees.courses.marks.values.import', $course->id),
                        'class' => 'form', 'novalidate',
                        'method' => 'post',
                        'enctype' => 'multipart/form-data'])
                !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control btn-sm"
                                   accept=".csv, .xlsx, .xls"
                                   type="file" id="import_file"
                                   name="import_file" required>
                            <label class="label red"
                                   for="import_file">{{trans('tms::training.trainee_import_filetype_alert')}}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit"
                                    name="fetch_trainee">{{trans('tms::training.file_import')}}</button>
                            <a href="{{ route('trainees.courses.marks.sample.file', ['training' => $course->training, 'course' => $course]) }}"
                               class="btn btn-primary btn-sm mt-1">
                                <i class="ft ft-download"></i> @lang('labels.sample_file')
                            </a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <div class="table-responsive">
                <table class="master table table-bordered" id="table" style="font-size:12px">
                    <thead>
                    <tr>
                        <th>@lang('tms::training.trainee_name')</th>
                        @foreach($markAllotmentTypeTitles as $allotmentTypeTitle)
                            <th>{{ $allotmentTypeTitle }}</th>
                        @endforeach
                        <th>@lang('tms::course.total_number')</th>
                        <th>@lang('tms::course.letter_grade')</th>
                        <th>@lang('labels.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($traineesWithMarks as $trainee)
                        @php 
                        // dd($trainee);
                            $totalMark = 0;
                        @endphp
                        <tr>
                            <th>{{ $trainee->full_name }}</th>
                            @foreach($trainee->achieved_marks as $achieved_mark)
                                @php
                                 $totalMark = (int)$trainee->achieved_marks->sum('value');
                                @endphp
                                <td>
                                    @if(is_null(optional($achieved_mark)->value))
                                        {{trans('tms::training_course.not_marked') ?? 'Not Marked'}}
                                    @else
                                        @enToBnNumber(optional($achieved_mark)->value ?? 0 )
                                    @endif
                                </td>
                            @endforeach
                            
                            @php
                                $grade = Modules\TMS\HTTP\Controllers\TraineeCourseMarkValueController::getCourseGradingInfo($course,$totalMark);
                                // dd($grade);
                            @endphp
                            
                            <td>{{ $totalMark }}</td>
                            <td>{{ $grade }}</td>
                            <td class="text-center">
                                <span class="dropdown">
                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" class="btn btn-info customabtn">
                                        <i class="la la-cog"></i>
                                    </button>
                                    <span aria-labelledby="btnSearchDrop2"
                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                          <a href="{{ route('trainees.courses.marks.values.sheet', [
                                                $training->id,
                                                $course->id,
                                                $trainee->id
                                            ]) }}"
                                             class="dropdown-item" target="_blank">
                                             <i class="la la-eye"></i> @lang('labels.details')
                                          </a>
                                          <a href="{{ route('trainees.courses.marks.values.edit', [
                                                $training->id,
                                                $course->id,
                                                $trainee->id
                                            ]) }}"
                                             class="dropdown-item">
                                                <i class="ft ft-edit"></i> @lang('labels.edit')
                                          </a>
                                        @if($trainee->should_show_certificate_link)
                                            <a href="{{ $trainee->certificate_link }}"
                                               class="dropdown-item">
                                                <i class="la la-certificate"></i> @lang('tms::trainee.certificate')
                                            </a>
                                        @endif
                                    </span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endcomponent
<script>

    function exportTableToExcel(id, filename = '') {

        var downloadLink;
        var dataType = 'application/vnd.ms-excel';

        let table = document.getElementById(id);
        let rows = table.rows;

        let vartual_table = document.createElement('table');
        let tableData = '';

        for (let i = 0; i < rows.length; i++) {

            let tr = `<tr>`
            for (let j = 0; j < (rows[i].cells.length - 1); j++) {
                if (j == 2) {
                    if (rows[i].cells[j].getElementsByTagName('a')[0] != undefined) {
                        tr += ` <td> ${rows[i].cells[j].getElementsByTagName('a')[0].innerHTML} </td> `;
                    } else {
                        tr += `<td> ${rows[i].cells[j].innerHTML} </td>`;
                    }
                } else {
                    tr += `<td> ${rows[i].cells[j].innerHTML} </td>`;
                }
            }
            tr += `</tr>`
            tableData += tr

        }

        vartual_table.innerHTML = tableData
        var tableSelect = vartual_table;
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>
