@extends('accounts::layouts.master')
@section('title', trans('accounts::budget.revenue_budget'))


@section('content')

    <section id="role-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ trans('accounts::budget.local_income') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <a href="#" class="btn btn-primary btn-sm"><i
                                    class="ft-plus white"></i> {{ trans('labels.add') }}
                            </a>

                        </div>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered alt-pagination" id="Example1">
                                    <thead>
                                    <tr>
                                        <th>{{trans('labels.serial')}}</th>
                                        <th>{{trans('accounts::fiscal-year.title')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>
                                            <a href="{{route('local-income.show',1)}}">2017-2018</a>
                                        </td>
                                        <td>
                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false" class="btn btn-info dropdown-toggle">
                                                <i class="la la-cog"></i>
                                            </button>
                                            <span aria-labelledby="btnSearchDrop2"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <a href="#"
                                                               class="dropdown-item"><i class="ft-edit"></i> {{trans('labels.edit')}}</a>
                                                        <a href="#"
                                                           class="dropdown-item"><i class="ft-eye"></i> {{trans('labels.details')}}</a>
                                                    </span>
                                        </td>
                                    </tr>

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
