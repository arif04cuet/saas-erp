@extends('tms::layouts.master')
@section('title', trans('tms::training.training_list'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title"><i class="las la-list-alt black"></i> {{ trans('tms::training.training_list') }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div>
                                @can('add_trainings')
                                    <a href="{{ route('training.create') }}" class="master btn btn-primary btn-sm">
                                        <i class="ft-plus white"></i> {{ trans('tms::training.training_create') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="master table table-striped table-bordered training-table">
                                        <thead>
                                            <tr>
                                                <th width="10px">{{ trans('labels.serial') }}</th>
                                                <th>{{ trans('tms::training.training_name') }}</th>
                                                <th>{{ trans('tms::training.through_training') }}</th>
                                                <th>{{ trans('tms::training.duration') }}</th>
                                                <th>{{ trans('labels.status') }}</th>
                                                <th>{{ trans('tms::training.total_registered_trainees') }}</th>
                                                <th>{{ trans('tms::training.registration_deadline') }}</th>
                                                <th>{{ trans('tms::training.training_category') }}</th>
                                                <th width="40">{{ trans('labels.action') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trainings as $training)
                                                <tr>
                                                    <td scope="row" class="text-center">
                                                        {{ $loop->iteration }}</th>
                                                    <td>
                                                        <a href="{{ route('training.show', $training->id) }}">
                                                            {{ $training->getTitle() }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($training->through_training == 'offline')
                                                            @lang('tms::training.through.offline')
                                                        @else
                                                            @lang('tms::training.through.online')
                                                        @endif
                                                    </td>
                                                    @if (optional($training)->start_date)
                                                        <td>
                                                            {{ date('d/m/Y', strtotime($training->start_date)) }}
                                                            @if (optional($training)->end_date)
                                                                - {{ date('d/m/Y', strtotime($training->end_date)) }}
                                                            @endif
                                                        </td>
                                                    @else
                                                        <td>@lang('labels.not_available')</td>
                                                    @endif
                                                    <td>{{ trans('tms::training.status.' . $training->modified_status) }}
                                                    </td>
                                                    <td>{{ $training->total_registered_trainees }}</td>
                                                    @if (optional($training)->registration_deadline)
                                                        <td>{{ date('d/m/Y', strtotime($training->registration_deadline)) }}
                                                        </td>
                                                    @else
                                                        <td>@lang('labels.not_available')</td>
                                                    @endif
                                                    <td>{{ $training->category ? $training->category->getName() : '' }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            @can('update_trainings')
                                                                <a href="{{ route('training.edit', $training->id) }}" class="master btn btn-info">
                                                                    <i class="ft-edit-2"></i>
                                                                    <!-- {{ trans('labels.edit') }} -->
                                                                </a>
                                                            @endcan
    
                                                            @can('view_trainings')
                                                                <a href="{{ route('training.show', $training->id) }}" class="master btn btn-success">
                                                                    <i class="ft-eye white"></i>
                                                                    <!-- {{ trans('labels.details') }} -->
                                                                </a>
                                                            @endcan

                                                            @can('view_training_courses')
                                                                <a href="{{ route('training.courses', [$training->id]) }}" class="master btn btn-info" title="{{ trans('tms::training.course.list') }}">
                                                                    <i class="ft-list"></i>
                                                                </a>
                                                            @endcan
                                                        </div>
    
                                                        <!-- <button id="imsRequestList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="master btn btn-info">
                                                            <i class="la la-cog"></i>
                                                        </button> -->
    
    
                                                        <span aria-labelledby="imsRequestList" class="dropdown-menu d-none">
                                                            <div class="btn-group">
                                                                @can('update_trainings')
                                                                    <a href="{{ route('training.edit', $training->id) }}" class="master btn btn-info">
                                                                        <i class="ft-edit-2"></i>
                                                                        <!-- {{ trans('labels.edit') }} -->
                                                                    </a>
                                                                @endcan
    
                                                                @can('view_trainings')
                                                                    <a href="{{ route('training.show', $training->id) }}" class="master btn btn-success">
                                                                        <i class="ft-eye white"></i>
                                                                        <!-- {{ trans('labels.details') }} -->
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                            {{-- 
                                                            @can('add_training_courses')
                                                                <a href="{{ route('trainings.courses.create', [$training->id]) }}"
                                                                    class="dropdown-item">
                                                                    <i
                                                                        class="ft-plus"></i>{{ trans('tms::training.course.add_course') }}
                                                                </a>
                                                            @endcan
                                                            @can('view_training_courses')
                                                                <a href="{{ route('training.courses', [$training->id]) }}"
                                                                    class="dropdown-item">
                                                                    <i class="ft-list"></i>
                                                                    {{ trans('tms::training.course.list') }}
                                                                </a>
                                                            @endcan
                                                            @can('view_training_course_module_batch_session_schedules')
                                                                <a href="{{ route('trainings.schedules.sessions.index', [$training->id]) }}"
                                                                    class="dropdown-item">
                                                                    <i class="ft-list"></i>
                                                                    {{ trans('tms::session.sessions') }}
                                                                </a>
                                                            @endcan --}}
                                                        </span>
                                                    </td>
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

@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
    <script>
        function getMomentDates(dateRange) {
            let dateFormat = 'DD/MM/YYYY';
            let [startDate, endDate] = dateRange.split('-');
            startDate = moment(startDate.trim(), dateFormat);
            endDate = moment(endDate.trim(), dateFormat);
            return {
                startDate,
                endDate
            };
        }

        $(document).ready(function() {
            let categoryFilterElementId = 'filter-category';
            let statusFilterElementId = 'filter-status';
            let dateFilterElementId = 'filter-date';

            let table = $('.training-table').dataTable({});

            let categoryFilter = `
                <label class="d-flex align-items-center mr-1">
                    <span>{{ trans('tms::training.training_category') }}&nbsp;</span>
                    <select id="${categoryFilterElementId}" class="form-control form-control-sm" style="width:90px">
                            <option value="all">{{ trans('labels.all') }}</option>
                    </select>
                </label>`;

            let statusFilter = `
                <label class="d-flex align-items-center mr-1">
                    {{ trans('labels.status') }}&nbsp;
                    <select id="${statusFilterElementId}" class="form-control form-control-sm" style="width:90px"></select>
                </label>`;

            $(".dataTables_filter").prepend(`
                ${categoryFilter}
                ${statusFilter}
            `);

            let categoryNames = @json($categoryNames);

            categoryNames.forEach(function(categoryName) {
                $('#filter-category').append(`<option>${categoryName}</option>`);
            });

            let defaultStatus = "{{ trans('tms::training.status.running') }}";

            ["all", "{{ trans('tms::training.status.running') }}",
                "{{ trans('tms::training.status.draft') }}", "{{ trans('tms::training.status.completed') }}",
                "{{ trans('tms::training.status.upcoming') }}"
            ].forEach(function(status) {
                if (status === "all") {
                    $('#filter-status').append(`<option value="all" selected>` +
                        "{{ trans('labels.all') }}" + `</option>`);
                } else if (status === defaultStatus) {
                    $('#filter-status').append(`<option value="${status}">${status}</option>`);
                } else {
                    $('#filter-status').append(`<option value="${status}">${status}</option>`);
                }
            });

            let categoryFilterSelector = `#${categoryFilterElementId}`;
            let statusFilterSelector = `#${statusFilterElementId}`;
            $(`${categoryFilterSelector}, ${statusFilterSelector}`).on('change', function() {
                table.DataTable().draw();
            });

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    let categoryFilterValue = $(categoryFilterSelector).val();
                    let statusFilterValue = $(statusFilterSelector).val();
                    let status = data[3];
                    let category = data[6];

                    return isEqual(categoryFilterValue, category) &&
                        isEqual(statusFilterValue, status);
                }
            );

            function isEqual(filterValue, columnValue) {
                return (filterValue === 'all' || filterValue === columnValue);
            }

            function isTrainingInBetweenDateRange(filterDateRange, trainingDuration) {
                let {
                    startDate: filterStartDate,
                    endDate: filterEndDate
                } = getMomentDates(filterDateRange);
                let {
                    startDate: trainingStartDate,
                    endDate: trainingEndDate
                } = getMomentDates(trainingDuration);

                return trainingStartDate.isSameOrAfter(filterStartDate) &&
                    trainingEndDate.isSameOrBefore(filterEndDate);
            }

            const startOfMonth = @json($startDate->format('d/m/Y'));
            const endOfMonth = @json($endDate->format('d/m/Y'));
            table.DataTable().draw();
        });
    </script>
@endpush
