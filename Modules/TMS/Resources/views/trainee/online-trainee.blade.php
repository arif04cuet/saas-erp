@extends('tms::layouts.master')
@section('title', trans('tms::training.trainee_card_title'))

@section('content')
    <section id="user-list">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <span class="card-title-sub-text"><i class="las la-list-alt black"></i> {{ trans('labels.online_enroll_trainee') }} </span>
                            </h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div style="overflow-x:auto">
                                    <table class="master table table-striped table-bordered trainee-table">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('labels.serial') }}</th>
                                                <th class="d-none"></th>
                                                <th>{{ trans('tms::training.trainee_name') }}</th>
                                                <th>{{ trans('tms::trainee.designation') }}</th>
                                                <th>{{ trans('tms::training.service_code') }}</th>
                                                <th>{{ trans('tms::training.trainee_gender') }}</th>
                                                <th>{{ trans('labels.mobile') }}</th>
                                                <th>{{ trans('tms::training.email') }}</th>
                                                <th>{{ trans('labels.status') }}</th>
                                                <th>@lang('labels.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($trainees))
                                                @foreach ($trainees as $trainee)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td class="d-none">{{$trainee->training->getTitle()}}</td>
                                                        <td>
                                                            <a
                                                                href="{{ Auth::user()->can('tms-access-medical') ? route('medical.trainee.show', $trainee->id) : route('trainee.show', $trainee->id) }}">
                                                                {{ $trainee[trans('tms::trainee.name_locale')] }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if (session()->get('locale') === 'bn')
                                                                {{ optional($trainee->services)->designation_bn }}
                                                            @else
                                                                {{ optional($trainee->services)->designation }}
                                                            @endif
                                                        </td>
                                                        <td>{{ optional($trainee->services)->service_code }}</td>
                                                        <td>{{ trans('labels.' . strtolower($trainee['trainee_gender'])) }}
                                                        </td>
                                                        <td>{{ $trainee['mobile'] }}</td>
                                                        <td>{{ $trainee['email'] }}</td>
                                                        <td>
                                                            @if($trainee['status'] == null && $trainee['register_to_online'] == 'online')
                                                            {{ trans('labels.status_pending') }}
                                                            @elseif($trainee['status'] == 1 && $trainee['register_to_online'] == 'online')
                                                            {{ trans('labels.status_approved') }}
                                                            @elseif($trainee['status'] == 2 && $trainee['register_to_online'] == 'online')
                                                            {{ trans('labels.status_rejected') }}
                                                            @endif
                                                        </td>
                                                        <td style="text-center">
                                                            <div class="btn-group">
                                                                @if($trainee['status'] == null && $trainee['register_to_online'] == 'online')
                                                                    <a href="{{ route('online.enroll.trainee.approve', $trainee->id) }}"
                                                                        class="master btn btn-info">
                                                                        <i class="ft-eye"></i>
                                                                        {{ trans('labels.approve') }}
                                                                    </a>
                                                                    @elseif($trainee['status'] == 1 && $trainee['register_to_online'] == 'online')
                                                                    <a href="{{ route('online.enroll.trainee.reject', $trainee->id) }}"
                                                                        class="master btn btn-danger">
                                                                        <i class="ft-eye white"></i>
                                                                        {{ trans('labels.reject') }}
                                                                    </a>
                                                                    @elseif($trainee['status'] == 2 && $trainee['register_to_online'] == 'online')
                                                                    <a href="{{ route('online.enroll.trainee.approve', $trainee->id) }}"
                                                                        class="master btn btn-info">
                                                                        <i class="ft-eye"></i>
                                                                        {{ trans('labels.approve') }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </td>
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
@push('page-js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').select2({
                placeholder: {
                    id: '', // the value of the option
                    text: '{{ __('tms::training.select_training') }}'
                }
            });
            let training = $('.card-title-text').html();
            let title = $('.card-title-sub-text').html();
            let text = title;
            
            let categoryFilterElementId = 'filter-category';
            let statusFilterElementId = 'filter-status';

            let table = $('.trainee-table').dataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        className: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                        },
                        bom: true,
                        charset: 'utf-8',
                        extension: '.csv',
                    },
                    {
                        extend: 'excel',
                        className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
                        },
                        customize: function(xlsx) {

                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            let colmn = $('c[r=A1] t', sheet).html(text);

                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,

            });

            let categoryFilter = `<label>
                <span style="padding-right:5px">{{ trans('tms::training.training') }}</span>
            <select id="${categoryFilterElementId}" class="form-control form-control-sm"
                    style="width: 200px; float: right; margin-right: 10px; height: 35px;">
                        <option value="all">{{ trans('labels.all') }}</option>
                </select>
                </label>`;

            let statusFilter = `<label>
                <span style="padding-right:5px">{{ trans('labels.status') }}</span>
            <select id="${statusFilterElementId}" class="form-control form-control-sm"
                    style="width: 100px; float: right; margin-right: 10px; height: 35px;">
                    </select>
                </label>`;

            $(".dataTables_filter").prepend(`
            ${categoryFilter}
            ${statusFilter}`);

            let categoryNames = @json($trainings);
            categoryNames.forEach(function(categoryName) {
                $('#filter-category').append(`<option>${categoryName}</option>`);
            });

            let defaultStatus = "{{ trans('labels.all') }}";

            ["all", "{{ trans('labels.all') }}",
              "{{ trans('labels.status_pending') }}", "{{ trans('labels.status_approved') }}",
              "{{ trans('labels.status_rejected') }}"
            ].forEach(function(status) {
                // console.log(status);
                if (status === "all") {
                    $('#filter-status').append(`<option value="all" selected>` +
                        "{{ trans('labels.all') }}" + `</option>`);
                } else if (status === defaultStatus) {
                    // $('#filter-status').append(`<option value="${status}">${status}</option>`);
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
                    let status = data[8];
                    let category = data[1];
                    // console.log(category);
                    return isEqual(categoryFilterValue, category) && isEqual(statusFilterValue, status);
                }
            );

            function isEqual(filterValue, columnValue) {
                // console.log(filterValue);
                return (filterValue === 'all' || filterValue === columnValue);
            }
            table.DataTable().draw();
        });
    </script>
@endpush
