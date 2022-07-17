@extends('hrm::layouts.master')
@section('title', trans('hrm::house-details.index'))


@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('hrm::house-details.index') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="{{route('house-details.create')}}" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('labels.add') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="house-list-table">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('hrm::house-details.house_id')}}</th>
                                        <th>{{trans('hrm::house-details.house_type')}}</th>
                                        <th>{{trans('hrm::house-details.location')}}</th>
                                        <th>{{trans('hrm::house-details.capacity')}}</th>
                                        <th>{{trans('hrm::house-details.allocated')}}</th>
                                        <th>{{ trans('labels.status') }}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($houses as $house)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                {{ $house->house_id  ?? trans('labels.not_found')}}
                                            </td>
                                            <td>
                                                {{ optional($house->category)->name  ?? trans('labels.not_found') }}
                                            </td>
                                            <td>
                                                {{ $house->location ?? trans('labels.not_found') }}
                                            </td>
                                            <td width="5%">
                                                {{ $house->capacity  ?? trans('labels.not_found') }}
                                            </td>
                                            <td width="15%">
                                                {{ $house->employee ? $house->employee->getName() : '' }}
                                            </td>
                                            <td>
                                                {{ $house->status }}
                                            </td>
                                            <td width="15%">
                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                    <i class="la la-cog"></i>
                                                </button>
                                                <span aria-labelledby="btnSearchDrop2"
                                                      class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('house-details.show', $house->id) }}"
                                                           class="dropdown-item" title="{{trans('labels.details')}}"><i
                                                                class="la la-eye"></i>{{trans('labels.details')}}</a>
                                                         <a href="{{ route('house-details.edit', $house->id) }}"
                                                            class="dropdown-item" title="{{trans('labels.edit')}}">
                                                                    <i class="la la-pencil-square"></i>{{trans('labels.edit')}}
                                                                </a>
                                                         <a href="{{ route('house-histories', $house->id) }}"
                                                               class="dropdown-item"><i class="ft-check-square"></i> {{trans('hrm::house-details.history.show')}}</a>
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
            let filterElementId = 'house-type-filter';
            let houseCategories = @json($houseCategories);
            let table = $('#house-list-table').DataTable({
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

            let options = '<option value="@lang('labels.all')">@lang('labels.all')</option>';
            for (key in houseCategories) {
                options += `<option value="${houseCategories[key]}">${houseCategories[key]}</option>`
            }
            $("div.dataTables_length").append(`
            <label style="margin-left: 20px">
                {{ trans('labels.filtered') }}
            <select id="${filterElementId}" class="form-control form-control-sm" style="width: 100px">
            ${options}
            </select>
                {{ trans('labels.records') }}
            </label>
            `);

            $('#' + filterElementId).on('change', function () {
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        let filterType = $('#' + filterElementId).val().trim();
                        let typeValue = data[2].trim();
                        console.log(filterType,typeValue);
                        return filterType === "@lang('labels.all')" || filterType === typeValue;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });
        });
    </script>

@endpush
