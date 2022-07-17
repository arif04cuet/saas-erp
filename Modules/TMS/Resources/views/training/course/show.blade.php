@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
    <div class="table-responsive">
        <table class="master table table-bordered" id="information-table">
            <thead>
                <tr>
                    <th>@lang('labels.name')</th>
                    <th>@lang('tms::course.course_id')</th>
                    <th>@lang('tms::course.start_time')</th>
                    <th>@lang('tms::course.end_time')</th>
                    <th>@lang('tms::training.registration_deadline')</th>
                    <th>@lang('tms::training.venue')</th>
                    <th>@lang('tms::trainee_type.title')</th>
                    <th>@lang('labels.photo')</th>
                </tr>
            </thead>
            <tr style="border-top: none">
                <td>{{ $course->getName()}}</td>
                <td>
                    <a href="{{ route('training.show', $course->id) }}">
                        {{ $course->uid }}
                    </a>
                </td>
                <td>{{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($course->registration_deadline)->format('d/m/Y') }}</td>
                <td>
                    {{ App::isLocale('bn') ? optional($course->venue)->title_bn :optional($course->venue)->title }}
                </td>
                <td>
                    {{ $course->participantType ? $course->participantType->getTitle() : trans('labels.not_found') }}
                </td>
                <td>
                    @if(!isset($course->photo) || empty($course->photo))
                    <img src="https://via.placeholder.com/150" class="img-fluid img-responsive">
                    @else
                    <img src="{{ url("/file/get?filePath=" .  $course->photo) }}" class="img-fluid img-responsive">
                    @endif
                </td>
            </tr>

        </table>
        <a href="{{ route('trainings.courses.edit', [$training->id, $course->id]) }}" class="master btn btn-sm btn-info custombtnbg">
            <i class="ft ft-edit"></i> @lang('labels.edit')
        </a>
        <a role="button" href="" onclick="exportTableToExcel('information-table','General_Information')"
           class="master btn btn-sm btn-info custombtnbg">
            @lang('labels.export')
        </a>
    </div>

@endcomponent

<script>
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);

        let dataTab = document.createElement('table'),
            dataTabBody = document.createElement('tbody'),
            rows = tableSelect.getElementsByTagName('tr');

        let cloneRows = '';
        for (var i = 0; i < rows.length; i++) {
            if (i >= 0) {
                cloneRows += rows[i].outerHTML;
            }
        }

        dataTabBody.innerHTML = cloneRows;
        dataTab.innerHTML = dataTabBody.outerHTML;

        var tableHTML = dataTab.outerHTML.replace(/ /g, '%20');
        filename = filename ? filename + '.xls' : 'excel_data.xls';
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            downloadLink.download = filename;
            downloadLink.click();
        }
    }
</script>
