@extends('tms::layouts.master')
@section('title', trans('tms::training.speaker_evaluation'))

@section('content')
    <section id="assessment">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="repeat-form"><i class="ft-list black"></i> @lang('tms::training.speaker_evaluation')</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row pl-2 pr-2">
                            <div class="col-md-3">
                                <label class="mt-1" for="training-filter">{!! trans('tms::training.title') !!} :</label>
                                <select class="custom-select select-filter training-filter select mr-sm-2"
                                    id="training-filter"></select>
                            </div>
                            <div class="col-md-3">
                                <label class="mt-1" for="course-filter">{!! trans('tms::course.title') !!} :</label>
                                <select class="custom-select select-filter training-filter select mr-sm-2"
                                    id="course-filter"></select>
                            </div>
                            <div class="col-md-3">
                                <label class="mt-1" for="module-filter">{!! trans('tms::module.title') !!} :</label>
                                <select class="custom-select select-filter training-filter select mr-sm-2"
                                    id="module-filter"></select>
                            </div>
                            <div class="col-md-3">
                                <label class="mt-1" for="session-filter">{!! trans('tms::session.title') !!} :</label>
                                <select class="custom-select select-filter training-filter select mr-sm-2"
                                    id="session-filter"></select>
                            </div>
                            <div class="col-md-3">
                                <label class="mt-1" for="speaker-filter">{!! trans('tms::training.evaluation.speaker_name') !!}
                                    :</label>
                                <select class="custom-select select-filter training-filter select mr-sm-2"
                                    id="speaker-filter"></select>
                            </div>

                            <div class="col-md-12 pull-right">
                                <a href="{{ route('trainings.public.index') }}" target="_blank"
                                    class="btn btn-primary btn-sm pull-right">@lang('tms::speaker.add')</a>
                            </div>
                        </div>
                        {{-- <div class="row">
                            
                        </div> --}}
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered alt-pagination">
                                        <thead>
                                            <tr>
                                                <th>@lang('labels.serial')</th>
                                                <th>@lang('tms::training.training_name')</th>
                                                <th>@lang('tms::training.evaluation.course_name')</th>
                                                <th>@lang('tms::training.module_name')</th>
                                                <th>@lang('tms::training.evaluation.session_name')</th>
                                                <th>@lang('tms::training.evaluation.speaker_name')</th>
                                                <th>@lang('tms::training.remark_total') (5)</th>
                                                @foreach ($questions as $question)
                                                    <th>@lang('tms::assessment_questions.' . $question->name) (5)</th>
                                                @endforeach
    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessionsAssessments as $key => $assessment)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $assessment->training_name }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('speakers.evaluations.charts.index', [
                                                                'course' => $assessment->course_id,
                                                                'speaker' => $assessment->speaker_id,
                                                            ]) }}">
                                                            {{ $assessment->course_name ?? trans('labels.not_found') }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $assessment->module_name ?? trans('labels.not_found') }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('speakers.evaluations.charts.show', [$assessment->session_id]) }}">{{ $assessment->session_name ?? trans('labels.not_found') }}</a>
                                                    </td>
                                                    <td>{{ $assessment->speaker_name ?? trans('labels.not_found') }}</td>
                                                    <td>
                                                        {{ $assessment->assessment_value_in_word ?? trans('labels.not_found') }}
                                                        ({{ $assessment->final_average ?? trans('labels.not_found') }})
                                                    </td>
                                                    @foreach ($questions as $question)
                                                        @php
                                                            $questionAnswer = $assessment->individual_question_avg_values->where('name', $question->name)->first();
                                                            $value = optional($questionAnswer)['value'];
                                                        @endphp
                                                        <td>{{ assessment_value_in_word($value, false) }}
                                                            ({{ number_format($value, 2) }})
                                                        </td>
                                                    @endforeach
    
                                                </tr>
                                            @endforeach
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

@push('page-js')
    <script>
        $(document).ready(function() {

            let table = $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        className: 'csv',
                    },
                    {
                        extend: 'excel',
                        className: 'excel',
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
            table.draw()
            $('select').select2({});

            $.ajax({
                url: "/tms/get-filter-data/speaker-evaluations",
                success: function(result) {
                    distributeData(result)
                }
            });

            let selectFilter = $('.select-filter')
            selectFilter.on('change', function() {
                table.draw();
            });


        });
        // table.draw()


        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {

                let training_filter_value = $('#training-filter').val();
                let course_filter_value = $('#course-filter').val();
                let module_filter_value = $('#module-filter').val();
                let session_filter_value = $('#session-filter').val();
                let speaker_filter_value = $('#speaker-filter').val();

                let training_data = data[1].trim();
                let course_data = data[2].trim();
                let module_data = data[3].trim();
                let session_data = data[4].trim();
                let speaker_data = data[5].trim();

                if (
                    isEqual(training_filter_value, training_data) &&
                    isEqual(course_filter_value, course_data) &&
                    isEqual(module_filter_value, module_data) &&
                    isEqual(session_filter_value, session_data) &&
                    isEqual(speaker_filter_value, speaker_data)
                ) {
                    return true;
                } else {
                    return false
                }
            }
        );

        function isEqual(filterValue, columnValue) {
            if (filterValue != null) {
                return (filterValue === "all" ? true : (filterValue === columnValue));
            } else {
                return true;
            }
        }

        $('#training-filter, #course-filter, #module-filter, #session-filter, #speaker-filter').change((e) => {
            let id = e.target.id;
            let options = $(`#${e.target.id} option`);
            let value = $(`#${e.target.id}`).val();
            checkForChange(id, options, value)
        })

        function distributeData(data) {

            let dependencyData = [
                data.course_dependancy,
                data.training_dependancy,
                data.session_dependancy,
                data.module_dependancy,
                data.speaker_dependancy
            ];

            let filtersData = data.filters;

            generateOption(filtersData);
            dependencyManger(dependencyData);

        }


        function generateOption(filtersData) {

            let trainings_filter_data = filtersData[0];
            let courses_filter_data = filtersData[1];
            let modules_filter_data = filtersData[2];
            let sessions_filter_data = filtersData[3];
            let speakers_filter_data = filtersData[4];

            createOptions(trainings_filter_data, 'training-filter');
            createOptions(courses_filter_data, 'course-filter');
            createOptions(sessions_filter_data, 'module-filter');
            createOptions(modules_filter_data, 'session-filter');
            createOptions(speakers_filter_data, 'speaker-filter');

        }

        function createOptions(optionsdata, id) {

            let option = `<option value='all' selected>All</option>`;
            for (const key in optionsdata) {
                option += `<option value='${optionsdata[key]}'>${optionsdata[key]}</option>`
            }
            $(`#${id}`).html(option);
        };

        let training_dependency;
        let cource_dependency;
        let session_dependency;
        let module_dependency;
        let speaker_dependency;

        function dependencyManger(data) {

            training_dependency = data[0];
            cource_dependency = data[1];
            session_dependency = data[2];
            module_dependency = data[3];
            speaker_dependency = data[4];

        }


        function changeDependentOptions(id, dependency, value, trail) {

            let optionData = [];

            for (const key in dependency) {


                for (const key2 in dependency[key]) {

                    switch (id) {
                        case 'course-filter':

                            if (is_true(dependency[key][key2].training_name, trail[0])) {
                                optionData.push(dependency[key][key2].course_name);
                            };

                            break;
                        case 'module-filter':
                            if (is_true(dependency[key][key2].training_name, trail[0]) &&
                                is_true(dependency[key][key2].course_name, trail[1])) {
                                optionData.push(dependency[key][key2].module_name);
                            };
                            break;
                        case 'session-filter':
                            if (is_true(dependency[key][key2].training_name, trail[0]) &&
                                is_true(dependency[key][key2].course_name, trail[1]) &&
                                is_true(dependency[key][key2].module_name, trail[2])) {
                                optionData.push(dependency[key][key2].session_name);
                            };

                            break;
                        case 'speaker-filter':
                            if (is_true(dependency[key][key2].training_name, trail[0]) &&
                                is_true(dependency[key][key2].course_name, trail[1]) &&
                                is_true(dependency[key][key2].module_name, trail[2]) &&
                                is_true(dependency[key][key2].session_name, trail[3])) {
                                optionData.push(dependency[key][key2].speaker_name);
                            };
                            break;
                    }

                }

            }
            resetOption(id, optionData)

        }

        function resetOption(id, optionData) {

            let uniqueData = optionData.filter((value, index, self) => {
                return self.indexOf(value) === index
            })

            option = `<option value='all'>All</option>`
            uniqueData.forEach(element => {
                option += `<option value='${element}'>${element}</option>`
            });
            $(`#${id}`).html(option);
        }

        function changeCourseDependentOption(dependency, value, trail) {

            let moduleOption = [];
            let sessionOption = [];
            let speakerOption = [];

            for (const key in dependency) {
                for (const key2 in dependency[key]) {

                    if (is_true(dependency[key][key2].training_name, trail[0])) {

                        moduleOption.push(dependency[key][key2].module_name);
                        sessionOption.push(dependency[key][key2].session_name);
                        speakerOption.push(dependency[key][key2].speaker_name);

                    };

                }
            }

            resetOption('module-filter', moduleOption)
            resetOption('session-filter', sessionOption)
            resetOption('speaker-filter', speakerOption)

        }


        function changeModuleDependentOption(dependency, value, trail) {

            let sessionOption = [];
            let speakerOption = [];

            for (const key in dependency) {
                for (const key2 in dependency[key]) {

                    if (is_true(dependency[key][key2].training_name, trail[0]) && is_true(dependency[key][key2].course_name,
                            trail[1])) {

                        sessionOption.push(dependency[key][key2].session_name);
                        speakerOption.push(dependency[key][key2].speaker_name);

                    };

                }
            }

            resetOption('session-filter', sessionOption)
            resetOption('speaker-filter', speakerOption)

        }

        function changeSessionDependentOption(dependency, value, trail) {

            let speakerOption = [];

            for (const key in dependency) {
                for (const key2 in dependency[key]) {

                    if (is_true(dependency[key][key2].training_name, trail[0]) &&
                        is_true(dependency[key][key2].course_name, trail[1]) &&
                        is_true(dependency[key][key2].module_name, trail[2])) {

                        speakerOption.push(dependency[key][key2].speaker_name);

                    };

                }
            }

            resetOption('speaker-filter', speakerOption)
        }

        function is_true(value1, value2) {
            if (value2 != 'all') {

                if (value1 == value2) {
                    return true
                } else {
                    return false
                }

            } else {
                return true
            }
        }


        function checkForChange(id, options, value) {

            let trail;
            let training_filter_value = $('#training-filter').val();
            let course_filter_value = $('#course-filter').val();
            let module_filter_value = $('#module-filter').val();
            let session_filter_value = $('#session-filter').val();
            let speaker_filter_value = $('#speaker-filter').val();

            switch (id) {
                case 'training-filter':
                    trail = [
                        [training_filter_value]
                    ];
                    changeDependentOptions('course-filter', training_dependency, value, trail);
                    changeCourseDependentOption(training_dependency, value, trail);

                    break;
                case 'course-filter':
                    trail = [
                        [training_filter_value],
                        [course_filter_value]
                    ];
                    changeDependentOptions('module-filter', cource_dependency, value, trail);
                    changeModuleDependentOption(cource_dependency, value, trail);

                    break;
                case 'module-filter':
                    trail = [
                        [training_filter_value],
                        [course_filter_value],
                        [module_filter_value]
                    ];
                    changeDependentOptions('session-filter', session_dependency, value, trail);
                    changeSessionDependentOption(session_dependency, value, trail);

                    break;
                case 'session-filter':
                    trail = [
                        [training_filter_value],
                        [course_filter_value],
                        [module_filter_value],
                        [session_filter_value]
                    ];
                    changeDependentOptions('speaker-filter', module_dependency, value, trail);

                    break;
                case 'speaker-filter':
                    // changeSpeakerDependententOption(speaker_dependency,speaker_filter_value,trail);
                    break;
                default:
            }

        }
    </script>
@endpush
