@extends('hm::layouts.master')
@section('title', trans('hm::hm_inventory.hm_inventory_location'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('hm::hm_inventory.hm_inventory_location') @lang('labels.list')</h4>

                        <div class="heading-elements">
                            <a href="{{ route('inventory-locations.create') }}" class="btn btn-primary btn-sm">
                                <i class="ft-plus white"></i> {{trans('ims::location.create_new_location')}}
                            </a>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="location-list-table table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('labels.serial')</th>
                                        <th scope="col">@lang('labels.name')</th>
                                        <th scope="col">@lang('ims::location.department')</th>
                                        <th scope="col">@lang('ims::location.type')</th>
                                        <th scope="col">@lang('labels.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($inventoryLocations as $inventoryLocation)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <a href="{{ route('hm-inventory-locations.show', $inventoryLocation->id) }}">
                                                    {{ $inventoryLocation->name }}
                                                </a>
                                            </td>
                                            <td>{{ $inventoryLocation->department->name }}</td>
                                            <td>@lang('ims::location.' . $inventoryLocation->type)</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="imsProductList" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            class="btn btn-info dropdown-toggle">
                                                        <i class="la la-cog"></i>
                                                    </button>
                                                    <span aria-labelledby="imsProductList"
                                                          class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('hm-inventory-locations.show', $inventoryLocation->id) }}"
                                                           class="dropdown-item"><i
                                                                class="ft-eye"></i> @lang('labels.details')</a>
                                                        <a href="{{ route('inventory-locations.edit', $inventoryLocation->id) }}"
                                                           class="dropdown-item"><i
                                                                class="ft-edit-2"></i> @lang('labels.edit')</a>
                                                    </span>
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
    </section>
@endsection


@push('page-js')
    <script>

        $(document).ready(function () {

            let departmentCode = @json($departmentCode);
            let userDesignationShortName = @json(get_user_designation()->short_name);

            let table = $('.location-list-table').DataTable({
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

            if (departmentCode.trim() == '{{ \App\Constants\DepartmentShortName::InventoryDivision }}' || userDesignationShortName == "DG") {
                $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                    {{ trans('labels.filtered') }}
                <select id="filter-select" class="form-control form-control-sm" style="width: 100px">

                </select>
{{ trans('labels.records') }}
                </label>
`);
            }

            let options = `<option value='all'>All</option>`
                + `<option value='@lang('ims::location.store')'>@lang('ims::location.store')</option>`
                + `<option value='@lang('ims::location.general')'>@lang('ims::location.general')</option>`;

            $('#filter-select').append(options);
            $('#filter-select').val('all');

            $('#filter-select').on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterValue = $('#filter-select').val();
                        let dataValue = data[3].trim();
                        if (filterValue == "all" || dataValue == filterValue) {
                            return true;
                        }
                        return false;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
        });
    </script>



@endpush
