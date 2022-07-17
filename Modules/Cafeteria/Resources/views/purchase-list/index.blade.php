@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::purchase-list.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::purchase-list.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    @if (!Auth::user()->hasRole(Config::get('constants.cafeteria.roles.cafeteria_manager')))
                        <div class="heading-elements">
                            <a href="{{route('purchase-lists.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('cafeteria::purchase-list.create') }}
                            </a>
                        </div>
                    @endif
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered purchase-list-table">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.date')}}</th>
                                        <th>{{trans('labels.title')}}</th>
                                        <th>{{trans('cafeteria::food-order.requester')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchaseItems as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $item->purchase_date }}
                                        </td>
                                        <td>
                                            {{ $item->title }}
                                        </td>
                                        <td>
                                            {{ $item->user == null ? '' : $item->user->name }}
                                        </td>
                                        <td>
                                            <span class="badge btn-secondary">{{ trans('cafeteria::cafeteria.'.$item->status) }}</span>
                                        </td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                    class="dropdown-menu mt-1 dropdown-menu-right">
                                                @if($item->user_id == Auth::user()->id && Auth::user()->hasRole(Config::get('constants.cafeteria.roles.cafeteria_user')))
                                                    @if ($item->status == "draft")
                                                        <a href="{{ route('purchase-lists.edit', $item->id) }}"
                                                                class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
                                                    @endif
                                                @endif
                                                @if(Auth::user()->hasRole(Config::get('constants.cafeteria.roles.cafeteria_manager')))
                                                    @if($item->status == "pending")
                                                        <a href="{{ route('purchase-lists.approval', $item->id) }}"
                                                            class="dropdown-item"><i class="ft-check-square"></i> {{trans('labels.approve')}}</a>
                                                    @endif
                                                @endif
                                                <a href="{{ route('purchase-lists.show', $item->id) }}"
                                                    class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.show')}}</a>
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
    <script type="text/javascript">

        $(document).ready(function () {

            let table = $('.purchase-list-table').DataTable({
                "stateSave": true,
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
                    {{ trans('labels.filtered') }}
                    <select id="filter-type-select" class="form-control form-control-sm" style="width: 100px">
                        <option value="@lang('labels.all')">@lang('labels.all')</option>
                        <option value="@lang('cafeteria::cafeteria.draft')">@lang('cafeteria::cafeteria.draft')</option>
                        <option value="@lang('cafeteria::cafeteria.pending')">@lang('cafeteria::cafeteria.pending')</option>
                        <option value="@lang('cafeteria::cafeteria.approved')">@lang('cafeteria::cafeteria.approved')</option>
                        <option value="@lang('cafeteria::cafeteria.rejected')">@lang('cafeteria::cafeteria.rejected')</option>
                        </select>
                    {{ trans('labels.records') }}
                </label>
            `);

            $('#filter-type-select').on('change', function () {

                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterType = $('#filter-type-select').val();
                        let typeValue = data[4];

                        return filterType === "@lang('labels.all')" || filterType === typeValue;
                    }
                );

                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
        });
    </script>
@endpush
