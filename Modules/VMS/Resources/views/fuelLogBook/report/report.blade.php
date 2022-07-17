@extends('vms::layouts.master')
@section('title', trans('vms::fuelLogBook.title'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        @include('vms::fuelLogBook.report.form')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-content ">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="company-list-table table table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">{{ trans('labels.serial') }}</th>
                                <th>@lang('vms::fuelLogBook.form_elements.vehicle')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.type')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.fuel_type')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.fuel_quantity')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.filling_station')</th>
                                <th>@lang('vms::fuelLogBook.form_elements.amount')</th>
                                <th>@lang('labels.status')</th>
                                <th>@lang('labels.date')</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('page-js')
    <script type="text/javascript">
        function aplicationAttachmentAdd(id) {
            $('#acknowledgement_slip_id').val('');
            $('#acknowledgement_slip_id').val(id);
        }

        $(document).ready(function () {
            let token = "{{csrf_token()}}";
            let url = "{{ route('vms.fuel.log.report.data') }}";
            var dataTable = $('.company-list-table').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'searching': false,
                "ordering": false,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                'dom': 'lBfrtip',
                'buttons': [
                    'csv', 'excel', 'pdf', 'print'
                ],
                'ajax': {
                    'url': url,
                    'data': function (data) {
                        // Read values
                        let date = $('#date').val();
                        let filling_station_id = $('#filling_station_id').val();
                        if (filling_station_id.length < 1) {
                            filling_station_id = ['ALL'];
                        }
                        $('#DataTables_Table_0_paginate').addClass('hidden');
                        // Append to data
                        data.date = date;
                        data.filling_station_id = filling_station_id;
                        data._token = token;
                    }
                },
                'columns': [
                    {data: 'sl'},
                    {data: 'vehicle_name'},
                    {data: 'vehicle_type'},
                    {data: 'fuel_type'},
                    {data: 'fuel_quantity'},
                    {data: 'filling_station_name'},
                    {data: 'amount'},
                    {data: 'status'},
                    {data: 'date'},
                ]
            });

            $('#date').change(function () {
                dataTable.draw();
            });

            $('#filling_station_id').change(function () {
                dataTable.draw();
            });

        });
    </script>
    <!-- validation -->
    <script type="text/javascript" src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>

    <script>
        $(document).ready(function () {
            validateForm('.company-form');
        });
        $('.select2').select2({
            allowClear: true
        });
    </script>
@endpush
