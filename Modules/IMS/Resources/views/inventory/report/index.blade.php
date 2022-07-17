@extends('ims::layouts.master')

@section('title', trans('ims::report.inventory.request.users.menu.title') .' '. trans('labels.list'))

@section('content')
    <section id="product-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::report.inventory.request.users.menu.title') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="inventory-report-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('labels.requester')</th>
                                        <th>@lang('ims::inventory-list-table.columns.name.title')</th>
                                        <th>@lang('labels.quantity')</th>
                                        <th>@lang('ims::inventory.inventory_request_type')</th>
                                        <th>@lang('ims::inventory.inventory_request_purpose')</th>
                                        <th>@lang('ims::location.from_location')</th>
                                        <th>@lang('ims::location.to_location')</th>
                                        <th width="80px">@lang('labels.date')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($requestDetails))
                                            @foreach($requestDetails as $requestDetail)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $requestDetail->request->requester->name }}</td>
                                                    <td>{{ $requestDetail->category->name }}</td>
                                                    <td>{{ $requestDetail->quantity }}</td>
                                                    <td>{{ trans('ims::inventory.inventory_request_types.' . $requestDetail->request->type) }}</td>
                                                    <td>
                                                        {{ __('ims::inventory.inventory_request_purposes.' . $requestDetail->request->purpose) }}
                                                    </td>
                                                    <td>{{ $requestDetail->request->fromLocation ? $requestDetail->request->fromLocation->name : ''}}</td>
                                                    <td>{{ $requestDetail->request->toLocation ? $requestDetail->request->toLocation->name : ''}}</td>
                                                    <td>{{ $requestDetail->request->created_at->format('d-m-Y') }}</td>
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
    </section>
@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style type="text/css">
        .dataTables_length {
            min-width: 600px;
        }
    </style>
@endpush
@push('page-js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">

        let table = $('.inventory-report-table').DataTable({
            "columnDefs": [
                {"orderable": false, "targets": 5}
            ],
            "language": {
                "search": "{{ trans('labels.search') }}",
                "zeroRecords": "{{ trans('labels.No_matching_records_found') }}",
                "lengthMenu": "{{ trans('labels.show') }} _MENU_ {{ trans('labels.records') }}",
                "info": "{{trans('labels.showing')}} _START_ {{trans('labels.to')}} _END_ {{trans('labels.of')}} _TOTAL_ {{ trans('labels.records') }}",
                "infoFiltered": "( {{ trans('labels.total')}} _MAX_ {{ trans('labels.infoFiltered') }} )",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "{{ trans('labels.next') }}",
                    "previous": "{{ trans('labels.previous') }}"
                },
            },

        });

        $('div.dataTables_length').append(`
            <label style="margin-left: 20px;">
                    <input style="display: inline; width: 161px;" class= "form-control form-control-sm calendar-input" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
            </label>
        `).append(`
            <label style="margin-left: 20px;">
                    <select style="display: inline; width: 175px;" class="users-list form-control form-control-sm">
                        <option value="all">All Users</options>
                        @foreach($users as $user)
                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
            </label>
        `);

        var dateRangePicker = $('input[name="daterange"]'),
            userLists = $('select.users-list'),
            selectedUser = "all",
            startDate = moment("{{ count($requestDetails) ? $requestDetails->last()->request->created_at->format('d-m-Y') : '01-05-2019'}}", 'DD-MM-YYYY'),
            endDate = moment("{{ count($requestDetails) ? $requestDetails->first()->request->created_at->format('d-m-Y') : '01-05-2019' }}", 'DD-MM-YYYY');

        dateRangePicker.daterangepicker({
            opens: 'center',
            startDate: startDate,
            endDate: endDate,
            locale: {
                format: 'DD-MM-YYYY'
            }

        }, function(start, end, label) {
            startDate = start;
            endDate = end;

        });


        dateRangePicker.on('apply.daterangepicker', function (e, picker) {
            startDate = picker.startDate;
            endDate = picker.endDate;

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {

                    let date = moment(data[7], 'DD-MM-YYYY'),
                        userName = data[1],
                        status = false;

                    if(selectedUser === "all" || (selectedUser === userName)) {
                        status = true;
                    }

                    if (startDate == null && endDate == null && status === true) {
                        return true;
                    }else if(startDate == null && date <= endDate && status === true) {
                        return true;
                    }else if(endDate == null && date >= startDate && status === true) {
                        return true;
                    }else if(date <= endDate && date >= startDate && status === true) {
                        return true;
                    }

                    return false;
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

        userLists.on('change', function (e) {

            selectedUser = $(this).val();

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {

                    let userName = data[1],
                        date = moment(data[7], 'DD-MM-YYYY'),
                        status = false;

                    if(selectedUser === "all" || (selectedUser === userName)) {
                        status = true;
                    }

                    if (startDate == null && endDate == null && status === true) {
                        return true;
                    }else if(startDate == null && date <= endDate && status === true) {
                        return true;
                    }else if(endDate == null && date >= startDate && status === true) {
                        return true;
                    }else if(date <= endDate && date >= startDate && status === true) {
                        return true;
                    }

                    return false;
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();

        });

    </script>
@endpush
