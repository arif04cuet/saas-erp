@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::sales.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::sales.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('sales.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('cafeteria::special-service.bill.bill_make') }}
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered sales-table">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('labels.date')}}</th>
                                        <th>{{trans('cafeteria::sales.bill_to')}}</th>
                                        <th>{{trans('cafeteria::sales.type.title')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->sales_date }}</td>
                                        <td>
                                            @if ($item->reference_type == "employee")
                                                {{ $item->employee->employee_id 
                                                    . ' - ' . $item->employee->first_name .
                                                        ' ' . $item->employee->last_name. ' - ' 
                                                            . $item->employee->mobile_one }}
                                            @elseif($item->reference_type == "training")
                                                {{ $item->training->title }}
                                            @else
                                                {{ $item->reference }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ trans('cafeteria::sales.type.'.$item->reference_type) }}
                                        </td>
                                        <td>
                                            <a href="{{ route('sales.show', $item->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="la la-eye" title="Show Sales"></i>
                                            </a>
                                            <a href="{{ route('sales.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square" title="Edit Sales"></i>
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
    <script>

        $(document).ready(function () {

        let table = $('.sales-table').DataTable({
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
                    <option value="@lang('cafeteria::sales.type.employee')">@lang('cafeteria::sales.type.employee')</option>
                    <option value="@lang('cafeteria::sales.type.training')">@lang('cafeteria::sales.type.training')</option>
                    <option value="@lang('cafeteria::sales.type.regular')">@lang('cafeteria::sales.type.regular')</option>
                    </select>
                {{ trans('labels.records') }}
            </label>
        `);

        $('#filter-type-select').on('change', function () {

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    let filterType = $('#filter-type-select').val();
                    let typeValue = data[3];

                    return filterType === "@lang('labels.all')" || filterType === typeValue;
                }
            );

            table.draw();
            $.fn.dataTable.ext.search.pop();
        });
    });
    </script>
@endpush