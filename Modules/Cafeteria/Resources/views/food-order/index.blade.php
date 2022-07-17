@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::food-order.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::food-order.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('food-orders.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('cafeteria::food-order.create') }}
                            </a>
                        </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered food-order">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.date')}}</th>
                                        <th>{{trans('labels.title')}}</th>
                                        <th>{{trans('cafeteria::sales.bill_to')}}</th>
                                        <th>{{trans('cafeteria::food-order.requester')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($foodOrders as $foodOrder)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ date('Y-m-d h:i A', strtotime($foodOrder->created_at))}}</td>
                                        <td>{{ $foodOrder->title }}</td>
                                        <td>
                                            @if ($foodOrder->reference_type == "employee")
                                                {{ $foodOrder->employee->employee_id
                                                    . ' - ' . $foodOrder->employee->first_name .
                                                        ' ' . $foodOrder->employee->last_name. ' - '
                                                            . $foodOrder->employee->mobile_one }}
                                            @elseif($foodOrder->reference_type == "training")
                                                {{ $foodOrder->training->title }}
                                            @else
                                                {{ $foodOrder->reference }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $foodOrder->user->name }}
                                        </td>
                                        <td>
                                            <span class="badge btn-secondary">{{ trans('cafeteria::cafeteria.'
                                            .$foodOrder->status) }}</span>
                                        </td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                    class="dropdown-menu mt-1 dropdown-menu-right">
                                                @if($foodOrder->requester == Auth::user()->id)
                                                    @if ($foodOrder->status == "draft" || $foodOrder->status == "pending")
                                                        <a href="{{ route('food-orders.edit', $foodOrder->id) }}"
                                                                class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
                                                    @endif
                                                @endif
                                                @if(Auth::user()->hasRole(Config::get('constants.cafeteria.roles.cafeteria_manager')))
                                                    @if($foodOrder->status == "pending")
                                                        <a href="{{ route('food-orders.approval', $foodOrder->id) }}"
                                                            class="dropdown-item"><i class="ft-check-square"></i> {{trans('labels.approve')}}</a>
                                                    @endif
                                                @endif
                                                <a href="{{ route('food-orders.show', $foodOrder->id) }}"
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
    <script>

        $(document).ready(function () {

        let table = $('.food-order').DataTable({
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
                    let typeValue = data[5];

                    return filterType === "@lang('labels.all')" || filterType === typeValue;
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();
        });
    });
    </script>
@endpush
