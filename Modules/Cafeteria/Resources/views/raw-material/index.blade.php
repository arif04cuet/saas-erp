@extends('cafeteria::layouts.master')
@section('title', trans('cafeteria::raw-material.index'))


@section('content')
<section id="role-list">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ trans('cafeteria::raw-material.index') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    <div class="heading-elements">
                        <a href="{{route('raw-materials.create')}}" class="btn btn-primary btn-sm"><i
                                class="ft-plus white"></i> {{ trans('labels.add') }}
                        </a>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered raw-material-table">
                                <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('cafeteria::raw-material.bangla_name')}}</th>
                                        <th>{{trans('cafeteria::raw-material.english_name')}}</th>
                                        <th>{{trans('cafeteria::raw-material.type.title')}}</th>
                                        <th>{{trans('labels.remarks')}}</th>
                                        <th>{{trans('labels.status')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materials as $material)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $material->bn_name }}
                                        </td>
                                        <td>
                                            {{ $material->en_name }}
                                        </td>
                                        <td>
                                            {{ $material->type == 'finish-food' ? trans('cafeteria::raw-material.type.prepare_food') : trans('cafeteria::raw-material.type.raw_item') }}
                                        </td>
                                        <td>
                                            {{ $material->remark }}
                                        </td>
                                        <td>
                                            <span class="badge {{ $material->status == "active" ? 'badge-success' : 'badge-warning'}}">{{$material->status }}</span>
                                        </td>
                                        <td>
                                            <a title="Edit" href="{{ route('raw-materials.edit', $material->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            {!! Form::open([
                                            'method'=>'PUT',
                                            'url' => route('raw_materials.change_status', $material->id),
                                            'style' => 'display:inline'
                                            ]) !!}
                                            {{ Form::hidden('status', $material->status == "active" ? 'inactive' : 'active') }}
                                            {!! Form::button('<i class="la ft-check-square"></i>', array(
                                            'type' => 'submit',
                                            'class' => $material->status == 'active' ? 'btn btn-warning btn-sm' : 'btn btn-success btn-sm',
                                            'title' => 'update status',
                                            'onclick'=> 'return confirm("Are you sure?")',
                                            )) !!}
                                            {!! Form::close() !!}
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

            let table = $('.raw-material-table').DataTable({
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
                    {{ trans('labels.filtered') }}
                    <select id="filter-type-select" class="form-control form-control-sm" style="width: 100px">
                        <option value="@lang('labels.all')">@lang('labels.all')</option>
                        <option value="@lang('cafeteria::raw-material.type.raw_item')">@lang('cafeteria::raw-material.type.raw_item')</option>
                        <option value="@lang('cafeteria::raw-material.type.prepare_food')">@lang('cafeteria::raw-material.type.prepare_food')</option>
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
