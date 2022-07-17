@extends('ims::layouts.master')

@section('title', trans('ims::inventory.title'))

@section('content')
    <div class="card">
        <!-- Inventory Request Workflow table -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if(count($inventoryRequests))
                        <div class="card-body">
                            <h5>{{ trans('labels.pending_items') }}</h5>
                            <table class="table table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>@lang('labels.feature')</th>
                                    <th>@lang('labels.message')</th>
                                    <th>@lang('labels.requester')</th>
                                    <th>@lang('ims::inventory.type')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($inventoryRequests as $inventoryRequest)
                                    <tr>
                                        <td>{{ $inventoryRequest->title }}</td>
                                        <td>
                                            @if(count($inventoryRequest->stateDetails) > 0)
                                                {{  $inventoryRequest->stateDetails->last()->message }}
                                            @endif
                                        </td>
                                        <td>{{ $inventoryRequest->requester->name }}</td>
                                        <td>@lang('ims::inventory.inventory_request_types.' . $inventoryRequest->type)</td>
                                        <td>{{ $inventoryRequest->status }}</td>
                                        <td>{{ $inventoryRequest->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ $inventoryRequest->getStateUrl() }}">
                                                @lang('labels.details')
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Auction Request Workflow table -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if(count($auctions))
                        <div class="card-body">
                            <h5>{{ trans('ims::auction.pending_items') }}</h5>
                            <table class="table table-bordered alt-pagination">
                                <thead>
                                <tr>
                                    <th>@lang('labels.feature')</th>
                                    <th>@lang('labels.message')</th>
                                    <th>@lang('labels.requester')</th>
                                    <th>@lang('labels.status')</th>
                                    <th>@lang('labels.date')</th>
                                    <th>@lang('labels.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($auctions as $auction)
                                    <tr>
                                        <td>{{ $auction->title }}</td>
                                        <td>
                                            @if(count($auction->stateDetails) > 0)
                                                {{  $auction->stateDetails->last()->message }}
                                            @endif
                                        </td>
                                        <td>{{ $auction->requester->name }}</td>
                                        <td>{{ $auction->status }}</td>
                                        <td>{{ $auction->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ $auction->getStateUrl() }}">
                                                @lang('labels.details')
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div>
    @can('ims-dashboard-content-access')
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                       href="#tab1"
                                       aria-expanded="true">@lang('ims::report.inventory.request.users.menu.title')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                       href="#tab2"
                                       aria-expanded="false">@lang('ims::report.inventory.request.category_items.menu.title')</a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">

                                <!--Tab 1 -->
                                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true">
                                    <section class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive" id="users-datatable-div">
                                                <table id="users" class="inventory-report-table table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('labels.serial')</th>
                                                        <th>@lang('labels.date')</th>
                                                        <th>@lang('labels.requester')</th>
                                                        <th>@lang('ims::inventory-list-table.columns.name.title')</th>
                                                        <th>@lang('labels.quantity')</th>
                                                        <th>@lang('ims::inventory.inventory_request_type')</th>
                                                        <th>@lang('ims::inventory.inventory_request_purpose')</th>
                                                        <th>@lang('ims::location.from_location')</th>
                                                        <th>@lang('ims::location.to_location')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($requestDetails))
                                                        @foreach($requestDetails as $requestDetail)
                                                            <tr>
                                                                <td width="2%">{{ $loop->iteration }}</td>
                                                                <td width="10%">{{ $requestDetail->request->created_at->format('d-m-Y') }}</td>
                                                                <td>{{ $requestDetail->request->requester->name }}</td>
                                                                <td>{{ $requestDetail->category->name }}</td>
                                                                <td>{{ $requestDetail->quantity }}</td>
                                                                <td>{{ trans('ims::inventory.inventory_request_types.' . $requestDetail->request->type) }}</td>
                                                                <td>
                                                                    {{ __('ims::inventory.inventory_request_purposes.' . $requestDetail->request->purpose) }}
                                                                </td>
                                                                <td>{{ $requestDetail->request->fromLocation ? $requestDetail->request->fromLocation->name : ''}}</td>
                                                                <td>{{ $requestDetail->request->toLocation ? $requestDetail->request->toLocation->name : ''}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                                <!--Tab 2 -->
                                <div role="tabpanel" class="tab-pane" id="tab2" aria-expanded="false">
                                    <section class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive" id="category-items-datatable-div">
                                                <table id="category-items"
                                                       class="inventory-report-table table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th width="2%">@lang('labels.serial')</th>
                                                        <th>@lang('labels.date')</th>
                                                        <th>@lang('ims::inventory-list-table.columns.name.title')</th>
                                                        <th>@lang('labels.quantity')</th>
                                                        <th>@lang('ims::inventory.inventory_request_type')</th>
                                                        <th>@lang('ims::inventory.inventory_request_purpose')</th>
                                                        <th>@lang('ims::location.from_location')</th>
                                                        <th>@lang('ims::location.to_location')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($requestDetails))
                                                        @foreach($requestDetails as $requestDetail)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td width="10%">{{ $requestDetail->request->created_at->format('d-m-Y') }}</td>
                                                                <td>{{ $requestDetail->category->name }}</td>
                                                                <td>{{ $requestDetail->quantity }}</td>
                                                                <td>{{ trans('ims::inventory.inventory_request_types.' . $requestDetail->request->type) }}</td>
                                                                <td>
                                                                    {{ __('ims::inventory.inventory_request_purposes.' . $requestDetail->request->purpose) }}
                                                                </td>
                                                                <td>{{ $requestDetail->request->fromLocation ? $requestDetail->request->fromLocation->name : ''}}</td>
                                                                <td>{{ $requestDetail->request->toLocation ? $requestDetail->request->toLocation->name : ''}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <style type="text/css">
        .dataTables_length {
            width: 600px;
        }
    </style>
@endpush

@push('page-js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">

        let dataTableConfig = {
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
        };

        let usersTable = $('#users').DataTable(dataTableConfig);
        let categoryItemsTable = $('#category-items').DataTable(dataTableConfig);
        // users-datatable-div
        // category-items-datatable-div
        $('#users-datatable-div div.dataTables_length').append(`
            <label style="margin-left: 20px;">
                    <input style="display: inline; width: 161px;" class= "form-control form-control-sm calendar-input" type="text" name="user_daterange" value="01/01/2018 - 01/15/2018" />
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

        $('#category-items-datatable-div div.dataTables_length').append(`
            <label style="margin-left: 20px;">
            <input style="display: inline; width: 92%;" class= "form-control form-control-sm calendar-input" type="text" name="category_item_daterange" value="01/01/2018 - 01/15/2018" />
            </label>
        `).append(`
            <label style="margin-left: 20px;">
                <select style="display: inline; width: 100%;" class="category-items-list form-control form-control-sm">
                    <option value="all">All Item</options>
                    @foreach($categoryItems as $categoryItem)
            <option value="{{ $categoryItem->name }}">{{ $categoryItem->name }}</option>
                    @endforeach
            </select>
        </label>
`);


        var usersDateRangePicker = $('input[name="user_daterange"]'),
            categoryItemsDateRangePicker = $('input[name="category_item_daterange"]'),
            userLists = $('select.users-list'),
            categoryItemsList = $('select.category-items-list'),
            selectedUser = "all",
            selectedCategoryItem = "all",
            startDate = moment("{{ count($requestDetails) ? $requestDetails->last()->request->created_at->format('d-m-Y') : '01-05-2019'}}", 'DD-MM-YYYY'),
            endDate = moment("{{ count($requestDetails) ? $requestDetails->first()->request->created_at->format('d-m-Y') : '01-05-2019' }}", 'DD-MM-YYYY');

        usersDateRangePicker.daterangepicker({
            opens: 'center',
            startDate: startDate,
            endDate: endDate,
            locale: {
                format: 'DD-MM-YYYY'
            }

        }, function (start, end, label) {
            startDate = start;
            endDate = end;

        });

        categoryItemsDateRangePicker.daterangepicker({
            opens: 'center',
            startDate: startDate,
            endDate: endDate,
            locale: {
                format: 'DD-MM-YYYY'
            }

        }, function (start, end, label) {
            startDate = start;
            endDate = end;

        });


        usersDateRangePicker.on('apply.daterangepicker', function (e, picker) {
            startDate = picker.startDate;
            endDate = picker.endDate;

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    let date = moment(data[2], 'DD-MM-YYYY'),
                        userName = data[1],
                        status = false;

                    if (selectedUser === "all" || (selectedUser === userName)) {
                        status = true;
                    }

                    if (startDate == null && endDate == null && status === true) {
                        return true;
                    } else if (startDate == null && date <= endDate && status === true) {
                        return true;
                    } else if (endDate == null && date >= startDate && status === true) {
                        return true;
                    } else if (date <= endDate && date >= startDate && status === true) {
                        return true;
                    }

                    return false;
                }
            );

            usersTable.draw();
            $.fn.dataTable.ext.search.pop();

        });

        userLists.on('change', function (e) {

            selectedUser = $(this).val();

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    let userName = data[2],
                        date = moment(data[1], 'DD-MM-YYYY'),
                        status = false;

                    if (selectedUser === "all" || (selectedUser === userName)) {
                        status = true;
                    }

                    if (startDate == null && endDate == null && status === true) {
                        return true;
                    } else if (startDate == null && date <= endDate && status === true) {
                        return true;
                    } else if (endDate == null && date >= startDate && status === true) {
                        return true;
                    } else if (date <= endDate && date >= startDate && status === true) {
                        return true;
                    }

                    return false;
                }
            );

            usersTable.draw();
            $.fn.dataTable.ext.search.pop();

        });

        categoryItemsDateRangePicker.on('apply.daterangepicker', function (e, picker) {
            startDate = picker.startDate;
            endDate = picker.endDate;

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    let date = moment(data[1], 'DD-MM-YYYY'),
                        categoryItemName = data[2],
                        status = false;

                    if (selectedCategoryItem === "all" || (selectedCategoryItem === categoryItemName)) {
                        status = true;
                    }

                    if (startDate == null && endDate == null && status === true) {
                        return true;
                    } else if (startDate == null && date <= endDate && status === true) {
                        return true;
                    } else if (endDate == null && date >= startDate && status === true) {
                        return true;
                    } else if (date <= endDate && date >= startDate && status === true) {
                        return true;
                    }

                    return false;
                }
            );

            categoryItemsTable.draw();
            $.fn.dataTable.ext.search.pop();

        });

        categoryItemsList.on('change', function (e) {

            selectedCategoryItem = $(this).val();

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    let categoryItemName = data[2],
                        date = moment(data[1], 'DD-MM-YYYY'),
                        status = false;

                    if (selectedCategoryItem === "all" || (selectedCategoryItem === categoryItemName)) {
                        status = true;
                    }

                    if (startDate == null && endDate == null && status === true) {
                        return true;
                    } else if (startDate == null && date <= endDate && status === true) {
                        return true;
                    } else if (endDate == null && date >= startDate && status === true) {
                        return true;
                    } else if (date <= endDate && date >= startDate && status === true) {
                        return true;
                    }

                    return false;
                }
            );

            categoryItemsTable.draw();
            $.fn.dataTable.ext.search.pop();

        });

    </script>
@endpush
