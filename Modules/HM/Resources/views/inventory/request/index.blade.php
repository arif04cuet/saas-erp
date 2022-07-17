@extends('hm::layouts.master')

@section('title', trans('hm::hm_inventory.hm_inventory_request') .' '. trans('labels.list'))

@section('content')
    <section id="product-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hm::hm_inventory.hm_inventory_request') @lang('labels.list')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-1">
                                <li>
                                    <a href="{{route('inventory-request.create.initial', 'requisition')}}"
                                       class="btn btn-sm btn-primary" target="_blank">
                                        <i class="ft ft-plus"></i>
                                        @lang('labels.new') @lang('hm::hm_inventory.inventory_request')
                                    </a>
                                </li>
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="inventory-request-table table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('labels.serial')</th>
                                        <th>@lang('ims::inventory.inventory_request_title')</th>
                                        <th>@lang('labels.receiver')</th>
                                        <th>@lang('ims::inventory.inventory_request_type')</th>
                                        <th>@lang('ims::location.from_location')</th>
                                        <th>@lang('ims::location.to_location')</th>
                                        <th>@lang('ims::location.status')</th>
                                        {{--<th>@lang('labels.action')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inventoryRequests as $inventoryRequest)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{ route('hm-inventory-request.show', $inventoryRequest->id) }}">
                                                    {{ $inventoryRequest->title }}
                                                </a>
                                            </td>
                                            <td>{{ $inventoryRequest->receiver ? $inventoryRequest->receiver->name : '' }}</td>
                                            <td>{{ trans('hm::hm_inventory.inventory_request_types.' . $inventoryRequest->type) }}</td>
                                            <td>{{ $inventoryRequest->fromLocation ? $inventoryRequest->fromLocation->name : ''}}</td>
                                            <td>{{ $inventoryRequest->toLocation ? $inventoryRequest->toLocation->name : ''}}</td>
                                            <td>@lang('labels.'. $inventoryRequest->status)</td>

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
    </section>
@stop

@push('page-js')
    <script>

        $(document).ready(function () {

            let table = $('.inventory-request-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 1}
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
                }
            });

            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                    {{ trans('labels.status') }}
            <select id="filter-status-select" class="form-control form-control-sm" style="width: 100px">
            </select>
        </label>
`);
            $("div.dataTables_filter").prepend(`
                <label style="margin-left: 20px;">
                    {{ trans('ims::inventory.inventory_request_type') }}
            <select id="filter-type-select" class="form-control form-control-sm" style="display: inline; width: 40%;">
            </select>
        </label>
`);

            let statusOptions = `<option value='all'>All</option>`
                + `<option value='@lang('labels.new')'>@lang('labels.new')</option>`
                + `<option value='@lang('labels.pending')'>@lang('labels.pending')</option>`
                + `<option value='@lang('labels.shared')'>@lang('labels.shared')</option>`
                + `<option value='@lang('labels.approved')'>@lang('labels.approved')</option>`
                + `<option value='@lang('labels.received')'>@lang('labels.received')</option>`
                + `<option value='@lang('labels.rejected')'>@lang('labels.rejected')</option>`;

            let typeOptions = `<option value='all'>All</option>`
                + `<option value='@lang('ims::inventory.inventory_request_types.requisition')'>@lang('ims::inventory.inventory_request_types.requisition')</option>`
                + `<option value='@lang('ims::inventory.inventory_request_types.transfer')'>@lang('ims::inventory.inventory_request_types.transfer')</option>`
                + `<option value='@lang('ims::inventory.inventory_request_types.scrap')'>@lang('ims::inventory.inventory_request_types.scrap')</option>`
                + `<option value='@lang('ims::inventory.inventory_request_types.abandon')'>@lang('ims::inventory.inventory_request_types.abandon')</option>`;


            $('#filter-status-select').append(statusOptions);
            $('#filter-status-select').val("@lang('labels.pending')");

            $('#filter-type-select').append(typeOptions);
            // $('#filter-type-select').val();


            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let filterStatusValue = $('#filter-status-select').val();
                    let filterTypeValue = $('#filter-type-select').val();
                    let statusColValue = data[6].trim();
                    let typeColValue = data[3].trim();

                    return isFilteredMatched(filterStatusValue, filterTypeValue, statusColValue, typeColValue);
                }
            );
            table.draw();

            $('#filter-status-select').on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterStatusValue = $('#filter-status-select').val();
                        let filterTypeValue = $('#filter-type-select').val();
                        let statusColValue = data[6].trim();
                        let typeColValue = data[3].trim();

                        return isFilteredMatched(filterStatusValue, filterTypeValue, statusColValue, typeColValue);
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });

            $('#filter-type-select').on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterStatusValue = $('#filter-status-select').val();
                        let filterTypeValue = $('#filter-type-select').val();
                        let statusColValue = data[6].trim();
                        let typeColValue = data[3].trim();

                        return isFilteredMatched(filterStatusValue, filterTypeValue, statusColValue, typeColValue);
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
        });

        function isFilteredMatched(filterStatusValue, filterTypeValue, statusColValue, typeColValue) {

            if ((filterStatusValue == "all" || statusColValue == filterStatusValue) && (filterTypeValue == "all" || typeColValue == filterTypeValue)) {
                return true;
            }

            return false;
        }
    </script>
@endpush
