@extends('hrm::layouts.master')
@section('title', trans('hrm::house-details.history.index'))

@section('content')
    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('hrm::house-details.history.index') }}</h4>
                        <h5 class="mt-3">{{trans('hrm::house-details.house_id')}} - {{ $house->house_id  ?? trans('labels.not_found')}} </h5>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="house-list-table">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('hrm::house-details.allocated')}}</th>
                                        <th>{{trans('hrm::house-details.history.from_date')}}</th>
                                        <th>{{trans('hrm::house-details.history.to_date')}}</th>
                                        <th>{{ trans('labels.status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($house->histories as $history)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                {{ $history->employee ? $history->employee->getName() : trans('labels.not_found') }}
                                            </td>
                                            <td>
                                                {{ date('Y-m-d h:i A', strtotime($history->from_date)) }}
                                            </td>
                                            <td>
                                                {{ $history->to_date ? date('Y-m-d h:i A', strtotime($history->to_date)) : trans('hrm::house-details.history.present') }}
                                            </td>
                                            <td width="5%">
                                                {{ $history->status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <a href="{{route('house-details.index')}}" class="btn btn-danger">
                                    <i class="la la-backward"></i> @lang('labels.back_page')
                                </a>
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

            table.draw();
            $.fn.dataTable.ext.search.pop();
        });
    </script>

@endpush
