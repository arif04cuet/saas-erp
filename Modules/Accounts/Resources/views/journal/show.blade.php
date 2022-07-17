@extends('accounts::layouts.master')
@section('title', trans('accounts::journal.details'))


@section('content')

    <div class="container">


        <!-- General Information Card -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('accounts::journal.details')</h4>
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
                                        <th>@lang('accounts::journal.title')</th>
                                        <td>{{ $journal->name }}</td>
                                    </tr>

                                    <!-- Created at -->
                                    <tr>
                                        <th>@lang('labels.created_at')</th>
                                        <td>{{ optional($journal->created_at)->diffForHumans() ?? '' }}</td>
                                    </tr>

                                    <!-- Default Credit Account -->
                                    <tr>
                                        <th>@lang('accounts::journal.debit')</th>
                                        <td>{{ $journal->debitAccount->code ?? '' }}</td>
                                    </tr>

                                    <!-- Default Debit Account -->
                                    <tr>
                                        <th>@lang('accounts::journal.credit')</th>
                                        <td>{{ $journal->creditAccount->code ?? ''}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Journal Entry of Journals -->
        {{--        <section id="room-type-list">--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-12">--}}
        {{--                    <div class="card">--}}
        {{--                        <div class="card-header">--}}
        {{--                            <h4 class="card-title">Journal Entry List</h4>--}}
        {{--                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>--}}
        {{--                            <div class="heading-elements">--}}
        {{--                                <a href="{{url(route('journal-entry.create'))}}" class="btn btn-primary btn-sm">--}}
        {{--                                    <i class="ft-plus white"></i> Manual Entry </a>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <div class="card-content collapse show">--}}
        {{--                            <div class="card-body card-dashboard">--}}
        {{--                                <table id="room-type" class="table table-striped table-bordered alt-pagination">--}}
        {{--                                    <thead>--}}
        {{--                                    <tr>--}}
        {{--                                        <th width="5%">@lang('labels.serial')</th>--}}
        {{--                                        <th>Date</th>--}}
        {{--                                        <th width="25%">Invoice #</th>--}}
        {{--                                        <th width="25%">Vendor Name</th>--}}
        {{--                                        <th width="15%">Amount (BDT)</th>--}}
        {{--                                        <th width="15%">Status</th>--}}
        {{--                                        <th width="15%">Action</th>--}}
        {{--                                    </tr>--}}
        {{--                                    </thead>--}}
        {{--                                    <tbody>--}}

        {{--                                    <tr>--}}
        {{--                                        <th scope="row">1</th>--}}
        {{--                                        <td> {{\Carbon\Carbon::now()->format('d/m/Y')}} </td>--}}
        {{--                                        <td><a href="#">INV-001001</a></td>--}}
        {{--                                        <td>Vendor-A</td>--}}
        {{--                                        <td>132.28</td>--}}
        {{--                                        <td>Approved</td>--}}
        {{--                                        <td>--}}
        {{--                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"--}}
        {{--                                                    aria-haspopup="true"--}}
        {{--                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">--}}
        {{--                                                <i class="la la-cog"></i>--}}
        {{--                                            </button>--}}
        {{--                                            <span aria-labelledby="btnSearchDrop2"--}}
        {{--                                                  class="dropdown-menu mt-1 dropdown-menu-right">--}}
        {{--                                                        <a href="{{route('journal.details',1)}}"--}}
        {{--                                                           class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>--}}
        {{--                                                    </span>--}}
        {{--                                        </td>--}}
        {{--                                    </tr>--}}
        {{--                                    </tbody>--}}
        {{--                                </table>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}


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
