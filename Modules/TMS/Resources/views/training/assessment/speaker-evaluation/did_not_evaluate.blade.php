@extends('tms::layouts.master')
@section('title', trans('tms::training.trainee_card_title') . ' - ' . trans('tms::trainee.did_not_evaluated'))

@section('content')
    <section id="scheduled-sessions-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list black"></i>
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
                                            <!-- training course dropdown -->
                                            <div class="col-3">
                                                {!!
                                                     Form::label('training_course_for_dropdown', trans('tms::training_course.training_course'), ['class' => 'form-label'])
                                                 !!}
                                                {!! Form::select('training_course_for_dropdown', $jsFilterOptions['training_course_for_dropdown'] ?? [],
                                                        $dropdownSelectedValues['training_course_selected_value']?? null,
                                                        [
                                                            'class'=>'form-control select2 course-dropdown'
                                                        ])
                                                !!}
                                            </div>
                                            <!-- module course dropdown -->
                                            <div class="col-3">
                                                {!!
                                                     Form::label('module_for_dropdown', trans('tms::module.title'), ['class' => 'form-label'])
                                                 !!}
                                                {!! Form::select('module_for_dropdown', $jsFilterOptions['module_for_dropdown'] ?? [],
                                                        $dropdownSelectedValues['module_selected_value'] ?? null,
                                                        [
                                                           'class'=>'form-control select2 module-dropdown '
                                                        ])
                                                !!}
                                            </div>
    
                                            <!-- Session dropdown -->
                                            <div class="col-3">
                                                {!!
                                                     Form::label('module_for_dropdown', trans('tms::session.title'), ['class' => 'form-label'])
                                                 !!}
                                                {!! Form::select('module_for_dropdown', $jsFilterOptions['sessions_by_module'][$dropdownSelectedValues['module_selected_value']] ?? [],
                                                        $dropdownSelectedValues['session_selected_value'] ?? null,
                                                        [
                                                           'class'=>'form-control select2 session-dropdown select-filter'
                                                        ])
                                                !!}
                                            </div>
    
                                            <!-- batch course dropdown -->
                                            <div class="col-3">
                                                {!!
                                                      Form::label('batches_for_dropdown', trans('tms::batch.batch'), ['class' => 'form-label'])
                                                !!}
                                                {!! Form::select('batches_for_dropdown', $jsFilterOptions['batches_for_dropdown'] ?? [],
                                                        $dropdownSelectedValues['batch_selected_value'] ?? null,
                                                        [
                                                           'class'=>'form-control select2 batch-dropdown select-filter'
                                                        ])
                                                !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered scheduled-sessions-table"
                                           style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th data-index-key="serial">@lang('labels.serial')</th>
                                            <th data-index-key="course">@lang('tms::course.title')</th>
                                            <th data-index-key="module">@lang('tms::module.title')</th>
                                            <th data-index-key="session">@lang('tms::session.title')</th>
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
                                        @if($indexData)
                                            @foreach($indexData as $datum)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $datum->training_course_id ?? '' }}</td>
                                                    <td>{{ $datum->training_course_module_id ?? '' }}</td>
                                                    <td>{{ $datum->training_course_module_session_id ?? '' }}</td>
                                                    <td>{{ $datum->training_course_module_session_batch_id ?? '' }}</td>
                                                    <td>{{ $datum->bangla_name  ?? trans('labels.not_found')}}</td>
                                                    <td>{{ $datum->english_name ?? trans('labels.not_found') }}</td>
                                                    <td>{{ $datum->mobile ?? trans('labels.not_found') }}</td>
                                                    <td>{{ $datum->email ?? trans('labels.not_found')}}</td>
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
        //------------------------------------------------------------------//
        //---------------------for filter issue-----------------------------//
        //------------------------------------------------------------------//

        let indexData = @json($indexData);
        let masterData = @json($data);
        let jsFilterOptions = @json($jsFilterOptions);
        let selectFilter = $('.select-filter');
        let genericErrorMessage = '{!! trans('labels.generic_error_message') !!}';
        let table;

        $(document).ready(function ($) {
            table = $('.scheduled-sessions-table').dataTable({
                scrollX: true,
                scrollCollapse: true,
                columnDefs: [
                    {
                        "targets": [1, 2, 3, 4],
                        "visible": false
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv', className: 'csv',
                        exportOptions: {
                            columns: [0, 5, 6, 7, 8],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 5, 6, 7, 8],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
            selectFilter.on('change', function () {
                let values = getFilterValue();
                indexData = masterData[values['session_value']];
                reloadDatatable(indexData);
                table.DataTable().draw();
            });
            // if a module is changed, reload the session
            $('.module-dropdown').on('change', function () {
                let value = $(this).val();
                if (!value)
                    return;
                let sessionData = jsFilterOptions['sessions_by_module'][value];
                resetDropdown('.session-dropdown', sessionData);
                indexData = masterData[getFilterValue()['session_value']];
                reloadDatatable(indexData);
                table.DataTable().draw();
            });

            // if course is changed, reload all the data using ajax
            $('.course-dropdown').on('change', function () {
                let value = $(this).val();
                if (!value) {
                    alert(genericErrorMessage);
                    return;
                }
                let url = '{{route('trainings.courses.modules.sessions.evaluations.load-data',":id")}}';
                url = url.replace(":id", value);
                let message = '<div><h3>{{ trans('tms::schedule.message.submit.wait') }}</h3><br> <span class="ft-refresh-cw icon-spin font-medium-2"></span></div>';
                // block the UI
                $.blockUI({
                    message: message,
                    timeout: null, //unblock after 2 seconds
                    overlayCSS: {
                        backgroundColor: '#FFF',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });


                $.ajax({
                    url: url,
                    data: {
                        'training_course_id': value,
                    },
                    type: "get",
                    success: function (data) {
                        let selectedSessionId = data.dropdownSelectedValues['session_selected_value'];
                        masterData = data.data;
                        jsFilterOptions = data.jsFilterOptions; // important to reset session dropdown
                        if (!data) {
                            alert(genericErrorMessage);
                            return false;
                        }
                        if (data.data[selectedSessionId]) {
                            indexData = data.data[selectedSessionId];
                            console.log(indexData);
                            resetDropdown('.batch-dropdown', data.jsFilterOptions['batches_for_dropdown']);
                            resetDropdown('.module-dropdown', data.jsFilterOptions['module_for_dropdown']);
                            $('.module-dropdown').trigger('change'); // manually triggered to change the session dropdown
                            reloadDatatable(indexData);
                            table.DataTable().draw();
                            $.unblockUI();
                            return true;
                        } else {
                            alert(genericErrorMessage);
                            $.unblockUI();
                            return false;
                        }
                    },
                    error: function (request, status, error) {
                        alert(genericErrorMessage);
                        $.unblockUI();
                        return false;
                    }
                })
            });

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let values = getFilterValue();
                    let courseValue = data[1].trim(), moduleValue = data[2].trim(), sessionValue = data[3].trim(),
                        batchValue = data[4].trim();
                    return batchValue === values['batch_value'];
                    return false;
                }
            );

            function resetDropdown(className, values) {
                $(className).empty();
                let options = '';
                $.each(values, function (key, value) {
                    options += `<option value="${key}">${value}</option>`
                });
                $(className).html(options);
            }

            function getFilterValue() {
                let values = [];
                values['course_value'] = $('.course-dropdown').val();
                values['module_value'] = $('.module-dropdown').val();
                values['session_value'] = $('.session-dropdown').val();
                values['batch_value'] = $('.batch-dropdown').val();
                return values;
            }

            function reloadDatatable(data) {
                table.DataTable().clear().draw();
                for (let row = 0; row < data.length; row++) {
                    let obj = data[row];
                    table.fnAddData([
                        row + 1,
                        obj.training_course_id,
                        obj.training_course_module_id,
                        obj.training_course_module_session_id,
                        obj.training_course_module_session_batch_id,
                        obj.bangla_name,
                        obj.english_name,
                        obj.mobile,
                        obj.email
                    ]);
                }
            }
        });

    </script>
@endpush
