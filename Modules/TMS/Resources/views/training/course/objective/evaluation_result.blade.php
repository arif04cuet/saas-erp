@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])

    @if(isset($chartsData['questionnaire']))
        <a href="#" id="downloadPdf"><span class="la la-download"></span>
            {{trans('labels.download')}}
        </a>
    @endif
    <br/><br/>

    <div id="reportPage">
        @if(isset($chartsData['objective']))
            <div class="">
                <canvas id="myChart"></canvas>
            </div>
        @endif

        <hr/>

        @if(isset($chartsData['questionnaire']) && count($chartsData['questionnaire'])>0)
            @foreach($chartsData['questionnaire'] as $subSectionId => $subsection)
                <div class="">
                    <canvas id="myChart_{{$subSectionId}}"></canvas>
                </div>
                <hr/>
            @endforeach
        @endif

        @if(!isset($chartsData['objective']) &&  !isset($chartsData['questionnaire']))
            <div class="text-center">
                <h3>@lang('tms::course_evaluation.course_empty_message')</h3>
            </div>
        @endif
    </div>
    {{--{{ dd($objective) }}--}}

    {{--    {{ dd($getSectionInsideSubSection) }}--}}
@endcomponent

<script src="{{ asset('theme/vendors/js/charts/chart.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
<script>
    $(document).ready(function () {
        @if(isset($chartsData['objective']))
        @php
            $arr =    array_keys($chartsData['objective']);
            $sectionId =   reset($arr);
            $subSectionTitle =  reset($getSectionInsideSubSection[$sectionId])['title_en'];

            $colors = [ 'rgba(54, 162, 235, 0.2)', 'rgba(243, 123, 239, 0.2)'];
            $index = 0;
            $subSectionId = 0;
        @endphp
        let chartLabel = @json($objectiveLabel);
        let data = [
                @foreach($chartsData['objective'] as $subSectionId => $item)
                @php
                    $subSectionId = $subSectionId;
                @endphp
            {
                label: `{{ $allSubSections[$subSectionId]->title_en }}`,
                data: @json(array_values($item)).concat({{round(collect($item)->avg(), 2)}}),
                backgroundColor: "{{ $colors[$index++] }}",
                borderWidth: 1
            },
            @endforeach
        ];
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabel.concat('Remark Total'),
                datasets: data,
            },
            options: {
                title: {
                    display: true,
                    text: "{{ $subSectionTitle  }}",
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            max: 5
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                        }
                    }]
                }
            }
        });
        @endif


        // ========================starting regular question evaluation==========================================
        @if(isset($chartsData['questionnaire']) && count($chartsData['questionnaire'])>0)

        @foreach($chartsData['questionnaire'] as $subSectionId => $subSectionData)
        let chartLabel_{{$subSectionId}} = @json($allQuestionnaire[$subSectionId]);
        @php
            $colors = [ 'rgba(54, 162, 235, 0.2)', 'rgba(243, 123, 239, 0.2)'];
            $index = 0;
            $subSectionId = $subSectionId;
        @endphp
        let data_{{$subSectionId}} = [
            {
                label: "'{!! trans('tms::training.remark') !!}'",
                data:
                @json(array_values($subSectionData)).concat({{round(collect($subSectionData)->avg(), 2)}}),
                backgroundColor: "{{ $colors[$index++] }}",
                borderWidth: 1
            },

        ];
        var chartId = "myChart_{{$subSectionId}}"
        var ctx = document.getElementById(chartId).getContext('2d');
        var myChart_{{$subSectionId}} = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabel_{{$subSectionId}}.concat('Remark Total'),
                datasets: data_{{$subSectionId}},
            },
            options: {
                title: {
                    display: true,
                    text: "{{ reset($getSectionInsideSubSection[$subSectionId])['title_en'] }}",
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            max: 5
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                        }
                    }]
                }
            }
        });

        @endforeach
        @endif
    });
</script>


<script>
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);


        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
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

    $('#downloadPdf').click(function (event) {
        // get size of report page
        var reportPageHeight = $('#reportPage').innerHeight();
        var reportPageWidth = $('#reportPage').innerWidth();

        // create a new canvas object that we will populate with all other canvas objects
        var pdfCanvas = $('<canvas />').attr({
            id: "canvaspdf",
            width: 1300,
            height: 2500
        });

        // keep track canvas position
        var pdfctx = $(pdfCanvas)[0].getContext('2d');
        var pdfctxX = 200;
        var pdfctxY = 0;
        var buffer = 100;

        // for each chart.js chart
        $("canvas").each(function (index) {
            // get the chart height/width
            var canvasHeight = $(this).innerHeight();
            var canvasWidth = $(this).innerWidth();

            // draw the chart into the new canvas
            pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
            pdfctxY += canvasHeight + buffer;
        });

        // create new pdf and add our new canvas as an image
        // var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
        var pdf = new jsPDF('p', 'mm', 'a4');
        var width = pdf.internal.pageSize.width;
        var height = pdf.internal.pageSize.height;
        pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0, width, height);
        // download the pdf
        pdf.save('report.pdf');
    });
</script>
