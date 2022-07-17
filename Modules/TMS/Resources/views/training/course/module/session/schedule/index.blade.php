@extends('tms::layouts.master')
@section('title', 'Training Course')

@section('content')
    <section id="scheduled-sessions-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list black"></i> @lang('tms::schedule.session.title')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row m-1">
                                    <div class="col-12">
                                        <div class="row">
                                            @if($filters->count())
                                                @foreach($filters as $key => $filter)
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label
                                                                for="">@lang('tms::' . $filter['key'] . '.' . $filter['label'])</label>
                                                            <select
                                                                class="form-control select-filter select-filter-{{ $filter['key'] }}" id="{{ $filter['key'] }}-option">
                                                                {{-- <option value="all">@lang('labels.all') @lang('tms::' . $filter['key'] . '.' . $filter['label'])</option> --}}
                                                                <option value="all">@lang('labels.all')</option>
                                                                @if(count($filter['data']))
                                                                    @foreach($filter['data'] as $data)
                                                                        <option
                                                                            data-prepend-text="{{ $filter['key'] == 'session' ? $data['speaker'] : '' }}"
                                                                            value="{{ $data['title'] }}">{{ $data['title'] }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">@lang('labels.date')</label>
                                                    <input type="text" class="form-control date-filter">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered scheduled-sessions-table" style="">
                                        <thead>
                                        <tr>
                                            <th data-index-key="serial">@lang('labels.serial')</th>
                                            <th data-index-key="training">@lang('tms::training.title')</th>
                                            <th data-index-key="course">@lang('tms::course.title')</th>
                                            <th data-index-key="module">@lang('tms::module.title')</th>
                                            <th data-index-key="session">@lang('tms::session.title')</th>
                                            <th data-index-key="batch">@lang('tms::batch.batch')</th>
                                            <th data-index-key="speaker">@lang('tms::speaker.title')</th>
                                            <th data-index-key="date">@lang('tms::schedule.fields.date')</th>
                                            <th data-index-key="date">@lang('tms::schedule.fields.date')</th>
                                            <th data-index-key="start">@lang('tms::schedule.fields.start')</th>
                                            <th data-index-key="end">@lang('tms::schedule.fields.end')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($scheduledSessions->count())
                                            @foreach($scheduledSessions as $key => $schedule)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($schedule->session->module->course->training)->title }}</td>
                                                    <td>{{ optional($schedule->session->module->course)->name }}</td>
                                                    <td>{{ optional($schedule->session->module)->title }}</td>
                                                    <td>{{ optional($schedule->session)->title }}</td>
                                                    <td>{{ optional($schedule->batch)->title }}</td>
                                                    <td>{{ optional($schedule->session->speaker)->getResourceName() }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('j F, Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($schedule->start)->format('H:i A') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($schedule->end)->format('H:i A') }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script type="text/javascript">

        function getMomentDates(dateRange) {
            let dateFormat = 'DD/MM/YYYY';
            let [startDate, endDate] = dateRange.split('-');
            startDate = moment(startDate.trim(), dateFormat);
            endDate = moment(endDate.trim(), dateFormat);
            return {startDate, endDate};
        }
        
        let filterKeys_data = @json($filterKeys);
        let filterdata = @json($filterdata);
        let filters_value = [];
        
        function getFilterData(){
            Value_array = []
            filterKeys_data.forEach( filter => {
                Value_array.push($(`.select-filter-${filter}`).val());
            });
            filters_value = Value_array
        }

        function unique(array){
            return array.filter((v, i, a) => a.indexOf(v) === i)
        }

        function multidimantion_unique(array) {
            return array.map(JSON.stringify).reverse() // convert to JSON string the array content, then reverse it (to check from end to begining)
            .filter(function(item, index, arr){ return arr.indexOf(item, index + 1) === -1; }) // check if there is any occurence of the item in whole array
            .reverse().map(JSON.parse) // revert it to original state
        }

        function generateOption(data,is_session){
            let option;
            if(is_session){
                option = `<option value='all'> @lang('labels.all') </option>`
                data.forEach( ( d ) => {
                    option+=`<option data-prepend-text = '${d[1]}' value='${d[0]}'> ${d[0]} </option>`
                })
            }else{
                option = `<option value='all'> @lang('labels.all') </option>`
                data.forEach( ( d ) => {
                    option+=`<option value='${d}'> ${d} </option>`
                })
            }

            $('select').select2({
                placeholder: 'select 1',
                templateResult: function (optionElement) {

                    let prependText = $(optionElement.element).attr('data-prepend-text');

                    if (prependText === '' || prependText === null || prependText === undefined) {
                        return $('<span>' + optionElement.text + '</span>');
                    }

                    return $('<span>' + optionElement.text + ' - <strong>' + prependText + '</strong></span>');
                },
            });
            return option;
        }

        function getData(data,key) {

            if(key!='session_title'){
                return unique( data.map( ( velue ) => { return velue[key] } ) );
            }else{
                return multidimantion_unique( data.map( ( velue ) => { return [velue[key],velue['speaker']] } ) );
            }

        }

        function changeFilterValue(id){

            let filteredData;
            
            switch (id) {
                case 'training-option':

                    filteredData = filterdata.filter( ( data ) =>{
                        return (is_equal(filters_value[0],data['training_title']))
                    })
                    
                    $(".select-filter-course").html(generateOption(getData(filteredData,'course_title'),false))
                    $(".select-filter-module").html(generateOption(getData(filteredData,'module_title'),false))
                    $(".select-filter-session").html(generateOption(getData(filteredData,'session_title'),true))
                    $(".select-filter-batch").html(generateOption(getData(filteredData,'batch_title'),false))

                    break;
                case 'course-option':

                    filteredData = filterdata.filter( ( data ) =>{
                        return (is_equal(filters_value[0],data['training_title']) &&
                                is_equal(filters_value[1],data['course_title']))
                    })

                    $(".select-filter-module").html(generateOption(getData(filteredData,'module_title'),false))
                    $(".select-filter-session").html(generateOption(getData(filteredData,'session_title'),true))
                    $(".select-filter-batch").html(generateOption(getData(filteredData,'batch_title'),false))
                    break;
                case 'module-option':

                    filteredData = filterdata.filter( ( data ) =>{
                        return (is_equal(filters_value[0],data['training_title'])   && 
                                is_equal(filters_value[1],data['course_title'])     &&
                                is_equal(filters_value[2],data['module_title']))
                    })

                    $(".select-filter-session").html(generateOption(getData(filteredData,'session_title'),true))
                    $(".select-filter-batch").html(generateOption(getData(filteredData,'batch_title'),false))
                    break;
                case 'session-option':

                    filteredData = filterdata.filter( ( data ) =>{
                        return (is_equal(filters_value[0],data['training_title'])  &&
                                is_equal(filters_value[1],data['course_title'])    &&
                                is_equal(filters_value[2],data['module_title'])    &&
                                is_equal(filters_value[3],data['session_title'])
                                )
                    })

                    $(".select-filter-batch").html(generateOption(getData(filteredData,'batch_title'),false))
                    break;

                default:
                    break;
            }

            
        }

        function is_equal( value1,value2 ){
            return value1 != 'all' ? value1 == value2 : true
        }

        $('.select-filter').change( (e) => {
            getFilterData();
            changeFilterValue(e.target.id);
        })

        $(document).ready(function ($) {
            $('select').select2({
                placeholder: 'select 1',
                templateResult: function (optionElement) {

                    let prependText = $(optionElement.element).attr('data-prepend-text');

                    if (prependText === '' || prependText === null || prependText === undefined) {
                        return $('<span>' + optionElement.text + '</span>');
                    }

                    return $('<span>' + optionElement.text + ' - <strong>' + prependText + '</strong></span>');
                },
            });

            let table = $('.scheduled-sessions-table').DataTable({
                scrollX: true,
                columnDefs: [
                    {
                        "targets": [8],
                        "visible": false,
                    },
                ]
            });


            let dateFilterContainer = $('.date-filter'),
                selectFilter = $('.select-filter'),
                filterKeys = @json($filterKeys);

            selectFilter.on('change', function () {
                table.draw();
            });

            dateFilterContainer.on('change', function () {
                table.draw();
            });

            dateFilterContainer.daterangepicker({
                startDate: moment().add(1, 'day'),
                endDate: moment().add(1, 'day'),
                showDropdowns: true,
                autoApply: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let matched = true,
                        dateRangeFilterValue = dateFilterContainer.val(),
                        scheduledDate = `${data[8]} - ${data[8]}`;

                    for (let i = 0; i < filterKeys.length; i++) {
                        let filterValue = $('.select-filter-' + filterKeys[i]).val()
                        let columnValue = data[$('table>thead>tr').find('[data-index-key=' + filterKeys[i] + ']').index()];

                        if (!isEqual(filterValue, columnValue)) {
                            matched = false;
                        }

                        if (matched === false) {
                            break;
                        }
                    }

                    return matched && isSessionScheduledBetweenDateRange(dateRangeFilterValue, scheduledDate);
                }
            );

            function isEqual(filterValue, columnValue) {
                return (filterValue === "all" || filterValue === columnValue);
            }

            function isSessionScheduledBetweenDateRange(filterDateRange, scheduledDate) {
                let {startDate: filterStartDate, endDate: filterEndDate} = getMomentDates(filterDateRange),
                    {startDate: scheduledStartDate, endDate: scheduledEndDate} = getMomentDates(scheduledDate);

                return scheduledStartDate.isSameOrAfter(filterStartDate)
                    && scheduledEndDate.isSameOrBefore(filterEndDate);
            }

            table.draw();

        });
    </script>
@endpush
