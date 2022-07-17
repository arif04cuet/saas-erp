@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::inventory.title'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::inventory.title') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered inventory-table">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('cafeteria::raw-material.title')}}</th>
                                        <th>{{trans('cafeteria::inventory.previous_amount')}}</th>
                                        <th>{{trans('cafeteria::inventory.present_amount')}}</th>
                                        <th>{{trans('cafeteria::unit.title')}}</th>
                                        <th>{{trans('cafeteria::raw-material-category.title')}}</th>
                                        <th>{{trans('cafeteria::cafeteria.type')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($collection as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $item->rawMaterial->getName() ?? trans('labels.not_found') }}
                                        </td>
                                        <td>
                                            {{ $item->previous_amount }}
                                        </td>
                                        <td>
                                            {{ $item->available_amount }}
                                        </td>
                                        <td>
                                            {{ $item->rawMaterial->unit->getName() ?? trans('labels.not_found') }}
                                        </td>
                                        <td>
                                            {{ $item->rawMaterial->rawMaterialCategory
                                                        ? $item->rawMaterial->rawMaterialCategory->getName() 
                                                        : trans('labels.not_found') }}
                                        </td>
                                        <td>{{ $item->rawMaterial->type == 'finish-food' ? 
                                                    trans('cafeteria::raw-material.type.prepare_food') : 
                                                    trans('cafeteria::raw-material.type.raw_item') }}
                                        </td>
                                        <td>
                                            <span class="{{ $item->rawMaterial->status == "active" ? 
                                                'badge badge-success' : 
                                                'badge badge-warning' }}">{{ $item->rawMaterial->status }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('cafeteria-inventories.show', $item->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="la la-eye"></i>
                                            </a>
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
    <script type="text/javascript">

        $(document).ready(function () {

            let table = $('.inventory-table').DataTable({
                'stateSave': true,
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
                },
            });


            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                    {{ trans('cafeteria::cafeteria.type') }}
                    <select id="filter-type-select" class="form-control form-control-sm" style="width: 100px">
                        <option value="@lang('labels.all')">@lang('labels.all')</option>
                        <option value="@lang('cafeteria::raw-material.type.raw_item')">@lang('cafeteria::raw-material.type.raw_item')</option>
                        <option value="@lang('cafeteria::raw-material.type.prepare_food')">@lang('cafeteria::raw-material.type.prepare_food')</option>
                        </select>
                </label>
            `);

            $("div.dataTables_filter").prepend(`
                <label style="margin-left: 20px;margin-right: 35px;">
                    {{ trans('cafeteria::raw-material-category.title') }}
                    <select id="filter-category-select" class="form-control form-control-sm" 
                        style="display: inline;  width: 70%;">
                        <option value="@lang('labels.all')">@lang('labels.all')</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                        </select>
                </label>
            `);

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let filterCategoryValue = $('#filter-category-select').val();
                    let filterTypeValue = $('#filter-type-select').val();
                    let catColValue = data[5].trim();
                    let typeColValue = data[6].trim();

                    return isFilteredMatched(filterCategoryValue, filterTypeValue, catColValue, typeColValue);
                }
            );
            table.draw();

            $('#filter-category-select').on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterCategoryValue = $('#filter-category-select').val();
                        let filterTypeValue = $('#filter-type-select').val();
                        let catColValue = data[5].trim();
                        let typeColValue = data[6].trim();

                        return isFilteredMatched(filterCategoryValue, filterTypeValue, catColValue, typeColValue);
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });

            $('#filter-type-select').on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterCategoryValue = $('#filter-category-select').val();
                        let filterTypeValue = $('#filter-type-select').val();
                        let catColValue = data[5].trim();
                        let typeColValue = data[6].trim();

                        return isFilteredMatched(filterCategoryValue, filterTypeValue, catColValue, typeColValue);
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
        });

        function isFilteredMatched(filterCategoryValue, filterTypeValue, catColValue, typeColValue) {

            if ((filterCategoryValue == "@lang('labels.all')" || catColValue == filterCategoryValue) && (filterTypeValue == "@lang('labels.all')" || typeColValue == filterTypeValue)) {
                return true;
            }

            return false;
        }
    </script>
@endpush
