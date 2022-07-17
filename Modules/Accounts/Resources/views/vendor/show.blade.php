@extends('accounts::layouts.master')
@section('title', trans('accounts::customer.title'))


@section('content')

    <div class="container">


        <!-- General Information Card -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Journal Detail </h4>
                        <a class="heading-elements-toggle" href=""><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements" style="top: 5px;">
                            <ul class="list-inline mb-1">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="col-md-8">
                                <table class="table">
                                    <!-- Journal Name -->
                                    <tr>
                                        <th>@lang('accounts::fiscal-year.title')</th>
                                        <td>Test Name</td>
                                    </tr>
                                    <!-- Created at -->
                                    <tr>
                                        <th>@lang('labels.created_at')</th>
                                        <td>{{\Carbon\Carbon::now()->diffForHumans()}}</td>
                                    </tr>
                                    <!-- Default Credit Account -->
                                    <tr>
                                        <th>Default Credit Account</th>
                                        <td><a href="#">Economy Code - Economy Name</a></td>
                                    </tr>
                                    <!-- Default Debit Account -->
                                    <tr>
                                        <th>Default Debit Account</th>
                                        <td><a href="#">Economy Code - Economy Head</a></td>
                                    </tr>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Journal Entry  -->
        @include('accounts::journal.entry.index')

    </div>

@endsection



@push('page-js')
    <script src="{{ asset('theme/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/js/scripts/tables/datatables/datatable-advanced.js') }}"
            type="text/javascript"></script>

    <script>

        //        table export configuration
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'pdf',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1],
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });


    </script>

@endpush
