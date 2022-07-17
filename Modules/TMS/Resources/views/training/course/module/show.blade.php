@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    @if($modules->count())
        <div class="col-md-12 p-0">
            <div class="table-responsive">
                <table class="master table table-bordered" id="table">
                    <thead>
                    <tr id="thead">
                        <th>@lang('labels.serial')</th>
                        <th>@lang('tms::module.module_heading')</th>
                        <th>@lang('labels.number')</th>
                        <th>@lang('labels.total') @lang('tms::session.title')</th>
                        <th>@lang('labels.action_session')</th>
                        <th>@lang('labels.action_batch')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modules as $module)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $module->title }}</td>
                            <td>{{ $module->mark }}</td>
                            <td>
                                <a href="{{ route('trainings.courses.modules.sessions.show',
                                ['training' => $training,
                                'course' => $course,
                                'module' => $module]) }}">{{ $module->sessions->count() }}</a>
                            </td>
                            <td>
                                <a href="{{ route('trainings.courses.modules.sessions.edit', [$training, $course, $module]) }}"
                                   class="master btn btn-sm btn-primary"><i
                                        class="ft ft-edit"></i> @lang('tms::session.title') @lang('labels.update')
                                </a>
                            </td>
                            <td>
                                @if($course->batches()->count())
                                    <select id="batchId" class="form-contro"
                                            onchange="javascript:location.href = this.value">
                                        <option value="#">-- @lang('tms::session.select_batch') --</option>
                                    @foreach($course->batches as $key => $batch)
                                            <option
                                                value="{{route('trainings.courses.modules.batches.sessions.schedules.edit', [$training, $course, $module, $batch]) }}">
                                                @lang('tms::schedule.link_title', ['attribute' => $batch->title])
                                            </option>

                                        @endforeach
                                    </select>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a class="master btn btn-sm btn-info"
           href="{{ route('trainings.courses.modules.edit', ['training' => $training, 'course' => $course]) }}"><i
                class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="#" onclick="exportTableToExcel('table','courses_module')" class="master btn btn-sm btn-info">
            @lang('labels.export')
        </a>
    @else
        <a class="master btn btn-sm btn-info"
           href="{{ route('trainings.courses.modules.edit', ['training' => $training, 'course' => $course]) }}"><i
                class="ft ft-plus"></i> @lang('labels.add')
        </a>
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
                } else if (j < 2) {
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

    $("select#batchId").select2();

</script>
