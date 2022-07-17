@extends('tms::layouts.master')
@section('title', 'Training Course')

@section('content')
    <section id="scheduled-sessions-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><i class="ft-list"></i> @lang('tms::schedule.session.title') - {{ optional($training)->getTitle() }}</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="row m-1">
                                    <div class="col-12">
                                        <div class="row">
                                            @if($filters->count())
                                                @foreach($filters as $key => $filter)
                                                    @if($filter['key'] != 'training')
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="">@lang('tms::' . $filter['key'] . '.' . $filter['label'])</label>
                                                                <select class="form-control select-filter select-filter-{{ $filter['key'] }}">
                                                                    <option
                                                                        value="all">@lang('labels.all') @lang('tms::' . $filter['key'] . '.' . $filter['label'])</option>
                                                                    @if(count($filter['data']))
                                                                        @foreach($filter['data'] as $data)
                                                                            <option
                                                                                value="{{ $data['title'] }}">{{ $data['title'] }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
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
                                    <table class="master table table-striped table-bordered scheduled-sessions-table" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th data-index-key="serial">@lang('labels.serial')</th>
                                            <th data-index-key="course">@lang('tms::course.title')</th>
                                            <th data-index-key="module">@lang('tms::module.title')</th>
                                            <th data-index-key="session">@lang('tms::session.title')</th>
                                            <th data-index-key="batch">@lang('tms::batch.batch')</th>
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
                                                    <td>{{ optional($schedule->session->module->course)->name }}</td>
                                                    <td>{{ optional($schedule->session->module)->title }}</td>
                                                    <td>{{ optional($schedule->session)->title }}</td>
                                                    <td>{{ optional($schedule->batch)->title }}</td>
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

        $(document).ready(function ($) {

            $('select').select2({
                placeholder: 'select 1'
            });

            let table = $('.scheduled-sessions-table').DataTable({
                scrollX: true,
                scrollCollapse: true,
                columnDefs: [
                    {
                        "targets": [6],
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
                        scheduledDate = `${data[6]} - ${data[6]}`;

                    for (let i = 0; i < filterKeys.length; i++) {
                        let filterValue = $('.select-filter-' + filterKeys[i]).val(),
                            columnValue = data[$('table>thead>tr').find('[data-index-key=' + filterKeys[i] + ']').index()];

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
