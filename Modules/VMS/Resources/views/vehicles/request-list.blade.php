@extends('vms::layouts.master')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mt-2">Today Request Lists</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements" style="top: 10px;">
                    <ul class="list-inline mb-1">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="prescriptions-list-table table table-bordered mt-2">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>Req. Id</th>
                                <th>Vehicle Name</th>
                                <th>Requester Name</th>
                                <th>Designation</th>
                                <th>Request Details</th>
                                <th>Car Details</th>
                                <th width="2%">Request</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>v005</td>
                                <td>Toyota Noah</td>
                                <td>Kalam</td>
                                <td>Axio</td>
                                <td><a href="{{ route('request.details') }}">Click here</a></td>
                                <td><a href="{{ route('vehicles.show') }}">Click here</a></td>
                                <td class="text-center text-green">Approved</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>v025</td>
                                <td>Toyota Corolla</td>
                                <td>Akram</td>
                                <td>Axio</td>
                                <td><a href="{{ route('request.details') }}">Click here</a></td>
                                <td><a href="{{ route('vehicles.show') }}">Click here</a></td>
                                <td class="text-center text-danger">Decline</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('page-css')
    <style>
        .text-green {
            color: #048000 !important;
        }
        #DataTables_Table_0_filter {
            position: absolute !important;
            right: 0;
            top: 0;
        }
        div.dataTables_wrapper {
            position: relative;
        }
    </style>
@endpush

@push('page-js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.prescriptions-list-table').DataTable({
                dom: "lBfrtip",
                "columnDefs": [
                    {"orderable": false, "targets": 5}
                ],
                buttons: ["pdf", "excelHtml5", "print"],

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
                paging: true,
                searching: true,
                "bDestroy": true
            });
        });
    </script>
@endpush
