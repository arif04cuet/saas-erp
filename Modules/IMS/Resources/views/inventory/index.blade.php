@extends('ims::layouts.master')

@section('title', trans('ims::inventory.list_page_title'))

@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('ims::inventory.list_page_title')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 10px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">

                                <table class="inventory-list-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="1%">{{trans('labels.serial')}}</th>
                                        <th width="1%">{{trans('ims::group.group_name')}}</th>
                                        <th>@lang('ims::inventory-list-table.columns.name.title')</th>
                                        <th>@lang('ims::inventory.type')</th>
                                        <th>@lang('ims::inventory-list-table.columns.quantity.title')</th>
                                        @foreach($locations as $location)
                                            <th>{{ $location->name }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $sl = 1;
                                        $currentGroup = 0;
                                    @endphp
                                    @foreach($inventoryDetailList as $groupId => $inventoryDetails)
                                        @foreach($inventoryDetails as $item)
                                            <tr>
                                                <th>{{ $sl++ }}</th>
                                                @php
                                                    if(isset($groups[$groupId])){
                                                            $groupName = $groups[$groupId];
                                                     }else{
                                                            $groupName = trans('ims::group.empty_group');
                                                     }
                                                @endphp

                                                @if($currentGroup != $groupId)
                                                    <th>{{ $groupName }}</th>
                                                @elseif(($sl-2) % 10 == 0)
                                                    {{--                                                    Displaying once per 10 item--}}
                                                    <th class="conditionalHide">{{ $groupName }}</th>
                                                @else
                                                    <th class="border-top-0" style="color: white">{{ $groupName }}</th>
                                                @endif
                                                <th>
                                                    <a href="{{ route('inventory.show', ['inventoryItemCategory' => $item['category_id']]) }}">
                                                        {{ $item['category_name'] }}
                                                    </a>
                                                </th>
                                                <th>
                                                    @if($item['type'])
                                                        @lang('ims::inventory.' . preg_replace('/\s+/', '_', $item['type']))
                                                    @endif
                                                </th>
                                                <th>{{ $item['total'] }}</th>
                                                @foreach($locations as $location)
                                                    <th>{{ $item['locations'][$location->id] }}</th>
                                                @endforeach
                                            </tr>
                                            @php
                                                $currentGroup = $groupId;
                                            @endphp
                                        @endforeach
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

    {{--    <script src="//cdn.rawgit.com/ashl1/datatables-rowsgroup/v1.0.0/dataTables.rowsGroup.js"></script>--}}
    <script type="text/javascript">

        $(document).ready(function () {
            let table = $('.inventory-list-table').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": [1, 2]}
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
                // scrollY:        500,
                scrollX: true,
                scrollCollapse: true,
                // paging:         false,
                // fixedColumns:   true,
                fixedColumns: {
                    leftColumns: 3
                },
                // select: true
            });



            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                {{ trans('ims::group.group_name') }}
            <select id="filter-group-select" class="form-control form-control-sm" style="width: 50%;">
            </select>
                {{ trans('labels.records') }}
            </label>`);

            let groups = `<option value='all'>All</option>`
                + `<option value='@lang('ims::group.empty_group')'>@lang('ims::group.empty_group')</option>`
                @foreach($groups as $group)
                + `<option value='{{ $group }}'>{{$group}}</option>`
                @endforeach
            ;

            $('#filter-group-select').append(groups);
            $('#filter-group-select').val('all');

            $('#filter-group-select').on('change', function () {
                groupFiltering();
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });

            function groupFiltering() {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterType = $('#filter-group-select').val();
                        let typeValue = data[1];
                        console.log(typeValue);
                        return filterType === "all" || filterType === typeValue;
                    }
                );

            }

            $("div.dataTables_length").append(`
                <label style="margin-left: 20px">
                 {{ trans('ims::inventory.type') }}
            <select id="filter-type-select" class="form-control form-control-sm" style="width: 50%;">
            </select>
                {{ trans('labels.records') }}
            </label>`);

            let options = `<option value='all'>All</option>`
                + `<option value='@lang('ims::inventory.fixed_asset')'>@lang('ims::inventory.fixed_asset')</option>`
                + `<option value='@lang('ims::inventory.temporary_asset')'>@lang('ims::inventory.temporary_asset')</option>`;

            $('#filter-type-select').append(options);
            $('#filter-type-select').val('all');
            $('#filter-group-select').val('all');

            $('#filter-type-select').on('change', function () {

                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterType = $('#filter-type-select').val();
                        let typeValue = data[3];

                        return filterType === "all" || filterType === typeValue;
                    }
                );

                groupFiltering();
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });


        });

        $(document).ready(function () {
            $("div.dataTables_length").parent().removeClass('col-md-6');
            $("div.dataTables_length").parent().addClass('col-md-9');
            $("div.dataTables_filter").parent().removeClass('col-md-6');
            $("div.dataTables_filter").parent().addClass('col-md-3');
            $("div.dataTables_filter").children().css("margin", "0");
        });
    </script>
@endpush
