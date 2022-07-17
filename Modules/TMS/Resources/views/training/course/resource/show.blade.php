@component('tms::training.course.partial.layout.show_tab_layout', [
    'training' => $training,
    'course' => $course,
    'action' => 'show'
])
        @if($course->resources()->count())
            <div class="row">
                <div class="col-md-6">
                    <label for="">@lang('tms::course.employee')</label>
                    <div class="table-responsive" id="table-employee">
                        @foreach($employeeResources as $employeeResource)
                            <table class="table table-emp">
                                <tr>
                                    <td> <b> @lang('labels.name')</b></td>
                                    <td>{{ $employeeResource->employee->getName() }}</td>
                                </tr>
                                <tr>
                                    <td> <b> @lang('labels.short_name')</b></td>
                                    <td>{{ $employeeResource->short_name }}</td>
                                </tr>
                                <tr>
                                    <td> <b> @lang('labels.email_address')</b></td>
                                    <td>{{ $employeeResource->employee->email }}</td>
                                </tr>
                            </table>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="">@lang('tms::course.guest')</label>
                    <div class="table-responsive">
                        @foreach($guestResources as $guestResource)
                            <table class="table table-gst" id="table-guest">
                                <tr>
                                    <td> <b> @lang('labels.name')</b></td>
                                    <td>{{ $guestResource->guest->first_name }} {{ $guestResource->guest->last_name }}</td>
                                </tr>
                                <tr>
                                    <td> <b> @lang('labels.short_name')</b></th>
                                    <td>{{ $guestResource->guest->short_name }}</td>
                                </tr>
                                <tr>
                                    <td> <b> @lang('labels.email_address')</b></td>
                                    <td>{{ $guestResource->guest->email }}</td>
                                </tr>
                                <tr>
                                    <td> <b> @lang('labels.mobile')</b></td>
                                    <td>{{ $guestResource->guest->mobile_no }}</td>
                                </tr>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="{{ $resourceEditRoute }}"
               class="btn btn-sm btn-info">
                <i class="ft ft-edit"></i> @lang('labels.edit')
            </a>
            <a role="button" href="" onclick="exportTableToExcel('table-emp','courses_employee_resources')" class="btn btn-sm btn-info">
                @lang('labels.export') ( @lang('labels.employee') )
            </a>
            <a role="button" href="" onclick="exportTableToExcel('table-gst','courses_guest_resources')" class="btn btn-sm btn-info">
                @lang('labels.export') ( @lang('labels.guest') )
            </a>
        @else
        <a href="{{ $resourceEditRoute }}"
           class="btn btn-sm btn-info"
        >
            <i class="ft ft-plus"></i> @lang('labels.add')
        </a>
        @endif
@endcomponent
<script>
        //--------------------------------------------
        function generateTable( className ){
            let tables = document.getElementsByClassName(className);
            let vartual_table = document.createElement('table');

            let th = [];
            let td = [];

            for (const key in tables) {
                if( key <= key.length + 1 || key >= key.length + 1 ){
                    for( i=0;i<tables[key].rows.length;i++ ){
                        for( j=0;j<tables[key].rows[i].cells.length;j++ ){

                            if( j%2 == 0 ){
                                th.push(`<td> ${tables[key].rows[i].cells[j].getElementsByTagName('b')[0].innerHTML}</td>`);
                            }else{
                                td.push(`<td> ${tables[key].rows[i].cells[j].innerHTML}</td>`);
                            }

                        }
                    }

                }
            }

            th = th.filter((v, i, a) => a.indexOf(v) === i);
            let all_tr = '';
            let all_th = '<tr>';
            let all_table_data = '';
            let count = 0;
            let tr;
            th.forEach( ( data ) => { all_th+= `${data}`; })
            all_th += `</tr>`


            td.forEach( data => {

                if(count === 0){
                    tr = `<tr>`
                }

                if( count < th.length  ){

                    tr += data
                    count++

                }

                if(count === th.length ){

                    tr      += `</tr>`
                    all_tr  += tr
                    tr       = ``
                    count    = 0

                }


            });


            all_table_data += all_th;
            all_table_data += all_tr;
            vartual_table.innerHTML = all_table_data;
            return vartual_table
        }
        //--------------------------------------------

    function exportTableToExcel(className, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = generateTable(className);


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