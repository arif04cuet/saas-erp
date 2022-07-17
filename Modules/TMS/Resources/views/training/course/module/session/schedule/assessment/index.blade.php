@extends('tms::layouts.master')
@section('title', trans('tms::training.trainee_card_title') . ' - ' . trans('tms::trainee.did_not_evaluated'))

@section('content')
    <section id="scheduled-sessions-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{
                                trans('tms::training.trainee_card_title')
                                . ' - '
                                . trans('tms::trainee.did_not_evaluated')
                            }}
                        </h4>
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
                                                            class="form-control select-filter select-filter-{{ $filter['key'] }}" id="select-filter-{{ $filter['key'] }}">
                                                            <option value="all" data-prepend-text="">@lang('labels.all') @lang('tms::' . $filter['key'] . '.' . $filter['label'])</option>

                                                            @if(count($filter['data']))

                                                                @foreach($filter['data'] as $data)
                                                                    <option
                                                                        data-prepend-text="{{ $filter['key'] == 'session' ? $data['speaker'] : '' }}"
                                                                        value="{{ $data['id'] }}">{{ $data['title'] }}</option>
                                                                @endforeach

                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered scheduled-sessions-table"
                                       style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th data-index-key="serial">@lang('labels.serial')</th>
                                        <th data-index-key="training">@lang('tms::training.title')</th>
                                        <th data-index-key="training">@lang('tms::training.title')</th>
                                        <th data-index-key="course">@lang('tms::course.title')</th>
                                        <th data-index-key="course">@lang('tms::course.title')</th>
                                        <th data-index-key="module">@lang('tms::module.title')</th>
                                        <th data-index-key="module">@lang('tms::module.title')</th>
                                        <th data-index-key="session">@lang('tms::session.title')</th>
                                        <th data-index-key="session">@lang('tms::session.title')</th>
                                        <th data-index-key="batch">@lang('tms::batch.batch')</th>
                                        <th data-index-key="batch">@lang('tms::batch.batch')</th>
                                        <th data-index-key="trainee-en-name">@lang('tms::training.full_name')
                                            (@lang('tms::training.in_bangla'))
                                        </th>
                                        <th data-index-key="trainee-bn-name">@lang('tms::training.full_name')
                                            (@lang('tms::training.in_english'))
                                        </th>
                                        <th data-index-key="trainee-mobile">@lang('labels.mobile')</th>
                                        <th data-index-key="trainee-email">@lang('tms::training.email')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @if($scheduledSessions->count())
                                        @foreach($scheduledSessions as $key => $schedule)
                                            @if($schedule->trainees->count())
                                                @foreach($schedule->trainees as  $traineeKey => $trainee)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td>{{ optional($schedule->session->module->course->training)->title }}</td>
                                                        <td>{{ optional($schedule->session->module->course->training)->id }}</td>
                                                        <td>{{ optional($schedule->session->module->course)->name }}</td>
                                                        <td>{{ optional($schedule->session->module->course)->id }}</td>
                                                        <td>{{ optional($schedule->session->module)->title }}</td>
                                                        <td>{{ optional($schedule->session->module)->id }}</td>
                                                        <td>{{ optional($schedule->session)->title }}</td>
                                                        <td>{{ optional($schedule->session)->id }}</td>
                                                        <td>{{ optional($schedule->batch)->title }}</td>
                                                        <td>{{ optional($schedule->batch)->id }}</td>
                                                        <td>{{ $trainee->bangla_name }}</td>
                                                        <td>{{ $trainee->english_name }}</td>
                                                        <td>{{ $trainee->mobile }}</td>
                                                        <td>{{ $trainee->email }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
    </section>
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>

    <script type="text/javascript">
        //------------------------------------------------------------------//
        //---------------------for filter issue-----------------------------//
        //------------------------------------------------------------------//



        let filterdata = @json($filters);

        let options = $('#select-filter-session').find('option')
        let sessionAndSpeaker = [];
        $('#select-filter-session').find('option').each( option => {
            sessionAndSpeaker.push([$(options[option]).val(),$(options[option]).attr('data-prepend-text')]);
        });

        let generateOption = (data,v,is_session = false) => {

            let option = ``;


            data.forEach(element => {
                let session_data = [];

                if(Array.isArray(element)){

                    element.forEach( entity => {
                        let found = is_session ? sessionAndSpeaker.filter(ss => { return ss[0] == entity.id }) : [];
                        let text = found.length > 0 ? found[0][1] : '';

                        option += ` <option data-prepend-text="${text}"  value="${entity.id}">
                                        ${ v ? entity.title : entity.name }
                                    </option>`
                    })

                }else{

                    let found = is_session ? sessionAndSpeaker.filter(ss => { return ss[0] == element.id }) : [];
                    let text = found.length > 0 ? found[0][1] : '';

                    option += ` <option data-prepend-text="${text}"  value="${element.id}">
                                    ${ v ? element.title : element.name }
                                </option>`

                }
            });

            return option;

        }

        let changeOption  = (optionClass,data,v,is_session) => {
            let courses = data;
            let course_option = generateOption(courses,v,is_session);
            $(`.${optionClass}`).find('option').not(':first').remove();
            $(`.${optionClass}`).append(course_option);

        }

        let changeCourseDependentOption = (data) => {

            let courses = filterdata[1].data;
            let moduls = [];
            let batches = [];

            data.forEach( entity => {

                courses.forEach( (course,key) => {

                    if( entity == course.id ){
                        moduls[key] = course.moduls;
                        batches[key] = course.batches;
                    }

                })

            })

            changeOption('select-filter-module',moduls,true);
            changeOption('select-filter-batch',batches,true);
            changeModelDependentOption(moduls)

        }

        let changeModelDependentOption = (data) => {
            let modulid = [];
            let moduleData = filterdata[2].data;
            let sessions = [];

            data.forEach(element => {
                element.forEach( entity => {
                    modulid.push(entity.id)
                })
            });


            modulid.forEach( id => {

                moduleData.forEach( (entity) => {

                    if( id == entity.id ){
                        sessions.push(entity.sessions);
                    }

                })

            });

            changeOption('select-filter-session',sessions,true,true)
        }

        $('.select-filter-training').change(function (e) {
            let training_data = filterdata[0].data
            let coursesId = []
            if(e.target.value != 'all'){

                training_data.forEach(training => {

                    if(training.id == e.target.value){
                        changeOption( 'select-filter-course', training.courses_under_training, false );
                        let data = training.courses_under_training;
                        data.forEach( entity => coursesId.push(entity.id) )
                    }

                });

            }else{

                let allData = [];
                training_data.forEach( (training) => {
                    let courses_under_training = training.courses_under_training;
                    courses_under_training.forEach( course => { allData.push(course) } )
                })
                allData.forEach( entity => coursesId.push(entity.id) )
                changeOption( 'select-filter-course', allData, false );
            }

            changeCourseDependentOption(coursesId);

        })

        $('.select-filter-course').change(function (e) {
            let courses_data = filterdata[1].data

            courses_data.forEach((course_data)=>{
                if(course_data.id == e.target.value){
                    changeOption( 'select-filter-module', course_data.moduls, true )
                    changeOption( 'select-filter-batch', course_data.batches, true )
                }
            })

        })

        $('.select-filter-module').change( function (e) {
            let modules_data = filterdata[2].data

            modules_data.forEach((module_data)=>{
                if(module_data.id == e.target.value){
                    changeOption( 'select-filter-session', module_data.sessions, true, true )
                }
            })
        })

        //------------------------------------------------------------------//
        //---------------------for filter issue-----------------------------//
        //------------------------------------------------------------------//

        function getMomentDates(dateRange) {
            let dateFormat = 'DD/MM/YYYY';
            let [startDate, endDate] = dateRange.split('-');
            startDate = moment(startDate.trim(), dateFormat);
            endDate = moment(endDate.trim(), dateFormat);
            return {startDate, endDate};
        }

        $(document).ready(function ($) {

            $('select').select2({

                placeholder: 'select 1',
                templateResult: function (optionElement) {
                    let prependText = $(optionElement.element).attr('data-prepend-text');

                    if(prependText === '' || prependText === null || prependText === undefined) {
                        return $('<span>' + optionElement.text + '</span>');
                    }

                    return $('<span>' + optionElement.text + ' - <strong>' + prependText + '</strong></span>');
                },
            });


            let table = $('.scheduled-sessions-table').DataTable({
                scrollX: true,
                scrollCollapse: true,
                columnDefs: [
                    {
                        "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                        "visible": false
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv', className: 'csv',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 7, 9, 11, 12, 13, 14],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 7, 9, 11, 12, 13, 14],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });


            let selectFilter = $('.select-filter'),
                filterKeys = @json($filterKeys);

            selectFilter.on('change', function () {
                table.draw();
            });

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let matched = true;

                    for (let i = 0; i < filterKeys.length; i++) {
                        let filterValue = $('.select-filter-' + filterKeys[i]).val(),
                            columnValue = data[(i + 1) * 2];
                        let filter = '.select-filter-' + filterKeys[i];

                        if (!isEqual(filterValue, columnValue,filter)) {
                            matched = false;
                        }

                        if (matched === false) {
                            break;
                        }
                    }

                    return matched;
                }
            );

            function isEqual(filterValue, columnValue ,filter) {
                return (filterValue === "all" ? optionNameChack(filter, columnValue) : filterValue === columnValue);
            }

            function optionNameChack(filter, columnValue) {
                // return true;
                return $(filter).find('option[value="' + columnValue + '"]').length > 0;
            }

            table.draw();

        });

    </script>
@endpush
